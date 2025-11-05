controllers/stats/unarchive.php

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

$blog_id = $_POST['id'] ?? null;

if (!$blog_id) {
    abort(404); 
}

$blog = $db->query(
    "SELECT author_id FROM blogs WHERE id = :id",
    ['id' => $blog_id]
)->findOrFail(); 

if ((int)$blog['author_id'] !== (int)$current_user_id) {
    abort(403); 
}

$db->query(
    "UPDATE blogs SET blog_status = 'ACTIVE' WHERE id = :id AND author_id = :author_id",
    [
        'id' => $blog_id,
        'author_id' => $current_user_id
    ]
);

redirect('/archived');
exit();