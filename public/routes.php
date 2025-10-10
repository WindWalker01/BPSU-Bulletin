<?php

//GET
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog_post.php")->only("auth");

$router->get("/register", "controllers/registration/show.php")->only("guest");
$router->get("/login", "controllers/login/show.php")->only("guest");
$router->get("/logout", "controllers/login/logout.php")->only("auth");

$router->get("/blog/editor", "controllers/blog/editor/show.php");

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

// PUT

// PATCH
$router->patch("/blog/editor", "controllers/blog/edit.php");

// DELETE
$router->delete("/blog/editor/image/delete", "controllers/image/delete.php");
