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

        $blog_details = $this->db
            ->query("SELECT * FROM blogs WHERE id = :blog", ["blog" => $blog])
            ->find();

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
                    "title" => $blog_details["title"],
                    "description" => "Posted",
                    "sender" => $sender,
                    "category" => "GENERAL",
                    "blog" => $blog,
                ],
            );
        }
    }

    function createCommentNotification($sender, $receiver, $blog, $title = "")
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
                "title" => $title,
                "description" => "Comments on your blog",
                "sender" => $sender,
                "category" => "GENERAL",
                "blog" => $blog,
            ],
        );
    }

    function createReplyNotification($sender, $receiver, $blog, $title = "")
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
                "title" => $title,
                "description" => "Replied on your comment",
                "sender" => $sender,
                "category" => "GENERAL",
                "blog" => $blog,
            ],
        );
    }

    function createLikeNotification($sender, $receiver, $blog, $title = "")
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
                "title" => $title,
                "description" => "Likes your",
                "sender" => $sender,
                "category" => "GENERAL",
                "blog" => $blog,
            ],
        );
    }

    function createDislikeNotification($sender, $receiver, $blog, $title = "")
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
                "title" => $title,
                "description" => "Dislikes your",
                "sender" => $sender,
                "category" => "GENERAL",
                "blog" => $blog,
            ],
        );
    }

    function createFollowNotification($receiver, $sender, $title)
    {
        $this->db->query(
            "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, NOW(), 'FOLLOW')",
            [
                "receiver" => $receiver,
                "title" => $title,
                "description" => "Follows",
                "sender" => $sender,
                "category" => "IMPORTANT",
            ],
        );
    }

    function createUnFollowNotification($receiver, $sender, $title)
    {
        $this->db->query(
            "INSERT INTO notifications(
            `receiver_id`, 
            `title`, 
            `description`, 
            `sender_id`, 
            `is_read`, 
            `category`, 
            `created_at`,
            `type`
            )
            VALUES(:receiver, :title, :description, :sender, 0, :category, NOW(), 'FOLLOW')",
            [
                "receiver" => $receiver,
                "title" => $title,
                "description" => "Unfollows",
                "sender" => $sender,
                "category" => "GENERAL",
            ],
        );
    }
}
