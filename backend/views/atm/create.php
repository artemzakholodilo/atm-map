<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Atm */

$this->title = 'Create Atm';
$this->params['breadcrumbs'][] = ['label' => 'Atms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
