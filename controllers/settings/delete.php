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

try {
    $db->query("DELETE FROM users WHERE id = :id", ['id' => $current_user_id]);
    $_SESSION = array();

    session_destroy();

    setcookie("auth_token", "", time() - 3600, "/", "", true, true);

    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    redirect('/register');
    exit();

} catch (\PDOException $e) {
    error_log("Failed to delete user $current_user_id: " . $e->getMessage());
    $_SESSION['_flash']['error'] = 'Could not delete account. Please contact support.';
    redirect('/settings');
    exit();
}