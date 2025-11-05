<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$current_user_id = (new Authenticator())->getLoggedInUserId();

if (!$current_user_id) {
    redirect('/login'); 
    exit();
}

$search_term = $_GET['search'] ?? '';
$sort_order = $_GET['sort'] ?? 'desc';

$sql_params = ['author_id' => $current_user_id];
$search_sql = '';
$order_by_sql = '';

if (!empty($search_term)) {
    $search_sql = " AND b.title LIKE :search"; 
    $sql_params['search'] = '%' . $search_term . '%';
}

if ($sort_order === 'asc') {
    $order_by_sql = "b.updated_at ASC"; 
} else {
    $order_by_sql = "b.updated_at DESC"; 
}


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
        b.blog_status = 'HIDDEN' AND b.author_id = :author_id
        {$search_sql}
    ORDER BY 
        {$order_by_sql}",
    $sql_params
)->get();


render('stats/drafts.view.php', [ 
    'draft_blogs' => $posts,
    'search_term' => $search_term, 
    'sort_order' => $sort_order     
]);