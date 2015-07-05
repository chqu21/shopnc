<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="clear">&nbsp;</div>
<div id="footer">
  <p><a href="<?php echo SHOP_SITE_URL;?>"><?php echo $lang['nc_index'];?></a>
    <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
    <?php foreach($output['nav_list'] as $nav){?>
    <?php if($nav['nav_location'] == '2'){?>
    | <a  <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php switch($nav['nav_type']){
    	case '0':echo $nav['nav_url'];break;
    	case '1':echo ncUrl(array('act'=>'search','nav_id'=>$nav['nav_id'],'cate_id'=>$nav['item_id']), '', 'www');break;
    	case '2':echo ncUrl(array('act'=>'article','nav_id'=>$nav['nav_id'],'ac_id'=>$nav['item_id']), '', 'www');break;
    	case '3':echo ncUrl(array('act'=>'activity','activity_id'=>$nav['item_id'],'nav_id'=>$nav['nav_id']), 'activity', 'www');break;
    }?>"><?php echo $nav['nav_title'];?></a>
    <?php }?>
    <?php }?>
    <?php }?>
    |&nbsp;<a href="index.php?act=slogin"><?php echo $lang['nc_store_login'];?></a>111
  </p>
  Copyright 2007-2013 ShopNC Inc.,All rights reserved.<br />
  Powered by <?php echo $GLOBALS['setting_config']['shopnc_version'];?>
  <?php echo $GLOBALS['setting_config']['icp_number']; ?><br />
  <?php echo html_entity_decode($GLOBALS['setting_config']['statistics_code'],ENT_QUOTES); ?> </div>
<?php if (C('debug') == 1){?>
<div id="think_page_trace" class="trace">
  <fieldset id="querybox">
    <legend><?php echo $lang['nc_debug_trace_title'];?></legend>
    <div>
      <?php print_r(Tpl::showTrace());?>
    </div>
  </fieldset>
</div>
<?php }?>
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/jquery.cookie.js"></script>
<script id="cron" src="<?php echo SHOP_SITE_URL;?>/index.php?act=scan"></script>
<script language="javascript">
$(function(){
	$('#topNav').find('li[class="cart"]').mouseover(function(){
		// 运行加载购物车
		load_cart_information();
		$(this).unbind();
	});
});
</script>