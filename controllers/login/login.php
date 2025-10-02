<?php
use Core\Authenticator;
use Firebase\JWT\JWT;

$email = $_POST["email"];
$password = $_POST["password"];

// check if the credentials are in the database
$signedIn = new Authenticator()->attempt($email, $password);

if (!$signedIn) {
    header("location: /login");
    exit();
}

// create a jwt token/payload
$config = require base_path("config/config.php");

$payload = [
    "iss" => "http://bpsu.bulletin.test", // Issuer
    "aud" => "http://bpsu-bulletin.test", // Audience
    "iat" => time(), // Issued at
    "exp" => time() + 60 * 60, // Expiration (1 hour)
    "email" => $email, // Custom claim
];

$jwt = JWT::encode($payload, $config["jwt-secret-key"], "HS256");

echo json_encode([
    "token" => $jwt,
]);

setcookie(
    "auth_token", // cookie name
    $jwt, // the token
    [
        "expires" => time() + 3600, // 1 hour
        "path" => "/", // available across the site
        "domain" => "bpsu-bulletin.test", // set your domain
        // "secure" => true, // only send over HTTPS
        "httponly" => true, // JavaScript can't access it
        "samesite" => "Strict", // protects from CSRF
    ],
);

header("location: /");
