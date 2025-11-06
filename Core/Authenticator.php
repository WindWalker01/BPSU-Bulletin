<?php

namespace Core;

use Core\App;
use Core\Database;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
            password_verify($password, $user["password"]);
            return true;
        }

        return false;
    }

    public function isUserExist($email)
    {
        $user = App::resolve(Database::class)
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $email,
            ])
            ->find();

        if (!$user) {
            return false;
        }
        return true;
    }

    public function generateToken($email, $role = "USER")
    {
        // create a jwt token/payload
        $config = require base_path("config/config.php");

        $payload = [
            "iss" => $config["domain"], // Issuer
            "aud" => $config["domain"], // Audience
            "iat" => time(), // Issued at
            "exp" => time() + 60 * 60, // Expiration (1 hour)
            "email" => $email, // Custom claim,
            "role" => $role,
        ];

        $jwt = JWT::encode($payload, $config["jwt-secret-key"], "HS256");

        setcookie(
            "auth_token", // cookie name
            $jwt, // the token / value
            [
                "expires" => time() + 3600, // 1 hour
                "path" => "/", // available across the site
                "domain" => $config["domain"], // set your domain
                "secure" => false, // only send over HTTPS
                "httponly" => true, // JavaScript can't access it
                "samesite" => "Lax", // protects from CSRF
            ],
        );
    }

    public function deleteToken()
    {
        $config = require base_path("config/config.php");

        setcookie(
            "auth_token", // cookie name
            "", // the token
            [
                "expires" => time() - 3600, // 1 hour
                "path" => "/", // available across the site
                "domain" => $config["domain"], // set your domain
                // "secure" => true, // only send over HTTPS
                "httponly" => true, // JavaScript can't access it
                "samesite" => "Strict", // protects from CSRF
            ],
        );
    }

    public function getLoggedInRole()
    {
        $config = require base_path("config/config.php");

        if (!isset($_COOKIE["auth_token"])) {
            return "guest";
        }

        $jwt = (array) JWT::decode(
            $_COOKIE["auth_token"],
            new Key($config["jwt-secret-key"], "HS256"),
        );

        $user = App::resolve(Database::class)
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $jwt["email"],
            ])
            ->find();

        return $user["role"];
    }

    public function getLoggedInRoleWithEmail($email)
    {
        $user = App::resolve(Database::class)
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $email,
            ])
            ->find();

        return $user["role"];
    }

    public function getLoggedInUserId()
    {
        $config = require base_path("config/config.php");

        if (!isset($_COOKIE["auth_token"])) {
            return null;
        }

        $jwt = (array) JWT::decode(
            $_COOKIE["auth_token"],
            new Key($config["jwt-secret-key"], "HS256"),
        );
        $user = App::resolve(Database::class)
            ->query("SELECT * FROM users WHERE email = :email", [
                "email" => $jwt["email"],
            ])
            ->find();
        return $user["id"];
    }
}
