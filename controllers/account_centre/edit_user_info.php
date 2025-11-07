<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);

$username = $_POST["username"];
$user_id = $_POST["user_id"];
$email = $_POST["email"];
$campus = $_POST["campus"];
$bio = ltrim($_POST["bio"]);

// get the role before updating the email
$role = getLoggedInRole();

$db->query(
    "UPDATE users 
    SET 
    username = :username, 
    email = :email,
    bio = :bio,
    campus = :campus
    WHERE id = :user_id",
    [
        "username" => $username,
        "email" => $email,
        "bio" => $bio,
        "campus" => $campus,
        "user_id" => $user_id,
    ],
);

// generate the cookies again
$auth = new Authenticator();

$auth->deleteToken();

$auth->generateToken($email, $role);

redirect("/account");
