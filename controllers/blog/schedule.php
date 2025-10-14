<?php

use Core\App;
use Core\Database;

$blog_id = (int) $_POST["blog_id"];
$is_schedule = $_POST["is_schedule"];
$schedule_value = $_POST["schedule"];

$db = App::resolve(Database::class);

if ($is_schedule === "true") {
    $db->query(
        "UPDATE blogs SET scheduled_at = STR_TO_DATE(:schedule, '%Y-%m-%dT%H:%i'), blog_status = 'SCHEDULED' WHERE id = :id",
        [
            "id" => $blog_id,
            "schedule" => $schedule_value,
        ],
    );
} else {
    $db->query(
        "UPDATE blogs SET blog_status = :status, scheduled_at = NOW(), published_at = NOW() WHERE id = :id",
        [
            "id" => $blog_id,
            "status" => "ACTIVE",
        ],
    );
}

redirect("/blog/editor?blog_id={$blog_id}");
exit();
