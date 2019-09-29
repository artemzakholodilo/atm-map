<?php

namespace frontend\controllers;

use common\models\Atm;
use frontend\models\actions\Detail;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * @todo move to new module api/v1
 */
class AtmController extends ActiveController
{
    public $modelClass = Atm::class;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['details', 'index'],  // in a controller
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ]
            ],
        ]);
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        $actions['details'] = [
            'class' => Detail::class,
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        return $actions;
    }

    public function actionIndex()
    {
        return Atm::find()->all();
    }
}