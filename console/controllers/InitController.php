<?php

namespace console\controllers;

use common\services\ATMServiceInterface;
use yii\console\Controller;

class InitController extends Controller
{
    public function __construct($id, $module, ATMServiceInterface $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        var_dump($service->getList('Днепропетровск')); exit;
    }
    /**
     * @return bool
     */
    public function actionIndex()
    {
        /*preg_match("/dbname=([^;]*)/", \Yii::$app->db->dsn, $matches);
        $dbName = $matches[1];
//        $transaction = \Yii::$app->db->beginTransaction(Transaction::READ_COMMITTED);
        try {
            $sql = "CREATE DATABASE IF NOT EXISTS $dbName";

            \Yii::$app->db->createCommand($sql)->execute();
//            $transaction->commit();
        } catch (\Yii\db\Exception $ex) {
//            $transaction->rollBack();
            sprintf("Database error %m, at line %l", $ex->getMessage(), $ex->getLine());
        } catch (\Exception $ex) {
//            $transaction->rollBack();
            sprintf("Error %m, at line %l", $ex->getMessage(), $ex->getLine());
        }*/
    }
}