<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'act_id') ?>

    <?= $form->field($model, 'act_name') ?>

    <?= $form->field($model, 'act_date_beg') ?>

    <?= $form->field($model, 'act_date_end') ?>

    <?= $form->field($model, 'act_time_submit') ?>

    <?php // echo $form->field($model, 'act_time_update') ?>

    <?php // echo $form->field($model, 'act_is_personal') ?>

    <?php // echo $form->field($model, 'act_id_submit') ?>

    <?php // echo $form->field($model, 'act_host') ?>

    <?php // echo $form->field($model, 'act_partici') ?>

    <?php // echo $form->field($model, 'act_id_cat') ?>

    <?php // echo $form->field($model, 'act_state') ?>

    <?php // echo $form->field($model, 'act_attach') ?>

    <?php // echo $form->field($model, 'act_comment') ?>

    <?php // echo $form->field($model, 'act_detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
