<?php
use Core\Authenticator;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";

    die();
}

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}

function redirect($path, $components = [])
{
    $query = http_build_query($components);
    header("location: {$path}{$query}");
}

function isUserLoggedIn()
{
    return isset($_COOKIE["auth_token"]);
}

function getLoggedInRole()
{
    return new Authenticator()->getLoggedInRole();
}
