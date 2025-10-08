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

function extractPublicIdFromUrl($url)
{
    $parts = parse_url($url);
    $path = $parts["path"]; // /demo/image/upload/v1234/folder/filename.jpg
    $segments = explode("/", $path);

    // Remove everything before /upload/
    $uploadIndex = array_search("upload", $segments);
    $relevant = array_slice($segments, $uploadIndex + 2); // skip 'upload' and 'v1234'

    // Join back the path and remove extension
    $publicIdWithExt = implode("/", $relevant);
    return preg_replace('/\.[^.]+$/', "", $publicIdWithExt);
}

$url = $_POST["image_url"];
if (!isset($url)) {
    echo json_encode(["error" => "missing url"]);
    http_response_code(400);
}

$publicId = extractPublicIdFromUrl($url);

try {
    $result = new UploadApi()->destroy($publicId);
    echo json_encode([
        "status" => "ok",
        "deleted" => $publicId,
        "result" => $result,
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}

// bpsu_bulletin/blog_images/sample_image_abcd1234

// if (!isset($_FILES["url"])) {
//     echo json_encode(["error" => "url not set"]);
//     exit();
// }

// try {
//     $result = new UploadApi()->upload($_FILES["url"]["tmp_name"], [
//         "folder" => "bpsu_bulletin/blog_images",
//     ]);

//     // Return the hosted URL to React
//     echo json_encode(["url" => $result["secure_url"]]);
// } catch (Exception $e) {
//     http_response_code(500);
//     echo json_encode(["error" => $e->getMessage()]);
// }

echo json_encode($_POST);
