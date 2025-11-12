<?php
use Core\App;
use Core\Database;

// last line of defense because a  user might accidentally go to this uri
// this should really be on its own middleware but oh well it is what it is

if (!isUserBanned()) {
    redirect("/");
    exit();
}

//  destroy token cookie on arrival
setcookie("auth_token", "", time() - 3600, "/", "", true, true);

view("banned.view.php");
