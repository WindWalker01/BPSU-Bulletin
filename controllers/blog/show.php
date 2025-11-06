<?php
use Core\App;
use Core\Database;
use Core\TiptapExtension\Youtube;
use Core\Authenticator;

$id = $_GET["id"];

if (!isset($id)) {
    redirect("/home");
    exit();
}

$current_user_reaction = null;
$like_count = 0;
$dislike_count = 0;

date_default_timezone_set("Asia/Manila");

$db = App::resolve(Database::class);

$auth = new Authenticator();
$user_id = $auth->getLoggedInUserId();
$blog_id = $_GET["id"];

// Only track if user is logged in
if ($user_id) {
    $existingView = $db
        ->query(
            "SELECT id FROM blog_views WHERE user_id = :user_id AND blog_id = :blog_id",
            [
                "user_id" => $user_id,
                "blog_id" => $blog_id,
            ],
        )
        ->find();

    if (!$existingView) {
        // Insert new view
        $db->query(
            "INSERT INTO blog_views (user_id, blog_id, viewed_at)
             VALUES (:user_id, :blog_id, :viewed_at)",
            [
                "user_id" => $user_id,
                "blog_id" => $blog_id,
                "viewed_at" => date("Y-m-d H:i:s"),
            ],
        );
    }
}

$blog = $db
    ->query(
        "SELECT * FROM blogs 
        INNER JOIN users ON blogs.author_id = users.id 
        INNER JOIN profile_images ON profile_images.user_id = users.id
        WHERE blogs.id = :id",
        ["id" => $id],
    )
    ->find();

if ($blog["blog_status"] === "BANNED") {
    redirect("/appeal?blog={$id}");
    exit();
}

// dd();

$html = new \Tiptap\Editor([
    "extensions" => [
        new \Tiptap\Extensions\StarterKit([
            "codeBlock" => false,
        ]),
        new \Tiptap\Nodes\CodeBlockHighlight(),
        new \Tiptap\Nodes\Image(),
        new Youtube(),
        new \Tiptap\Extensions\TextAlign(["types" => ["heading", "paragraph"]]),
        new \Tiptap\Marks\Underline(),
        new \Tiptap\Marks\Highlight(["multicolor" => true]),
        new \Tiptap\Marks\Link(),
        new \Tiptap\Marks\Subscript(),
        new \Tiptap\Marks\Superscript(),
    ],
])
    ->setContent(json_decode(json_decode($blog["content"]), true))
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
        c.dislike_count,
        c.status,
        u.username,
        u.role,
        u.account_status,
        COALESCE(pi.secure_url, 'https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760538796/default_profile_xgg15t.jpg') AS avatar_url
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

if (isUserLoggedIn()) {
    $reaction_count = $db
        ->query(
            "SELECT 
        SUM(CASE WHEN reaction_id = 1 THEN 1 ELSE 0 END) AS like_count, 
        SUM(CASE WHEN reaction_id = 2 THEN 1 ELSE 0 END) AS dislike_count 
        FROM blog_reactions
        WHERE blog_id = :blog_id",
            ["blog_id" => $id],
        )
        ->get();

    $like_count = $reaction_count[0]["like_count"] ?? 0;
    $dislike_count = $reaction_count[0]["dislike_count"] ?? 0;

    $current_user_reaction = $db
        ->query(
            "SELECT * FROM blog_reactions WHERE user_id = :user_id AND blog_id = :blog_id;",
            [
                "blog_id" => $id,
                "user_id" => new Authenticator()->getLoggedInUserId(),
            ],
        )
        ->findorFail();
}

// Check if the user is already followed to the author
$isFollowed = $db
    ->query(
        "SELECT * FROM follows WHERE follower_id = :follower AND followed_id = :followed",
        [
            "follower" => new Authenticator()->getLoggedInUserId(),
            "followed" => $blog["author_id"] ?? 0,
        ],
    )
    ->findOrFail();

$totalViews = $db
    ->query(
        "SELECT COUNT(*) AS total FROM blog_views WHERE blog_id = :blog_id",
        ["blog_id" => $id],
    )
    ->find();

$viewCount = $totalViews["total"] ?? 0;

// Render the page
render("blog/blog.view.php", [
    "blog_html" => $html,
    "title" => $blog["title"],
    "comment_tree" => $comment_tree,
    "blog_id" => $id,
    "comment_count" => count($comments),
    "like_count" => $like_count,
    "dislike_count" => $dislike_count,
    "current_user_reaction" => (int) $current_user_reaction["reaction_id"],
    "db" => $db,
    "published_at" => DateTime::createFromFormat(
        "Y-m-d H:i:s",
        $blog["updated_at"],
    )->format("F j, Y"),
    "author_profile" => $blog["secure_url"],
    "author_name" => $blog["username"],
    "author_id" => $blog["author_id"],
    "isOwner" =>
        $blog["author_id"] === new Authenticator()->getLoggedInUserId(),
    "isFollowed" => $isFollowed === null ? 0 : 1,
    "view_count" => $viewCount,
]);

// Recursive render
function renderComments($parent_id, $tree, $level = 0, $db)
{
    if (empty($tree[$parent_id])) {
        return;
    }

    foreach ($tree[$parent_id] as $c) {
        $indent =
            $level > 0 ? "border-l border-card-dark pl-2 lg:pl-6 mt-4" : "mt-4";

        $reaction = $db
            ->query(
                "SELECT reaction_id FROM comment_reactions WHERE user_id = :user_id AND comment_id = :comment_id",
                [
                    "user_id" => new Authenticator()->getLoggedInUserId(),
                    "comment_id" => $c["id"],
                ],
            )
            ->findOrFail();
        view("partials/comment-card.php", [
            "comment_id" => $c["id"],
            "indent" => $indent,
            "username" => $c["username"],
            "avatar" => $c["avatar_url"],
            "content" => trim($c["content"]),
            "like_count" => $c["like_count"],
            "dislike_count" => $c["dislike_count"],
            "created_at" => timeAgo($c["created_at"]),
            "blog_id" => $c["blog_id"],
            "reply_parent_id" => $c["id"],
            "user_reaction" => $reaction["reaction_id"],
            "user_id" => $c["user_id"],
            "status" => $c["status"],
            "user_status" => $c["account_status"],
        ]);

        // Recursive call
        renderComments($c["id"], $tree, $level + 1, $db);

        echo "</div></div>"; // close both divs
    }
}
