<?php
// <!-- Scenario A: User Clicks 'Like' (No existing reaction)

//     Check: Does a record exist for this user_id and comment_id? (No)

//     Action: INSERT a new row into the reactions table: (user_id, comment_id, reaction_id = 'like').

// Scenario B: User Clicks 'Dislike' (No existing reaction)

//     Check: Does a record exist for this user_id and comment_id? (No)

//     Action: INSERT a new row into the reactions table: (user_id, comment_id, reaction_id = 'dislike').

// Scenario C: User Clicks the Same Button Again (Undo)

//     Check: Does a record exist where user_id, comment_id, AND reaction_id match the click? (Yes)

//     Action: DELETE the row from the reactions table.

// Scenario D: User Changes from 'Like' to 'Dislike' (or vice versa)

//     Check: Does a record exist for this user_id and comment_id? (Yes)

//     Check: Does the existing reaction_id match the new click? (No)

//     Action: UPDATE the existing row to change the reaction_id to the new value. -->

header("Content-Type: application/json");

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Notification;

$comment_id = $_POST["comment_id"];
$reaction_type = $_POST["reaction_type"];
$action = $_POST["action"];

$auth = new Authenticator();

$user_id = $auth->getLoggedInUserId();
$notification = new Notification();

$db = App::resolve(Database::class);

$reaction_id = $reaction_type === "like" ? 1 : 2;

echo json_encode([
    "comment_id" => $comment_id,
    "reaction_type" => $reaction_type,
    "action" => $action,
    "reaction_id" => $reaction_id,
    "user_id" => $user_id,
]);

$reactions = $db
    ->query(
        "SELECT * FROM comment_reactions WHERE user_id = :user_id AND comment_id = :comment_id",
        ["user_id" => $user_id, "comment_id" => $comment_id],
    )
    ->get();

$query = "";

switch ($action) {
    case "undo":
        // Scenario C: User clicks the same filled button
        $db->query(
            "DELETE FROM comment_reactions WHERE user_id = :user_id AND comment_id = :comment_id",
            ["user_id" => $user_id, "comment_id" => $comment_id],
        );

        if ($reaction_id === 1) {
            $db->query(
                "UPDATE comments SET like_count = like_count - 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        } else {
            $db->query(
                "UPDATE comments SET dislike_count = dislike_count - 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        }
        break;

    case "switch":
        // Scenario D: User changes from 'like' to 'dislike' or vice versa
        // We can rely on the existing_reaction check being true here.
        $db->query(
            "UPDATE comment_reactions SET reaction_id = :reaction_id WHERE user_id = :user_id AND comment_id = :comment_id",
            [
                "user_id" => $user_id,
                "comment_id" => $comment_id,
                "reaction_id" => $reaction_id,
            ],
        );

        if ($reaction_id === 1) {
            $db->query(
                "UPDATE comments SET like_count = like_count + 1, dislike_count = dislike_count - 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        } else {
            $db->query(
                "UPDATE comments SET like_count = like_count - 1, dislike_count = dislike_count + 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        }
        break;

    case "set":
        // Scenario A or B: User is setting a new reaction
        $db->query(
            "INSERT INTO comment_reactions (`user_id`, `comment_id`, `reaction_id`) VALUES (:user_id, :comment_id, :reaction_id)",
            [
                "user_id" => $user_id,
                "comment_id" => $comment_id,
                "reaction_id" => $reaction_id,
            ],
        );

        if ($reaction_id === 1) {
            $db->query(
                "UPDATE comments SET like_count = like_count + 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        } else {
            $db->query(
                "UPDATE comments SET dislike_count = dislike_count + 1 WHERE id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            );
        }

        $author_id = $db
            ->query(
                "SELECT user_id FROM comment_reactions WHERE comment_id = :comment_id",
                [
                    "comment_id" => $comment_id,
                ],
            )
            ->find();

        $blog_id = $db
            ->query("SELECT blog_id FROM comments WHERE id = :comment_id", [
                "comment_id" => $comment_id,
            ])
            ->findOrFail();

        $existing = $db
            ->query(
                "SELECT * FROM notifications
                WHERE
                receiver_id = :author_id AND
                sender_id = :sender_id AND
                blog_id = :blog_id AND
                type = 'REACTION'",
                [
                    "sender_id" => $user_id,
                    "author_id" => $author_id["user_id"],
                    "blog_id" => $blog_id["blog_id"],
                ],
            )
            ->findOrFail();

        if ($existing !== null || $user_id === $author_id["user_id"]) {
            break;
        }

        if ($reaction_id === 1) {
            $notification->createLikeNotification(
                $user_id,
                $author_id["user_id"],
                $blog_id["blog_id"],
            );
        } else {
            $notification->createDislikeNotification(
                $user_id,
                $author_id["user_id"],
                $blog_id["blog_id"],
            );
        }

        break;

    default:
        echo json_encode([
            "success" => false,
            "message" => "Invalid action",
        ]);
        exit();
}

echo json_encode([
    "success" => true,
    "message" => "Reaction processed.",
    "action" => $action,
]);
