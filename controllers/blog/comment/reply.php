<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Notification;

$blog_id = $_POST["blog_id"];
$content = $_POST["reply_content"];
$parent_id = $_POST["parent_id"];

$auth = new Authenticator();
$notification = new Notification();

$user_id = $auth->getLoggedInUserId() ?? null;

if ($user_id === null) {
    redirect("/login");
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
        "content" => $content,
    ],
);

// get the id of the replied commentor
$replied_id = $db
    ->query("SELECT user_id from comments WHERE id = :parent_id", [
        "parent_id" => $parent_id,
    ])
    ->find();

$notification->createCommentNotification(
    $user_id,
    $replied_id["user_id"],
    $blog_id,
);

redirect("/blog?id=" . $blog_id . "#comments");
