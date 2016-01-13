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
				<div class="panel panel-default">
					<div class="panel-footer">
						<a class="btn " href="?r=admin/index">管理员管理</a>
					</div>
					<div class="panel-body">
						<a class="btn " href="?r=user/index">管理用户</a>
					</div>
					<div class="panel-footer">
						<a class="btn " href="?r=activity/index">管理活动</a>
					</div>
					<div class="panel-body">
						<a class="btn " href="?r=category/index">管理活动分类</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 column">
			</div>
		</div>
	</div>
</div>