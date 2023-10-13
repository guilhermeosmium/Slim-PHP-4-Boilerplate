<?php

namespace App\Infra\Db;

use Dotenv\Dotenv;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class PostGresConnection
{
    /**
     * @var Connection
     */
    private Connection $connection;

    /**
     * @param string $host
     * @param string $port
     * @param string $database
     * @param string $username
     * @param string $password
     */
    public function __construct(
    ) {
        $this->connection = DriverManager::getConnection([
            'driver' => 'pdo_pgsql',
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
        ]);
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }
}
