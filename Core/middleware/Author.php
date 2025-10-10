<?php
namespace Core\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Author
{
    public function handle()
    {
        $config = require base_path("config/config.php");

        if (isset($_COOKIE["auth_token"])) {
            dd(
                JWT::decode(
                    $_COOKIE["auth_token"],
                    new Key($config["jwt-secret-key"], "HS256"),
                ),
            );

            exit();
        }
    }
}
