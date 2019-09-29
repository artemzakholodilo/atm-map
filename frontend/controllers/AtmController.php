<?php

namespace frontend\controllers;

use common\models\Atm;
use frontend\models\actions\DetailAction;
use yii\rest\Controller;
use yii\web\Response;

class AtmController extends Controller
{
    /**
     * @var string $modelClass
     */
    public $modelClass = Atm::class;

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['detail'] = [
            'class' => DetailAction::class,
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        return $actions;
    }
}