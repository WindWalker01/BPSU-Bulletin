<?php

namespace Core;

use Core\Database;
use Core\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Notification
{
    private $db;
    private $mail;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
        $this->mail = new PHPMailer(true);
    }

    function createRemovedCommentNotification($receiver, $source)
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
                "title" => "your comment",
                "description" => "Removed",
                "sender" => getLoggedInUserId(),
                "category" => "IMPORTANT",
                "blog" => $source,
            ],
        );
    }

    function createRemovedBlogNotification($receiver, $source)
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
            VALUES(:receiver, :title, :description, :sender, 0, :category, :blog, NOW(), 'BLOG')",
            [
                "receiver" => $receiver,
                "title" => "your blog",
                "description" => "Banned",
                "sender" => getLoggedInUserId(),
                "category" => "IMPORTANT",
                "blog" => $source,
            ],
        );
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
            `created_at`,
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

    function createEmailForBlogPublish($sender, $blog_id)
    {
        $config = require base_path("config/config.php");

        $author_name = $sender["username"];
        $author_avatar_url = $sender["secure_url"];
        $post_title = $sender["title"];

        $post_excerpt = extractFirstParagraphFromTiptap(
            json_decode($sender["content"]),
        );
        $post_url = "{$config["website_url"]}/blog?id={$blog_id}";
        $unsubscribe_url = "{$config["website_url"]}/preferences";

        $content = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>{$author_name} published a new blog</title>
          <style>
            body {
              background: #ffffff;
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 24px;
              color: #000000;
            }

            @media (prefers-color-scheme: dark) {
              body {
                background: #0D0D0D;
                color: #ffffff;
              }
              .container {
                background: #0D0D0D !important;
                border-color: #2E2E2E !important;
              }
              .footer {
                border-top-color: #2E2E2E !important;
                color: #A3A3A3 !important;
              }
              .author-info small, p {
                color: #A3A3A3 !important;
              }
            }

            .container {
              max-width: 600px;
              margin: 0 auto;
              background: #ffffff;
              border: 1px solid #E5E5E5;
              border-radius: 10px;
              padding: 32px 28px;
            }

            .author {
              display: flex;
              align-items: center;
              gap: 12px;
              margin-bottom: 20px;
            }

            .author img {
              border-radius: 50%;
              width: 50px;
              height: 50px;
              object-fit: cover;
            }

            .author-info strong {
              display: block;
              font-size: 15px;
              color: #000000;
            }

            .author-info small {
              color: #737373;
              font-size: 13px;
            }

            h2 {
              font-size: 20px;
              margin-top: 8px;
              margin-bottom: 12px;
            }

            p {
              font-size: 15px;
              line-height: 1.6;
              color: #737373;
              margin-bottom: 24px;
            }

            /* Button fix: use inline-safe CSS with fallback colors */
            .button {
              display: inline-block;
              background-color: #C00000;
              color: #ffffff !important;
              text-decoration: none;
              padding: 12px 22px;
              border-radius: 6px;
              font-weight: 600;
              font-size: 15px;
              border: none;
            }

            .button:hover {
              background-color: #D55454;
            }

            .footer {
              border-top: 1px solid #E5E5E5;
              margin-top: 32px;
              padding-top: 16px;
              font-size: 13px;
              color: #737373;
              text-align: center;
              line-height: 1.5;
            }

            .footer a {
              color: #737373;
              text-decoration: underline;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="author">
              <img src="{$author_avatar_url}" alt="{$author_name}">
              <div class="author-info">
                <strong>{$author_name}</strong>
                <small>just published a new blog</small>
              </div>
            </div>

            <h2>{$post_title}</h2>
            <p>{$post_excerpt}</p>

            <!-- Button with inline background as fallback -->
            <a href="{$post_url}"
               class="button"
               style="background-color:#C00000;color:#ffffff;text-decoration:none;display:inline-block;border-radius:6px;padding:12px 22px;font-weight:600;font-size:15px;">
               Read Blog
            </a>

            <div class="footer">
              You’re receiving this email because you follow
              <strong>{$author_name}</strong> on <strong>BPSU Bulletin</strong>.<br>
              <a href="{$unsubscribe_url}">Unsubscribe</a>
            </div>
          </div>
        </body>
        </html>
        HTML;

        // Get all the followers that has enabled in app notification
        $followers = $this->db
            ->query(
                "SELECT users.id, users.email, users.username
            FROM users
            INNER JOIN user_preferences ON user_preferences.user_id = users.id
            INNER JOIN follows ON follows.follower_id = users.id 
            WHERE user_preferences.email_notification = 1 
            AND follows.followed_id = :sender                 
            AND users.id != :sender",
                ["sender" => $sender["id"]],
            )
            ->get();

        foreach ($followers as $follower) {
            $this->sendEmail(
                $follower["email"],
                $follower["username"],
                $follower["username"] . " Posted",
                $content,
                $follower["username"] . " Posted",
            );
        }
    }

    function sendEmail($email, $username, $subject, $content, $alt_body)
    {
        $config = require base_path("config/config.php");

        try {
            // Server settings
            $this->mail->isSMTP();
            $this->mail->Host = "smtp.gmail.com";
            $this->mail->SMTPAuth = true;
            $this->mail->Username = "bpsubulletin@gmail.com"; // your Gmail
            $this->mail->Password = $config["email_app_password"]; // Gmail App Password, not your actual password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Recipients
            $this->mail->setFrom("bpsubulletin@gmail.com", "BPSU Bulletin");
            $this->mail->addAddress($email, $username);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;
            $this->mail->AltBody = $alt_body;

            $this->mail->send();
            echo "Message has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
