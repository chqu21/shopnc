<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $lang['login_title'];?></title>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
<header class="header"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/logo.gif"></header>
<div class="main_wrap">
  <div class="main_inner">
    <div id="loginwrap" class="login_inner login_shadow">
      <div class="login_hd">
        <h2><?php echo $lang['login_title'];?></h2>
        <a href="<?php echo BASE_SITE_URL;?>" target='_blank'><?php echo $lang['login_back_home'];?></a> </div>
      <div class="login_bd">
        <form id="form_login" method="post">
          <div class="usernm">
            <h2><?php echo $lang['login_index_username'];?>:</h2>
            <input type="text" autocomplete="off" name="user_name" id="user_name" class="text">
          </div>
          <div class="password">
            <h2><?php echo $lang['login_index_password'];?>:</h2>
            <input type="password" autocomplete="off" id="password" name="password" class="text">
          </div>
          <div class="code">
            <h2><?php echo $lang['login_index_checkcode'];?>:</h2>
			<input class="text" name="captcha" id="captcha" autocomplete="off"  type="text" style="width:120px;"><span><a href="JavaScript:void(0);" onclick="javascript:document.getElementById('codeimage').src='../index.php?act=seccode&op=makecode&admin=1&nchash=<?php echo $output['nchash'];?>&t=' + Math.random();"> <img src="../index.php?act=seccode&op=makecode&admin=1&nchash=<?php echo $output['nchash'];?>" title="<?php echo $lang['login_index_change_checkcode'];?>" name="codeimage" border="0" id="codeimage" onclick="this.src='../index.php?act=seccode&op=makecode&admin=1&nchash=<?php echo $output['nchash'];?>&t=' + Math.random()" /></a></span>
		  </div>
          <div class="login_btn clearfix">
			<input name="nchash" type="hidden" value="<?php echo $output['nchash'];?>" />
            <input type="submit" value="" id="loginSubmit" class="btn-regist">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--
  <div id="footer">
	<p><a href="#"><?php echo $lang['nc_home'];?></a> | <a href="#"><?php echo $lang['nc_join_us'];?></a> | <a href="#"><?php echo $lang['nc_adv_contact'];?></a> | <a href="#"><?php echo $lang['nc_about_shopnc'];?></a> | <a href="#"><?php echo $lang['nc_about_us'];?></a> </p>
    Copyright 2007-2013 ShopNC Inc.,All rights reserved.<br>
    Powered by <span class="vol"><font class="b">Shop</font><font class="o">NC</font><em>2013</em></span> <br>
  </div>-->
</div>
</body>
</html>
