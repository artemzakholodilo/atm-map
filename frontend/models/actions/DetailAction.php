<?php

namespace frontend\models\actions;

use yii\base\Model;
use yii\rest\ViewAction;
use yii\web\Response;

class DetailAction extends ViewAction
{
    /**
     * @param integer $id
     * @return Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function run(integer $id): Response
    {
        /**
         * @var Model $model
         */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $response = new Response(
            [
                'detail' => $model->alias
            ]
        );

        return $response;
    }
}