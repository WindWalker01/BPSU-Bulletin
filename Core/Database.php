<?php

namespace Core;
use PDO;

class Database
{
    public $connection;
    public $statement;

    private $sql = [
        "CREATE TABLE `users` (
        `id` int NOT NULL AUTO_INCREMENT,
        `role` enum('USER','AUTHOR','ADMIN') DEFAULT NULL,
        `username` varchar(255) DEFAULT NULL,
        `email` varchar(255) DEFAULT NULL,
        `password` varchar(255) DEFAULT NULL,
        `account_status` enum('ACTIVE','DELETED') DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `auth_provider` enum('LOCAL','GOOGLE') NOT NULL DEFAULT 'LOCAL',
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `blogs` (
            `id` int NOT NULL AUTO_INCREMENT,
            `author_id` int DEFAULT NULL,
            `blog_status` enum('ACTIVE','DELETED','HIDDEN') DEFAULT NULL,
            `content` json DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `scheduled_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `author_id` (`author_id`),
            CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `user_reports` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `reported_id` int DEFAULT NULL,
            `report_type` enum('SEXUAL','VIOLENT','HARMFUL','HARRASSMENT','SELF_HARM') DEFAULT NULL,
            `reason_description` text,
            `created_at` timestamp NULL DEFAULT NULL,
            `status` enum('PENDING','RESOLVED') DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            KEY `reported_id` (`reported_id`),
            CONSTRAINT `user_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `user_reports_ibfk_2` FOREIGN KEY (`reported_id`) REFERENCES `users` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `user_preferences` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `theme_preference` enum('LIGHT','DARK') DEFAULT NULL,
            `email_notification` tinyint(1) DEFAULT NULL,
            `push_notification` tinyint(1) DEFAULT NULL,
            `reaction_notification` tinyint(1) DEFAULT NULL,
            `follow_notification` tinyint(1) DEFAULT NULL,
            `show_email_public` tinyint(1) DEFAULT NULL,
            `show_profile_public` tinyint(1) DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `user_preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",
        "CREATE TABLE `tags` (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",
        "CREATE TABLE `reactions` (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `emoji` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `notifications` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `title` varchar(255) DEFAULT NULL,
            `description` text,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `follows` (
            `id` int NOT NULL AUTO_INCREMENT,
            `follower_id` int DEFAULT NULL,
            `followed_id` int DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `follower_id` (`follower_id`),
            KEY `followed_id` (`followed_id`),
            CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `comments` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `blog_id` int DEFAULT NULL,
            `content` text,
            `like_count` int DEFAULT NULL,
            `parent_id` int DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `blog_id` (`blog_id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
            CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `blog_views` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `blog_id` int DEFAULT NULL,
            `viewed_at` timestamp NULL DEFAULT NULL,
            `platform` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `blog_id` (`blog_id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `blog_views_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
            CONSTRAINT `blog_views_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `blog_tags` (
            `id` int NOT NULL AUTO_INCREMENT,
            `tag_id` int DEFAULT NULL,
            `blog_id` int DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `tag_id` (`tag_id`),
            KEY `blog_id` (`blog_id`),
            CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
            CONSTRAINT `blog_tags_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `blog_reports` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `target_id` int DEFAULT NULL,
            `report_type` enum('SEXUAL','VIOLENT','HARMFUL','HARRASSMENT','SELF_HARM') DEFAULT NULL,
            `reason` text,
            `status` enum('PENDING','RESOLVED') DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            KEY `target_id` (`target_id`),
            CONSTRAINT `blog_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            CONSTRAINT `blog_reports_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `blogs` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `blog_reactions` (
            `id` int NOT NULL AUTO_INCREMENT,
            `blog_id` int DEFAULT NULL,
            `reaction_id` int DEFAULT NULL,
            `user_id` int DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `blog_id` (`blog_id`),
            KEY `reaction_id` (`reaction_id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `blog_reactions_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
            CONSTRAINT `blog_reactions_ibfk_2` FOREIGN KEY (`reaction_id`) REFERENCES `reactions` (`id`) ON DELETE CASCADE,
            CONSTRAINT `blog_reactions_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

        "CREATE TABLE `admin_logs` (
            `id` int NOT NULL AUTO_INCREMENT,
            `status` enum('PENDING','APPROVED','REJECTED') DEFAULT NULL,
            `title` varchar(255) DEFAULT NULL,
            `description` text,
            `admin_id` int DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `admin_id` (`admin_id`),
            CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",
    ];

    public function __construct($config)
    {
        $this->migrations($config);
        $this->connection = $this->create_db_connection($config);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            dd("QUERY FAILED!");
            //TODO: IMPLEMENT THIS
        }

        return $result;
    }

    public function create_db_connection($config)
    {
        $dsn = "mysql:" . http_build_query($config["database"], "", ";");

        return new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );
    }

    protected function migrations($config)
    {
        $dsn = "mysql:host=" . $config["database"]["host"] . ";charset=utf8mb4";

        $testDBConnection = new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        );

        // Check if the DB exists
        $stmt = $testDBConnection->prepare("SHOW DATABASES LIKE ?");
        $stmt->execute([$config["database"]["dbname"]]);

        if ($stmt->fetch()) {
            echo "<script>console.log('db already exist');</script>";
            return;
        }

        // Create database
        $testDBConnection->exec(
            "CREATE DATABASE IF NOT EXISTS " . $config["database"]["dbname"],
        );

        $testDBConnection->exec("USE {$config["database"]["dbname"]}");

        //Create tables
        foreach ($this->sql as $query) {
            $testDBConnection->exec($query);
        }

        echo "<script>console.log('DB Created 😍');</script>";
    }
}