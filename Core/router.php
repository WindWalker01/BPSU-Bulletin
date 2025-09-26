<?php
$routes = [
    "/" => "controllers/index.php",
    "/blogPost" => "controllers/blog_post.php",
];

routeToController($_SERVER["REQUEST_URI"], $routes);

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        echo "Not Found.";
        http_response_code(404);
        die();
    }
}
