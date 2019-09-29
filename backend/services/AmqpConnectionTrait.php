<?php

namespace backend\services;

use PhpAmqpLib\Connection\AMQPStreamConnection;

trait AmqpConnectionTrait
{
    /**
     * @var string
     */
    protected $queueName;

    protected $autoDelete;

    /**
     * @var AMQPStreamConnection $connection
     */
    protected $connection;

    public function __construct()
    {
        $amqpParams = \Yii::$app->params['rabbitMQ'];
        $this->setQueueName($amqpParams['defaultQueue']);
        $this->connection = new AMQPStreamConnection(
            $amqpParams['host'], $amqpParams['port'],
            $amqpParams['username'], $amqpParams['password']
        );
    }

    /**
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    protected function getChannel()
    {
        $channel = $this->connection->channel();
        $channel->queue_declare(
            $this->queueName, false, false, false,
            false
        );
        return $channel;
    }

    protected function closeConnection()
    {
        $this->connection->close();
    }

    public function setQueueName($name)
    {
        $this->queueName = $name;
    }
}