<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
$db = App::resolve(Database::class);
$auth = new Authenticator();

$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];
$errors = [];

if ($password !== $confirm_password) {
    $errors["password"] = "Passwords do not match.";
}

if ($auth->isUserExist($email)) {
    $errors["email"] = "An account with this email already exists.";
}

if (!empty($errors)) {
    render(
        "/register/register.view.php",
        [
            "title" => "Register Account",
            "errors" => $errors,
            "old" => ["email" => $email],
        ],
        false,
    );
    exit();
}
$hashed_password = password_hash($password, PASSWORD_ARGON2ID);

$_SESSION["registration_data"] = [
    "email" => $email,
    "password_hash" => $hashed_password,
];

redirect("/edit-profile");
exit();
