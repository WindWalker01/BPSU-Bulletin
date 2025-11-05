<?php
namespace Core\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Admin
{
    public function handle()
    {
        $config = require base_path("config/config.php");

        if (!isset($_COOKIE["auth_token"])) {
            redirect("/login");
            exit();
        }

        $jwt = (array) JWT::decode(
            $_COOKIE["auth_token"],
            new Key($config["jwt-secret-key"], "HS256"),
        );

        if ($jwt["role"] !== "ADMIN") {
            // TODO: create an unauthorized page
            redirect("/");
            exit();
        }
    }
}
