<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Notification;
use Google\Service\ServiceControl\Auth;

$blog_id = $_POST["blog_id"];
$content = $_POST["comment_content"];

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
    VALUES (:user_id, :blog_id, :content, 0, 0, NULL, NOW())",
    [
        "user_id" => $user_id,
        "blog_id" => $blog_id,
        "content" => $content,
    ],
);

$author_id = $db
    ->query("SELECT author_id FROM blogs WHERE id = :blog_id", [
        "blog_id" => $blog_id,
    ])
    ->find();

$notification->createCommentNotification(
    $user_id,
    $author_id["author_id"],
    $blog_id,
);

redirect("/blog?id=" . $blog_id . "#comments");
