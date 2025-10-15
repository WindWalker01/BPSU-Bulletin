<?php

//GET
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog_post.php")->only("auth");

$router->get("/register", "controllers/registration/show.php")->only("guest");
$router->get("/login", "controllers/login/show.php")->only("guest");
$router->get("/logout", "controllers/login/logout.php")->only("auth");
$router->get("/home", "controllers/home/home.php");

$router->get("/blog/publish", "controllers/blog/publish.php");

$router
    ->get("/blog/editor", "controllers/blog/editor/show.php")
    ->only("author");

$router->get("/account", "controllers/account_centre/user_activity_log.php");
$router->get(
    "/user_profile",
    "controllers/account_centre/user_edit_profile.php",
);

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

$router->post("/blog", "controllers/blog/create.php")->only("author");
$router->post("/blog/editor/image/upload", "controllers/image/blog/create.php");

// PUT

// PATCH
$router->patch("/blog/editor", "controllers/blog/edit.php");
$router->patch("/blog/publish", "controllers/blog/schedule.php");

$router->patch("/user_profile/image", "controllers/image/profile/edit.php");

// DELETE
$router->delete(
    "/blog/editor/image/delete",
    "controllers/image/blog/delete.php",
);
