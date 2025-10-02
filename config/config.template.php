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
    "service" => [
        "google-auth" => [
            "client_id" => "id",
            "project_id" => "bpsu-bulletin",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" =>
                "https://www.googleapis.com/oauth2/v1/certs",
            "client_secret" => "secret",
            "redirect_uris" => "uri",
        ],
    ],
    "jwt-secret-key" => "secret-key",
    "domain" => "localhost",
];
