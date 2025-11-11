<?php
use Core\App;
use Core\Authenticator;
use Core\Database;

$db = App::resolve(Database::class);
$auth = new Authenticator();

$loggedInId = $auth->getLoggedInUserId();
$id = $_GET["id"] ?? $loggedInId;

//  Fetch account
$account = $db
    ->query(
        "SELECT 
            users.id, 
            users.username, 
            users.role,
            users.email, 
            users.bio, 
            users.created_at, 
            profile_images.secure_url,
            user_preferences.show_email_public
        FROM users 
        INNER JOIN profile_images ON users.id = profile_images.user_id 
        INNER JOIN user_preferences ON users.id = user_preferences.user_id 
        WHERE users.id = :id",
        ["id" => $id],
    )
    ->findOrFail();

if ($account === null) {
    redirect("/404");
    exit();
}

$isFollowed = $db
    ->query(
        "SELECT * FROM follows WHERE follower_id = :follower AND followed_id = :followed",
        [
            "follower" => $loggedInId,
            "followed" => $id,
        ],
    )
    ->find();

$prefs = $db
    ->query(
        "SELECT show_profile_public FROM user_preferences WHERE user_id = :id",
        ["id" => $id],
    )
    ->find();

$isProfileLocked =
    isset($prefs["show_profile_public"]) && $prefs["show_profile_public"] == 1;

// Fetch all posts made by this author/user
try {
    $blogs = $db
        ->query(
            "SELECT 
            b.id,
            b.title,
            b.content,
            b.created_at,
            c.value AS category_label,
            u.username AS author_name,
            pi.secure_url AS author_image_url
         FROM blogs b
         INNER JOIN users u ON b.author_id = u.id
         INNER JOIN profile_images pi ON b.author_id = pi.user_id
         LEFT JOIN blog_categories bc ON b.id = bc.blog_id
         LEFT JOIN categories c ON bc.category_id = c.id
         WHERE b.author_id = :author_id
         ORDER BY b.created_at DESC",
            ["author_id" => $account["id"]],
        )
        ->get();
} catch (Exception $e) {
    $blogs = [];
    error_log("Database error: " . $e->getMessage());
}

if ($isProfileLocked && !$isFollowed && $id !== $loggedInId) {
    render("account_locked.view.php", [
        "username" => $account["username"],
        "profile_img" => $account["secure_url"],
    ]);
    exit();
}

// Render normal user profile if followed
$followed_authors = $db
    ->query(
        "SELECT 
            users.username, 
            users.id, 
            profile_images.secure_url 
        FROM follows 
        INNER JOIN profile_images ON follows.followed_id = profile_images.user_id
        INNER JOIN users ON follows.followed_id = users.id
        WHERE follows.follower_id = :follower_id",
        ["follower_id" => $id],
    )
    ->get();

// Categories Color Label
$categoryColorMap = [
    "University Announcements" => "bg-red-500/20 text-brand",
    "Organizations" => "bg-green-500/20 text-green-500",
    "Enrollment & Documents" => "bg-blue-500/20 text-blue-400",
    "Achievement" => "bg-pink-500/20 text-pink-400",
    "Scholarship" => "bg-yellow-500/20 text-yellow-300",
];

// Iterate through the fetched blogs and add the color class to each blog item
$blogs = array_map(function ($blog) use ($categoryColorMap) {
    $colorClass =
        $categoryColorMap[$blog["category_label"]] ??
        "bg-gray-500/20 text-gray-400";

    $blog["category_color"] = $colorClass;

    return $blog;
}, $blogs);

render("account_activity_log.view.php", [
    "account_id" => $account["id"],
    "url" => $account["secure_url"],
    "username" => $account["username"],
    "join_date" => date("F d, Y", strtotime($account["created_at"])),
    "bio" => $account["bio"],
    "isAuthor" => $account["role"] === "AUTHOR",
    "isFollowed" => $isFollowed ? 1 : 0,
    "isQueryLoggedIn" => $account["id"] === $loggedInId,
    "followed_authors" => $followed_authors,
    "blogs" => $blogs,
    "email" => $account["email"],
    "isEmailLocked" => (int) $account["show_email_public"] === 1,
]);
