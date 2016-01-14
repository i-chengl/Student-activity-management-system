<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usr_id')->textInput(['maxlength' => true]) ?>
    
   	<?= $form->field($model, 'usr_group')->dropDownList(['1' =>'普通用户' , '2' =>'管理员']) ?> 

    <?= $form->field($model, 'usr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usr_passwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usr_state')->dropDownList([0=>'学生',1=>'教师']) ?>

    <?= $form->field($model, 'usr_depart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usr_class')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
