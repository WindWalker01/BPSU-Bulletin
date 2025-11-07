<?php

namespace Core;

class IntelligentSystem
{
    private $config;

    public function __construct()
    {
        $this->config = require base_path("config/config.php");
    }

    public function classifyText($text)
    {
        // Prepare the data as form data (not JSON)
        $postData = [
            "content" => $text,
        ];

        // Initialize cURL
        $ch = curl_init(
            "{$this->config["intelligent_system_url"]}/api/classify",
        );

        // Configure cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // form data automatically encoded
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10); // I commented this out because of render free tier startup

        // Execute the request
        $response = curl_exec($ch);

        // Check for connection or execution errors
        if (curl_errno($ch)) {
            echo "Request Error: " . curl_error($ch);
            curl_close($ch);
            exit();
        }

        // Close connection
        curl_close($ch);

        // Decode JSON response
        $result = json_decode($response, true);

        // Handle the result
        if (isset($result["classification"])) {
            return $result["classification"];
        } else {
            return null;
        }
    }

    public function addTrainingData($text, $spam = 0, $toxic = 0)
    {
        // Prepare the data as form data (not JSON)
        $postData = [
            "content" => $text,
            "is-spam" => $spam,
            "is-toxic" => $toxic,
        ];

        // Initialize cURL
        $ch = curl_init("{$this->config["intelligent_system_url"]}/api/add");

        // Configure cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // form data automatically encoded
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10); // I commented this out because of render free tier startup

        // Execute the request
        $response = curl_exec($ch);

        // Check for connection or execution errors
        if (curl_errno($ch)) {
            echo "Request Error: " . curl_error($ch);
            curl_close($ch);
            exit();
        }

        // Close connection
        curl_close($ch);

        // Decode JSON response
        $result = json_decode($response, true);

        // Handle the result
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
