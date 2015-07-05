<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $html_title;?></title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../data/resource/js/jquery.js"></script>
<script type="text/javascript" src="../data/resource/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../data/resource/js/jquery.mousewheel.js"></script>
</head>

<body>
<?php echo $html_header;?>
<div class="main">
  <div class="final-succeed"> <span class="ico"></span>
    <h2>程序已成功安装</h2>
    <h5>选择您要进入的页面</h5>
  </div>
  <div class="final-site-nav">
    <div class="arrow"></div>
    <ul>
      <li class="cms">
        <div class="ico"></div>
        <h5><a href="<?php echo substr($auto_site_url,0,-8);?>" target="_blank">本地生活</a></h5>
        <h6>团购、优惠券、会员卡...</h6>
      </li>
    </ul>
  </div>
  <div class="final-intro">
    <p><strong>系统管理默认地址:&nbsp;</strong><a href="<?php echo substr($auto_site_url,0,-8);?>/admin" target="_blank"><?php echo substr($auto_site_url,0,-8);?>/admin</a></p>
    <p><strong>网站首页默认地址:&nbsp;</strong><a href="<?php echo substr($auto_site_url,0,-8);?>" target="_blank"><?php echo substr($auto_site_url,0,-8);?></a><br>
      <em>如选择安装了演示数据，网站默认帐号和密码均为shopnc</em></p>
  </div>
</div>
<?php echo $html_footer;?>
<script type="text/javascript">
$(document).ready(function(){
	//自定义滚定条
	$('#text-box').perfectScrollbar();
});
</script>
</body>
</html>
