controllers/settings/preferences-update.php

<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$current_user_id = (new Authenticator())->getLoggedInUserId();

if (!$current_user_id) {
    http_response_code(403); // Forbidden
    echo json_encode(['error' => 'User not authenticated']);
    exit();
}

// Get the raw POST data
$json = file_get_contents('php://input');
// Decode the JSON data
$data = json_decode($json, true);

if (!$data || !isset($data['name']) || !isset($data['value'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid data']);
    exit();
}

$column_name = $data['name'];
$value = $data['value'];

// Whitelist of allowed columns to prevent SQL injection
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
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid preference name']);
    exit();
}

// Dynamically build the query
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