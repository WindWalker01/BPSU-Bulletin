<?php
require "router.php";
require "utils.php";
require "Database.php";

$db = new Database(require "../config/config.php");

routeToController($_SERVER["REQUEST_URI"], $routes);
