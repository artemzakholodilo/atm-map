<?php

namespace backend\services;

use yii\base\BaseObject;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class TaskSender extends BaseObject
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

    public function sendTask($message = [], $environmentProd = false)
    {
        $message = new AMQPMessage($message, ['delivery_mode' => $environmentProd ? 1 : 2]);
        try {
            $this->connection->basic_publish($message, '', $this->queueName);
        } catch (\AMQPException $ex) {
            var_dump($ex); exit;
        }
    }
}