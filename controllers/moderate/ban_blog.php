<?php
use Core\App;
use Core\Database;
use Core\Notification;

$blog_id = $_GET["blogId"] ?? null;
$author_id = $_GET["authorId"] ?? null;

$db = App::resolve(Database::class);

// this is for the admin.view.php
if ($blog_id === null && $author_id === null) {
    $input = json_decode(file_get_contents("php://input"), true);

    $blog_id = $input["blogId"] ?? null;
    $author_id = $input["authorId"] ?? null;
    $report_id = $input["reportId"] ?? null;

    if ($report_id === null) {
        http_response_code(500);
        echo json_encode([
            "status" => "unsuccessful",
            "input" => $input,
        ]);
        exit();
    }

    $db->query("UPDATE blog_reports SET status = 'RESOLVED' WHERE id = :id", [
        "id" => $report_id,
    ]);
}

if ($blog_id === null) {
    http_response_code(500);
    echo json_encode([
        "id" => $blog_id,
        "status" => "unsuccessful",
    ]);
    exit();
}

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
