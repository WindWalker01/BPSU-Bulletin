<?php
use Core\App;
use Core\Database;

$input = json_decode(file_get_contents("php://input"), true);

$id = $input["id"] ?? null;

if ($id === null) {
    http_response_code(500);
    echo json_encode([
        "id" => $id,
        "status" => "unsuccessful",
        "input" => $input,
    ]);
    exit();
}

$db = App::resolve(Database::class);

$db->query("UPDATE blog_reports SET status = 'RESOLVED' WHERE id = :id", [
    "id" => $id,
]);

$db->query(
    "INSERT INTO admin_logs(`title`, `description`, `admin_id`) VALUES ('Decline report of blog', 'declined of banning a blog reprot #{$id}')",
);

exit();
