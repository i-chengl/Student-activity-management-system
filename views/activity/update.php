<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = '更新活动: ' . ' ' . $model->act_id;
$this->params['breadcrumbs'][] = ['label' => '查看活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->act_id, 'url' => ['view', 'id' => $model->act_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
