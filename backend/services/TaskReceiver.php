<?php

namespace backend\services;

use yii\base\BaseObject;

class TaskReceiver extends BaseObject
{
    use AmqpConnectionTrait;

    /**
     * @return mixed
     */
    public function getMessages()
    {
        $channel = $this->getChannel();
        $channel->queue_declare($this->queueName, false, false, false, false);
        $result = $channel->basic_get($this->queueName);

        return $result->getBody() ?? [];
    }
}