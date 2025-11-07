<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Notification;
use Core\IntelligentSystem;

$blog_id = $_POST["blog_id"];
$content = $_POST["comment_content"];

$auth = new Authenticator();
$notification = new Notification();
$i_s = new IntelligentSystem();

$user_id = $auth->getLoggedInUserId() ?? null;

if ($user_id === null) {
    redirect("/login");
    exit();
}

$classification = $i_s->classifyText($content);

if ($classification["prediction"] !== "SAFE") {
    redirect("/blog?id={$blog_id}&error=content_not_safe");
    exit();
}

$db = App::resolve(Database::class);

$db->query(
    "INSERT INTO comments (`user_id`, `blog_id`, `content`, `like_count`, `dislike_count`, `parent_id`, `created_at`, `status`)
    VALUES (:user_id, :blog_id, :content, 0, 0, NULL, NOW(), 'ACTIVE')",
    [
        "user_id" => $user_id,
        "blog_id" => $blog_id,
        "content" => $content,
    ],
);

$comment_id = $db->getLastInsertID();

$author_id = $db
    ->query("SELECT author_id FROM blogs WHERE id = :blog_id", [
        "blog_id" => $blog_id,
    ])
    ->find();

$notification->createCommentNotification(
    $user_id,
    $author_id["author_id"],
    $blog_id,
    $content,
);

if (
    $classification["probability"]["spam"] >= 0.48 ||
    $classification["probability"]["toxic"] >= 0.48
) {
    $category =
        $classification["probability"]["spam"] >
        $classification["probability"]["toxic"]
            ? "SPAM"
            : "HARASSMENT";

    $db->query(
        "INSERT INTO comment_reports (`reporter_id`, `comment_id`, `report_type`, `reason`, `status`, `created_at`)
         VALUES (:user, :comment, :report, :reason, 'PENDING', NOW())",
        [
            "user" => getLoggedInUserId(),
            "comment" => $comment_id,
            "reason" => "Flagged by the Intelligent System",
            "report" => $category,
        ],
    );
}

redirect("/blog?id=" . $blog_id . "#comments");
