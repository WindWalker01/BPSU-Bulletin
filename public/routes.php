<?php
$router->get("/blog", "controllers/blog_post.php")->only("auth");
$router->get("/", "controllers/index.php");
$router->get("/register", "controllers/registration/create.php")->only("guest");

//POST
$router->post("/register", "controllers/registration/store.php");
