<?php

class Database
{
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct($config) {
        $dsn = 'pgsql:'.http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []): Database
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function find() {
        return $this->statement->fetch();
    }
    public function findAll() {
        return $this->statement->fetchAll();
    }
    public function findOrFail() {
        $result = $this->statement->fetch();

        if (!$result) {
            abort();
        }

        return $result;
    }
}