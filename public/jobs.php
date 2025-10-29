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

    foreach ($followers as $follower) {
        $notification->createBlogNotification(
            $sender["id"],
            $blog_id["id"],
            "hello World",
            "Hello World",
            "IMPORTANT",
        );

        $notification->createEmailForBlogPublish($sender, $blog_id["id"]);
    }
}
