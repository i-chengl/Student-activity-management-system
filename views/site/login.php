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
				<div align="center">
					<h2><strong>登陆</strong></h2>
				</div>
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					 'options' => ['class' => 'form-horizontal'],
					 'fieldConfig' => [
					     'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
					      'labelOptions' => ['class' => 'col-lg-1 control-label'],
					   ],
    			]); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>	
        <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				普通用户 
				<input type="radio" name="radiobutton" value="radiobutton" />
				管理员 
				<input type="radio" name="radiobutton" value="radiobutton" />
			</div>
		</div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    	<?php ActiveForm::end(); ?>
					</div>
		</div>
		</div>
	</div>
</div>


	<!-- 


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
        <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				普通用户 
				<input type="radio" name="radiobutton" value="radiobutton" />
				管理员 
				<input type="radio" name="radiobutton" value="radiobutton" />
			</div>
		</div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


 -->
</div>
