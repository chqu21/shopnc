<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $lang['nc_member_'.$output['menu_sign']];?></title>
<link href="<?php echo TEMPLATE_SITE_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<link href="<?php echo TEMPLATE_SITE_URL;?>/css/member_show.css" rel="stylesheet" type="text/css">
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
</head>
<body>
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
        <li class="drop_wrap"> <a class="item2" href="#"><?php echo $_SESSION['member_name']; ?><i></i></a>
            <ul id="sub-menu">
              <li class="sm1"><a href="index.php?act=membershow&mid=<?php echo $_SESSION['member_id']; ?>">我的主页</a></li>
              <li class="sm1"><a href="index.php?act=memberaccount&op=account">个人资料</a></li>
              <li class="sm1"><a href="index.php?act=memberaccount&op=accountinfo">账号信息</a></li>
              <li class="sm1"><a href="index.php?act=memberorder&op=list">订单管理</a></li>
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
<div id="container">
  <div class="layout clearfix">
    <div class="sidebar">
      <div class="side_nav">
        <div class="hd">
        
        <a class="sh_img" target="_blank" href="index.php?act=membershow&mid=<?php echo $_SESSION['member_id']?>" >
          <img class="avatar" alt="<?php echo $lang['nc_member_title_avatar'];?>" src="<?php if(!empty($_SESSION['avatar'])){ echo BASE_SITE_URL.'/data/upload/shop/member/'.$_SESSION['avatar'];}else{ echo SHOP_TEMPLATES_URL.'/images/lsimg/avatar_photo.png';}?>" />
        </a>
        <span class="username"><?php echo $_SESSION['member_name']; ?></span>
        </div>
        <div class="con">
          <ul>
            <li class="<?php if(in_array($output['menu'],array('account','detail','avatar','address','accountinfo'))){ echo 'active';}?>">
              <h2><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=account"><i class="icon01"></i><!--<?php echo $lang['nc_left_my_personal'];?>-->我的账户</a></h2>
              <div class="nav">
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=account" class="<?php if($output['menu']=='account'){ echo 'cur';}?>"><?php echo $lang['nc_left_base_information'];?></a>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=detail" class="<?php if($output['menu']=='detail'){ echo 'cur';}?>"><?php echo $lang['nc_left_detail_information'];?></a>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=avatar" class="<?php if($output['menu']=='avatar'){ echo 'cur';}?>"><?php echo $lang['nc_left_personal_avatar'];?></a>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=address" class="<?php if($output['menu']=='address'){ echo 'cur';}?>"><?php echo $lang['nc_left_shipping_address'];?></a>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=accountinfo" class="<?php if($output['menu']=='accountinfo'){ echo 'cur';}?>"><?php echo $lang['nc_left_account_infomation'];?></a>
              </div>
            </li>
             <li class="<?php if(in_array($output['menu'],array('order','comment','coupon','predeposit','appointment','card','refund'))){ echo 'active';}?>">
              <h2><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberorder&op=list"><i class="icon05"></i>消费管理</a></h2>
             <div class="nav">
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberorder&op=list" class="<?php if($output['menu']=='order'){ echo 'cur';}?>"><?php echo $lang['nc_left_order_manage'];?></a>
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=comment" class="<?php if($output['menu']=='comment'){ echo 'cur';}?>"><?php echo $lang['nc_left_comment_manage'];?></a>
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=membercoupon&op=list" class="<?php if($output['menu']=='coupon'){ echo 'cur';}?>"><?php echo $lang['nc_left_coupon_manage'];?></a>
             
                        
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberappointment&op=list" class="<?php if($output['menu']=='appointment'){ echo 'cur';}?>"><?php echo $lang['nc_member_appointment_manage'];?></a>
         
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=card_list" class="<?php if($output['menu']=='card'){ echo 'cur';}?>">我的会员卡</a>
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberpredeposit&op=list" class="<?php if($output['menu']=='predeposit'){ echo 'cur';}?>"><?php echo $lang['nc_member_predeposit_manage'];?></a>
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberpredeposit&op=log" class="<?php if($output['menu']=='log'){ echo 'cur';}?>">预存款明细</a>
			 <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberorder&op=refund" class="<?php if($output['menu']=='refund'){ echo 'cur';}?>"><i class="icon05"></i>我的退款</a>     
             </div>
             </li>
              <li class="<?php if(in_array($output['menu'],array('favorite','groupbuyremind','giftorder','scorelog'))){ echo 'active';}?>" style="border-bottom:none;">
              <h2><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=fav_list"><i class="icon08"></i>特色功能</a></h2>
             <div class="nav" >
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=fav_list" class="<?php if($output['menu']=='favorite'){ echo 'cur';}?>">我的收藏</a>
        
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=groupbuyremind" class="<?php if($output['menu']=='groupbuyremind'){ echo 'cur';}?>">团购提醒</a>
       
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=giftorder" class="<?php if($output['menu']=='giftorder'){ echo 'cur';}?>">积分兑换</a>
           
             <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=scorelog" class="<?php if($output['menu']=='scorelog'){ echo 'cur';}?>">我的积分</a>
          
          
             </div>
              </li>
    
       
          </ul>
        </div>
      </div>
    </div>
    <div class="main-box">
      <?php require_once($tpl_file);?>
    </div>
  </div>
</div>
<?php require BASE_TPL_PATH.'/layout/footer.php';?>
</body>
</html>
