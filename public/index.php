<?php
use Core\Database;
use Core\Router;

define("BASE_PATH", dirname(__DIR__) . "/");
require BASE_PATH . "core/utils.php";

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);

    require base_path("{$class}.php");
});

$db = new Database(require base_path("config/config.php"));

// require base_path("core/router.php");
$router = new Router();

$routes = require base_path("public/routes.php");

// routeToController($_SERVER["REQUEST_URI"], $routes);

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

$router->route($_SERVER["REQUEST_URI"], $method);
