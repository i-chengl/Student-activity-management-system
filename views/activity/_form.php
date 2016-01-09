<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'act_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_date_beg')->textInput() ?>

    <?= $form->field($model, 'act_date_end')->textInput() ?>

    <?= $form->field($model, 'act_time_submit')->textInput() ?>

    <?= $form->field($model, 'act_time_update')->textInput() ?>

    <?= $form->field($model, 'act_is_personal')->textInput() ?>

    <?= $form->field($model, 'act_id_submit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_partici')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'act_id_cat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_state')->textInput() ?>

    <?= $form->field($model, 'act_attach')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'act_detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
