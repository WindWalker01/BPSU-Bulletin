<?php

//GET
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog_post.php")->only("auth");

$router->get("/register", "controllers/registration/show.php")->only("guest");
$router->get("/login", "controllers/login/show.php")->only("guest");
$router->get("/logout", "controllers/login/logout.php")->only("auth");
$router->get("/home", "controllers/home/home.php");

$router->get("/blog/editor", "controllers/blog/create.php");

//POST
$router
    ->post("/register", "controllers/registration/create.php")
    ->only("guest");
$router->post("/login", "controllers/login/login.php")->only("guest");
$router->get("/login_google", "controllers/oauth/login.php")->only("guest");
$router
    ->get("/google_callback", "controllers/oauth/google-callback.php")
    ->only("guest");
$router->post("/logout", "controllers/login/logout.php")->only("auth");

$router->post("/blog/editor/image/upload", "controllers/image/create.php");
$router->post("/blog/editor/content/publish", "controllers/blog/content.php");

// PUT

// PATCH

// DELETE
$router->delete("/blog/editor/image/delete", "controllers/image/delete.php");
