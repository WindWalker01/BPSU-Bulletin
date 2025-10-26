<?php

use Core\App;
use Core\Database;
use Core\Notification;

$blog_id = (int) $_POST["blog_id"];
$is_schedule = (int) $_POST["is_schedule"];
$schedule_value = $_POST["schedule"];
$categorties = $_POST["categories"];

$tags = preg_split("/\s+/", trim($_POST["tags"])); // split by spaces

$followers = [];
$sender;
$notification = new Notification();

$clean_tags = array_map(function ($tag) {
    return ltrim($tag, "#");
}, $tags);

$db = App::resolve(Database::class);

if ($is_schedule === 1) {
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

    $sender = $db
        ->query("SELECT author_id FROM blogs WHERE id = :blog", [
            "blog" => $blog_id,
        ])
        ->find();

    $notification->createNotification(
        $sender["author_id"],
        $blog_id,
        "hello World",
        "Hello World",
        "IMPORTANT",
    );
}

foreach ($categorties as $c) {
    $db->query(
        "INSERT INTO blog_categories(`category_id`, `blog_id`) VALUES (:category, :blog)",
        ["category" => (int) $c, "blog" => (int) $blog_id],
    );
}

foreach ($clean_tags as $ct) {
    $check = $db
        ->query("SELECT COUNT(*) FROM tags WHERE name = :name", [
            "name" => strtolower($ct),
        ])
        ->get()[0]["COUNT(*)"];

    // Check if the tag already exist in the database
    if ($check < 1) {
        $db->query("INSERT INTO tags(`name`) VALUES (:name)", [
            "name" => strtolower($ct),
        ]);
    }

    $id = $db
        ->query("SELECT id FROM tags WHERE name = :name", ["name" => $ct])
        ->find()["id"];

    $db->query(
        "INSERT INTO blog_tags(`tag_id`, `blog_id`) VALUES (:tag, :blog)",
        ["tag" => $id, "blog" => (int) $blog_id],
    );
}

redirect("/blog/editor?blog_id={$blog_id}");
exit();
