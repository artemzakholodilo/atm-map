<?php

namespace console\controllers;

use common\services\ATMServiceInterface;
use yii\console\Controller;

class UpdateATMController extends Controller
{
    /**
     * @var ATMServiceInterface $atmService
     */
    private $atmService;

    private $amqpService;

    public function __construct($id, $module, ATMServiceInterface $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->atmService = $service;
    }

    public function actionIndex()
    {

    }
}