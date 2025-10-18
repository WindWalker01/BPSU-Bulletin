<?php
use Core\App;
use Core\Database;
use Core\TiptapExtension\Youtube;

$id = $_GET["id"];

if (!isset($id)) {
    redirect("/home");
    exit();
}
date_default_timezone_set("Asia/Manila");

$db = App::resolve(Database::class);

$blog = $db->query("SELECT * FROM blogs WHERE id = :id", ["id" => $id])->find();

$html = new \Tiptap\Editor([
    "extensions" => [
        new \Tiptap\Extensions\StarterKit([
            "codeBlock" => false,
        ]),
        new \Tiptap\Nodes\CodeBlockHighlight(),
        new \Tiptap\Nodes\Image(),
        new Youtube(),
    ],
])
    ->setContent(json_decode($blog["content"]))
    ->getHTML();

// Query all the comments and replies
$comments = $db
    ->query(
        "
    SELECT 
        c.id,
        c.parent_id,
        c.user_id,
        c.blog_id,
        c.content,
        c.like_count,
        c.created_at,
        u.username,
        u.role,
        COALESCE(pi.secure_url, 'https://i.pravatar.cc/40') AS avatar_url
    FROM comments c
    JOIN users u ON c.user_id = u.id
    LEFT JOIN profile_images pi ON u.id = pi.user_id
    WHERE c.blog_id = :id
    ORDER BY c.created_at ASC
",
        ["id" => $id],
    )
    ->get();

// Setup the comment and replies structure
$comment_tree = [];
foreach ($comments as $comment) {
    $parent_id = $comment["parent_id"] ?? 0;
    $comment_tree[$parent_id][] = $comment;
}

// Render the page
render("blog/blog.view.php", [
    "blog_html" => $html,
    "title" => $blog["title"],
    "comment_tree" => $comment_tree,
    "blog_id" => $id,
]);

// Helper to render time ago
function timeAgo($datetime)
{
    $time = strtotime($datetime);
    $diff = time() - $time;
    if ($diff < 60) {
        return $diff . "s ago";
    }
    if ($diff < 3600) {
        return floor($diff / 60) . "m ago";
    }
    if ($diff < 86400) {
        return floor($diff / 3600) . "h ago";
    }
    return floor($diff / 86400) . "d ago";
}

// Recursive render
function renderComments($parent_id, $tree, $level = 0)
{
    if (empty($tree[$parent_id])) {
        return;
    }

    foreach ($tree[$parent_id] as $c) {
        $indent = $level > 0 ? "border-l border-gray-700 pl-6 mt-4" : "mt-4";
        view("partials/comment-card.php", [
            "indent" => $indent,
            "username" => $c["username"],
            "avatar" => $c["avatar_url"],
            "content" => $c["content"],
            "like_count" => $c["like_count"],
            "created_at" => timeAgo($c["created_at"]),
            "blog_id" => $c["blog_id"],
            "reply_parent_id" => $c["id"],
        ]);

        // Recursive call
        renderComments($c["id"], $tree, $level + 1);

        echo "</div></div>"; // close both divs
    }
}
