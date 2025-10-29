use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$email = $_POST["email"];
$password = $_POST["password"];

$hashed_pasword = password_hash($password, PASSWORD_ARGON2ID);
$auth = new Authenticator();

if ($auth->isUserExist($email)) {
    // TODO: make an error page about this
    $auth->generateToken($email);
    redirect("/");
    exit();
}

// create user account
$id = $db->query(
    "INSERT INTO `users` (`role`, `username`, `email`, `password`, `account_status`, `created_at`, `auth_provider`) VALUES
('USER', 'Ruzzel', :email, :password, 'ACTIVE', NOW(), 'LOCAL');",
    [
        "email" => $email,
        "password" => $hashed_pasword,
    ],
);

// log in the user
$auth->generateToken($email);

// gets the registered user id because its the last inserted row
$id = $db->getLastInsertID();

if (!$signedIn) {
    redirect("/login");

    exit();
}

$role = $auth->getLoggedInRoleWithEmail($email);

$auth->generateToken($email, $role);

redirect("/");

$db->query(
    "INSERT INTO `user_preferences` (
    `user_id`, 
    `theme_preference`, 
    `email_notification`, 
    `push_notification`, 
    `reaction_notification`, 
    `follow_notification`, 
    `show_email_public`, 
    `show_profile_public`, 
    `created_at`, 
    `updated_at`
    ) VALUES(
    :id, 
    'DARK', 
    1, 
    1, 
    1, 
    1, 
    1, 
    1, 
    NOW(), 
    NOW());",
    ["id" => $id],
);

// create profile image of the user
$db->query(
    "INSERT INTO profile_images (`user_id`, `secure_url`, `asset_id`) VALUES (:id, :url, :asset)",
    [
        "id" => $id,
        "url" =>
            "https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760538796/default_profile_xgg15t.jpg",
        "asset" => "default_profile_xgg15t",
    ],
);

redirect("/");
exit();