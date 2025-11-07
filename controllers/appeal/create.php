<?php
use Core\App;
use Core\Database;

$blog_id = $_POST["blog_id"];
$reason = $_POST["reason"];

$db = App::resolve(Database::class);

$db->query(
    "INSERT INTO appeals (`author_id`, `blog_id`, `reason`, `status`) VALUES (:author, :blog, :reason, 'PENDING')",
    ["author" => getLoggedInUserId(), "blog" => $blog_id, "reason" => $reason],
);

echo json_encode(["status" => "appeal sent!"]);

redirect("/appeal_sucess");
exit();
