<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

if (!isset($_SESSION['registration_data'])) {
    redirect('/register');
    exit();
}

$db = App::resolve(Database::class);
$config = require base_path('config/config.php');
$auth = new Authenticator();

$email = $_SESSION['registration_data']['email'];
$hashed_password = $_SESSION['registration_data']['password_hash'];
$username = $_POST['username'];
$campus = $_POST['campus'];
$profile_image_file = $_FILES['profile_image'];

$db->query(
    "INSERT INTO users (role, email, password, username, campus, account_status, created_at, auth_provider)
     VALUES ('USER', :email, :password, :username, :campus, 'ACTIVE', NOW(), 'LOCAL')",
    [
        'email' => $email,
        'password' => $hashed_password,
        'username' => $username,
        'campus' => $campus
    ]
);

$user_id = $db->getLastInsertID();
$secure_url = "https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760538796/default_profile_xgg15t.jpg";
$asset_id = "default_profile_xgg15t";

if (isset($profile_image_file) && $profile_image_file['error'] === UPLOAD_ERR_OK) {
    try {
        $cloudinary_config = $config['service']['cloudinary'];
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloudinary_config['cloud_name'],
                'api_key'    => $cloudinary_config['api_key'],
                'api_secret' => $cloudinary_config['api_secret'],
            ],
        ]);

        $upload_result = $cloudinary->uploadApi()->upload(
            $profile_image_file['tmp_name'],
            ['folder' => 'bulletin_profile_images']
        );
        
        $secure_url = $upload_result['secure_url'];
        $asset_id = $upload_result['public_id'];

    } catch (Exception $e) {
        // Log the error but continue with the default image
        error_log("Cloudinary upload failed for new user $user_id: " . $e->getMessage());
    }
}

// 6. Insert the profile image (default or uploaded)
$db->query(
    "INSERT INTO profile_images (user_id, secure_url, asset_id)
     VALUES (:id, :url, :asset)",
    [
        'id' => $user_id,
        'url' => $secure_url,
        'asset' => $asset_id,
    ]
);

$db->query(
    "INSERT INTO user_preferences (user_id, theme_preference, email_notification, push_notification,
     reaction_notification, follow_notification, show_email_public, show_profile_public,
     created_at, updated_at)
     VALUES (:id, 'DARK', 1, 1, 1, 1, 1, 1, NOW(), NOW())",
    ['id' => $user_id]
);

$auth->generateToken($email, 'USER');

unset($_SESSION['registration_data']);

redirect('/');
exit();