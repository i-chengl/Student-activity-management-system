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
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879302">活动管理</a>
					</div>
					<div id="panel-element-879302" class="panel-collapse collapse">
						<div class="panel-body">
							<a  href= "?r=activity/index" >查看所有活动</a>
						</div>
						<div class="panel-body">
							<a href = "?r=activity/&state=0">未审核活动</a>
						</div>
						<div class="panel-body">
							<a href= "?r=activity/&state=2" >已完结活动</a>
						</div>
						<div class="panel-body">
							<a href= "?r=activity/&state=1">审核未通过活动</a>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879301">管理活动分类</a>
					</div>
					<div id="panel-element-879301" class="panel-collapse collapse">
						<div class="panel-body"><a href="?r=category/create">增加分类</a></div>
						<div class="panel-body"><a href = "?r=category/index">查看分类</a></div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="panel-title collapsed" data-toggle="collapse"
							data-parent="#panel-110204" href="#panel-element-879303">我的个人信息</a>
					</div>
					<div id="panel-element-879303" class="panel-collapse collapse">
						<div class="panel-body">
							<a href="?r=category/create">增加分类</a>
						</div>
						<div class="panel-body">
							<a href="?r=category/index">查看分类</a>
						</div>
					</div>
				</div>

				</div>
			</div>
			<div class="col-md-4 column"></div>
		</div>
	</div>
</div>