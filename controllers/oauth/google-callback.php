<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
$config = require base_path("config/config.php");

$client = new Google_Client();
$client->setClientId($config["service"]["google-auth"]["client_id"]);
$client->setClientSecret($config["service"]["google-auth"]["client_secret"]);
$client->setRedirectUri($config["service"]["google-auth"]["redirect_uris"]);

if (isset($_GET["code"])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $client->setAccessToken($token);

    $id_token = $client->verifyIdToken();
    if (!$id_token) {
        echo "<script>console.log('error');</script>";
        redirect("/");
        exit();
    }

    $user_email = $id_token["email"];

    $auth = new Authenticator();
    $db = App::resolve(Database::class);

    if (!$auth->isUserExist($user_email)) {
        $_SESSION['registration_data'] = [
            'email' => $user_email,
            'password_hash' => null,
            'auth_provider' => 'GOOGLE'
        ];

        redirect("/edit-profile");
        exit();
    } else {
        $user = $db
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $user_email,
            ])
            ->find();

        if ($user['account_status'] === 'DELETED') {
            $db->query(
                "UPDATE users SET account_status = 'ACTIVE' WHERE id = :id",
                ['id' => $user['id']]
            );
        }

        $role = $user["role"];

        $auth->generateToken($user_email, $role ?? "USER");

        redirect("/");
        exit();
    }
}

redirect("/login");