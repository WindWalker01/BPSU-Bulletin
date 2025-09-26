<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Router;

define("BASE_PATH", dirname(__DIR__) . "/");
require BASE_PATH . "core/utils.php";

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);

    require base_path("{$class}.php");
});

//Set up the service container
$container = new Container();
App::setContainer($container);

// bind the database class
App::bind("Core\Database", function () {
    return new Database(require base_path("config/config.php"));
});

// get the instance of the db class in the service container
$db = App::resolve(Database::class);

$router = new Router();

$routes = require base_path("public/routes.php");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

$router->route($_SERVER["REQUEST_URI"], $method);
