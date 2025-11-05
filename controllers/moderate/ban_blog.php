<?php
use Core\App;
use Core\Database;
use Core\Notification;

$blog_id = $_GET["blogId"];
$author_id = $_GET["authorId"];

if (!isset($blog_id)) {
    http_response_code(500);
    echo json_encode(["id" => $blog_id, "status" => "unsuccessful"]);
}

echo json_encode(["id" => (int) $blog_id]);

$db = App::resolve(Database::class);

$db->query("UPDATE blogs SET blog_status = 'BANNED' WHERE id = :id", [
    "id" => (int) $blog_id,
]);

$db->query(
    "INSERT INTO admin_logs(`title`, `description`, `admin_id`) VALUES ('Banned Blog', '', :id)",
    ["id" => getLoggedInUserId()],
);

// Send notifications
$notifications = new Notification();

$notifications->createRemovedBlogNotification($author_id, $blog_id);

exit();
