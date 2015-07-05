<?php defined('InShopNC') or exit('Access Invalid!');?>
<div id="footer">
<div class="footer-box">
    <p><a href="<?php echo BASE_SITE_URL;?>"><?php echo $lang['nc_index'];?></a>
    <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
    <?php foreach($output['nav_list'] as $nav){?>
    <?php if($nav['nav_location'] == '2'){?>
    | <a  <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php echo BASE_SITE_URL?>/<?php switch($nav['nav_type']){
    	case '0':echo $nav['nav_url'];break;
    	case '1':echo ncUrl(array('act'=>'search','nav_id'=>$nav['nav_id'],'cate_id'=>$nav['item_id']), '', 'www');break;
    	case '2':echo ncUrl(array('act'=>'article','nav_id'=>$nav['nav_id'],'ac_id'=>$nav['item_id']), '', 'www');break;
    	case '3':echo ncUrl(array('act'=>'activity','activity_id'=>$nav['item_id'],'nav_id'=>$nav['nav_id']), 'activity', 'www');break;
    }?>"><?php echo $nav['nav_title'];?></a>
    <?php }?>
    <?php }?>
    <?php }?>
    |&nbsp;<a href="index.php?act=slogin"><?php echo $lang['nc_store_login'];?></a>
  </p>
  
  Copyright 2007-2014 siyangtuan Inc.,All rights reserved.<br>
  Powered by <span class="vol"><font class="b">siyang</font><font class="o">tuan</font></span>
  <?php echo $GLOBALS['setting_config']['icp_number'];?><br>
  <?php echo htmlspecialchars_decode($GLOBALS['setting_config']['statistics_code']); ?><br>
</div>
</div>