<?php
use Core\Authenticator;

$auth = new Authenticator();

$auth->deleteToken();

redirect("/");

exit();
