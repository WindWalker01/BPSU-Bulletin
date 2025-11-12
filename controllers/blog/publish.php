<?php

use Core\Database;
use Core\App;
use Core\TiptapExtension\Youtube;
use Core\IntelligentSystem;

date_default_timezone_set("Asia/Manila");

$db = App::resolve(Database::class);
$i_s = new IntelligentSystem();

$blog = $db
    ->query(
        "SELECT * FROM blogs 
        INNER JOIN users ON blogs.author_id = users.id 
        INNER JOIN profile_images ON profile_images.user_id = users.id
        WHERE blogs.id = :id",
        ["id" => $_GET["blog_id"]],
    )
    ->find();

if ($blog["blog_status"] === "ACTIVE") {
    redirect("/home");
    exit();
}

$categories = $db->query("SELECT * FROM categories")->get();

$html = new \Tiptap\Editor([
    "extensions" => [
        new \Tiptap\Extensions\StarterKit([
            "codeBlock" => false,
        ]),
        new \Tiptap\Nodes\CodeBlockHighlight(),
        new \Tiptap\Nodes\Image(),
        new Youtube(),
        new \Tiptap\Extensions\TextAlign(["types" => ["heading", "paragraph"]]),
        new \Tiptap\Marks\Underline(),
        new \Tiptap\Marks\Highlight(["multicolor" => true]),
        new \Tiptap\Marks\Link(),
        new \Tiptap\Marks\Subscript(),
        new \Tiptap\Marks\Superscript(),
    ],
])
    ->setContent(json_decode(json_decode($blog["content"]), true))
    ->getHTML();

$text = new \Tiptap\Editor([
    "extensions" => [
        new \Tiptap\Extensions\StarterKit([
            "codeBlock" => false,
        ]),
        new \Tiptap\Nodes\CodeBlockHighlight(),
        new \Tiptap\Nodes\Image(),
        new Youtube(),
        new \Tiptap\Extensions\TextAlign(["types" => ["heading", "paragraph"]]),
        new \Tiptap\Marks\Underline(),
        new \Tiptap\Marks\Highlight(["multicolor" => true]),
        new \Tiptap\Marks\Link(),
        new \Tiptap\Marks\Subscript(),
        new \Tiptap\Marks\Superscript(),
    ],
])
    ->setContent(json_decode(json_decode($blog["content"]), true))
    ->getText();

$classification = $i_s->classifyText($text);

if ($classification["prediction"] !== "SAFE") {
    redirect("/blog/editor?blog_id={$_GET["blog_id"]}&error=content_not_safe");
    exit();
}

render("blog/publish.view.php", [
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
    "categories" => $categories,
    "raw_text_content" => $text,
]);
