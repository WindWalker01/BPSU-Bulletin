<?php

namespace Core;

use Core\Database;
use Core\App;

class Notification
{
    private $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    function createNotification(
        $sender,
        $blog,
        $title,
        $description,
        $category = "GENERAL",
    ) {
        // Get all the followers that has enabled in app notification
        $followers = $this->db
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
            $this->db->query(
                "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `blog_id`,
            `created_at`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW())",
                [
                    "receiver" => $follower["id"],
                    "title" => $title,
                    "description" => $description,
                    "sender" => $sender,
                    "category" => $category,
                    "blog" => $blog,
                ],
            );
        }
    }

    function fetchNotifications($receiver) {}
}
