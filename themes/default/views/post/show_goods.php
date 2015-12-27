<?php $this->renderPartial('/_include/header')?>
<script src="<?php echo $this->_baseUrl?>/static/js/lightbox/js/lightbox-2.6.min.js"></script>
<link href="<?php echo $this->_baseUrl?>/static/js/lightbox/css/lightbox.css" rel="stylesheet" />
<div class="mainWrap">
<div class="topDesc">
  <div class="desc">
    <p style=" margin-top:40px;">致力于提升客户品牌形象、实现客户商业目标!</p>
    <p>Commitment to enhance customer brand image,customer business goals!</p>
  </div>
</div>
<div class="global clear">
  <div class="sidebar right" id="sidebar">
    <div class="moduleBox">
      <div class="boxTit clear">
        <h3>热门产品</h3>
      </div>
      <div class="border">
        <div id="portal_block_237_content" class="dxb_bc">
          <div class="module cl xld slideshow">
            <?php foreach((array)Bagecms::getList('post','hot_goods',array('where'=>"status_is='Y' AND catalog_id=5",'order'=>'view_count DESC', 'limit'=>2)) as $goodsKey=>$goodsRow):?>
			<dl class="clear">
              <dd class="m"><a href="<?php echo $this->createUrl('post/show',array('id'=>$goodsRow['id']))?>" target="_blank"><img src="<?php echo $this->_baseUrl?>/<?php echo $goodsRow['attach_thumb']?>" width="150" height="115"></a></dd>
             
              <dt><a href="<?php echo $this->createUrl('post/show',array('id'=>$goodsRow['id']))?>" title="<?php echo $goodsRow['title']?>" target="_blank"><?php echo $goodsRow['title']?></a></dt>
            </dl>
           <?php endforeach?>
          </div>
        </div>
      </div>
    </div>
    <div class="sideBox moduleBox">
      <p><?php echo $this->_conf['_telephone_400']?></p>
    </div>
  </div>
  <div class="mainBox floatL">
    <div class="loc clear">
      <div class="floatL position"> <span>您的位置：</span> <a href="<?php echo Yii::app()->homeUrl?>">首页</a> <em></em><span>产品中心</span><em></em> <a href="<?php echo $this->createUrl('post/index',array('catalog'=>$catalogArr['id']))?>"><?php echo $catalogArr['catalog_name']?></a> <em></em> 查看内容 </div>
    </div>
    <div class="postWrap">
      <div class="h head">
        <h1 class="title"><?php echo $bagecmsShow->title?></h1>
        <p class="info"><?php echo date('Y-m-d H:i:s',$bagecmsShow->create_time)?><span class="split">|</span> 发布者: admin<span class="split">|</span> 查看: <em id="_viewnum"><?php echo $bagecmsShow->view_count?></em></p>
      </div>
	  <?php if($attrVal):?>
      <div class="attrVal"><p>属性</p>
        <ul>
          <?php foreach($attrVal as $val):?>
          <li><span><?php echo $val->attr->attr_name?>:</span><?php echo $val->attr_val?></li>
          <?php endforeach?>
        </ul>
      </div>
      <?php endif?>
	  <?php if($bagecmsShow->image_list):?>
	  <?php $imageList = unserialize($bagecmsShow->image_list)?>
	  <div class="postAlbum clear"><ul><?php foreach($imageList as $album):?><li><a href="<?php echo $this->_baseUrl?>/<?php echo $album['file']?>" data-lightbox="a"><img src="<?php echo $this->_baseUrl?>/<?php echo $album['file']?>" /></a></li><?php endforeach?></div>
	  <?php endif?>
      <?php if($bagecmsShow->intro):?>
      <div class="intro clear"><?php echo $bagecmsShow->intro?></div>
      <?php endif?>
      <div class="cdata">
        <table cellpadding="0" cellspacing="0" class="showTb">
          <tbody>
            <tr>
              <td id="postContent"><?php echo $bagecmsShow->content?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--上下篇-->
    <?php $before = Bagecms::getList('Post', 'pageBefore', array('where'=>"id<{$bagecmsShow['id']} AND catalog_id={$bagecmsShow['catalog_id']} AND status_is='Y'",'order'=>'id DESC', 'limit'=>1))?>
    <?php $behind = Bagecms::getList('Post', 'pageBehind', array('where'=>"id>{$bagecmsShow['id']} AND catalog_id={$bagecmsShow['catalog_id']} AND status_is='Y'",'order'=>'id ASC', 'limit'=>1))?>
    <div class="preNext clear" > <em class="floatL">上一篇：
      <?php if($before):?>
      <a href="<?php if($before[0]['redirect_url']):?><?php echo XUtils::convertHttp($before[0]['redirect_url'])?><?php else:?><?php echo $this->createUrl('post/show',array('id'=>$before[0]['id']))?><?php endif?>"><?php echo $before[0]['title']?></a>
      <?php else:?>
      没有了
      <?php endif?>
      </em><em class="floatR">下一篇：
      <?php if($behind):?>
      <a href="<?php if($behind[0]['redirect_url']):?><?php echo XUtils::convertHttp($behind[0]['redirect_url'])?><?php else:?><?php echo $this->createUrl('post/show',array('id'=>$behind[0]['id']))?><?php endif?>"><?php echo $behind[0]['title']?></a>
      <?php else:?>
      没有了
      <?php endif?>
      </em></div>
  <!--/上下篇-->
    </div>
   <?php $this->renderPartial('_comment',array('bagecmsShow'=>$bagecmsShow))?>
  </div>
</div>
<?php $this->renderPartial('/_include/footer')?>
