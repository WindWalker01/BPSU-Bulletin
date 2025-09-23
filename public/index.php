<?php
require 'router.php';
require 'utils.php';

dd($_SERVER['REQUEST_URI']);
routeToController($_SERVER['REQUEST_URI'], $routes);