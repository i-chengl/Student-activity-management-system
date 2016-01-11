<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '查看活动';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建活动 ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'act_id',
            'act_name',
//             'act_date_beg',
//             'act_date_end',
//             'act_time_submit',
            // 'act_time_update',
            'act_is_personal',
            'act_id_submit',
            // 'act_host',
            'act_partici:ntext',
            'act_id_cat', 
//         		=>(Category::find()->select(['cat_id'])
//             			->where(['cat_id' => 'act_id_cat'])->limit(1)->column()),
            // 'act_state',
            // 'act_attach',
            // 'act_comment:ntext',
            // 'act_detail:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
