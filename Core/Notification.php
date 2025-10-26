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
        $receiver,
        $sender,
        $blog,
        $title,
        $description,
        $category = "GENERAL",
    ) {
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
                "receiver" => $receiver,
                "title" => $title,
                "description" => $description,
                "sender" => $sender,
                "category" => $category,
                "blog" => $blog,
            ],
        );
    }

    function fetchNotifications($receiver) {}
}
