<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$current_user_id = (new Authenticator())->getLoggedInUserId();

if (!$current_user_id) {
    http_response_code(403); 
    echo json_encode(['error' => 'User not authenticated']);
    exit();
}

$json = file_get_contents('php://input');

$data = json_decode($json, true);

if (!$data || !isset($data['name']) || !isset($data['value'])) {
    http_response_code(400); 
    echo json_encode(['error' => 'Invalid data']);
    exit();
}

$column_name = $data['name'];
$value = $data['value'];


$allowed_columns = [
    'theme_preference',
    'email_notification',
    'push_notification',
    'reaction_notification',
    'follow_notification',
    'show_email_public',
    'show_profile_public'
];

if (!in_array($column_name, $allowed_columns)) {
    http_response_code(400); 
    echo json_encode(['error' => 'Invalid preference name']);
    exit();
}

$db->query(
    "UPDATE user_preferences SET {$column_name} = :value WHERE user_id = :user_id",
    [
        'value' => $value,
        'user_id' => $current_user_id
    ]
);

http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Preference updated']);
exit();