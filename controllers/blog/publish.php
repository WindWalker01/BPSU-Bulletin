<?php

use Core\Database;
use Core\App;
use Core\TiptapExtension\Youtube;

date_default_timezone_set("Asia/Manila");

$db = App::resolve(Database::class);
$content = $db->query("SELECT * FROM blogs WHERE id = 1")->find();

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
    ->setContent(json_decode($content["content"]))
    ->getHTML();

view("blog/publish.view.php", [
    "date_now" => date("'Y-m-d\TH:i'"),
    "tiptap_html" => $html,
    "title" => $content["title"],
]);
