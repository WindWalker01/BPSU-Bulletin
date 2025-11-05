<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$banned_blogs = $db
    ->query(
        "SELECT id, title, blog_status FROM blogs WHERE author_id = :author_id AND blog_status = 'BANNED'",
        ["author_id" => getLoggedInUserId()],
    )
    ->get();

render("appeal/appeal.view.php", ["banned_blogs" => $banned_blogs]);
