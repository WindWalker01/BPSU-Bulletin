<?php
use Core\Authenticator;
use Core\App;
use Core\Database;
use Core\TiptapExtension\Youtube;

date_default_timezone_set("Asia/Manila");

function getConfig()
{
    return require base_path("config/config.php");
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";

    die();
}

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}

function redirect($path, $components = [])
{
    $query = http_build_query($components);
    header("location: {$path}{$query}");
}

function isUserLoggedIn()
{
    if ($_COOKIE["auth_token"] !== null) {
        return true;
    }
    return false;
}

function getBlogContent($content)
{
    $string_content = "";

    $data = json_decode($content, true);

    if (is_string($data)) {
        $data = json_decode($data, true); // Second decode
    }
    dd($data);

    $first_paragraph = null;

    foreach ($data["content"] ?? [] as $node) {
        if (
            !$first_paragraph &&
            $node["type"] === "paragraph" &&
            isset($node["content"])
        ) {
            $texts = array_map(fn($c) => $c["text"] ?? "", $node["content"]);
            $first_paragraph = trim(implode(" ", $texts));
        }

        if ($first_paragraph) {
            break;
        }
    }

    return $first_paragraph;
}

function getLoggedInRole()
{
    return new Authenticator()->getLoggedInRole();
}

function getLoggedInUserId()
{
    return new Authenticator()->getLoggedInUserId();
}

function isUserBanned()
{
    return new Authenticator()->getLoggedInAccountStatus() === "BANNED";
}

function getTextFromTitapHtml($content)
{
    return new \Tiptap\Editor([
        "extensions" => [
            new \Tiptap\Extensions\StarterKit([
                "codeBlock" => false,
            ]),
            new \Tiptap\Nodes\CodeBlockHighlight(),
            new \Tiptap\Nodes\Image(),
            new Youtube(),
            new \Tiptap\Extensions\TextAlign([
                "types" => ["heading", "paragraph"],
            ]),
            new \Tiptap\Marks\Underline(),
            new \Tiptap\Marks\Highlight(["multicolor" => true]),
            new \Tiptap\Marks\Link(),
            new \Tiptap\Marks\Subscript(),
            new \Tiptap\Marks\Superscript(),
        ],
    ])
        ->setContent(json_decode(json_decode($content), true))
        ->getText();
}

function analyzeReports($reports)
{
    $containsSpam = false;
    $containsOther = false;

    foreach ($reports as $report) {
        $type = strtoupper($report["report_type"]); // normalize case
        if ($type === "SPAM") {
            $containsSpam = true;
        } else {
            $containsOther = true;
        }
    }

    return [
        "toxic" => $containsOther ? 1 : 0,
        "spam" => $containsSpam ? 1 : 0,
    ];
}

function handleBannedUsers()
{
    $db = App::resolve(Database::class);

    $as = $db
        ->query("SELECT account_status FROM users WHERE id = :id", [
            "id" => getLoggedInUserId(),
        ])
        ->find()["account_status"];

    if ($as === "BANNED") {
        redirect("/banned");
        exit();
    }
}

function timeAgo($datetime)
{
    $tz = new DateTimeZone("Asia/Manila"); // your local timezone
    $now = new DateTime("now", $tz);
    $ago = new DateTime($datetime, $tz);
    $diff = $now->diff($ago);

    if ($diff->y > 0) {
        return $diff->y . " year(s) ago";
    }
    if ($diff->m > 0) {
        return $diff->m . " month(s) ago";
    }
    if ($diff->d > 0) {
        return $diff->d . " day(s) ago";
    }
    if ($diff->h > 0) {
        return $diff->h . " hour(s) ago";
    }
    if ($diff->i > 0) {
        return $diff->i . " minute(s) ago";
    }
    return "just now";
}

// helpers.php or functions.php
function render($view, $data = [], $showHeader = true)
{
    ob_start();
    view($view, $data);
    $slot = ob_get_clean();

    // Pass $showHeader to head.php
    view("partials/head.php", compact("slot", "data", "showHeader"));
}

function extractFirstParagraphFromTiptap($content)
{
    $data = json_decode($content, true);

    if (is_string($data)) {
        $data = json_decode($data, true); // Second decode
    }

    $first_paragraph = null;

    foreach ($data["content"] ?? [] as $node) {
        if (
            !$first_paragraph &&
            $node["type"] === "paragraph" &&
            isset($node["content"])
        ) {
            $texts = array_map(fn($c) => $c["text"] ?? "", $node["content"]);
            $first_paragraph = trim(implode(" ", $texts));
        }

        if ($first_paragraph) {
            break;
        }
    }

    return $first_paragraph;
}

function extractFirstImageFromTiptap($content)
{
    $data = json_decode($content, true); // First decode

    // Handle double-encoded JSON
    if (is_string($data)) {
        $data = json_decode($data, true); // Second decode
    }

    if (
        empty($data) ||
        !isset($data["content"]) ||
        !is_array($data["content"])
    ) {
        return null; // No valid content found
    }

    foreach ($data["content"] as $node) {
        if ($node["type"] === "image" && isset($node["attrs"]["src"])) {
            return $node["attrs"]["src"]; // Return the src of the first image
        }
    }

    return null; // No image node found
}

function getBadgeColor($categoryValue)
{
    switch ($categoryValue) {
        case "University Announcements":
            return "bg-badge-university-bg text-badge-university-text";
        case "Organizations":
            return "bg-badge-organizations-bg text-badge-organizations-text";
        case "Scholarship":
            return "bg-badge-scholarship-bg text-badge-scholarship-text";
        case "Achievement":
            return "bg-badge-achievement-bg text-badge-achievement-text";
        case "Enrollment & Documents":
            return "bg-badge-enrollment-bg text-badge-enrollment-text";
        default:
            return "bg-badge-university-bg text-badge-university-text";
    }
}
