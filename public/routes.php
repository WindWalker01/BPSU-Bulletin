<?php

// GET — Public
$router->get("/", "controllers/index.php");
$router->get("/blog", "controllers/blog/show.php");
$router->get("/categories", "controllers/categories.php");
$router->get(
    "/announcement",
    "controllers/overall_category/announcement_cat.php",
);
$router->get("/achievement", "controllers/overall_category/achievements.php");
$router->get("/organization", "controllers/overall_category/organization.php");
$router->get("/scholar", "controllers/overall_category/scholar.php");
$router->get("/enrollment", "controllers/overall_category/enrollment.php");
$router->get("/search", "controllers/search.php");
$router->get("/banned", "controllers/banned.php");

// GET — Guest only
$router
    ->get("/register", "controllers/registration/show.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->get("/edit-profile", "controllers/registration/edit-profile-show.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->get("/login", "controllers/login/show.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->get("/login_google", "controllers/oauth/login.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->get("/google_callback", "controllers/oauth/google-callback.php")
    ->onlyRoles("role", ["guest"]);

// GET — Authenticated (includes admin)
$router
    ->get("/logout", "controllers/login/logout.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/home", "controllers/home/home.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/blog/publish", "controllers/blog/publish.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/blog/editor", "controllers/blog/editor/show.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/account", "controllers/account_centre/user_activity_log.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/user_profile", "controllers/account_centre/user_edit_profile.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/stats", "controllers/stats/stats.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/drafts", "controllers/stats/drafts.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/scheduled", "controllers/stats/scheduled.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/archived", "controllers/stats/archived.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/settings", "controllers/settings/settings.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/preferences", "controllers/settings/preferences.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/data", "controllers/settings/data.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/feedback", "controllers/settings/feedback.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/about", "controllers/settings/about.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/notifications", "controllers/notifications/show.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->get("/appeal", "controllers/appeal/show.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/appeal_sucess", "controllers/appeal/success.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->get("/admin", "controllers/moderate/show.php")
    ->onlyRoles("role", ["admin"]);

// POST — Authenticated (includes admin)
$router
    ->post(
        "/settings/preferences/update",
        "controllers/settings/preferences-update.php",
    )
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->post("/archive", "controllers/stats/archive.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->post("/delete", "controllers/stats/delete.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->post("/unarchive", "controllers/stats/unarchive.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->post("/account/deactivate", "controllers/settings/deactivate.php")
    ->onlyRoles("role", ["author", "admin"]);

$router
    ->post("/report", "controllers/moderate/report.php")
    ->onlyRoles("role", ["admin", "user", "author"]);

$router
    ->post("/appeal", "controllers/appeal/create.php")
    ->onlyRoles("role", ["author", "admin"]);

$router
    ->post("/register", "controllers/registration/create.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->post("/edit-profile", "controllers/registration/edit-profile.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->post("/login", "controllers/login/login.php")
    ->onlyRoles("role", ["guest"]);
$router
    ->post("/logout", "controllers/login/logout.php")
    ->onlyRoles("role", ["user", "admin", "author"]);

$router
    ->post("/blog", "controllers/blog/create.php")
    ->onlyRoles("role", ["author", "admin"]);
$router->post("/blog/editor/image/upload", "controllers/image/blog/create.php");

$router
    ->post("/account/follow", "controllers/account_centre/follow.php")
    ->onlyRoles("role", ["user", "admin", "author"]);

$router
    ->post("/comment", "controllers/blog/comment/comment.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->post("/reply", "controllers/blog/comment/reply.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->post("/react", "controllers/blog/reaction.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->post("/comment/react", "controllers/blog/comment/reaction.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->post("/account", "controllers/account_centre/user_activity_log.php")
    ->onlyRoles("role", ["user", "admin", "author"]);

// PATCH — Authenticated (includes admin)
$router
    ->patch("/blog/editor", "controllers/blog/edit.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->patch("/blog/publish", "controllers/blog/schedule.php")
    ->onlyRoles("role", ["author", "admin"]);
$router
    ->patch("/account", "controllers/account_centre/edit_user_info.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->patch("/user_profile/image", "controllers/image/profile/edit.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
$router
    ->patch(
        "/notification/marked",
        "controllers/notifications/marked_as_read.php",
    )
    ->onlyRoles("role", ["user", "admin", "author"]);

$router
    ->patch("/admin/ban_comment", "controllers/moderate/ban_comment.php")
    ->onlyRoles("role", ["admin"]);
$router
    ->patch("/admin/ban_blog", "controllers/moderate/ban_blog.php")
    ->onlyRoles("role", ["admin"]);
$router
    ->patch("/admin/ban_user", "controllers/moderate/ban_user.php")
    ->onlyRoles("role", ["admin"]);
$router
    ->patch(
        "/admin/decline_ban_blog",
        "controllers/moderate/decline_blog_report.php",
    )
    ->onlyRoles("role", ["admin"]);
$router
    ->patch(
        "/admin/decline_ban_comment",
        "controllers/moderate/decline_comment_report.php",
    )
    ->onlyRoles("role", ["admin"]);

// DELETE — Authenticated (includes admin)
$router
    ->delete("/account/delete", "controllers/settings/delete.php")
    ->onlyRoles("role", ["user", "admin", "author"]);
