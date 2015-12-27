<?php $this->renderPartial('/_include/header');?>

<div id="contentHeader">
  <h3>会员组管理</h3>
  <div class="searchArea">
    <ul class="action left" >
      <li class="current"><a href="<?php echo $this->createUrl('groupCreate')?>" class="actionBtn"><span>录入</span></a></li>
    </ul>
    <div class="search right"> </div>
  </div>
</div>
<table class="content_list">
  <form method="post" action="" name="cpform" >
    <tr class="tb_header">
      <th width="5%">ID</th>
      <th width="10%">用户组 </th>
      <th width="15%">录入时间</th>
      <th >操作</th>
    </tr>
    <?php foreach ($datalist as $row):?>
    <tr class="tb_list">
      <td ><?php echo $row->id?></td>
      <td ><?php echo $row->group_name?></td>
      <td ><?php echo date('Y-m-d H:i',$row->create_time)?></td>
      <td ><a href="<?php echo  $this->createUrl('groupUpdate',array('id'=>$row->id))?>"><img src="<?php echo $this->_baseUrl?>/static/admin/images/update.png" align="absmiddle" /></a>&nbsp;&nbsp;<a href="<?php echo  $this->createUrl('batch',array('command'=>'groupDelete', 'id'=>$row->id))?>" class="confirmSubmit"><img src="<?php echo $this->_baseUrl?>/static/admin/images/delete.png" align="absmiddle" /></a></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="9"><div class="cuspages right">
          <?php $this->widget('CLinkPager',array('pages'=>$pagebar));?>
        </div></td>
    </tr>
  </form>
</table>
<?php $this->renderPartial('/_include/footer');?>
