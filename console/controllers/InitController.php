<?php

namespace console\controllers;

use backend\services\TaskSender;
use common\models\Atm;
use common\services\ATMServiceInterface;
use yii\console\Controller;

class InitController extends Controller
{
    private $atmService;

    public function __construct($id, $module, ATMServiceInterface $service, TaskSender $sender, $config = [])
    {
        parent::__construct($id, $module, $config);
        var_dump($sender); exit;
        $this->atmService = $service;
    }

    /**
     * Get all atm data
     * @return bool
     */
    public function actionIndex()
    {
        $atmList = $this->atmService->getList('');
        foreach ($atmList as $item) {
            $atm = new Atm();
            $atm->hydrate($item);
            $atm->save();
        }

        return true;
    }
}