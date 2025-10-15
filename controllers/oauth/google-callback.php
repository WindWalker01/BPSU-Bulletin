<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
$config = require base_path("config/config.php");

//request the users data from google
$client = new Google_Client();
$client->setClientId($config["service"]["google-auth"]["client_id"]);
$client->setClientSecret($config["service"]["google-auth"]["client_secret"]);
$client->setRedirectUri($config["service"]["google-auth"]["redirect_uris"]);

if (isset($_GET["code"])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $client->setAccessToken($token);

    // Get profile info
    // Verify and decode the ID token
    $id_token = $client->verifyIdToken();
    if (!$id_token) {
        echo "<script>console.log('error');</script>";
        redirect("/");
        exit();
    }

    $user_email = $id_token["email"];
    $user_name = $id_token["name"] ?? "";

    $auth = new Authenticator();

    if (!$auth->isUserExist($user_email)) {
        // create user
        $db = App::resolve(Database::class);

        $user = $db->query(
            "INSERT INTO `users` (`role`, `username`, `email`, `password`, `account_status`, `created_at`, `auth_provider`) VALUES
('USER', 'Ruzzel', :email, NULL, 'ACTIVE',  NOW(), 'GOOGLE');",
            [
                "email" => $user_email,
            ],
        );
    }

    // generate the token and store in client as cookies
    $auth->generateToken($user_email);

    $id = $db->getLastInsertID();

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
}

redirect("/login");
