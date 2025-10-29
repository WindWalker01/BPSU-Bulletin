<?php
use Core\Database;
use Core\App;

// Check if request was made via fetch()
$isDropdown =
    !empty($_SERVER["HTTP_X_SEARCH_SOURCE"]) &&
    $_SERVER["HTTP_X_SEARCH_SOURCE"] === "dropdown";

if ($isDropdown) {
    // Return JSON for dropdown preview
    header("Content-Type: application/json");
    echo searchDropDownResults($_GET["query"] ?? "");

    exit();
} else {
    // Render full HTML page for Enter/Submit search
    $query = $_GET["query"] ?? "";
    $results = searchResults($query);

    render("search.view.php", [
        "users" => $results["users"],
        "blogs" => $results["blogs"],
    ]);
}

function searchDropDownResults($query)
{
    $db = App::resolve(Database::class);

    $blogs = $db
        ->query(
            "
            SELECT DISTINCT 
                b.id, b.title, b.created_at, b.published_at,
                u.username AS author_name,
                GROUP_CONCAT(DISTINCT t.name) AS tags,
                GROUP_CONCAT(DISTINCT c.value) AS categories
            FROM blogs b
            LEFT JOIN users u ON b.author_id = u.id
            LEFT JOIN blog_tags bt ON bt.blog_id = b.id
            LEFT JOIN tags t ON bt.tag_id = t.id
            LEFT JOIN blog_categories bc ON bc.blog_id = b.id
            LEFT JOIN categories c ON bc.category_id = c.id
            WHERE b.blog_status = 'ACTIVE'
                AND (
                LOWER(b.title) LIKE LOWER(:query)
                OR LOWER(IFNULL(t.name, '')) LIKE LOWER(:query)
                OR LOWER(IFNULL(c.value, '')) LIKE LOWER(:query)
                OR LOWER(IFNULL(u.username, '')) LIKE LOWER(:query)
                )
            GROUP BY b.id
            ORDER BY b.published_at DESC
            LIMIT 10
            ",
            [
                "query" => "%{$query}%",
            ],
        )
        ->get();

    $users = $db
        ->query(
            "
            SELECT 
                u.id,
                u.username,
                u.email,
                u.created_at,
            pi.secure_url
            FROM users u
            INNER JOIN profile_images pi ON pi.user_id = u.id
            WHERE 
            LOWER(u.username) LIKE LOWER(:query)
            LIMIT 10;
            ",
            [
                "query" => "%{$query}%",
            ],
        )
        ->get();

    return json_encode(["blogs" => $blogs, "users" => $users]);
}

function searchResults($query)
{
    $db = App::resolve(Database::class);

    $blogs = $db
        ->query(
            "
            SELECT
                b.id,
                u.username,
                pi.secure_url,
                b.updated_at,
                b.title,
                b.content,
                GROUP_CONCAT(DISTINCT t.name) AS tags,
                GROUP_CONCAT(DISTINCT cat.value) AS categories,
                COUNT(DISTINCT CASE WHEN br.reaction_id = 1 THEN br.id END) AS reaction_count_like,
                COUNT(DISTINCT c.id) AS comment_count

            FROM blogs b
            INNER JOIN users u ON b.author_id = u.id
            LEFT JOIN profile_images pi ON b.author_id = pi.user_id
            LEFT JOIN blog_reactions br ON b.id = br.blog_id
            LEFT JOIN comments c ON b.id = c.blog_id
            LEFT JOIN blog_tags bt ON bt.blog_id = b.id
            LEFT JOIN tags t ON bt.tag_id = t.id
            LEFT JOIN blog_categories bc ON bc.blog_id = b.id
            LEFT JOIN categories cat ON bc.category_id = cat.id

            WHERE b.blog_status = 'ACTIVE'
            AND (
                LOWER(b.title) LIKE LOWER(:query)
                OR LOWER(IFNULL(t.name, '')) LIKE LOWER(:query)
                OR LOWER(IFNULL(cat.value, '')) LIKE LOWER(:query)
                OR LOWER(IFNULL(u.username, '')) LIKE LOWER(:query)
            )

            GROUP BY
                b.id,
                u.username,
                pi.secure_url,
                b.updated_at,
                b.title,
                b.content

            ORDER BY
                b.updated_at DESC
            LIMIT 10;


    ",
            ["query" => "%{$query}%"],
        )
        ->get();

    $users = $db
        ->query(
            "
            SELECT 
                u.id,
                u.username,
                u.email,
                u.created_at,
            pi.secure_url
            FROM users u
            INNER JOIN profile_images pi ON pi.user_id = u.id
            WHERE 
            LOWER(u.username) LIKE LOWER(:query)
            LIMIT 10;
            ",
            [
                "query" => "%{$query}%",
            ],
        )
        ->get();

    return ["blogs" => $blogs, "users" => $users];
}

exit();
