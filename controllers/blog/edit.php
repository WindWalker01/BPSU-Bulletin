<?php
use Core\App;
use Core\Database;

$new_content = $_POST["content"];
$blog_id = $_POST["blog_id"] ?? null;
$title = $_POST["title"] ?? null;

if (!isset($blog_id)) {
    http_response_code(500);
    echo json_encode(["error" => "blog id not set"]);
    exit();
}

if (!isset($title) && !isset($new_content)) {
    http_response_code(500);
    echo json_encode(["error" => "content and title not set"]);
    exit();
}

$db = App::resolve(Database::class);

if (!isset($title)) {
    $db->query("UPDATE blogs SET content = :content WHERE id = :id", [
        "content" => json_encode($new_content),
        "id" => $blog_id,
    ]);
} elseif (!isset($new_content)) {
    $db->query("UPDATE blogs SET title = :title WHERE id = :id", [
        "title" => $title,
        "id" => $blog_id,
    ]);
} else {
    $db->query(
        "UPDATE blogs SET content = :content, title = :title WHERE id = :id",
        [
            "content" => json_encode($new_content),
            "title" => $title,
            "id" => $blog_id,
        ],
    );
}
