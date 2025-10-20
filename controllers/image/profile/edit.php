<?php
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Core\App;
use Core\Database;

$user_id = $_POST["user_id"];
$image_file = $_FILES["profile_image"];

$config = require base_path("config/config.php");

Configuration::instance([
    "cloud" => [
        "cloud_name" => $config["service"]["cloudinary"]["cloud_name"],
        "api_key" => $config["service"]["cloudinary"]["api_key"],
        "api_secret" => $config["service"]["cloudinary"]["api_secret"],
    ],
    "url" => ["secure" => true],
]);

if (!isset($image_file)) {
    echo json_encode(["error" => "image not sent", "image" => $_FILES]);
    exit();
}

$db = App::resolve(Database::class);

$old_image = $db
    ->query("SELECT * FROM profile_images WHERE user_id = :id", [
        "id" => $user_id,
    ])
    ->find();

// if the image that is being replace is the default then dont delete it to the cloudinary
if (!$old_image["asset_id"] === "default_profile_xgg15t") {
    try {
        // delete the image we dont need to use it anymore
        new UploadApi()->destroy($old_image["asset_id"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
}

try {
    $result = new UploadApi()->upload($image_file["tmp_name"], [
        "folder" => "bpsu_bulletin/profile_images",
    ]);

    echo json_encode([
        "url" => $result["secure_url"],
        "public_id" => $result["public_id"],
    ]);

    if (isset($result["secure_url"]) && isset($result["public_id"])) {
        $db->query(
            "UPDATE profile_images SET secure_url = :url, asset_id = :asset WHERE user_id = :id",
            [
                "id" => $user_id,
                "url" => $result["secure_url"],
                "asset" => $result["public_id"],
            ],
        );
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}

redirect("/");
exit();
