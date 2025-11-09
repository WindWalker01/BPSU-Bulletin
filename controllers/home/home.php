<?php
require_once __DIR__ . "/../../Core/Database.php";
require_once __DIR__ . "/../../Core/utils.php";
$config = require __DIR__ . "/../../config/config.php";
$db = new \Core\Database($config);

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
    header("Content-Type: application/json");

    $postsPerPage = 9; 
    $initialLoad = 7; 
    $page = (int) $_GET["page"];

    if ($page <= 1) {
        echo json_encode([]);
        exit();
    }

    $offset = ($page - 2) * $postsPerPage + $initialLoad;

    $sql = "
        SELECT 
            b.id, b.title, b.content, b.published_at,
            ANY_VALUE(u.username) AS author_name,
            ANY_VALUE(pi.secure_url) AS author_avatar,
            ANY_VALUE(bi.secure_url) AS featured_image,
            ANY_VALUE(c.value) AS category_name,
            COALESCE(ANY_VALUE(likes.likes_count), 0) AS likes_count,
            COALESCE(ANY_VALUE(comments.comments_count), 0) AS comments_count,
            COALESCE(ANY_VALUE(views.view_count), 0) AS view_count
        FROM blogs AS b
        LEFT JOIN users AS u ON b.author_id = u.id
        LEFT JOIN profile_images AS pi ON u.id = pi.user_id
        LEFT JOIN blog_images AS bi ON b.id = bi.blog_id
        LEFT JOIN blog_categories AS bc ON b.id = bc.blog_id
        LEFT JOIN categories AS c ON bc.category_id = c.id
        LEFT JOIN (
            SELECT blog_id, COUNT(id) as likes_count FROM blog_reactions GROUP BY blog_id
        ) AS likes ON b.id = likes.blog_id
        LEFT JOIN (
            SELECT blog_id, COUNT(id) as comments_count FROM comments GROUP BY blog_id
        ) AS comments ON b.id = comments.blog_id
         LEFT JOIN (
            SELECT blog_id, COUNT(DISTINCT user_id) as view_count FROM blog_views GROUP BY blog_id
        ) AS views ON b.id = views.blog_id
        WHERE 
            b.blog_status = 'ACTIVE' AND b.published_at IS NOT NULL AND b.published_at <= NOW() AND u.account_status != 'BANNED'
        GROUP BY b.id
        ORDER BY b.published_at DESC
        LIMIT $postsPerPage
        OFFSET $offset
    ";

    $db_posts = $db->query($sql)->get();

    // Transform data
    $posts = [];
    foreach ($db_posts as $row) {
        $category = $row["category_name"] ?? "General";
        $posts[] = [
            "author" => $row["author_name"] ?? "Unknown Author",
            "avatar" =>
                $row["author_avatar"] ??
                "https://lh3.googleusercontent.com/aida-public/AB6AXuC9NMh9sGihLlPg4qW0ZVugJwTHWCfx4R7RDdwO_d7fx76hgkqLOmmyzKtt2O1O8PILHK6uoqPNHxjAU1sgIrqeFIT7bwAq8W_h4fUhIjugKbitv6Hfx5fzsP_hHija_6jkQLolfI1gz4YmjBHeRB5kN9DIndJ_nULBMJDkwrNYq2Xq-y97KmDpiVewKZOgl9vJ7lZKVqbnDVZSaZUsbUMZpw98_SEf69VB6JVbLPMOYx3yi33r6BEz33cnDryThk-3Yuno-ul4CfWL",
            "date" => $row["published_at"]
                ? timeAgo($row["published_at"])
                : "Unknown Date",
            "category" => $category,
            "badgeColor" => getBadgeColor($category),
            "title" => $row["title"],
            "excerpt" => extractFirstParagraphFromTiptap($row["content"]) ?? "",
            "link" => "/blog?id=" . $row["id"],
            "image" =>
                $row["featured_image"] ??
                "https://via.placeholder.com/640x360?text=No+Image",
            "likes" => $row["likes_count"],
            "comments" => $row["comments_count"],
            "views" => $row["view_count"],
        ];
    }

    echo json_encode($posts);
    exit(); 
} else {
    $limit = 7;

    $sql = "
        SELECT 
            b.id, b.title, b.content, b.published_at,
            ANY_VALUE(u.username) AS author_name,
            ANY_VALUE(pi.secure_url) AS author_avatar,
            ANY_VALUE(bi.secure_url) AS featured_image,
            ANY_VALUE(c.value) AS category_name,
            COALESCE(ANY_VALUE(likes.likes_count), 0) AS likes_count,
            COALESCE(ANY_VALUE(comments.comments_count), 0) AS comments_count,
            COALESCE(ANY_VALUE(views.view_count), 0) AS view_count
        FROM blogs AS b
        LEFT JOIN users AS u ON b.author_id = u.id
        LEFT JOIN profile_images AS pi ON u.id = pi.user_id
        LEFT JOIN blog_images AS bi ON b.id = bi.blog_id
        LEFT JOIN blog_categories AS bc ON b.id = bc.blog_id
        LEFT JOIN categories AS c ON bc.category_id = c.id
        LEFT JOIN (
            SELECT blog_id, COUNT(id) as likes_count FROM blog_reactions GROUP BY blog_id
        ) AS likes ON b.id = likes.blog_id
        LEFT JOIN (
            SELECT blog_id, COUNT(id) as comments_count FROM comments GROUP BY blog_id
        ) AS comments ON b.id = comments.blog_id
        LEFT JOIN (
            SELECT blog_id, COUNT(DISTINCT user_id) as view_count FROM blog_views GROUP BY blog_id
        ) AS views ON b.id = views.blog_id
        WHERE 
            b.blog_status = 'ACTIVE' AND b.published_at IS NOT NULL AND b.published_at <= NOW() AND u.account_status != 'BANNED'
        GROUP BY b.id
        ORDER BY b.published_at DESC
        LIMIT $limit
    ";

    $db_posts = $db->query($sql)->get();

    $posts_data = [];
    foreach ($db_posts as $row) {
        $category = $row["category_name"] ?? "General";
        $posts_data[] = [
            "author" => $row["author_name"] ?? "Unknown Author",
            "avatar" =>
                $row["author_avatar"] ??
                "https://lh3.googleusercontent.com/aida-public/AB6AXuC9NMh9sGihLlPg4qW0ZVugJwTHWCfx4R7RDdwO_d7fx76hgkqLOmmyzKtt2O1O8PILHK6uoqPNHxjAU1sgIrqeFIT7bwAq8W_h4fUhIjugKbitv6Hfx5fzsP_hHija_6jkQLolfI1gz4YmjBHeRB5kN9DIndJ_nULBMJDkwrNYq2Xq-y97KmDpiVewKZOgl9vJ7lZKVqbnDVZSaZUsbUMZpw98_SEf69VB6JVbLPMOYx3yi33r6BEz33cnDryThk-3Yuno-ul4CfWL",
            "date" => $row["published_at"]
                ? timeAgo($row["published_at"])
                : "Unknown Date",
            "category" => $category,
            "badgeColor" => getBadgeColor($category),
            "title" => $row["title"],
            "excerpt" => extractFirstParagraphFromTiptap($row["content"]) ?? "",
            "link" => "/blog?id=" . $row["id"],
            "image" =>
                $row["featured_image"] ??
                (extractFirstImageFromTiptap($row["content"]) ??
                    "https://via.placeholder.com/640x360?text=No+Image"),
            "likes" => $row["likes_count"],
            "comments" => $row["comments_count"],
            "views" => $row["view_count"],
        ];
    }

    $featured_posts = array_slice($posts_data, 0, 3);
    $grid_posts = array_slice($posts_data, 3);

    render("home.view.php", [
        "title" => "Home Page",
        "featured_posts" => $featured_posts, 
        "grid_posts" => $grid_posts, 
    ]);
}
