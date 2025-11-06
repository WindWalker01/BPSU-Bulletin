<?php

namespace Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    private $connection;
    public $statement;

    public function __construct($config)
    {
        $this->migrations($config);
        $this->connection = $this->create_db_connection($config);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function getLastInsertID()
    {
        return $this->connection->lastInsertId();
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            return null;
        }

        return $result;
    }

    public function create_db_connection($config)
    {
        $dsn = "mysql:" . http_build_query($config["database"], "", ";");

        return new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );
    }

    protected function migrations($config)
    {
        $dsn = "mysql:host=" . $config["database"]["host"] . ";charset=utf8mb4";

        $testDBConnection = new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        );

        // Check if the DB exists
        $stmt = $testDBConnection->prepare("SHOW DATABASES LIKE ?");
        $stmt->execute([$config["database"]["dbname"]]);

        if ($stmt->fetch()) {
            return;
        }

        // Create database
        $testDBConnection->exec(
            "CREATE DATABASE IF NOT EXISTS " . $config["database"]["dbname"],
        );

        $testDBConnection->exec("USE {$config["database"]["dbname"]}");

        $sql_dump = file_get_contents("bulletin.sql");
        $statements = array_filter(array_map("trim", explode(";", $sql_dump)));

        // 3. Execute Statements
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                // Re-add the semicolon for execution (some databases may require it)
                $testDBConnection->exec($statement . ";");
            }
        }
    }
}
