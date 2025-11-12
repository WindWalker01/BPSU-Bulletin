<?php
use Core\Database;
use Core\App;

$report_id = $_POST["id"];
$report_type = $_POST["reportType"];
$category = $_POST["category"];
$reason = $_POST["reason"] ?? "";
$blog_id = $_POST["blogId"] ?? "";

$db = App::resolve(Database::class);

if ($report_type === "BLOG") {
    $db->query(
        "INSERT INTO blog_reports (`reporter_id`, `blog_id`, `report_type`, `reason`, `status`, `created_at`)
         VALUES (:user, :blog, :report, :reason, 'PENDING', NOW())",
        [
            "user" => getLoggedInUserId(),
            "blog" => $report_id,
            "reason" => $reason,
            "report" => $category,
        ],
    );
} elseif ($report_type === "COMMENT") {
    $db->query(
        "INSERT INTO comment_reports (`reporter_id`, `comment_id`, `report_type`, `reason`, `status`, `created_at`)
         VALUES (:user, :comment, :report, :reason, 'PENDING', NOW())",
        [
            "user" => getLoggedInUserId(),
            "comment" => $report_id,
            "reason" => $reason,
            "report" => $category,
        ],
    );
}
redirect("/blog?id={$blog_id}");
exit();
