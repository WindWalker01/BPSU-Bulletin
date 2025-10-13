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

view("blog/editor.view.php", [
    "blog_id" => (int) $_GET["blog_id"],
    "draft_content" => json_decode($blog["content"]) ?? "{}",
    "title" => $blog["title"] ?? "Enter Title",
]);
