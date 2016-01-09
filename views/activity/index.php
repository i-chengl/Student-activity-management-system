<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'act_id',
            'act_name',
            'act_date_beg',
            'act_date_end',
            'act_time_submit',
            // 'act_time_update',
            // 'act_is_personal',
            // 'act_id_submit',
            // 'act_host',
            // 'act_partici:ntext',
            // 'act_id_cat',
            // 'act_state',
            // 'act_attach',
            // 'act_comment:ntext',
            // 'act_detail:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
