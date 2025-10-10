<?php
use Core\App;
use Core\Database;

$new_content = $_POST["content"];
$blog_id = $_POST["blog_id"];

if (!isset($new_content) && !isset($blog_id)) {
    echo json_encode(["error" => "new content and blog id not set"]);
    exit();
}

$db = App::resolve(Database::class);

$db->query("UPDATE blogs SET content = :content WHERE id = :id", [
    "content" => json_encode($new_content),
    "id" => $blog_id,
]);
