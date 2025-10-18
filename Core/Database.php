<?php

namespace Core;
use PDO;

class Database
{
    private $connection;
    public $statement;

    private $sample_content = "{\n  \"type\": \"doc\",\n  \"content\": [\n    {\n      \"type\": \"heading\",\n      \"attrs\": {\n        \"textAlign\": null,\n        \"level\": 1\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Getting started\"\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": null\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Welcome to the \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"italic\"\n            },\n            {\n              \"type\": \"highlight\",\n              \"attrs\": {\n                \"color\": \"var(--tt-color-highlight-yellow)\"\n              }\n            }\n          ],\n          \"text\": \"Simple Editor\"\n        },\n        {\n          \"type\": \"text\",\n          \"text\": \" template! This template integrates \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"bold\"\n            }\n          ],\n          \"text\": \"open source\"\n        },\n        {\n          \"type\": \"text\",\n          \"text\": \" UI components and Tiptap extensions licensed under \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"bold\"\n            }\n          ],\n          \"text\": \"MIT\"\n        },\n        {\n          \"type\": \"text\",\n          \"text\": \".\"\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": null\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Integrate it by following the \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"link\",\n              \"attrs\": {\n                \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor\",\n                \"target\": \"_blank\",\n                \"rel\": \"noopener noreferrer nofollow\",\n                \"class\": null\n              }\n            }\n          ],\n          \"text\": \"Tiptap UI Components docs\"\n        },\n        {\n          \"type\": \"text\",\n          \"text\": \" or using our CLI tool.\"\n        }\n      ]\n    },\n    {\n      \"type\": \"codeBlock\",\n      \"attrs\": {\n        \"language\": null\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"npx @tiptap/cli init\"\n        }\n      ]\n    },\n    {\n      \"type\": \"heading\",\n      \"attrs\": {\n        \"textAlign\": null,\n        \"level\": 2\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Features\"\n        }\n      ]\n    },\n    {\n      \"type\": \"blockquote\",\n      \"content\": [\n        {\n          \"type\": \"paragraph\",\n          \"attrs\": {\n            \"textAlign\": null\n          },\n          \"content\": [\n            {\n              \"type\": \"text\",\n              \"marks\": [\n                {\n                  \"type\": \"italic\"\n                }\n              ],\n              \"text\": \"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \"\n            },\n            {\n              \"type\": \"text\",\n              \"marks\": [\n                {\n                  \"type\": \"code\"\n                }\n              ],\n              \"text\": \"**\"\n            },\n            {\n              \"type\": \"text\",\n              \"marks\": [\n                {\n                  \"type\": \"italic\"\n                }\n              ],\n              \"text\": \" or use keyboard shortcuts \"\n            },\n            {\n              \"type\": \"text\",\n              \"marks\": [\n                {\n                  \"type\": \"code\"\n                }\n              ],\n              \"text\": \"⌘+B\"\n            },\n            {\n              \"type\": \"text\",\n              \"text\": \" for \"\n            },\n            {\n              \"type\": \"text\",\n              \"marks\": [\n                {\n                  \"type\": \"strike\"\n                }\n              ],\n              \"text\": \"most\"\n            },\n            {\n              \"type\": \"text\",\n              \"text\": \" all common markdown marks. 🪄\"\n            }\n          ]\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": \"left\"\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Add images, customize alignment, and apply \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"highlight\",\n              \"attrs\": {\n                \"color\": \"var(--tt-color-highlight-blue)\"\n              }\n            }\n          ],\n          \"text\": \"advanced formatting\"\n        },\n        {\n          \"type\": \"text\",\n          \"text\": \" to make your writing more engaging and professional.\"\n        }\n      ]\n    },\n    {\n      \"type\": \"image\",\n      \"attrs\": {\n        \"src\": \"/images/tiptap-ui-placeholder-image.jpg\",\n        \"alt\": \"placeholder-image\",\n        \"title\": \"placeholder-image\"\n      }\n    },\n    {\n      \"type\": \"bulletList\",\n      \"content\": [\n        {\n          \"type\": \"listItem\",\n          \"content\": [\n            {\n              \"type\": \"paragraph\",\n              \"attrs\": {\n                \"textAlign\": \"left\"\n              },\n              \"content\": [\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"bold\"\n                    }\n                  ],\n                  \"text\": \"Superscript\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \" (x\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"superscript\"\n                    }\n                  ],\n                  \"text\": \"2\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \") and \"\n                },\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"bold\"\n                    }\n                  ],\n                  \"text\": \"Subscript\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \" (H\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"subscript\"\n                    }\n                  ],\n                  \"text\": \"2\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \"O) for precision.\"\n                }\n              ]\n            }\n          ]\n        },\n        {\n          \"type\": \"listItem\",\n          \"content\": [\n            {\n              \"type\": \"paragraph\",\n              \"attrs\": {\n                \"textAlign\": \"left\"\n              },\n              \"content\": [\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"bold\"\n                    }\n                  ],\n                  \"text\": \"Typographic conversion\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \": automatically convert to \"\n                },\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"code\"\n                    }\n                  ],\n                  \"text\": \"->\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \" an arrow \"\n                },\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"bold\"\n                    }\n                  ],\n                  \"text\": \"→\"\n                },\n                {\n                  \"type\": \"text\",\n                  \"text\": \".\"\n                }\n              ]\n            }\n          ]\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": \"left\"\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"italic\"\n            }\n          ],\n          \"text\": \"→ \"\n        },\n        {\n          \"type\": \"text\",\n          \"marks\": [\n            {\n              \"type\": \"link\",\n              \"attrs\": {\n                \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\",\n                \"target\": \"_blank\",\n                \"rel\": \"noopener noreferrer nofollow\",\n                \"class\": null\n              }\n            }\n          ],\n          \"text\": \"Learn more\"\n        }\n      ]\n    },\n    {\n      \"type\": \"horizontalRule\"\n    },\n    {\n      \"type\": \"heading\",\n      \"attrs\": {\n        \"textAlign\": \"left\",\n        \"level\": 2\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Make it your own\"\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": \"left\"\n      },\n      \"content\": [\n        {\n          \"type\": \"text\",\n          \"text\": \"Switch between light and dark modes, and tailor the editor's appearance with customizable CSS to match your style.\"\n        }\n      ]\n    },\n    {\n      \"type\": \"taskList\",\n      \"content\": [\n        {\n          \"type\": \"taskItem\",\n          \"attrs\": {\n            \"checked\": true\n          },\n          \"content\": [\n            {\n              \"type\": \"paragraph\",\n              \"attrs\": {\n                \"textAlign\": \"left\"\n              },\n              \"content\": [\n                {\n                  \"type\": \"text\",\n                  \"text\": \"Test template\"\n                }\n              ]\n            }\n          ]\n        },\n        {\n          \"type\": \"taskItem\",\n          \"attrs\": {\n            \"checked\": false\n          },\n          \"content\": [\n            {\n              \"type\": \"paragraph\",\n              \"attrs\": {\n                \"textAlign\": \"left\"\n              },\n              \"content\": [\n                {\n                  \"type\": \"text\",\n                  \"marks\": [\n                    {\n                      \"type\": \"link\",\n                      \"attrs\": {\n                        \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor\",\n                        \"target\": \"_blank\",\n                        \"rel\": \"noopener noreferrer nofollow\",\n                        \"class\": null\n                      }\n                    }\n                  ],\n                  \"text\": \"Integrate the free template\"\n                }\n              ]\n            }\n          ]\n        }\n      ]\n    },\n    {\n      \"type\": \"paragraph\",\n      \"attrs\": {\n        \"textAlign\": \"left\"\n      }\n    }\n  ]\n}\n";

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
        `campus` enum('MAIN','BALANGA','ABUCAY','ORANI','DINALUPIHAN','BAGAC') DEFAULT NULL,
        `bio` longtext,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `blogs` (
        `id` int NOT NULL AUTO_INCREMENT,
        `author_id` int DEFAULT NULL,
        `blog_status` enum('ACTIVE','DELETED','HIDDEN','SCHEDULED') DEFAULT NULL,
        `content` json DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `scheduled_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
        `published_at` timestamp NULL DEFAULT NULL,
        `categories` enum('ANNOUNCEMENT','ORGANIZATION','ACHIEVEMENT','SCHOLARSHIP','ENROLLMENT') DEFAULT NULL,
        `campus` enum('MAIN','BALANGA','ABUCAY','ORANI','DINALUPIHAN','BAGAC') DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `author_id` (`author_id`),
        CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `reactions` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        `emoji` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `notifications` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int DEFAULT NULL,
        `title` varchar(255) DEFAULT NULL,
        `description` text,
        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `comments` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int DEFAULT NULL,
        `blog_id` int DEFAULT NULL,
        `content` text,
        `like_count` int NOT NULL DEFAULT '0',
        `parent_id` int DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `dislike_count` int NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        KEY `blog_id` (`blog_id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
        CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `admin_logs` (
        `id` int NOT NULL AUTO_INCREMENT,
        `status` enum('PENDING','APPROVED','REJECTED') DEFAULT NULL,
        `title` varchar(255) DEFAULT NULL,
        `description` text,
        `admin_id` int DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `admin_id` (`admin_id`),
        CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `profile_images` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int DEFAULT NULL,
        `secure_url` text,
        `asset_id` text,
        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `profile_images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `blog_images` (
        `id` int NOT NULL AUTO_INCREMENT,
        `blog_id` int DEFAULT NULL,
        `secure_url` text,
        `asset_id` text,
        PRIMARY KEY (`id`),
        KEY `blog_id` (`blog_id`),
        CONSTRAINT `blog_images_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "CREATE TABLE `comment_reactions` (
        `id` int NOT NULL AUTO_INCREMENT,
        `comment_id` int DEFAULT NULL,
        `user_id` int DEFAULT NULL,
        `reaction_id` int DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `comment_id` (`comment_id`),
        KEY `user_id` (`user_id`),
        KEY `reaction_id` (`reaction_id`),
        CONSTRAINT `comment_reaction_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
        CONSTRAINT `comment_reaction_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
        CONSTRAINT `comment_reaction_ibfk_4` FOREIGN KEY (`reaction_id`) REFERENCES `reactions` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci",

        "INSERT INTO `reactions` (`id`, `name`, `emoji`) VALUES(1, 'like', '👍');",
        "INSERT INTO `reactions` (`id`, `name`, `emoji`) VALUES(2, 'dislike', '👎');",

        "INSERT INTO `users` (`role`, `username`, `email`, `password`, `account_status`, `created_at`, `auth_provider`) VALUES
        ('AUTHOR', 'test_author', 'testAuthor@gmail.com', '\$argon2id\$v=19\$m=65536,t=4,p=1\$NUhHTjVwY1gybzRMT1RKcQ\$svAFH9wXoxmYwFc1vidrXDYgypWuqiLMYIjVAjbiyQQ', 'ACTIVE', '2025-10-10 14:29:05', 'LOCAL');",
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

    public function getLastInsertID()
    {
        return $this->connection->lastInsertId();
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
            return null;
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

        $content = json_encode($this->sample_content);
        $testDBConnection->exec(
            "INSERT INTO `blogs` (`author_id`, `blog_status`, `content`, `created_at`, `scheduled_at`, `title`) VALUES
        (1, 'HIDDEN', {$content}, '2025-10-10 14:29:05', '2025-10-10 14:29:05', 'Getting Started');",
        );

        // add profile image to the sample author
        $testDBConnection->exec("INSERT INTO `profile_images` (`user_id`, `secure_url`, `asset_id`) VALUES
(1, 'https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760671868/bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0.jpg', 'bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0');");
    }
}
