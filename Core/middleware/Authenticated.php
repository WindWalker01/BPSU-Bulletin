<?php

namespace Core\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class Authenticated
{
    public function handle()
    {
        //TODO:
        // check if the session has a token
        if (!isset($_COOKIE["auth_token"])) {
            http_response_code(401);
            header("location: /login");
            exit();
        }

        $auth_token = $_COOKIE["auth_token"];

        try {
            $config = require base_path("config/config.php");

            JWT::decode(
                $auth_token,
                new Key($config["jwt-secret-key"], "HS256"),
            );
        } catch (ExpiredException $e) {
            http_response_code(401);
            // echo "Token expired";
            header("location: /login");
        } catch (SignatureInvalidException $e) {
            http_response_code(401);
            // echo "Invalid token signature";
            header("location: /login");
        } catch (Exception $e) {
            http_response_code(401);
            // echo "Invalid token: " . $e->getMessage();
            header("location: /login");
        }

        // if it has extract it
        // check that token if it is valid
    }
}
