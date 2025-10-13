<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$auth = new Authenticator();

$blog = $db
    ->query("SELECT * FROM blogs WHERE id = :id", [
        "id" => 1,
    ])
    ->find();

view("blog/editor.view.php", [
    "blog_id" => 1,
    "draft_content" => json_decode($blog["content"]) ?? "{}",
    "title" => $blog["title"] ?? "Enter Title",
]);
