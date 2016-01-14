<?php 
use yii\helpers\Html;

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

<?php if(!empty($username)){?>
	<h1><?= Html::encode($username."，您好！") ?></h1>
<?php } else {?>
	<h1><?= Html::encode('您好，请及时') ?><a href="?r=site/login"><?= Html::encode('登陆') ?></a></h1>
<?php }?>
	<div class="container">
	<div class="row clearfix">
		<div class="col-md-4 column">
		
			<span class="label label-default">管理员</span>

			<div class="panel-group" id="panel-110204">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-141314">管理用户</a>
					</div>
					<div id="panel-element-141314" class="panel-collapse collapse ">
						<div class="panel-body">
							<a href="?r=user/index">查看用户</a>
						</div>
						<div class="panel-body">
							<a href="?r=user/create">增加用户</a>
						</div>
						<div class="panel-body">修改用户</div>
						<div class="panel-body">删除用户</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879302">活动管理</a>
					</div>
					<div id="panel-element-879302" class="panel-collapse collapse">
						<div class="panel-body">查看所有活动</div>
						<div class="panel-body">未审核活动</div>
						<div class="panel-body">已完结活动</div>
						<div class="panel-body">审核未通过活动</div>
						<div class="panel-body">我组织的个人活动</div>
						<div class="panel-body">我组织的个人活动</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879301">管理活动分类</a>
					</div>
					<div id="panel-element-879301" class="panel-collapse collapse">
						<div class="panel-body">增加分类</div>
						<div class="panel-body">查看分类</div>
						<div class="panel-body">删除分类</div>
						<div class="panel-body">更新分类</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879303">管理活动分类</a>
					</div>
					<div id="panel-element-879303" class="panel-collapse collapse">
						<div class="panel-body">增加分类</div>
						<div class="panel-body">查看分类</div>
						<div class="panel-body">删除分类</div>
						<div class="panel-body">更新分类</div>
					</div>
				</div>

				</div>
			</div>
			<div class="col-md-4 column"></div>
		</div>
	</div>

	
	
	
</div>