<?php
use yii\helpers\Html;

$this->title = '个人页';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-manger">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    
	<h1><?= Html::encode($user['usr_name']) ?></h1>
    
    
<div class="container">
	<div class="row clearfix">
		<div class="col-md-4 column">
		
			<span class="label label-default">普通用户</span>

			<div class="panel-group" id="panel-110204">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-141314">我参加的活动</a>
					</div>
					<div id="panel-element-141314" class="panel-collapse collapse ">
						<div class="panel-body">
							<a href="?r=activity/participate">我参加的全部活动</a>
						</div>
						<div class="panel-body">
//						<a href="?r=activity/">我参加的集体活动</a>
						</div>
						<div class="panel-body">
//							<a href="?r=activity/">我参加的个人活动</a>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879302">我组织的活动</a>
					</div>
					<div id="panel-element-879302" class="panel-collapse collapse">
						<div class="panel-body">我组织的个人活动</div>
						<div class="panel-body">我组织的个人活动</div>
						<div class="panel-body">我组织的个人活动</div>	
						<div class="panel-body">我组织的个人活动</div>
						<div class="panel-body">我组织的个人活动</div>
						<div class="panel-body">我组织的个人活动</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879301">我的个人信息</a>
					</div>
					<div id="panel-element-879301" class="panel-collapse collapse">
						<div class="panel-body">姓名：静态名字</div>
					</div>
				</div>

				</div>
			</div>
			<div class="col-md-4 column"></div>
		</div>
	</div>

</div>