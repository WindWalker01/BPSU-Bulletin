<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$blog_id = $_POST["blog_id"];
$content = $_POST["reply_content"];
$parent_id = $_POST["parent_id"];

$auth = new Authenticator();

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

redirect("/blog?id=" . $blog_id . "#comments");
