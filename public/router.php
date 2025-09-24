<?php
$routes = [
    "/" => "../views/home.view.php",
    "/blogPost" => "../views/blogPost.view.php",
];

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        echo "Not Found.";
        http_response_code(404);
        die();
    }
}
