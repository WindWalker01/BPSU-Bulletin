<?php
use Core\Database;

define("BASE_PATH", dirname(__DIR__) . "/");
require BASE_PATH . "core/utils.php";

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);

    require base_path("{$class}.php");
});

$db = new Database(require base_path("config/config.php"));

require base_path("core/router.php");
