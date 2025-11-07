<?php
use Core\App;
use Core\Database;
use Core\Notification;

$appeal = $_GET["appeal_id"] ?? null;
$author_id = $_GET["author_id"] ?? null;
$blog_id = $_GET["blog_id"] ?? null;

if ($blog_id === null || $appeal === null || $author_id === null) {
    http_response_code(400);
    echo json_encode([
        "status" => "unsuccessful",
        "reason" => "blog id, appeal id or author id not set",
    ]);
    exit();
}

$db = App::resolve(Database::class);

$db->query("UPDATE appeals SET status = 'RESOLVED' WHERE id = :id", [
    "id" => $appeal,
]);

new Notification()->createRejectAppealNotification($author_id, $blog_id);

echo json_encode([
    "status" => "successful",
    "response" => "appeal has been rejected",
]);
exit();
