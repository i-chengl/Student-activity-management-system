<?php echo $this->renderPartial('/_include/header')?>

<div id="contentHeader">
  <h3>数据库还原</h3>
  <div class="searchArea">
    <ul class="action left" >
     <li><a href="<?php echo $this->createUrl('index')?>" class=""><span>常规管理</span></a></li>
      <li><a href="<?php echo $this->createUrl('query')?>" class=""><span>执行SQL</span></a></li>
      <li><a href="<?php echo $this->createUrl('database/export')?>" class=""><span>数据库备份</span></a></li>
      <li><a href="<?php echo $this->createUrl('database/import')?>" class="current"><span>数据库还原</span></a></li>
    </ul>
    <div class="search right"> </div>
  </div>
</div>
<form action="<?php echo $this->createUrl('database/operate')?>" method="post">
  <table class="content_list">
    <thead>
      <tr class="tb_header">
        <th width="4%"align="left"></th>
        <th>名称</th>
        <th width="10%">文件大小</th>
        <th width="20%">备份时间</th>
        <th width="10%">分卷</th>
        <th width="15%">恢复/下载</th>
      </tr>
    </thead>
    <tbody>
      <?php if(is_array($infos)):?>
      <?php foreach($infos as $info):?>
      <tr bgcolor="<?php echo $info['bgcolor']?>">
        <td ><input name="sqlfile[]" type="checkbox" id="sqlfile[]" value="<?php echo $info['filename']?>"></td>
        <td><?php echo $info['filename']?></td>
        <td><?php echo $info['filesize']?> M</td>
        <td><?php echo $info['maketime']?></td>
        <td><?php echo $info['number']?></td>
        <td><a href="<?php echo $this->createUrl('database/import',array('pre'=>$info['pre'], 'dosubmit'=>'1'))?>"><img src="<?php echo $this->_baseUrl?>/static/admin/images/refresh.png" align="absmiddle" /></a>&nbsp;&nbsp;&nbsp; <a href="<?php echo $this->createUrl('database/operate',array('command'=>'downloadFile','sqlfile'=>$info['filename']))?>"><img src="<?php echo $this->_baseUrl?>/static/admin/images/download.png" align="absmiddle" /></a></td>
      </tr>
      <?php endforeach?>
      <?php endif?>
    </tbody>
    <tr class="submit">
      <td colspan="6" ><input name="command" type="hidden" value="deleteFile" />
        <input type="checkbox" id="chkall" name="chkall" onclick="checkAll(this.form, 'file')">
        全选
        <input name="submit" type="submit" id="submit" value="删除" class="button"/>
        &nbsp;</td>
    </tr>
  </table>
</form>
<?php echo $this->renderPartial('/_include/footer')?>