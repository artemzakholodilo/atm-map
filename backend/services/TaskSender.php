<?php

namespace backend\services;

use PhpAmqpLib\Message\AMQPMessage;
use yii\base\BaseObject;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class TaskSender extends BaseObject
{
    use AmqpConnectionTrait;

    /**
     * @param array $message
     * @param bool $environmentProd
     */
    public function sendTask($message = [], $environmentProd = false)
    {
        $message = new AMQPMessage($message, ['delivery_mode' => $environmentProd ? 1 : 2]);
        try {
            $this->getChannel()->basic_publish($message, '', $this->queueName);
        } catch (\AMQPException $ex) {
            var_dump($ex); exit;
        }
    }
}