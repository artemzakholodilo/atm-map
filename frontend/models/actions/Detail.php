<?php

namespace frontend\models\actions;

use common\models\Atm;
use yii\rest\ViewAction;
use yii\web\Response;

class Detail extends ViewAction
{
    /**
     * @param string $id
     * @return array|\yii\db\ActiveRecordInterface
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        /**
         * @var Atm $model
         */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if (!$model) {
            return [];
        } else {
            return [$model->address];
        }
    }
}