<?php
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

$config = require base_path("config/config.php");

Configuration::instance([
    "cloud" => [
        "cloud_name" => $config["service"]["cloudinary"]["cloud_name"],
        "api_key" => $config["service"]["cloudinary"]["api_key"],
        "api_secret" => $config["service"]["cloudinary"]["api_secret"],
    ],
    "url" => ["secure" => true],
]);

if (!isset($_FILES["image"])) {
    echo json_encode(["error" => "image not set"]);
    exit();
}

try {
    $result = new UploadApi()->upload($_FILES["image"]["tmp_name"], [
        "folder" => "bpsu_bulletin/blog_images",
    ]);

    // Return the hosted URL to React
    echo json_encode([
        "url" => $result["secure_url"],
        "public_id" => $result["public_id"],
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
