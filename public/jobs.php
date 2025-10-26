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

    // Get all the followers that has enabled in app notification
    $followers = $db
        ->query(
            "SELECT users.id
            FROM users
            INNER JOIN user_preferences ON user_preferences.user_id = users.id
            INNER JOIN follows ON follows.follower_id = users.id  -- CORRECT: Link the user being selected (the follower)
            WHERE user_preferences.push_notification = 1 
            AND follows.followed_id = :sender                 -- Filter by the user they are following (the sender)
            AND users.id != :sender",
            ["sender" => $sender["author_id"]],
        )
        ->get();

    foreach ($followers as $follower) {
        $notification->createNotification(
            $follower["id"],
            $sender["author_id"],
            $blog_id["id"],
            "hello World",
            "Hello World",
            "IMPORTANT",
        );
    }
}
