<?php
use Core\App;
use Core\Database;

$new_content = $_POST["content"];
$blog_id = $_POST["blog_id"] ?? null;
$title = $_POST["title"] ?? null;
$author_id = $_POST["author_id"] ?? null;

if (!isset($blog_id) || !isset($author_id)) {
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
$owner_id = $db
    ->query("SELECT author_id from blogs WHERE id = :id", [
        "id" => (int) $blog_id,
    ])
    ->find();

if ((int) $author_id !== (int) $owner_id["author_id"]) {
    // not authorized
    // TODO: create a not authorized page
    redirect("/");
    http_response_code(401);
    echo json_encode([
        "errors" => "{$owner_id["author_id"]}",
        "author_id" => "{$author_id}",
    ]);
    exit();
}

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
