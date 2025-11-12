<?php

use Core\App;
use Core\Database;
use Core\Notification;
use Core\IntelligentSystem;

$blog_id = (int) $_POST["blog_id"];
$is_schedule = (int) $_POST["is_schedule"];
$schedule_value = $_POST["schedule"];
$categorties = $_POST["categories"];
$text = $_POST["text_content"];

$tags = preg_split("/\s+/", trim($_POST["tags"])); // split by spaces

$followers = [];
$sender;
$notification = new Notification();
$i_s = new IntelligentSystem();

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
    // Publish now
    $db->query(
        "UPDATE blogs SET blog_status = :status, scheduled_at = NOW(), published_at = NOW() WHERE id = :id",
        [
            "id" => $blog_id,
            "status" => "ACTIVE",
        ],
    );

    // Send in app notification
    $sender = $db
        ->query(
            "SELECT 
            blogs.author_id as 'id',
            users.username,
            profile_images.secure_url,
            blogs.title,
            blogs.`content`
            FROM blogs
            INNER JOIN users ON users.id = blogs.author_id
            INNER JOIN profile_images ON profile_images.user_id = blogs.author_id 
            WHERE blogs.id = :blog",
            [
                "blog" => $blog_id,
            ],
        )
        ->find();

    $notification->createBlogNotification($sender["id"], $blog_id);
    $notification->createEmailForBlogPublish($sender, $blog_id);
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

$classification = $i_s->classifyText($text);

if (
    $classification["probability"]["spam"] >= 0.48 ||
    $classification["probability"]["toxic"] >= 0.48
) {
    $category =
        $classification["probability"]["spam"] >
        $classification["probability"]["toxic"]
            ? "SPAM"
            : "HARASSMENT";

    $db->query(
        "INSERT INTO comment_reports (`reporter_id`, `comment_id`, `report_type`, `reason`, `status`, `created_at`)
         VALUES (:user, :comment, :report, :reason, 'PENDING', NOW())",
        [
            "user" => getLoggedInUserId(),
            "comment" => $comment_id,
            "reason" => "Flagged by the Intelligent System",
            "report" => $category,
        ],
    );
}

redirect("/blog/editor?blog_id={$blog_id}");
exit();
