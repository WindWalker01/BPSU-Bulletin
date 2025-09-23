<?php
require 'router.php';
require 'utils.php';


routeToController($_SERVER['REQUEST_URI'], $routes);