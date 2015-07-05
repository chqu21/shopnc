<?php defined('InShopNC') or exit('Access Invalid!');?>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<!-- 顶部公用导航 -->
<div id="page">
  <div id="topNav" class="warp-all">
    <?php if($_SESSION['is_login'] == '1'){?>
    <dl class="user-entry">
      <dt><?php echo $lang['nc_hello'];?><span><a href="<?php echo SHOP_SITE_URL.'/';?>index.php?act=member_snsindex"><?php echo str_cut($_SESSION['member_name'],20);?></a></span><?php echo $lang['nc_comma'],$lang['welcome_to_site'];?><a href="<?php echo SHOP_SITE_URL;?>"  title="<?php echo $lang['nc_index'];?>" alt="<?php echo $lang['nc_index'];?>"><span><?php echo $GLOBALS['setting_config']['site_name']; ?></span></a></dt>
      <dd>[<a href="<?php echo SHOP_SITE_URL.'/';?>index.php?act=login&op=logout"><?php echo $lang['nc_logout'];?></a>]</dd>
    </dl>
    <?php }else{?>
    <dl class="user-entry">
      <dt><?php echo $lang['nc_hello'].$lang['nc_comma'].$lang['welcome_to_site'];?><span><a href="<?php echo SHOP_SITE_URL;?>" title="<?php echo $lang['nc_index'];?>" alt="<?php echo $lang['nc_index'];?>"><?php echo $GLOBALS['setting_config']['site_name']; ?></a></span></dt>
      <dd>[<a href="<?php echo SHOP_SITE_URL.'/index.php?act=login&ref_url='.getRefUrl();?>"><?php echo $lang['nc_login'];?></a>]</dd>
      <dd>[<a href="<?php echo SHOP_SITE_URL.'/';?>index.php?act=login&op=register"><?php echo $lang['nc_register'];?></a>]</dd>
    </dl>
    <?php }?>
    <ul class="quick-menu">
      <li class="links">
        <a href="<?php echo SHOP_SITE_URL;?>"><?php echo $lang['return_shop'];?></a>
      </li>
    </ul>
  </div>
</div>
<!-- 圈子头部 -->
<header id="topHeader">
  <div class="warp-all">
    <div class="circle-logo"><a href="<?php echo CIRCLE_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_CIRCLE.'/'.C('circle_logo');?>"/></a></div>
    <div class="circle-search" id="circleSearch">
      <form id="form_search" method="get" action="<?php echo CIRCLE_SITE_URL;?>/index.php" >
        <input type="hidden" name="act" value="search" />
        <div class="input-box"><i class="icon"></i>
          <input id="keyword" name="keyword" type="text" class="input-text" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'';?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search" />
          <input id="btn_search" type="submit" class="input-btn" value="<?php echo $lang['nc_search_nbsp'];?>">
        </div>
        <div class="radio-box">
          <label>
            <input name="op" value="theme" type="radio" <?php if($output['search_sign']=='theme' || !isset($output['search_sign'])){?>checked="checked"<?php }?> />
            <h5><?php echo $lang['search_theme'];?></h5></label>
          <label>
            <input name="op" value="group" type="radio" <?php if($output['search_sign']=='group'){?>checked="checked"<?php }?> />
            <h5><?php echo $lang['search_circle'];?></h5></label>
        </div>
      </form>
    </div>
    <div class="circle-user">
      <h2><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=search&op=group"><?php echo $lang['nc_find_fascinating'];?></a></h2>
      <div class="head-portrait"><span class="thumb size20"> <i></i><img src="<?php  echo getMemberAvatarForCircle($_SESSION['avatar']);?>" /></span></div>
      <div class="user-login">
        <?php if($_SESSION['is_login']){?>
        <div class="my-group"><?php echo $lang['my_circle'];?><span><i></i></span><span class="hidden" nctype="span-mygroup">
          </span> </div>
        <?php }else{?>
        <a href="Javascript:void(0)" nctype="login"><?php echo $lang['nc_login'];?></a> | <a href="<?php echo SHOP_SITE_URL.'/';?>index.php?act=login&op=register"><?php echo $lang['nc_register'];?></a>
        <?php }?>
      </div>
    </div>
  </div>
</header>