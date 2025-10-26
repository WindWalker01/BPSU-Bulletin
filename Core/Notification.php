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

    function createBlogNotification($sender, $blog)
    {
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
                ["sender" => $sender],
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
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'BLOG')",
                [
                    "receiver" => $follower["id"],
                    "title" => "Title Creation blog",
                    "description" => "Description Creation blog",
                    "sender" => $sender,
                    "category" => "IMPORTANT",
                    "blog" => $blog,
                ],
            );
        }
    }

    function fetchNotifications($receiver) {}

    function createCommentNotification($sender, $receiver, $blog)
    {
        $this->db->query(
            "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `blog_id`,
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'COMMENT')",
            [
                "receiver" => $receiver,
                "title" => "Title Comment Creation ",
                "description" => "Description Comment Creation",
                "sender" => $sender,
                "category" => "IMPORTANT",
                "blog" => $blog,
            ],
        );
    }

    function createReplyNotification($sender, $receiver, $blog)
    {
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
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'REPLY')",
            [
                "receiver" => $receiver,
                "title" => "Title Reply Creation ",
                "description" => "Description Reply Creation",
                "sender" => $sender,
                "category" => "IMPORTANT",
                "blog" => $blog,
            ],
        );
    }

    function createLikeNotification($sender, $receiver, $blog)
    {
        $this->db->query(
            "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `blog_id`,
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'REACTION')",
            [
                "receiver" => $receiver,
                "title" => "Title Like ",
                "description" => "Description Like",
                "sender" => $sender,
                "category" => "IMPORTANT",
                "blog" => $blog,
            ],
        );
    }

    function createDislikeNotification($sender, $receiver, $blog)
    {
        $this->db->query(
            "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `blog_id`,
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'REACTION')",
            [
                "receiver" => $receiver,
                "title" => "Title dislike ",
                "description" => "Description dislike",
                "sender" => $sender,
                "category" => "IMPORTANT",
                "blog" => $blog,
            ],
        );
    }
}
