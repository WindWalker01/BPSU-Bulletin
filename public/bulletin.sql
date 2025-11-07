/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `admin_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `appeals`;
CREATE TABLE `appeals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `reason` text,
  `status` enum('PENDING','RESOLVED') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `appeals_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `appeals_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_categories_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_images`;
CREATE TABLE `blog_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blog_id` int DEFAULT NULL,
  `secure_url` text,
  `asset_id` text,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `blog_images_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_reactions`;
CREATE TABLE `blog_reactions` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_reports`;
CREATE TABLE `blog_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reporter_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `report_type` enum('SEXUAL','VIOLENT','HARMFUL','HARASSMENT','SELF_HARM','SPAM') DEFAULT NULL,
  `reason` text,
  `status` enum('PENDING','RESOLVED') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`reporter_id`),
  KEY `target_id` (`blog_id`),
  CONSTRAINT `blog_reports_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`),
  CONSTRAINT `blog_reports_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE `blog_tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_tags_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blog_views`;
CREATE TABLE `blog_views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_views_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_views_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `blog_status` enum('ACTIVE','DELETED','HIDDEN','SCHEDULED','BANNED') DEFAULT NULL,
  `content` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `comment_reactions`;
CREATE TABLE `comment_reactions` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `comment_reports`;
CREATE TABLE `comment_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reporter_id` int DEFAULT NULL,
  `comment_id` int DEFAULT NULL,
  `report_type` enum('SEXUAL','VIOLENT','HARMFUL','HARASSMENT','SELF_HARM','SPAM') DEFAULT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `status` enum('PENDING','RESOLVED') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`reporter_id`),
  KEY `reported_id` (`comment_id`),
  CONSTRAINT `comment_reports_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_reports_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `content` text,
  `like_count` int NOT NULL DEFAULT '0',
  `parent_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `dislike_count` int NOT NULL DEFAULT '0',
  `status` enum('ACTIVE','REMOVED') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `follower_id` int DEFAULT NULL,
  `followed_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follower_id` (`follower_id`),
  KEY `followed_id` (`followed_id`),
  CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receiver_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `sender_id` int DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `category` enum('IMPORTANT','GENERAL') DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `type` enum('REACTION','BLOG','REPLY','COMMENT','FOLLOW') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`receiver_id`),
  KEY `blog_id_2` (`blog_id`),
  KEY `sender_id` (`sender_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `profile_images`;
CREATE TABLE `profile_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `secure_url` text,
  `asset_id` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profile_images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE `reactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `emoji` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `user_preferences`;
CREATE TABLE `user_preferences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `theme_preference` enum('LIGHT','DARK','SYSTEM') DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('USER','AUTHOR','ADMIN') DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_status` enum('ACTIVE','DELETED','BANNED') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `auth_provider` enum('LOCAL','GOOGLE') NOT NULL DEFAULT 'LOCAL',
  `campus` enum('MAIN','BALANGA','ABUCAY','ORANI','DINALUPIHAN','BAGAC') DEFAULT NULL,
  `bio` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin_logs` (`id`, `title`, `description`, `admin_id`) VALUES
(1, 'Banned Blog', '', 9),
(2, 'Removed Comment', 'removed comment with the id of 1', 9),
(3, 'Removed Comment', 'removed comment with the id of 1', 9),
(4, 'Removed Comment', 'removed comment with the id of 2', 9),
(5, 'BAN USER', 'banned user id of 10', 9),
(6, 'Banned Blog', '', 9),
(7, 'Banned Blog', '', 9),
(8, 'Banned Blog', '', 9),
(9, 'Banned Blog', '', 9),
(10, 'Banned Blog', '', 9),
(11, 'BAN USER', 'banned user id of ', 9),
(12, 'BAN USER', 'banned user id of ', 9),
(13, 'BAN USER', 'banned user id of 1', 9),
(14, 'Banned Blog', '', 9);
INSERT INTO `appeals` (`id`, `author_id`, `blog_id`, `reason`, `status`) VALUES
(1, 1, 5, 'asdasdasd', 'RESOLVED'),
(2, 1, 3, 'hello world', 'RESOLVED'),
(3, 1, 3, 'asdasd', 'RESOLVED');
INSERT INTO `blog_categories` (`id`, `category_id`, `blog_id`) VALUES
(1, 3, 2),
(2, 2, 3),
(3, 4, 4),
(4, 2, 5);


INSERT INTO `blog_reports` (`id`, `reporter_id`, `blog_id`, `report_type`, `reason`, `status`, `created_at`) VALUES
(1, 10, 5, 'HARASSMENT', '', 'RESOLVED', '2025-11-07 13:23:57'),
(3, 10, 2, 'VIOLENT', '', 'RESOLVED', '2025-11-07 14:01:53'),
(4, 10, 4, 'SEXUAL', '', 'PENDING', '2025-11-07 14:38:52'),
(5, 10, 4, 'SEXUAL', '', 'RESOLVED', '2025-11-07 14:40:26');
INSERT INTO `blog_tags` (`id`, `tag_id`, `blog_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5);
INSERT INTO `blog_views` (`id`, `user_id`, `blog_id`, `viewed_at`) VALUES
(1, 9, 2, '2025-11-06 09:51:13'),
(2, 10, 2, '2025-11-06 09:52:31'),
(3, 1, 5, '2025-11-06 12:18:00'),
(4, 9, 5, '2025-11-07 00:27:32'),
(5, 10, 5, '2025-11-07 13:19:33'),
(6, 10, 4, '2025-11-07 13:24:19'),
(7, 9, 4, '2025-11-07 13:24:40'),
(8, 9, 3, '2025-11-07 13:49:37'),
(9, 1, 3, '2025-11-07 13:50:06'),
(10, 10, 3, '2025-11-07 13:51:37'),
(11, 1, 2, '2025-11-07 14:59:25');
INSERT INTO `blogs` (`id`, `author_id`, `blog_status`, `content`, `created_at`, `scheduled_at`, `updated_at`, `title`, `published_at`) VALUES
(1, 1, 'HIDDEN', '{\"type\": \"doc\", \"content\": [{\"type\": \"heading\", \"attrs\": {\"level\": 1, \"textAlign\": null}, \"content\": [{\"text\": \"Getting started\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": null}, \"content\": [{\"text\": \"Welcome to the \", \"type\": \"text\"}, {\"text\": \"Simple Editor\", \"type\": \"text\", \"marks\": [{\"type\": \"italic\"}, {\"type\": \"highlight\", \"attrs\": {\"color\": \"var(--tt-color-highlight-yellow)\"}}]}, {\"text\": \" template! This template integrates \", \"type\": \"text\"}, {\"text\": \"open source\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \" UI components and Tiptap extensions licensed under \", \"type\": \"text\"}, {\"text\": \"MIT\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \".\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": null}, \"content\": [{\"text\": \"Integrate it by following the \", \"type\": \"text\"}, {\"text\": \"Tiptap UI Components docs\", \"type\": \"text\", \"marks\": [{\"type\": \"link\", \"attrs\": {\"rel\": \"noopener noreferrer nofollow\", \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor\", \"class\": null, \"target\": \"_blank\"}}]}, {\"text\": \" or using our CLI tool.\", \"type\": \"text\"}]}, {\"type\": \"codeBlock\", \"attrs\": {\"language\": null}, \"content\": [{\"text\": \"npx @tiptap/cli init\", \"type\": \"text\"}]}, {\"type\": \"heading\", \"attrs\": {\"level\": 2, \"textAlign\": null}, \"content\": [{\"text\": \"Features\", \"type\": \"text\"}]}, {\"type\": \"blockquote\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": null}, \"content\": [{\"text\": \"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \", \"type\": \"text\", \"marks\": [{\"type\": \"italic\"}]}, {\"text\": \"**\", \"type\": \"text\", \"marks\": [{\"type\": \"code\"}]}, {\"text\": \" or use keyboard shortcuts \", \"type\": \"text\", \"marks\": [{\"type\": \"italic\"}]}, {\"text\": \"u2318+B\", \"type\": \"text\", \"marks\": [{\"type\": \"code\"}]}, {\"text\": \" for \", \"type\": \"text\"}, {\"text\": \"most\", \"type\": \"text\", \"marks\": [{\"type\": \"strike\"}]}, {\"text\": \" all common markdown marks. ud83eude84\", \"type\": \"text\"}]}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Add images, customize alignment, and apply \", \"type\": \"text\"}, {\"text\": \"advanced formatting\", \"type\": \"text\", \"marks\": [{\"type\": \"highlight\", \"attrs\": {\"color\": \"var(--tt-color-highlight-blue)\"}}]}, {\"text\": \" to make your writing more engaging and professional.\", \"type\": \"text\"}]}, {\"type\": \"image\", \"attrs\": {\"alt\": \"placeholder-image\", \"src\": \"/images/tiptap-ui-placeholder-image.jpg\", \"title\": \"placeholder-image\"}}, {\"type\": \"bulletList\", \"content\": [{\"type\": \"listItem\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Superscript\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \" (x\", \"type\": \"text\"}, {\"text\": \"2\", \"type\": \"text\", \"marks\": [{\"type\": \"superscript\"}]}, {\"text\": \") and \", \"type\": \"text\"}, {\"text\": \"Subscript\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \" (H\", \"type\": \"text\"}, {\"text\": \"2\", \"type\": \"text\", \"marks\": [{\"type\": \"subscript\"}]}, {\"text\": \"O) for precision.\", \"type\": \"text\"}]}]}, {\"type\": \"listItem\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Typographic conversion\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \": automatically convert to \", \"type\": \"text\"}, {\"text\": \"->\", \"type\": \"text\", \"marks\": [{\"type\": \"code\"}]}, {\"text\": \" an arrow \", \"type\": \"text\"}, {\"text\": \"u2192\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}, {\"text\": \".\", \"type\": \"text\"}]}]}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"u2192 \", \"type\": \"text\", \"marks\": [{\"type\": \"italic\"}]}, {\"text\": \"Learn more\", \"type\": \"text\", \"marks\": [{\"type\": \"link\", \"attrs\": {\"rel\": \"noopener noreferrer nofollow\", \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\", \"class\": null, \"target\": \"_blank\"}}]}]}, {\"type\": \"horizontalRule\"}, {\"type\": \"heading\", \"attrs\": {\"level\": 2, \"textAlign\": \"left\"}, \"content\": [{\"text\": \"Make it your own\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Switch between light and dark modes, and tailor the editor\'s appearance with customizable CSS to match your style.\", \"type\": \"text\"}]}, {\"type\": \"taskList\", \"content\": [{\"type\": \"taskItem\", \"attrs\": {\"checked\": true}, \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Test template\", \"type\": \"text\"}]}]}, {\"type\": \"taskItem\", \"attrs\": {\"checked\": false}, \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}, \"content\": [{\"text\": \"Integrate the free template\", \"type\": \"text\", \"marks\": [{\"type\": \"link\", \"attrs\": {\"rel\": \"noopener noreferrer nofollow\", \"href\": \"https://tiptap.dev/docs/ui-components/templates/simple-editor\", \"class\": null, \"target\": \"_blank\"}}]}]}]}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"left\"}}]}', '2025-10-10 14:29:05', '2025-10-10 14:29:05', NULL, 'Getting Started', NULL),
(2, 1, 'ACTIVE', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":1},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Getting started \\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Welcome tasdasdasdo the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"},{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-yellow)\\\"}}],\\\"text\\\":\\\"Simple Editor\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" template! This template integrates \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"open source\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" UI components and Tiptap extensions licensed under \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"MIT\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Integrate it by following the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Tiptap UI Components docs\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" or using our CLI tool.\\\"}]},{\\\"type\\\":\\\"youtube\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://www.youtube.com/watch?v=7YR72RFu7z8\\\",\\\"start\\\":0,\\\"width\\\":640,\\\"height\\\":360}},{\\\"type\\\":\\\"codeBlock\\\",\\\"attrs\\\":{\\\"language\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"npx @tiptap/cli init\\\"}]},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Features\\\"}]},{\\\"type\\\":\\\"blockquote\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"**\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\" or use keyboard shortcuts \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"⌘+B\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" for \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"strike\\\"}],\\\"text\\\":\\\"most\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" all common markdown marks. 🪄\\\"}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Add images, customize alignment, and apply \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-blue)\\\"}}],\\\"text\\\":\\\"advanced formatting\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" to make your writing more engaging and professional.\\\"}]},{\\\"type\\\":\\\"image\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760279229/bpsu_bulletin/blog_images/jvsin0ctj64wavfqqmsb.png\\\",\\\"alt\\\":\\\"Group1_ERD_SD3A\\\",\\\"title\\\":\\\"Group1_ERD_SD3A\\\",\\\"width\\\":null,\\\"height\\\":null}},{\\\"type\\\":\\\"bulletList\\\",\\\"content\\\":[{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Superscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (x\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\") and \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Subscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (H\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"O) for precision.asdasdas\\\"}]}]},{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Typographic conversion\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\": automatically convert to \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"->\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" an arrow \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"→\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"→ \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Learn more\\\"}]},{\\\"type\\\":\\\"horizontalRule\\\"},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\",\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Make it your own\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Switch between light and dark modes, and tailor the editor\'s appearance with customizable CSS to match your style.\\\"}]},{\\\"type\\\":\\\"taskList\\\",\\\"content\\\":[{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":true},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Test template\\\"}]}]},{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":false},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Integrate the free template\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"}}]}\"', '2025-11-06 09:34:25', '2025-11-06 09:38:00', '2025-11-06 09:36:49', 'Hello World', '2025-11-06 09:38:09'),
(3, 1, 'BANNED', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":1},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Getting started \\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Welcome tasdasdasdo the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"},{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-yellow)\\\"}}],\\\"text\\\":\\\"Simple Editor\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" template! This template integrates \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"open source\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" UI components and Tiptap extensions licensed under \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"MIT\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Integrate it by following the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Tiptap UI Components docs\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" or using our CLI tool.\\\"}]},{\\\"type\\\":\\\"youtube\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://www.youtube.com/watch?v=7YR72RFu7z8\\\",\\\"start\\\":0,\\\"width\\\":640,\\\"height\\\":360}},{\\\"type\\\":\\\"codeBlock\\\",\\\"attrs\\\":{\\\"language\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"npx @tiptap/cli init\\\"}]},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Features\\\"}]},{\\\"type\\\":\\\"blockquote\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"**\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\" or use keyboard shortcuts \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"⌘+B\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" for \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"strike\\\"}],\\\"text\\\":\\\"most\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" all common markdown marks. 🪄\\\"}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Add images, customize alignment, and apply \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-blue)\\\"}}],\\\"text\\\":\\\"advanced formatting\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" to make your writing more engaging and professional.\\\"}]},{\\\"type\\\":\\\"image\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760279229/bpsu_bulletin/blog_images/jvsin0ctj64wavfqqmsb.png\\\",\\\"alt\\\":\\\"Group1_ERD_SD3A\\\",\\\"title\\\":\\\"Group1_ERD_SD3A\\\",\\\"width\\\":null,\\\"height\\\":null}},{\\\"type\\\":\\\"bulletList\\\",\\\"content\\\":[{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Superscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (x\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\") and \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Subscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (H\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"O) for precision.asdasdas\\\"}]}]},{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Typographic conversion\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\": automatically convert to \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"->\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" an arrow \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"→\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"→ \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Learn more\\\"}]},{\\\"type\\\":\\\"horizontalRule\\\"},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\",\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Make it your own\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Switch between light and dark modes, and tailor the editor\'s appearance with customizable CSS to match your style.\\\"}]},{\\\"type\\\":\\\"taskList\\\",\\\"content\\\":[{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":true},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Test template\\\"}]}]},{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":false},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Integrate the free template\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"}}]}\"', '2025-11-06 10:00:41', '2025-11-06 10:01:06', '2025-11-06 10:01:08', 'This is for my first follower: Tambay sa Reddit 💗', '2025-11-06 10:01:06'),
(4, 1, 'ACTIVE', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":1},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Getting started \\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Welcome tasdasdasdo the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"},{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-yellow)\\\"}}],\\\"text\\\":\\\"Simple Editor\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" template! This template integrates \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"open source\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" UI components and Tiptap extensions licensed under \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"MIT\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Integrate it by following the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Tiptap UI Components docs\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" or using our CLI tool.\\\"}]},{\\\"type\\\":\\\"youtube\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://www.youtube.com/watch?v=7YR72RFu7z8\\\",\\\"start\\\":0,\\\"width\\\":640,\\\"height\\\":360}},{\\\"type\\\":\\\"codeBlock\\\",\\\"attrs\\\":{\\\"language\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"npx @tiptap/cli init\\\"}]},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Features\\\"}]},{\\\"type\\\":\\\"blockquote\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"**\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\" or use keyboard shortcuts \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"⌘+B\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" for \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"strike\\\"}],\\\"text\\\":\\\"most\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" all common markdown marks. 🪄\\\"}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Add images, customize alignment, and apply \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-blue)\\\"}}],\\\"text\\\":\\\"advanced formatting\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" to make your writing more engaging and professional.\\\"}]},{\\\"type\\\":\\\"image\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760279229/bpsu_bulletin/blog_images/jvsin0ctj64wavfqqmsb.png\\\",\\\"alt\\\":\\\"Group1_ERD_SD3A\\\",\\\"title\\\":\\\"Group1_ERD_SD3A\\\",\\\"width\\\":null,\\\"height\\\":null}},{\\\"type\\\":\\\"bulletList\\\",\\\"content\\\":[{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Superscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (x\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\") and \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Subscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (H\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"O) for precision.asdasdas\\\"}]}]},{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Typographic conversion\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\": automatically convert to \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"->\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" an arrow \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"→\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"→ \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Learn more\\\"}]},{\\\"type\\\":\\\"horizontalRule\\\"},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\",\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Make it your own\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Switch between light and dark modes, and tailor the editor\'s appearance with customizable CSS to match your style.\\\"}]},{\\\"type\\\":\\\"taskList\\\",\\\"content\\\":[{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":true},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Test template\\\"}]}]},{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":false},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Integrate the free template\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"}}]}\"', '2025-11-06 10:02:33', '2025-11-06 10:02:56', '2025-11-06 10:03:02', 'This is for first follower: Tambay sa Reddit 💗', '2025-11-06 10:02:56'),
(5, 1, 'ACTIVE', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\",\\\"level\\\":1},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Getting started \\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Welcome tasdasdasdo the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"},{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-yellow)\\\"}}],\\\"text\\\":\\\"Simple Editor\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" template! This template integrates \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"open source\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" UI components and Tiptap extensions licensed under \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"MIT\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Integrate it by following the \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Tiptap UI Components docs\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" or using our CLI tool.\\\"}]},{\\\"type\\\":\\\"youtube\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://www.youtube.com/watch?v=7YR72RFu7z8\\\",\\\"start\\\":0,\\\"width\\\":640,\\\"height\\\":360}},{\\\"type\\\":\\\"codeBlock\\\",\\\"attrs\\\":{\\\"language\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"npx @tiptap/cli init\\\"}]},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Features\\\"}]},{\\\"type\\\":\\\"blockquote\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"A fully responsive rich text editor with built-in support for common formatting and layout tools. Type markdown \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"**\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\" or use keyboard shortcuts \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"⌘+B\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" for \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"strike\\\"}],\\\"text\\\":\\\"most\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" all common markdown marks. 🪄\\\"}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Add images, customize alignment, and apply \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-blue)\\\"}}],\\\"text\\\":\\\"advanced formatting\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" to make your writing more engaging and professional.\\\"}]},{\\\"type\\\":\\\"image\\\",\\\"attrs\\\":{\\\"src\\\":\\\"https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760279229/bpsu_bulletin/blog_images/jvsin0ctj64wavfqqmsb.png\\\",\\\"alt\\\":\\\"Group1_ERD_SD3A\\\",\\\"title\\\":\\\"Group1_ERD_SD3A\\\",\\\"width\\\":null,\\\"height\\\":null}},{\\\"type\\\":\\\"bulletList\\\",\\\"content\\\":[{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Superscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (x\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\") and \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Subscript\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" (H\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"O) for precision.asdasdas\\\"}]}]},{\\\"type\\\":\\\"listItem\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"Typographic conversion\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\": automatically convert to \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"code\\\"}],\\\"text\\\":\\\"->\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\" an arrow \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"bold\\\"}],\\\"text\\\":\\\"→\\\"},{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\".\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"italic\\\"}],\\\"text\\\":\\\"→ \\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor#features\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Learn more\\\"}]},{\\\"type\\\":\\\"horizontalRule\\\"},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\",\\\"level\\\":2},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Make it your own\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Switch between light and dark modes, and tailor the editor\'s appearance with customizable CSS to match your style.\\\"}]},{\\\"type\\\":\\\"taskList\\\",\\\"content\\\":[{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":true},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Test template\\\"}]}]},{\\\"type\\\":\\\"taskItem\\\",\\\"attrs\\\":{\\\"checked\\\":false},\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://tiptap.dev/docs/ui-components/templates/simple-editor\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}}],\\\"text\\\":\\\"Integrate the free template\\\"}]}]}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"left\\\"}}]}\"', '2025-11-06 12:17:09', '2025-11-06 12:17:52', '2025-11-06 12:17:58', 'center', '2025-11-07 15:35:42'),
(6, 1, 'HIDDEN', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"strike\\\"}],\\\"text\\\":\\\"Hello\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"underline\\\"}],\\\"text\\\":\\\"Hello World\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"Hello 1\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"1\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"2\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"center\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"3\\\"}]}]}\"', '2025-11-06 13:05:14', NULL, '2025-11-06 13:10:36', 'Center Fix', NULL),
(7, 1, 'HIDDEN', '\"{\\\"type\\\":\\\"doc\\\",\\\"content\\\":[{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"link\\\",\\\"attrs\\\":{\\\"href\\\":\\\"https://www.youtube.com/watch?v=SPX1bDfggQA\\\",\\\"target\\\":\\\"_blank\\\",\\\"rel\\\":\\\"noopener noreferrer nofollow\\\",\\\"class\\\":null}},{\\\"type\\\":\\\"bold\\\"},{\\\"type\\\":\\\"underline\\\"}],\\\"text\\\":\\\"asdasdasdas\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":\\\"right\\\"},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"underline\\\"},{\\\"type\\\":\\\"highlight\\\",\\\"attrs\\\":{\\\"color\\\":\\\"var(--tt-color-highlight-purple)\\\"}}],\\\"text\\\":\\\"asdasdasdasdasdasdas\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"sad\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"}],\\\"text\\\":\\\"1\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"superscript\\\"},{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"},{\\\"type\\\":\\\"text\\\",\\\"marks\\\":[{\\\"type\\\":\\\"subscript\\\"}],\\\"text\\\":\\\"2\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}},{\\\"type\\\":\\\"heading\\\",\\\"attrs\\\":{\\\"textAlign\\\":null,\\\"level\\\":1},\\\"content\\\":[{\\\"type\\\":\\\"text\\\",\\\"text\\\":\\\"assdasdsadsa\\\"}]},{\\\"type\\\":\\\"paragraph\\\",\\\"attrs\\\":{\\\"textAlign\\\":null}}]}\"', '2025-11-06 13:19:17', NULL, '2025-11-06 13:36:08', 'Highlight Color', NULL);
INSERT INTO `categories` (`id`, `value`) VALUES
(1, 'University Announcements'),
(2, 'Organizations'),
(3, 'Scholarship'),
(4, 'Achievement'),
(5, 'Enrollment & Documents');

INSERT INTO `comment_reports` (`id`, `reporter_id`, `comment_id`, `report_type`, `reason`, `created_at`, `status`) VALUES
(1, 10, 1, 'HARASSMENT', '', '2025-11-06 09:55:55', 'RESOLVED'),
(2, 10, 1, 'SPAM', '', '2025-11-07 13:27:09', 'RESOLVED'),
(3, 10, 2, 'HARASSMENT', '', '2025-11-07 13:30:05', 'RESOLVED');
INSERT INTO `comments` (`id`, `user_id`, `blog_id`, `content`, `like_count`, `parent_id`, `created_at`, `dislike_count`, `status`) VALUES
(1, 10, 2, 'Hello World', 0, NULL, '2025-11-06 09:52:37', 0, 'REMOVED'),
(2, 10, 2, 'hello world', 0, NULL, '2025-11-07 13:30:00', 0, 'REMOVED');
INSERT INTO `follows` (`id`, `follower_id`, `followed_id`, `created_at`) VALUES
(1, 10, 1, '2025-11-06 09:58:57'),
(2, 9, 1, '2025-11-07 00:30:39');
INSERT INTO `notifications` (`id`, `receiver_id`, `title`, `description`, `sender_id`, `is_read`, `category`, `blog_id`, `created_at`, `type`) VALUES
(1, 1, 'Hello World', 'Comments on your blog', 10, 1, 'GENERAL', 2, '2025-11-06 09:52:37', 'COMMENT'),
(2, 1, 'You', 'Follows', 10, 1, 'IMPORTANT', NULL, '2025-11-06 09:58:57', 'FOLLOW'),
(3, 10, 'This is for first follower: Tambay sa Reddit 💗', 'Posted', 1, 1, 'GENERAL', 4, '2025-11-06 10:02:56', 'BLOG'),
(4, 10, 'center', 'Posted', 1, 1, 'GENERAL', 5, '2025-11-06 12:17:52', 'BLOG'),
(5, 1, 'You', 'Follows', 9, 1, 'IMPORTANT', NULL, '2025-11-07 00:30:39', 'FOLLOW'),
(6, 1, 'your blog', 'Banned', 9, 1, 'IMPORTANT', 5, '2025-11-07 13:24:44', 'BLOG'),
(7, 10, 'your comment', 'Removed', 9, 1, 'IMPORTANT', 2, '2025-11-07 13:29:47', 'COMMENT'),
(8, 10, 'your comment', 'Removed', 9, 1, 'IMPORTANT', 2, '2025-11-07 13:29:47', 'COMMENT'),
(9, 1, 'hello world', 'Comments on your blog', 10, 1, 'GENERAL', 2, '2025-11-07 13:30:00', 'COMMENT'),
(10, 10, 'your comment', 'Removed', 9, 1, 'IMPORTANT', 2, '2025-11-07 13:30:29', 'COMMENT'),
(11, 1, 'your blog', 'Banned', 9, 0, 'IMPORTANT', 3, '2025-11-07 14:01:22', 'BLOG'),
(12, 1, 'your blog', 'Banned', 9, 0, 'IMPORTANT', 2, '2025-11-07 14:02:22', 'BLOG'),
(13, 1, 'your blog', 'Banned', 9, 0, 'IMPORTANT', 4, '2025-11-07 14:41:23', 'BLOG'),
(14, 1, 'your blog', 'Banned', 9, 1, 'IMPORTANT', 5, '2025-11-07 14:42:55', 'BLOG'),
(15, 1, 'your blog', 'Banned', 9, 1, 'IMPORTANT', 4, '2025-11-07 14:51:29', 'BLOG'),
(16, 1, 'your blog', 'Banned', 9, 1, 'IMPORTANT', 3, '2025-11-07 15:29:51', 'BLOG'),
(17, 1, 'your appeal', 'Approved', 9, 1, 'IMPORTANT', 5, '2025-11-07 15:52:00', 'BLOG'),
(18, 1, 'your appeal', 'Approved', 9, 1, 'IMPORTANT', 3, '2025-11-07 15:52:04', 'BLOG'),
(19, 1, 'your appeal', 'Rejected', 9, 1, 'IMPORTANT', 3, '2025-11-07 15:54:01', 'BLOG');
INSERT INTO `profile_images` (`id`, `user_id`, `secure_url`, `asset_id`) VALUES
(1, 1, 'https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760671868/bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0.jpg', 'bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0'),
(7, 9, 'https://res.cloudinary.com/dz4qgnk5v/image/upload/v1762393847/bulletin_profile_images/lbps4o0wrsovp4rbazqp.png', 'bulletin_profile_images/lbps4o0wrsovp4rbazqp'),
(8, 10, 'https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760538796/default_profile_xgg15t.jpg', 'default_profile_xgg15t');
INSERT INTO `reactions` (`id`, `name`, `emoji`) VALUES
(1, 'like', '👍'),
(2, 'dislike', '👎');
INSERT INTO `tags` (`id`, `name`) VALUES
(1, '');
INSERT INTO `user_preferences` (`id`, `user_id`, `theme_preference`, `email_notification`, `push_notification`, `reaction_notification`, `follow_notification`, `show_email_public`, `show_profile_public`, `created_at`, `updated_at`) VALUES
(1, 1, 'SYSTEM', 0, 0, 0, 0, 0, 0, '2025-10-26 12:34:00', '2025-10-26 12:34:00'),
(7, 9, 'LIGHT', 0, 0, 0, 0, 0, 0, '2025-11-06 09:50:48', '2025-11-06 09:50:48'),
(8, 10, 'SYSTEM', 1, 1, 1, 1, 1, 1, '2025-11-06 09:52:21', '2025-11-06 09:52:21');
INSERT INTO `users` (`id`, `role`, `username`, `email`, `password`, `account_status`, `created_at`, `auth_provider`, `campus`, `bio`) VALUES
(1, 'AUTHOR', 'Author', 'mendozaruzzel103@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NUhHTjVwY1gybzRMT1RKcQ$svAFH9wXoxmYwFc1vidrXDYgypWuqiLMYIjVAjbiyQQ', 'ACTIVE', '2025-10-10 14:29:05', 'LOCAL', 'MAIN', ''),
(9, 'ADMIN', 'Admin', 'mendozaruzzel100@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VEc4b0N0R0Q5YU80V1RGNw$hom8tT4StFagZbEZzjAUapxadsBQU1DcKowJ+u0gsKU', 'ACTIVE', '2025-11-06 09:50:46', 'LOCAL', 'MAIN', NULL),
(10, 'USER', 'Tambay sa reddit', 'rupmendoza23@bpsu.edu.ph', NULL, 'ACTIVE', '2025-11-06 09:52:21', 'GOOGLE', 'BALANGA', NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;