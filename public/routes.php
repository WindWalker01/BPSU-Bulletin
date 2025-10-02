<?php
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog_post.php")->only("auth");
$router->get("/register", "controllers/registration/show.php")->only("guest");
$router->get("/login", "controllers/login/show.php")->only("guest");
$router->get("/logout", "controllers/login/logout.php")->only("auth");

//POST
$router->post("/register", "controllers/registration/store.php")->only("guest");
$router->post("/login", "controllers/login/login.php")->only("guest");
$router->post("/logout", "controllers/login/logout.php")->only("auth");
