<?php
// A template for local configuration.
// DO NOT COMMIT THIS FILE WITH YOUR CREDENTIALS.
// Instead, create a copy and name it config.php
return [
    "database" => [
        "host" => "localhost",
        "port" => "3306",
        "dbname" => "bulletin",
        "charset" => "utf8mb4",
        "user" => "your_username",
        "password" => "your_password",
    ],
    "service" => [],
    "jwt-secret-key" => "secret-key",
];
