<?php

namespace App\Infra\Cache;

use Predis\Client;

class RedisConnection
{
    /**
     * @var Client
     */
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host' => $_ENV['REDIS_HOST'] ?: 'localhost',
            'port' => $_ENV['REDIS_PORT'] ?: 6379,
            'password' => $_ENV['REDIS_PASSWORD'] ?: null,
        ]);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
