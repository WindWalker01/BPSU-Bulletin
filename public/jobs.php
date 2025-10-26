<?php
use Core\App;
use Core\Database;
use Core\Notification;

$notification = new Notification();

$db = App::resolve(Database::class);

$blogs = $db
    ->query(
        "SELECT id
        FROM blogs
        WHERE blog_status = 'SCHEDULED' AND scheduled_at <= NOW();",
    )
    ->get();

$db->query(
    "UPDATE blogs SET blog_status = 'ACTIVE', published_at = NOW() WHERE blog_status = 'SCHEDULED' AND scheduled_at <= NOW()",
);

foreach ($blogs as $blog_id) {
    $sender = $db
        ->query("SELECT author_id FROM blogs WHERE id = :blog", [
            "blog" => $blog_id["id"],
        ])
        ->find();

    foreach ($followers as $follower) {
        $notification->createNotification(
            $sender["author_id"],
            $blog_id["id"],
            "hello World",
            "Hello World",
            "IMPORTANT",
        );
    }
}
