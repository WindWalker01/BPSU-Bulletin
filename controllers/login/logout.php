<?php
use Core\Authenticator;

$auth = new Authenticator();

$auth->deleteToken();

header("location: /");

exit();
