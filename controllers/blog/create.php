<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$starting_content =
    "{\"type\":\"doc\",\"content\":[{\"type\":\"paragraph\",\"attrs\":{\"textAlign\":null}}]}";

$author_id = $_POST["author_id"];
$title = $_POST["title"];

$db->query(
    "INSERT INTO blogs (`author_id`, `blog_status`, `content`, `created_at`, `updated_at`, `title`) 
    VALUES (:author_id, 'HIDDEN', :content, NOW(), NOW(), :title)",
    [
        "author_id" => $author_id,
        "content" => $starting_content,
        "title" => $title,
    ],
);
