controllers/stats/delete.php

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

// === ADD THIS LINE ===
// Get the redirect URL from the form, defaulting to /stats
$redirect_url = $_POST['redirect_to'] ?? '/stats';

if (!$blog_id) {
    abort(404); // Not Found
}

$blog = $db->query(
    "SELECT author_id FROM blogs WHERE id = :id",
    ['id' => $blog_id]
)->findOrFail(); // findOrFail will abort(404) if not found

if ((int)$blog['author_id'] !== (int)$current_user_id) {
    abort(403); // Forbidden
}

$db->query(
    "DELETE FROM blogs WHERE id = :id AND author_id = :author_id",
    [
        'id' => $blog_id,
        'author_id' => $current_user_id
    ]
);

redirect($redirect_url);
exit();