<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Notification;
use Core\IntelligentSystem;

$blog_id = $_POST["blog_id"];
$content = $_POST["reply_content"];
$parent_id = $_POST["parent_id"];

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
    "INSERT INTO comments (`user_id`, `blog_id`, `content`, `like_count`, `dislike_count`, `parent_id`, `created_at`)
    VALUES (:user_id, :blog_id, :content, 0, 0, :parent_id, NOW());",
    [
        "user_id" => (int) $user_id,
        "blog_id" => (int) $blog_id,
        "parent_id" => (int) $parent_id,
        "content" => str_replace(["\n", "\r"], "", $content),
    ],
);

$comment_id = $db->getLastInsertID();

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

// get the id of the replied commentor
$replied_id = $db
    ->query("SELECT user_id from comments WHERE id = :parent_id", [
        "parent_id" => $parent_id,
    ])
    ->find();

$notification->createReplyNotification(
    $user_id,
    $replied_id["user_id"],
    $blog_id,
    $content,
);

redirect("/blog?id=" . $blog_id . "#comments");
