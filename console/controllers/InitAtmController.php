<?php

namespace console\controllers;

use common\models\Atm;
use common\services\ATMServiceInterface;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Transaction;
use yii\helpers\Console;

class InitAtmController extends Controller
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

        $count = count($atmList);
        Atm::deleteAll();
        $rows = [];
        $model = new Atm();
        for ($i = 0; $i < $count; $i++) {
            $rows[$i][] = $atmList[$i]['fullAddressUa'];
            $rows[$i][] = $atmList[$i]['latitude'];
            $rows[$i][] = $atmList[$i]['longitude'];
        }
        $attributes = $model->attributes;
        unset($attributes['id']);

        $transaction = \Yii::$app->db->beginTransaction(Transaction::READ_COMMITTED);
        try {
            \Yii::$app->db->createCommand()->batchInsert(Atm::tableName(), array_keys($attributes), $rows)->execute();
            $transaction->commit();
            return ExitCode::OK;
        } catch (\yii\db\Exception $ex) {
            $transaction->rollBack();
            $this->stdout("Error {$ex->getMessage()}!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

    }
}