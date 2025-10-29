<?php
use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$username = $_POST["username"];
$user_id = $_POST["user_id"];
$email = $_POST["email"];
$campus = $_POST["campus"];
$bio = ltrim($_POST["bio"]);


$db->query(
    "UPDATE users 
    SET 
    username = :username, 
    email = :email,
    bio = :bio,
    campus = :campus
    WHERE id = :user_id",
    ["username" => $username, "email" => $email, "bio" => $bio, "campus" => $campus, "user_id" => $user_id]
);


redirect("/account");