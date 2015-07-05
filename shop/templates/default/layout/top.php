<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
<meta name="description" content="<?php echo $output['seo_description']; ?>" />
<meta name="author" content="ShopNC">
<meta name="copyright" content="ShopNC Inc. All Rights Reserved">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offline.css">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/header.css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$('#search-box').children('ul').children('li').click(function(){
		$(this).parent().children('li').removeClass("current");
		$(this).addClass("current");
		if($(this).attr("op") == 'search_groupbuy'){
			$("input[name=act]").val('groupbuy');
			$("input[name=op]").val('list');
			$("input[name=keyword]").attr('placeholder','<?php echo $lang['nc_search_groupbuy'];?>');
		}else if($(this).attr("op") == 'search_store'){
			$("input[name=act]").val('index');
			$("input[name=op]").val('list');
			$("input[name=keyword]").attr('placeholder','<?php echo $lang['nc_search_store'];?>');
		}

		$('#search_op').val($(this).attr("op"));
	});

	$('#SubmitFrom').click(function(){
		$('#search_form').submit();
	});
});

function AddFavorite(sURL, sTitle)
{
    try
    {
        window.external.addFavorite(sURL, sTitle);
    }
    catch (e)
    {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        }
        catch (e)
        {
            alert('<?php echo $lang['nc_add_favorite_exception'];?>');
        }
    }
}

var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
</head>
<body>
<div id='topNav' style="z-index:999;position:relative;">
  <div id='topNav-inner'>
    <ul class="topNav-left">
      <li class="topnav-phone"><a href="<?php echo $GLOBALS['setting_config']['android_app_url'];?>"><?php echo $lang['nc_phone_client'];?></a><em>|</em></li>
      <li class="topnav-add"><a href="index.php?act=memberaccount&op=fav_list" >我的收藏</a><em>|</em></li>
      <?php if($GLOBALS['setting_config']['qrcode_app_url'] != ''){ ?>
      <li class="dcode-box">
      <div class="code-img"></div>
        <div class="login-dcode">
          <h2>扫码下载</h2>
          <div class="lifecode-img"> <img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/common/<?php echo $GLOBALS['setting_config']['qrcode_app_url']; ?>" width="153px" /> </div>
          <span>（扫码下载本地生活手机版）</span> </div>
      </li>
      <?php } ?>
      <li class="seller-login"><?php if($_SESSION['seller_login'] == 1){ ?><a href="index.php?act=storesetting&op=dashboard">进入商户中心</a><?php }else{ ?><a href="index.php?act=slogin">商户登录</a><?php } ?></li>
    </ul>
    <ul class="topNav-right">
      <?php if($_SESSION['is_login']==1){?>
      <!-- 登陆成功 -->
      <li class="user_info"><img src="<?php if(!empty($_SESSION['avatar'])){ echo UPLOAD_SITE_URL.'/shop/member/'.$_SESSION['avatar'];}else{ echo UPLOAD_SITE_URL.'/shop/member/member.png';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount"><?php echo $_SESSION['member_name']?></a></li>
      <li id="mainnav_user"> <em class="tools"></em>
        <ul>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=membershow&mid=<?php echo $_SESSION['member_id']; ?>">我的主页</a></li>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount"><?php echo $lang['nc_member_center'];?></a></li>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberorder&op=list">订单管理</a></li>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=membercoupon&op=list">优惠券管理</a></li>
          <li>
            <div class="links"><a href="<?php echo $GLOBALS['setting_config']['android_app_url'];?>"><?php echo $lang['nc_phone_client'];?></a></div>
          </li>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=login&op=logout">退出登录</a></li>
        </ul>
      </li>
      <?php }else{?>
      <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=login" class="login_btn"><?php echo $lang['nc_login'];?></a></li>
      <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=login&op=register" class="register_btn"><?php echo $lang['nc_register'];?></a></li>
      <?php }?>
    </ul>
  </div>
</div>
<!-- 导航 -->
<?php if(!isset($output['banner']) || $output['banner']!=1){?>
<div id="header">
  <div id="header-bottom">
    <div id="header-bottom-con">
      <div id="logo"> <a href="<?php echo BASE_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL;?>/shop/common/<?php echo $GLOBALS['setting_config']['site_logo'];?>"></a>
        <?php if($_GET['act']!='city'){?>
        <div class="nc—city-info">
          <h2>@<?php echo $output['city'];?></h2>
          <a class="ncchange-city" href="<?php echo BASE_SITE_URL;?>/index.php?act=city&op=city">[<?php echo $lang['nc_change_city'];?>]</a> </div>
        <?php }?>
      </div>
      <div id="search-box">
        <ul class="tab f13">
          <li op="search_store" class="<?php if($_GET['act'] == 'index'){ echo 'current';}?>"><?php echo $lang['nc_location_store'];?></li>
          <li>|</li>
          <li op="search_groupbuy" class="<?php if($_GET['act'] == 'groupbuy'){ echo 'current';}?>"><?php echo $lang['nc_location_groupbuy'];?></li>
        </ul>
        <div class="search-box-from">
          <form id="search_form" target="_top" method="get" action="<?php echo BASE_SITE_URL;?>/index.php">
            <input type="hidden" name="act" value='index'>
            <input type="hidden" name="op" value='list'>
            <div style="position: relative;display:inline-block;zoom:1;" class="placeholder">
              <input type='text' name='keyword' class='nc-search-input J_KeyWord gray' id='keyword' value='' placeholder='<?php echo $lang['nc_search_groupbuy'];?>'>
            </div>
            <a href="javascript:void(0);" id="SubmitFrom"></a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>
<div id='main-nav'>
  <div id='main-nav-wrap'>
    <ul>
      <li><span class="split-line"><a href="<?php echo BASE_SITE_URL;?>" class="<?php if((string)$output['index_sign']=='index'){ echo 'current';}?>"><?php echo $lang['nc_first'];?></a></span></li>
      <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
      <?php foreach($output['nav_list'] as $nav){?>
      <?php if($nav['nav_location'] == '0'){?>
      <li><span class="split-line"> <a <?php if((string)$output['index_sign'] == $nav['nav_byname']){echo 'class="current"';}else{echo 'class=""';} ?><?php if($nav['nav_new_open']){?>target="_blank" <?php }?> href="<?php switch($nav['nav_type']){
    	   case '0':echo $nav['nav_url'];break;
    	   case '1':echo ncUrl(array('act'=>'search','nav_id'=>$nav['nav_id'],'cate_id'=>$nav['item_id']));break;
    	   case '2':echo ncUrl(array('act'=>'article','nav_id'=>$nav['nav_id'],'ac_id'=>$nav['item_id']));break;
    	   case '3':echo ncUrl(array('act'=>'activity','activity_id'=>$nav['item_id'],'nav_id'=>$nav['nav_id']), 'activity');break;
      }?>"><?php echo $nav['nav_title'];?></span></a></li>
      <?php }?>
      <?php }?>
      <?php }?>
    </ul>
  </div>
</div>
