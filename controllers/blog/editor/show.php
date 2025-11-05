<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$auth = new Authenticator();

$blog = $db
    ->query("SELECT * FROM blogs WHERE id = :id", [
        "id" => (int) $_GET["blog_id"],
    ])
    ->find();

if ($blog["author_id"] !== $auth->getLoggedInUserId()) {
    //TODO: make an unauthorized page
    http_response_code(401);
    redirect("/");
    exit();
}

$user = $db->query("SELECT username FROM users WHERE id = :id", [
    "id" => $auth->getLoggedInUserId()
])->find();

$user_name = $user["username"] ?? "Unknown";

view("blog/editor.view.php", [
    "blog_id" => (int) $_GET["blog_id"],
    "draft_content" => json_decode($blog["content"]) ?? "{}",
    "title" => $blog["title"] ?? "Enter Title",
    "author_id" => $auth->getLoggedInUserId(),
    "editing" => $blog["blog_status"],
    "user_name" => $user_name
]);
