<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->act_id;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->act_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->act_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'act_id',
            'act_name',
            'act_date_beg',
            'act_date_end',
            'act_time_submit',
            'act_time_update',
            'act_is_personal',
            'act_id_submit',
            'act_host',
            'act_partici:ntext',
            'act_id_cat',
            'act_state',
            'act_attach',
            'act_comment:ntext',
            'act_detail:ntext',
        ],
    ]) ?>

</div>
