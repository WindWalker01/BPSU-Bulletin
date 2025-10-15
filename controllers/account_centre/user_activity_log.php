<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$image = $db
    ->query("SELECT * FROM profile_images WHERE user_id = :id", ["id" => $id])
    ->find();

render("account_activity_log.view.php", [
    "url" => $image["secure_url"],
]);
