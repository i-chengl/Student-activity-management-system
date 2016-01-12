<?php 
use yii\helpers\Html;

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
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