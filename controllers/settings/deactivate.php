<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$auth = new Authenticator();
$current_user_id = $auth->getLoggedInUserId();

if (!$current_user_id) {
    redirect('/login');
    exit();
}

$db->query(
    "UPDATE users SET account_status = 'DELETED' WHERE id = :id",
    ['id' => $current_user_id]
);

$_SESSION = array();

session_destroy();

$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
);

redirect('/login');
exit();