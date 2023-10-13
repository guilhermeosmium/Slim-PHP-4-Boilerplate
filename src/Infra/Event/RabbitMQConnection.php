<?php

namespace App\Infra\Event;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;

class RabbitMQConnection
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @var AMQPChannel
     */
    private $channel;

    public function __construct()
    {
        $host = $_ENV['RABBITMQ_HOST'];
        $port = $_ENV['RABBITMQ_PORT'];
        $user = $_ENV['RABBITMQ_USER'];
        $pass = $_ENV['RABBITMQ_PASS'];
        $vhost = $_ENV['RABBITMQ_VHOST'] ?: '/';

        $this->connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
        $this->channel = $this->connection->channel();
    }

    /**
     * @return AMQPChannel
     */
    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    /**
     * Close channel and connection.
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}