<?php
use Core\Authenticator;
use Core\App;
use Core\Database;

$email = $_POST["email"];
$password = $_POST["password"];
$auth = new Authenticator();
$db = App::resolve(Database::class);

$user = $db->query(
    "SELECT * FROM users WHERE email = :email",
    ['email' => $email]
)->find();

if (!$user || !password_verify($password, $user['password'])) {
    redirect("/login"); 
    exit();
}

if ($user['account_status'] === 'DELETED') {
    // Reactivate the account
    $db->query(
        "UPDATE users SET account_status = 'ACTIVE' WHERE id = :id",
        ['id' => $user['id']]
    );
}
$auth->generateToken($user['email'], $user['role']);

redirect("/");
exit();