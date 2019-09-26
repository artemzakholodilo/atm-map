<?php

namespace console\controllers;

use common\models\Atm;
use common\services\ATMServiceInterface;
use yii\console\Controller;

class InitController extends Controller
{
    private $atmService;

    public function __construct($id, $module, ATMServiceInterface $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        /*$list = $service->getList('Днепропетровск');
        foreach ($list as $item) {
            var_dump($item); exit;
        }*/
        $this->atmService = $service;
    }

    /**
     * @return bool
     */
    public function actionIndex()
    {
        $atmList = $this->atmService->getList(\Yii::$app->params['atmDefaultCity']);
        foreach ($atmList as $item) {
            $atm = new Atm();
            $atm->hydrate($item);
            $atm->save();
        }
    }
}