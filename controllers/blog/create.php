<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$auth = new Authenticator();

$starting_content = "{}";
$author_id = $auth->getLoggedInUserId();

if (!isset($author_id)) {
    // TODO: make this an error page
    redirect("/blog");
    exit();
}

$db->query(
    "INSERT INTO blogs (`author_id`, `blog_status`, `content`, `created_at`, `updated_at`, `title`) 
    VALUES (:author_id, 'HIDDEN', :content, NOW(), NOW(), :title)",
    [
        "author_id" => (int) $author_id,
        "content" => json_encode($starting_content),
        "title" => "",
    ],
);

redirect("/blog/editor?blog_id=" . $db->getLastInsertID());
exit();
