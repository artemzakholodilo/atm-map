<?php

namespace backend\services;

use yii\base\BaseObject;

class TaskReceiver extends BaseObject
{
    use AmqpConnectionTrait;

    private $messages;

    public function getMessages()
    {
        $connection = $this->getConnection();
        $callback = function($message)
        {
            $data = json_decode($message->body, true);
            $this->sender->send($data);
        };
        $connection->basic_qos(null, 1, null);
        $connection->basic_consume($this->queueName, '', false, false, false, false, $callback);
        while(count($connection->callbacks)) {
            $connection->wait();
        }
    }
}