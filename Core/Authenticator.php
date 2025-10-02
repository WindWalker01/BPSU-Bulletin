<?php

namespace Core;

use Core\App;
use Core\Database;
use Firebase\JWT\JWT;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $email,
            ])
            ->find();

        if ($user) {
            // TODO: verify the password
            password_verify($password, $user["password"]);
            return true;
        }

        return false;
    }

    public function generateToken($email)
    {
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
    }
}
