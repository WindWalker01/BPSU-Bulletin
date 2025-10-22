<?php

//GET
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog/show.php");

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
    "controllers/account_centre/user_edit_profile.php",);

$router->get("/categories", "controllers/categories.php");
$router->get("/announcement", "controllers/overall_category/announcement_cat.php");
$router->get("/achievement", "controllers/overall_category/achievements.php");
$router->get("/organization", "controllers/overall_category/organization.php");
$router->get("/scholar", "controllers/overall_category/scholar.php");
$router->get("/enrollment", "controllers/overall_category/enrollment.php");
$router->get("/stats", "controllers/stats/stats.php")->only("auth");
$router->get("/drafts", "controllers/stats/drafts.php")->only("auth");
$router->get("/scheduled", "controllers/stats/scheduled.php")->only("auth");
$router->get("/archived", "controllers/stats/archived.php")->only("auth");
$router->get("/settings", "controllers/settings/settings.php")->only("auth");
$router->get("/preferences", "controllers/settings/preferences.php")->only("auth");
$router->get("/data", "controllers/settings/data.php")->only("auth");
$router->get("/feedback", "controllers/settings/feedback.php")->only("auth");

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

$router->post("/comment", "controllers/blog/comment/comment.php");
$router->post("/reply", "controllers/blog/comment/reply.php");

$router->post("/react", "controllers/blog/reaction.php");
$router->post("/comment/react", "controllers/blog/comment/reaction.php");

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