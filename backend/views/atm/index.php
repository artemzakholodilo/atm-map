<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AtmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atms';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>HQGDUYQWGDUYQW</h1>
<div class="atm-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update Atm list', ['update-list'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address',
            'latitude',
            'longitude',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                        'update' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('yii', 'Edit'),
                            ]);
                        }
                ],
            ],
        ],
    ]); ?>


</div>
