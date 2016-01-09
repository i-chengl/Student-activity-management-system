<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = 'Update Admin: ' . ' ' . $model->adm_id;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->adm_id, 'url' => ['view', 'id' => $model->adm_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
