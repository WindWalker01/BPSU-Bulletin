<?php
use Core\App;
use Core\Database;
use Core\Notification;
use Core\IntelligentSystem;

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

$report_type = $db
    ->query("SELECT report_type FROM blog_reports WHERE blog_id = :id", [
        "id" => $blog_id,
    ])
    ->get();

$analyzed = analyzeReports($report_type);

if ($blog_id === null) {
    http_response_code(500);
    echo json_encode([
        "id" => $blog_id,
        "status" => "unsuccessful",
    ]);
    exit();
}

$content = $db
    ->query("SELECT content FROM blogs WHERE id = :id", ["id" => $blog_id])
    ->find()["content"];

$db->query("UPDATE blogs SET blog_status = 'BANNED' WHERE id = :id", [
    "id" => (int) $blog_id,
]);

$db->query(
    "INSERT INTO admin_logs(`title`, `description`, `admin_id`) VALUES ('Banned Blog', '', :id)",
    ["id" => getLoggedInUserId()],
);

if ($content !== null) {
    $result = new IntelligentSystem()->addTrainingData(
        getTextFromTitapHtml($content),
        $analyzed["spam"],
        $analyzed["toxic"],
    );

    echo json_encode(["result" => $result]);
}

// Send notifications
$notifications = new Notification();

$notifications->createRemovedBlogNotification($author_id, $blog_id);

exit();
