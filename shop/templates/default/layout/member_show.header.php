<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo TEMPLATE_SITE_URL;?>/css/member_show.css" rel="stylesheet" type="text/css">
<style>
.topnav_bd {
    height: 40px;
    margin: 0 auto;
    width: 990px;
}
</style>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$(".quick-menu li").hover(function() {
		$(this).addClass("active");
	},
	function() {
		$(this).removeClass("active");
	});

});
</script>
<div id="public_top">
  <div class="public_topnav">
    <div class="topnav_bd">
    <a href="<?php echo BASE_SITE_URL; ?>">
    <?php if(C('seller_logo')){?>
      <img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.C('member_logo'));?>"/>
      <?php }else{?>
      <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/menber_show/m-logo.jpg" />
      <?php }?>
    </a>
     <div class="quick-menu">
<!--        <ul>
          <li><a class="item" title="" href="#">注册</a></li>
          <li><a class="item" title="" href="#">登录</a></li>
          <li class="drop_wrap"> <a class="item2" href="#">本地生活网<i></i></a>
            <ul id="sub-menu">
              <li class="sm1"><a href="">优惠券</a></li>
              <li class="sm1"><a href="">团购</a></li>
              <li class="sm1"><a href="">会员卡</a></li>
              <li class="sm1"><a href="">预约</a></li>
              <li class="sm1"><a href="">社区</a></li>
            </ul>
          </li>
        </ul>-->
 <ul>
        
        <li class="drop_wrap"> <a class="item2" href="#"><?php echo $_SESSION['member_name']; ?><i></i></a>
            <ul id="sub-menu" class="clearfix">
              <li class="sm1"><a href="index.php?act=membershow&mid=<?php echo $_SESSION['member_id']; ?>">我的主页</a></li>
              <li class="sm1"><a href="index.php?act=memberaccount&op=account">个人资料</a></li>
              <li class="sm1"><a href="index.php?act=memberaccount&op=accountinfo">账号信息</a></li>
              <li class="sm1"><a href="index.php?act=memberaccount&op=comment">评论管理</a></li>
              <li class="sm1"><a href="index.php?act=membercoupon&op=list">优惠券管理</a></li>
              <li class="sm1"><a href="index.php?act=login&op=logout">退出登录</a></li>
            </ul>
          </li>
        <li><a class="item" href="<?php echo $GLOBALS['setting_config']['android_app_url'];?>">手机客户端</a></li>
          <li class="drop_wrap"> <a class="item2" href="<?php echo BASE_SITE_URL; ?>">本地生活网<i></i></a>
            <ul id="sub-menu">
              <li class="sm1"><a href="index.php?act=coupon&op=list">优惠券</a></li>
              <li class="sm1"><a href="index.php?act=groupbuy">团购</a></li>
              <li class="sm1"><a href="index.php?act=card">会员卡</a></li>
              <li class="sm1"><a href="index.php?act=appointment">预约</a></li>
              <li class="sm1"><a href="<?php echo BASE_SITE_URL.'/circle/'; ?>" target="_blank">社区</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="public_top_shadow"><span class="b"></span></div>
</div>
