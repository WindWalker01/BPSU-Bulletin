<?php
// This is the content for your new 'scheduled.php' controller

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
        blog_status = 'SCHEDULED' AND author_id = :author_id
    ORDER BY 
        scheduled_at ASC",
    ['author_id' => $current_user_id]
)->get();


render('stats/scheduled.view.php', [ 
    'scheduled_blogs' => $posts
]);