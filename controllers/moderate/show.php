<?php
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$badge_color_map = [
    "SEXUAL" => "bg-flag-sexual-bg text-flag-sexual-text",
    "VIOLENT" => "bg-flag-violent-bg text-flag-violent-text",
    "HARMFUL" => "bg-flag-harmful-bg text-flag-harmful-text",
    "HARASSMENT" => "bg-flag-harassment-bg text-flag-harassment-text",
    "SELF_HARM" => "bg-flag-self-harm-bg text-flag-self-harm-text",
    "SPAM" => "bg-flag-spam-bg text-flag-spam-text",
    "APPEAL" => "bg-flag-appeal-bg text-flag-appeal-text",
];

$blogs_reports = $db
    ->query(
        "SELECT 
        br.id AS report_id,
        br.reporter_id,
        ru.username AS reporter_name,
        br.blog_id,
        au.username AS author_name,
        c.value AS category_name,
        br.report_type,
        br.reason,
        br.status,
        br.created_at,
        b.title,
        b.author_id
        FROM blog_reports br
        JOIN blogs b 
        ON br.blog_id = b.id
        JOIN users au 
        ON b.author_id = au.id           -- blog author
        JOIN users ru 
        ON br.reporter_id = ru.id            -- reporting user
        LEFT JOIN blog_categories bc 
        ON b.id = bc.blog_id             -- link blog to category
        LEFT JOIN categories c 
        ON bc.category_id = c.id         -- get category name
        WHERE br.status = 'PENDING'
        AND br.blog_id NOT IN (
            SELECT blog_id
            FROM blog_reports
            WHERE status = 'RESOLVED'
        )
        AND b.blog_status != 'BANNED'
        ORDER BY br.created_at DESC;
",
    )
    ->get();

$comment_reports = $db
    ->query(
        "SELECT 
        cr.id AS report_id,
        cr.comment_id,
        c.content AS comment_content,
        cr.report_type,
        cr.reason,
        cr.status,
        cr.created_at,
        c.blog_id,
        c.user_id,
        c.id AS comment_id,

        -- Reporter info
        ru.username AS reporter_username,

        -- Reported (comment author) info
        cu.username AS reported_username,
        cu.campus AS reported_campus,
        pi.secure_url AS reported_profile_image

        FROM comment_reports cr
        JOIN comments c 
        ON cr.comment_id = c.id
        JOIN users cu 
        ON c.user_id = cu.id              -- reported user (comment author)
        LEFT JOIN profile_images pi 
        ON cu.id = pi.user_id             -- reported user’s profile image
        JOIN users ru 
        ON cr.reporter_id = ru.id         -- reporter user
        WHERE cr.status = 'PENDING'
        AND cr.comment_id NOT IN (
            SELECT comment_id
            FROM comment_reports
            WHERE status = 'RESOLVED'
        )
        ORDER BY cr.created_at DESC;",
    )
    ->get();

$appeals = $db
    ->query(
        "SELECT users.username as appealed_by, appeals.reason, appeals.id as appeal_id FROM appeals INNER JOIN users ON users.id = appeals.author_id",
    )
    ->get();

render("moderate/admin.view.php", [
    "blogs_reports" => $blogs_reports,
    "badge_color_map" => $badge_color_map,
    "comment_reports" => $comment_reports,
    "appeals" => $appeals,
]);
