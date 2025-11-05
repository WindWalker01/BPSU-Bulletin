<?php
use Core\App;
use Core\Database;
use Core\Notification;

$comment_id = $_GET["commentId"];
$report_id =
    json_decode(file_get_contents("php://input"), true)["reportId"] ?? null;

$db = App::resolve(Database::class);

// if the request comes from the admin panel
if ($report_id !== null) {
    // resolve the comment report
    $db->query(
        "UPDATE comment_reports SET status = 'RESOLVED' WHERE id = :id",
        [
            "id" => $report_id,
        ],
    );
}

if (!isset($comment_id)) {
    http_response_code(500);
    echo json_encode(["id" => $comment_id, "status" => "unsuccessful"]);
}

echo json_encode(["id" => (int) $comment_id]);

$db->query("UPDATE comments SET status = 'REMOVED' WHERE id = :id", [
    "id" => (int) $comment_id,
]);

$db->query(
    "INSERT INTO admin_logs(`title`, `description`, `admin_id`) VALUES ('Removed Comment', 'removed comment with the id of {$comment_id}', :id)",
    ["id" => getLoggedInUserId()],
);

// Send notifications
$notifications = new Notification();

$comment = $db
    ->query("SELECT user_id, blog_id FROM comments WHERE id = :id", [
        "id" => (int) $comment_id,
    ])
    ->find();

$notifications->createRemovedCommentNotification(
    $comment["user_id"],
    $comment["blog_id"],
);

exit();
