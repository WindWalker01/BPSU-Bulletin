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


render("account_activity_log.view.php", [
    "url" => $image["secure_url"],
    "bio" => $user["bio"],

      

]);

