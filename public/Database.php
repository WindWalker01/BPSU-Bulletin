<?php

class Database
{
    public $connection;

    public function __construct($config)
    {
        $dsn = "mysql:" . http_build_query($config, "", ";");

        $this->connection = new PDO(
            $dsn,
            $config["database"]["user"],
            $config["database"]["password"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );

        //Check if the DB exists
        $stmt = $this->connection->query(
            "SHOW DATABASE LIKE " . $config["database"]["dbname"],
        );
        if ($stmt->rowCount() > 0) {
            exit();
        }

        //Create database
        $this->connection->exec(
            "CREATE DATABASE IF NOT EXIST " .
                "'" .
                $config["database"]["dbname"] .
                "'",
        );

        //TODO: Create Tables
    }

    public function query($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
}
