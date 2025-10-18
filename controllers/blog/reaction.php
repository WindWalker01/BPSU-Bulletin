<?php
// <!-- Scenario A: User Clicks 'Like' (No existing reaction)

//     Check: Does a record exist for this user_id and blog_id? (No)

//     Action: INSERT a new row into the reactions table: (user_id, blog_id, reaction_id = 'like').

// Scenario B: User Clicks 'Dislike' (No existing reaction)

//     Check: Does a record exist for this user_id and blog_id? (No)

//     Action: INSERT a new row into the reactions table: (user_id, blog_id, reaction_id = 'dislike').

// Scenario C: User Clicks the Same Button Again (Undo)

//     Check: Does a record exist where user_id, blog_id, AND reaction_id match the click? (Yes)

//     Action: DELETE the row from the reactions table.

// Scenario D: User Changes from 'Like' to 'Dislike' (or vice versa)

//     Check: Does a record exist for this user_id and blog_id? (Yes)

//     Check: Does the existing reaction_id match the new click? (No)

//     Action: UPDATE the existing row to change the reaction_id to the new value. -->

header("Content-Type: application/json");

use Core\App;
use Core\Authenticator;
use Core\Database;

$blog_id = $_POST["post_id"];
$reaction_type = $_POST["reaction_type"];
$action = $_POST["action"];

$auth = new Authenticator();

$user_id = $auth->getLoggedInUserId();

$db = App::resolve(Database::class);

$reaction_id = $reaction_type === "like" ? 1 : 2;

$reactions = $db
    ->query(
        "SELECT * FROM blog_reactions WHERE user_id = :user_id AND blog_id = :blog_id",
        ["user_id" => $user_id, "blog_id" => $blog_id],
    )
    ->get();

$query = "";

switch ($action) {
    case "undo":
        // Scenario C: User clicks the same filled button
        $db->query(
            "DELETE FROM blog_reactions WHERE user_id = :user_id AND blog_id = :blog_id",
            ["user_id" => $user_id, "blog_id" => $blog_id],
        );
        break;

    case "switch":
        // Scenario D: User changes from 'like' to 'dislike' or vice versa
        // We can rely on the existing_reaction check being true here.
        $db->query(
            "UPDATE blog_reactions SET reaction_id = :reaction_id WHERE user_id = :user_id AND blog_id = :blog_id",
            [
                "user_id" => $user_id,
                "blog_id" => $blog_id,
                "reaction_id" => $reaction_id,
            ],
        );
        break;

    case "set":
        // Scenario A or B: User is setting a new reaction
        $db->query(
            "INSERT INTO blog_reactions (user_id, blog_id, reaction_id) VALUES (:user_id, :blog_id, :reaction_id)",
            [
                "user_id" => $user_id,
                "blog_id" => $blog_id,
                "reaction_id" => $reaction_id,
            ],
        );
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
    "new_like_count" => $new_like_count,
    "new_dislike_count" => $new_dislike_count,
    "action" => $action,
]);
