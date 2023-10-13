<?php

namespace App\Infra\Db;

use MongoDB\Client;

class MongoDBConnection
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $database;

    /**
     * @param string $host
     * @param int $port
     * @param string $database
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct() {

        $this->database = $_ENV['MONGO_DB'];
        $connectionUri = $this->createConnectionUri(
            $_ENV['MONGO_HOST'],
            $_ENV['MONGO_PORT'],
            $_ENV['MONGO_USER'] ?? null,
            $_ENV['MONGO_PASSWORD'] ?? null,
        );

        $this->client = new Client($connectionUri);
    }

    /**
     * Creates the connection URI.
     * 
     * @param string $host
     * @param int $port
     * @param string|null $username
     * @param string|null $password
     * @return string
     */
    private function createConnectionUri(string $host, int $port, ?string $username, ?string $password): string
    {
        if ($username && $password) {
            return sprintf('mongodb://%s:%s@%s:%d/%s', $username, $password, $host, $port, $this->database);
        }

        return sprintf('mongodb://%s:%d', $host, $port);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param string $collection
     * @return \MongoDB\Collection
     */
    public function getCollection(string $collection): \MongoDB\Collection
    {
        return $this->client->{$this->database}->{$collection};
    }
}
