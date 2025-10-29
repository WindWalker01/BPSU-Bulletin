<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$current_user_id = (new Authenticator())->getLoggedInUserId();

// If no user is logged in, they can't see "Their Posts"
if (!$current_user_id) {
    redirect('/login'); 
    exit();
}

// 1. THE CORRECT QUERY
// This query joins the blogs, views, and comments tables to get the counts.
$posts = $db->query(
    "SELECT 
        b.id, 
        b.title, 
        b.blog_status, 
        COALESCE(v.views_count, 0) as views_count, 
        COALESCE(c.comments_count, 0) as comments_count
    FROM blogs b
    LEFT JOIN (
        SELECT blog_id, COUNT(*) as views_count 
        FROM blog_views 
        GROUP BY blog_id
    ) v ON b.id = v.blog_id
    LEFT JOIN (
        SELECT blog_id, COUNT(*) as comments_count 
        FROM comments 
        GROUP BY blog_id
    ) c ON b.id = c.blog_id
    WHERE 
        b.blog_status = 'ACTIVE' AND b.author_id = :author_id
    ORDER BY 
        b.published_at DESC",
    ['author_id' => $current_user_id]
)->get();

render('stats/stats.view.php', [ 
    'published_blogs' => $posts
]);