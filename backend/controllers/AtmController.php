<?php

namespace backend\controllers;

use backend\services\TaskSender;
use Yii;
use common\models\Atm;
use common\models\AtmSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AtmController implements the CRUD actions for Atm model.
 */
class AtmController extends Controller
{
    /**
     * @var TaskSender $taskSender
     */
    private $taskSender;

    /**
     * AtmController constructor.
     * @param $id
     * @param $module
     * @param TaskSender $taskSender
     * @param array $config
     */
    public function __construct($id, $module, TaskSender $taskSender, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->taskSender = $taskSender;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'update'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['update-list'],
                        'allow' => true,
                        'roles' => ['superadmin']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Atm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AtmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionUpdateList()
    {
        if (\Yii::$app->request->isGet) {
            $this->taskSender->sendTask('update-list');

            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Atm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Atm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Atm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Atm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
