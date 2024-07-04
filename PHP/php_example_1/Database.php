<?php

class Database
{
    public PDO $connection;

    public function __construct($config) {
        $dsn = 'pgsql:'.http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []): false|PDOStatement
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}