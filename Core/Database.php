<?php

namespace Core;
use PDO;

class Database
{
    public $connection;

    public function __construct($config)
    {
        $this->migrations($config);
        $this->connection = $this->create_db_connection($config);
    }

    public function query($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function migrations($config)
    {
        $dsn = "mysql:host=" . $config["database"]["host"] . ";charset=utf8mb4";

        $testDBConnection = new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // add this for better error handling
            ],
        );

        // Check if the DB exists
        $stmt = $testDBConnection->prepare("SHOW DATABASES LIKE ?");
        $stmt->execute([$config["database"]["dbname"]]);

        if ($stmt->fetch()) {
            echo "<script>console.log('db already exist');</script>";
        }

        // Create database
        $testDBConnection->exec(
            "CREATE DATABASE IF NOT EXISTS " . $config["database"]["dbname"],
        );
    }

    public function create_db_connection($config)
    {
        $dsn = "mysql:" . http_build_query($config, "", ";");

        return new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );
    }
}
