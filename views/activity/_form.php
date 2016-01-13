<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\jui\DatePicker;
use app\models\User;
use app\models\Category;

// $datePicker = new DatePicker();
/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin([
    		 'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'act_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_date_beg')->textInput()//->widget($datePicker) ?>

    <?= $form->field($model, 'act_date_end')->textInput() ?>
<!-- 
    <?= $form->field($model, 'act_time_submit')->textInput() ?>

    <?= $form->field($model, 'act_time_update')->textInput() ?>
 -->


    <?= $form->field($model, 'act_is_personal')//->textInput()
		->dropDownList(['2'=>' ','1'=>'是','0'=>'否'])?>

    <?= $form->field($model, 'act_id_submit')//->textInput(['maxlength' => true])
    	->dropDownList(User::find()->select(['usr_name','usr_id'])->indexBy('usr_id')->column()) ?>

    <?= $form->field($model, 'act_host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_partici')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'act_id_cat')//->textInput(['maxlength' => true])
    	->dropDownList(Category::find()->select(['cat_name','cat_id'])->indexBy('cat_id')->column(),['id'=>'请选择活动分类']) ?>
<!-- 
    <?//= $form->field($model, 'act_state')->textInput()
    	//->dropDownList(['','待审核','审核未通过','完结'])?>
 -->

    <?= $form->field($model, 'zipUpload')->label('附件（压缩包）')->fileInput()
//     ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'act_detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	
    <?php ActiveForm::end(); ?>

</div>
