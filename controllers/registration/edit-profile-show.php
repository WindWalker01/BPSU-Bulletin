<?php

if (!isset($_SESSION['registration_data'])) {
    redirect('/register');
    exit();
}

render("register/edit-profile.view.php");