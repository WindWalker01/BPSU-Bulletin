<?php
use Core\App;
use Core\Database;

$id = $_GET["id"];

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

if (!isset($id)) {
    http_response_code(500);
    echo json_encode([
        "status" => "unsuccessful",
        "reason" => "user id not defined",
    ]);

    exit();
}

if ($_GET["by"] === "comment") {
    $id = $db
        ->query("SELECT user_id FROM comments WHERE id = :id", ["id" => $id])
        ->find()["user_id"];
}

$db->query("UPDATE users SET account_status = 'BANNED' WHERE id = :id", [
    "id" => $id,
]);

$db->query(
    "INSERT INTO admin_logs(`title`, `description`, `admin_id`) VALUES ('BAN USER', 'banned user id of {$id}', :id)",
    ["id" => getLoggedInUserId()],
);

http_response_code(200);
echo json_encode([
    "status" => "successful",
]);
