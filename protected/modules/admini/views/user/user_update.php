<?php $this->renderPartial('/_include/header');?>

<div id="contentHeader">
  <h3>会员管理</h3>
  <div class="searchArea">
    <ul class="action left" >
      <li ><a href="<?php echo $this->createUrl('index')?>" class="actionBtn"><span>返回</span></a></li>
      <li ><a href="<?php echo $this->createUrl('create')?>" class="actionBtn"><span>录入</span></a></li>
    </ul>
    <div class="search right"> </div>
  </div>
</div>
<?php $this->renderPartial('_user_form',array('model'=>$model))?>
<?php $this->renderPartial('/_include/footer');?>
