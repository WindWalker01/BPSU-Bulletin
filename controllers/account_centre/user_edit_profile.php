<?php
use Core\App;
use Core\Authenticator;
use Core\Database;

$id = new Authenticator()->getLoggedInUserId();

$db = App::resolve(Database::class);

$image = $db
    ->query("SELECT * FROM profile_images WHERE user_id = :id", ["id" => $id])
    ->find();

$user = $db->query("SELECT * FROM users WHERE id = :id", ["id" => $id])->find();



render("user_edit_profile.view.php", [
    "image_url" => $image["secure_url"],
    "id" => $id,
    "username" => $user["username"],
    "email" => $user["email"],
    "campus" => $user["campus"],
    "bio" => $user["bio"],


]);



