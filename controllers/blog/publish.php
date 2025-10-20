<?php

use Core\Database;
use Core\App;
use Core\TiptapExtension\Youtube;

date_default_timezone_set("Asia/Manila");

$db = App::resolve(Database::class);

$blog = $db
    ->query(
        "SELECT * FROM blogs 
        INNER JOIN users ON blogs.author_id = users.id 
        INNER JOIN profile_images ON profile_images.user_id = users.id
        WHERE blogs.id = :id",
        ["id" => $_GET["blog_id"]],
    )
    ->find();

$html = new \Tiptap\Editor([
    "extensions" => [
        new \Tiptap\Extensions\StarterKit([
            "codeBlock" => false,
        ]),
        new \Tiptap\Nodes\CodeBlockHighlight(),
        new \Tiptap\Nodes\Image(),
        new Youtube(),
    ],
])
    ->setContent(json_decode($blog["content"]))
    ->getHTML();

view("blog/publish.view.php", [
    "date_now" => date("'Y-m-d\TH:i'"),
    "blog_html" => $html,
    "title" => $blog["title"],
    "blog_id" => $_GET["blog_id"],
    "author_name" => $blog["username"],
    "published_at" => DateTime::createFromFormat(
        "Y-m-d H:i:s",
        $blog["updated_at"],
    )->format("F j, Y"),
    "author_profile" => $blog["secure_url"],
]);
