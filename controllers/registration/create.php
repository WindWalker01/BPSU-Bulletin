<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$email = $_POST["email"];
$password = $_POST["password"];

$hashed_pasword = password_hash($password, PASSWORD_ARGON2ID);

$user = $db->query(
    "INSERT INTO `users` (`role`, `username`, `email`, `password`, `account_status`, `created_at`, `auth_provider`) VALUES
('USER', 'Ruzzel', :email, :password, 'ACTIVE', NOW(), 'LOCAL');",
    [
        "email" => $email,
        "password" => $hashed_pasword,
    ],
);

$auth = new Authenticator();

$auth->generateToken($email);

redirect("/");
exit();
