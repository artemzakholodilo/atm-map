<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class RbacController extends Controller
{
    /**
     * @throws \yii\base\Exception
     */
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $superAdmin = $auth->createRole('superadmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $admin);
    }

    /**
     * @param $id
     * @return int
     * @throws \Exception
     */
    public function actionAssignAdmin($id)
    {
        if (!$id || is_int($id)) {
            $this->stdout("Param 'id' must be set!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $user = User::findOne($id);
        if (!$user) {
            $this->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $auth = \Yii::$app->authManager;

        $role = $auth->getRole('admin');

        $auth->revokeAll($id);
        $auth->assign($role, $id);

        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }

    /**
     * @param $id
     * @return int
     * @throws \Exception
     */
    public function actionAssignSuperAdmin($id)
    {
        if (!$id || is_int($id)) {
            $this->stdout("Param 'id' must be set!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $user = User::findOne($id);
        if (!$user) {
            $this->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $auth = \Yii::$app->authManager;

        $role = $auth->getRole('superadmin');

        $auth->revokeAll($id);
        $auth->assign($role, $id);

        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }
}