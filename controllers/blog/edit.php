<?php
use Core\Database;
use Core\App;

$blog_id = $_POST["blog"] ?? null;
$content = $_POST["content"] ?? null;

if (!$content && !$blog_id) {
    echo json_encode(["error" => "content and author is null"]);
    exit();
}

$json_content = json_encode($content);

$db = App::resolve(Database::class);

$db->query(
    "UPDATE blogs
SET `content` = :content WHERE id = :id",
    ["content" => $content, "id" => $blog_id],
);

echo json_encode(["status" => "ok", "result" => "BLOG UPDATED", "code" => 200]);
http_response_code(200);
exit();
