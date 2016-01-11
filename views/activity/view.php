<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->act_id;
$this->params['breadcrumbs'][] = ['label' => '查看活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['更新', 'id' => $model->act_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['删除', 'id' => $model->act_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这个活动吗?',
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
