<h1>test/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php
/* @var $this yii\web\View */
use yii\jui\DatePicker;

?>
<h2>请选择日期</h2> <?= DatePicker::widget([
		'language' => 'zh-CN',
// 		'language' => 'en-us',
		
		'name'  => 'country',
		'clientOptions' => [
			'dateFormat' => 'yy-mm-dd',
		],
]) ?>