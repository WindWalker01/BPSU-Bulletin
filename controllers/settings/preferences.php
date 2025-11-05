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

// Fetch the user's preferences
$preferences = $db->query(
    "SELECT * FROM user_preferences WHERE user_id = :user_id",
    ['user_id' => $current_user_id]
)->find();

// If no preferences exist, create a default entry
if (!$preferences) {
    $db->query(
        "INSERT INTO user_preferences (user_id) VALUES (:user_id)",
        ['user_id' => $current_user_id]
    );
    // Fetch the newly created (default) preferences
    $preferences = $db->query(
        "SELECT * FROM user_preferences WHERE user_id = :user_id",
        ['user_id' => $current_user_id]
    )->find();
}

render('settings/preferences.view.php', [
    'preferences' => $preferences
]);
