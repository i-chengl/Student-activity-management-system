<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
	<br>
	<div class="container">
		<div class="row clearfix">
			<div class="row clearfix">
				<div class="col-md-6 column">
					<div class="jumbotron">
						<div align="center">
							<h2><strong>学生活动管理系统</strong></h2>
						</div>
						<div align="left">
							<p>（1）统计学生在本科阶段所参加的各项活动</p>
							<p>（2）确认各项活动是否合理开展</p>
							<p>（3）修改并纠正统计错误</p>
						</div>
					</div>
				</div>
			<div class="col-md-6 column">
					<div class = "col-lg-offset-4 col-lg-8"><br>
						<h2><strong>登陆</strong></h2>
						<br>
					</div>
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					 'options' => ['class' => 'form-horizontal'],
					 'fieldConfig' => [
					     'template' => "{label}:<div class=\"col-lg-5\">{input}</div><div class=\"col-lg-5\">{error}</div>",
					      'labelOptions' => ['class' => 'col-lg-2 control-label'],
					   ],
    			]); ?>

        <?= $form->field($model, 'usr_id')->label('id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'usr_passwd')->label('Pass')->passwordInput() ?>
        
        <?= $form->field($model, 'usr_group')->dropDownList(['1' =>'普通用户' , '2'=>'管理员']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>	
       

        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <?= Html::submitButton('登陆', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    	<?php ActiveForm::end(); ?>
					</div>
		</div>
		</div>
	</div>
</div>
</div>
