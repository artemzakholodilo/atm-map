<?php

namespace console\controllers;

use common\models\Atm;
use common\services\ATMServiceInterface;
use yii\console\Controller;
use yii\console\ExitCode;

class InitController extends Controller
{
    /**
     * @var ATMServiceInterface $atmService
     */
    private $atmService;

    /**
     * InitController constructor.
     * @param $id
     * @param $module
     * @param ATMServiceInterface $service
     * @param array $config
     */
    public function __construct($id, $module, ATMServiceInterface $service, $config = [])
    {
        parent::__construct($id, $module, $config);
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

        return ExitCode::OK;
    }
}