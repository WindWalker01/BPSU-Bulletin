<?php

use Core\Database;
use Core\App;
use Core\Authenticator;

$auth = new Authenticator();

$db = App::resolve(Database::class);

$notifications = $db
    ->query(
        "SELECT
            notifications.id, 
            notifications.title,
            notifications.blog_id,
            profile_images.secure_url,
            users.username,
            notifications.sender_id,
            notifications.is_read,
            notifications.description,
            notifications.created_at,
            notifications.category 
        FROM notifications
        INNER JOIN users ON users.id = notifications.sender_id
        INNER JOIN profile_images ON profile_images.user_id = notifications.sender_id
        WHERE notifications.receiver_id = :receiver_id
        ORDER BY notifications.is_read ASC, notifications.created_at DESC",
        [
            "receiver_id" => $auth->getLoggedInUserId(),
        ],
    )
    ->get();

render("notifications.view.php", ["notifications" => $notifications]);
