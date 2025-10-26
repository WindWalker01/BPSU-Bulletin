<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Notification;

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

redirect("/blog?id=" . $blog_id . "#comments");
