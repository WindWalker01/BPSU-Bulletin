<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Get category ID for "University Announcements"
$category = $db
    ->query(
        "SELECT id FROM categories WHERE value = 'University Announcements' LIMIT 1",
    )
    ->find();

$category_id = $category["id"];

// Pagination setup
$limit = 5;
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$offset = ($page - 1) * $limit;

// Get search term from input
$search = $_GET["search"] ?? "";

// Build base SQL with optional search condition
$searchCondition = "";
$params = ["category_id" => $category_id];

if (!empty($search)) {
    $searchCondition = "AND blogs.title LIKE :search";
    $params["search"] = "%" . $search . "%";
}

// Get total count (for pagination)
$totalQuery = $db
    ->query(
        "SELECT COUNT(*) as total 
     FROM blogs 
     JOIN blog_categories ON blogs.id = blog_categories.blog_id
     WHERE blog_categories.category_id = :category_id
       AND blogs.blog_status = 'ACTIVE'
       $searchCondition",
        $params,
    )
    ->find();

$totalBlogs = $totalQuery["total"];
$totalPages = ceil($totalBlogs / $limit);

// Get filtered blog posts (with search + pagination)
$blogs = $db
    ->query(
        "SELECT 
        blogs.id,
        blogs.title,
        blogs.content,
        blogs.created_at,
        users.username,
        users.campus,
        profile_images.secure_url AS author_avatar,
        blog_images.secure_url AS blog_image
     FROM blogs
     JOIN users ON blogs.author_id = users.id
     LEFT JOIN profile_images ON profile_images.user_id = users.id
     LEFT JOIN blog_images ON blog_images.blog_id = blogs.id
     JOIN blog_categories ON blogs.id = blog_categories.blog_id
     WHERE blog_categories.category_id = :category_id 
       AND blogs.blog_status = 'ACTIVE'
       $searchCondition
     ORDER BY blogs.created_at DESC
     LIMIT $limit OFFSET $offset",
        $params,
    )
    ->get();

// Render view
render("kategorya/announcement_cat.view.php", [
    "blogs" => $blogs,
    "totalPages" => $totalPages,
    "page" => $page,
]);
?>
