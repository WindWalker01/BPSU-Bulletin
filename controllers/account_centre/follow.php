<?php
use Core\Authenticator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$auth = new Authenticator();

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
    );
} else {
    $db->query(
        "INSERT INTO follows (`follower_id`, `followed_id`, `created_at`) VALUES (:follower, :followed, NOW())",
        [
            "follower" => $follower_id,
            "followed" => $followed_id,
        ],
    );
}

redirect("/account?id=" . $followed_id);
