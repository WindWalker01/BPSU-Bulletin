<?php
session_start();

use Core\App;
use Core\Container;
use Core\Database;
use Core\Router;

define("BASE_PATH", dirname(__DIR__) . "/");
require BASE_PATH . "core/utils.php";

require base_path("vendor/autoload.php");
require __DIR__ . "/../vendor/autoload.php";

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

App::resolve(Database::class);

require base_path("public/jobs.php");

$router = new Router();

// get all the routes of the application
$routes = require base_path("public/routes.php");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

$router->route(parse_url($_SERVER["REQUEST_URI"])["path"], $method);
