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
    if ($_COOKIE["auth_token"] !== null) {
        return true;
    }
    return false;
}

function getLoggedInRole()
{
    return new Authenticator()->getLoggedInRole();
}

function timeAgo($datetime)
{
    $tz = new DateTimeZone("Asia/Manila"); // your local timezone
    $now = new DateTime("now", $tz);
    $ago = new DateTime($datetime, $tz);
    $diff = $now->diff($ago);

    if ($diff->y > 0) {
        return $diff->y . " year(s) ago";
    }
    if ($diff->m > 0) {
        return $diff->m . " month(s) ago";
    }
    if ($diff->d > 0) {
        return $diff->d . " day(s) ago";
    }
    if ($diff->h > 0) {
        return $diff->h . " hour(s) ago";
    }
    if ($diff->i > 0) {
        return $diff->i . " minute(s) ago";
    }
    return "just now";
}

// helpers.php or functions.php
function render($view, $data = [], $showHeader = true)
{
    ob_start();
    view($view, $data);
    $slot = ob_get_clean();

    // Pass $showHeader to head.php
    view("partials/head.php", compact("slot", "data", "showHeader"));
}
