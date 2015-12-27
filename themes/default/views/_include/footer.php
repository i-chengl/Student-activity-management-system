<div class="siteInfo clear">
  <div class="wrap">
    <div class="box">
      <h2 class="title">联系我们</h2>
      <div class="action">
        <p class="home"><?php echo $this->_conf['_address']?></p>
        <p class="telephone"><?php echo $this->_conf['_telephone']?></p>
        <p class="telephone"><?php echo $this->_conf['_fax']?></p>
        <p class="mobile"><?php echo $this->_conf['_mobile']?></p>
        <p class="email"><?php echo $this->_conf['admin_email']?></p>
      </div>
    </div>
    <div class="box paddLeft">
      <h2 class="title">网站导航</h2>
      <div class="action"> <span class="actionTitle">公司介绍</span> <a href="<?php echo $this->createUrl('page/show',array('name'=>'about'))?>">公司介绍</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'cultural'))?>">企业文化</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'team'))?>">管理团队</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'contact'))?>">联系我们</a> </div>
      <div class="action"> <span class="actionTitle">友情链接</span><?php foreach((array)Bagecms::getList('link','_link',array('where'=>"status_is='Y' ",'order'=>'id DESC', 'limit'=>4)) as $link):?> <a href="<?php echo $link['site_url']?>" title="<?php echo $link['site_name']?>"><?php echo $link['site_name']?></a><?php endforeach?> </div>
      
      <div class="clear"></div>
    </div>
    <div class="box paddLeft">
      <h2 class="title">官网直达</h2>
      <div class="action"> <img src="<?php echo $this->_baseUrl?>/static/images/bagecms.png" width="100" height="100" /></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
</div>
<div id="footer">
  <div class="wrap clear">
    <div class="act"><p>&nbsp;</p>
      <p><?php echo $this->_conf['site_copyright']?>&nbsp;&nbsp;Powered by <a href="http://www.bagecms.com">BageCMS</a> &nbsp;&nbsp;<?php if($this->_conf['site_icp']):?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $this->_conf['site_icp']?></a> ) <?php endif?><?php echo $this->_conf['site_stats']?></p>
    </div>
  </div>
</div>
</div>
</body>
</html>