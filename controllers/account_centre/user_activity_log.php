<?php
use Core\App;
use Core\Authenticator;
use Core\Database;

$id = $_GET["id"] ?? new Authenticator()->getLoggedInUserId();

$db = App::resolve(Database::class);

$account = $db
    ->query(
        "SELECT 
            users.id, 
            users.username, 
            users.role, 
            users.bio, 
            users.created_at, 
            profile_images.secure_url 
        FROM users 
        INNER JOIN profile_images ON users.id = profile_images.user_id 
        WHERE users.id = :id",
        ["id" => $id],
    )
    ->findOrFail();

if ($account === null) {
    redirect("/account");
    exit();
}

// Check if the it is already followed
$isFollowed = $db
    ->query(
        "SELECT * FROM follows WHERE follower_id = :follower AND followed_id = :followed",
        [
            "follower" => new Authenticator()->getLoggedInUserId(),
            "followed" => $_GET["id"] ?? 0,
        ],
    )
    ->findOrFail();

render("account_activity_log.view.php", [
    "account_id" => $account["id"],
    "url" => $account["secure_url"],
    "username" => $account["username"],
    "join_date" => date("F d, Y", strtotime($account["created_at"])),
    "bio" => $account["bio"],
    "isAuthor" => $account["role"] === "AUTHOR",
    "isFollowed" => $isFollowed === null ? 0 : 1,
    "isQueryLoggedIn" =>
        $account["id"] === new Authenticator()->getLoggedInUserId(), // checks if the id uri is the same as the logged in user
]);
