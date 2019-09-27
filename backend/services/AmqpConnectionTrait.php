<?php

namespace backend\services;

use PhpAmqpLib\Connection\AMQPStreamConnection;

trait AmqpConnectionTrait
{
    /**
     * @var string
     */
    protected $queueName;

    /**
     * @return mixed
     */
    protected function getConnection()
    {
        $amqpParams = \Yii::$app->params['rabbitMQ'];
        $connection = new AMQPStreamConnection(
            $amqpParams['host'], $amqpParams['port'],
            $amqpParams['username'], $amqpParams['password']
        );
        $channel = $connection->channel();
        $channel->queue_declare($this->queueName, false, false, false, false);
        return $channel;
    }

    public function setQueueName($name)
    {
        $this->queueName = $name;
    }
}