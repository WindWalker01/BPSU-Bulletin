<?php
use Core\App;
use Core\Database;

$notification_id = $_POST["id"] ?? 1;

$db = App::resolve(Database::class);

$db->query("UPDATE notifications SET is_read = 1 WHERE id = :id", [
    "id" => $notification_id,
]);

exit();
