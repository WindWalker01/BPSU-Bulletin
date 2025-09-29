<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$email = $_POST["email"];
$password = $_POST["password"];

$user = $db->query(
    "INSERT INTO users (role, username, email, password, account_status, created_at) VALUES
('USER', 'ruzzel', :email, :password, 'ACTIVE', NOW());",
    [
        "email" => $email,
        "password" => $password,
    ],
);

header("location: /");
exit();
