<?php

namespace console\controllers;

use backend\services\TaskReceiver;
use common\models\Atm;
use common\services\ATMServiceInterface;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class UpdateAtmController extends Controller
{
    /**
     * @var ATMServiceInterface $atmService
     */
    private $atmService;

    /**
     * @var TaskReceiver $taskReceiver
     */
    private $taskReceiver;

    /**
     * UpdateATMController constructor.
     * @param $id
     * @param $module
     * @param ATMServiceInterface $service
     * @param TaskReceiver $taskReceiver
     * @param array $config
     */
    public function __construct($id, $module, ATMServiceInterface $service, TaskReceiver $taskReceiver, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->atmService = $service;
        $this->taskReceiver = $taskReceiver;
    }

    /**
     * @return bool
     */
    public function actionIndex()
    {
        $messages = $this->taskReceiver->getMessages();
        if (count($messages)) {
            $this->updateList();
        }

        $this->stdout("Already up to date!\n", Console::BG_GREEN);
        return ExitCode::OK;
    }

    /**
     * @return bool
     */
    protected function updateList()
    {
        /**
         * @var Atm $newAtm
         */
        $atmList = $this->atmService->getList('');
        $models = [];
        $currentAtmList = Atm::find()->all();
        foreach ($atmList as $item) {
            $atm = new Atm();
            $atm->hydrate($item);
            $models[] = $atm;
        }

        $newAtmData = array_udiff($models, $currentAtmList, function ($a, $b) {

            return ($a->latitude !== $b->latitude) && ($a->longitude !== $b->longitude);
        });

        foreach ($newAtmData as $newAtm) {
            $newAtm->save();
        }

        return true;
    }
}