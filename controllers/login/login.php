<?php
use Core\Authenticator;

$email = $_POST["email"];
$password = $_POST["password"];

$auth = new Authenticator();

// check if the credentials are in the database
$signedIn = $auth->attempt($email, $password);

if (!$signedIn) {
    redirect("/login");

    exit();
}

$auth->generateToken($email);

redirect("/");
