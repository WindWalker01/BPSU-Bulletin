<?php
use Core\Authenticator;
use Core\App;
use Core\Database;
use Core\Notification;

$db = App::resolve(Database::class);
$auth = new Authenticator();
$notification = new Notification();

$follower_id = $auth->getLoggedInUserId();
$followed_id = (int) $_POST["author_id"];
$isFollowed = (bool) $_POST["is_followed"];

if ($isFollowed) {
    $db->query(
        "DELETE FROM follows WHERE follower_id = :follower AND followed_id = :followed",
        [
            "follower" => $follower_id,
            "followed" => $followed_id,
        ],

        $notification->createUnFollowNotification(
            $followed_id,
            $follower_id,
            "You",
        ),
    );
} else {
    $db->query(
        "INSERT INTO follows (`follower_id`, `followed_id`, `created_at`) VALUES (:follower, :followed, NOW())",
        [
            "follower" => $follower_id,
            "followed" => $followed_id,
        ],

        $notification->createFollowNotification(
            $followed_id,
            $follower_id,
            "You",
        ),
    );
}

redirect("/account?id=" . $followed_id);
