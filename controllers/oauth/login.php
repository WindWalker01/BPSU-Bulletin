<?php

$config = require base_path("config/config.php");

$client = new Google_Client();
$client->setClientId($config["service"]["google-auth"]["client_id"]);
$client->setClientSecret($config["service"]["google-auth"]["client_secret"]);
$client->setRedirectUri($config["service"]["google-auth"]["redirect_uris"]);
$client->addScope("email");
$client->addScope("profile");

// Redirect to Google Sign-in
if (!isset($_GET["code"])) {
    $auth_url = $client->createAuthUrl();
    header("Location: " . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit();
}
