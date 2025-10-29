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

$posts = $db->query(
    "SELECT 
        id, 
        title, 
        blog_status 
    FROM blogs
    WHERE 
        blog_status = 'DELETED' AND author_id = :author_id
    ORDER BY 
        updated_at DESC",
    ['author_id' => $current_user_id]
)->get();

render('stats/archived.view.php', [ 
    'archived_blogs' => $posts 
]);