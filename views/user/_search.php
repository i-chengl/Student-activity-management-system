<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usr_id') ?>

    <?= $form->field($model, 'usr_name') ?>

    <?= $form->field($model, 'usr_passwd') ?>

    <?= $form->field($model, 'usr_state') ?>

    <?= $form->field($model, 'usr_depart') ?>

    <?php // echo $form->field($model, 'usr_class') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
