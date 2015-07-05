<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/skin_0.css" rel="stylesheet" type="text/css" id="cssfile"/>
<script type="text/javascript" SRC="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.cookie.js"></script>
<script type="text/javascript">
	var SiteUrl = '<?php echo BASE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.tslogin.js"></script>
<script>
//
$(document).ready(function () {
    $('span.bar-btn').click(function () {
	$('ul.bar-list').toggle('fast');
    });
});

$(document).ready(function(){
	var pagestyle = function() {
		var iframe = $("#workspace");
		var h = $(window).height() - iframe.offset().top;
		var w = $(window).width() - iframe.offset().left;
		if(h < 300) h = 300;
		if(w < 973) w = 973;
		iframe.height(h);
		iframe.width(w);
	}
	pagestyle();
	$(window).resize(pagestyle);
	//turn location
	if($.cookie('now_location_act') != null){
		openItem($.cookie('now_location_op')+','+$.cookie('now_location_act')+','+$.cookie('now_location_nav'));
	}else{
		$('#mainMenu>ul').first().css('display','block');
		//第一次进入后台时，默认定到欢迎界面
		$('#item_base_information').addClass('selected');			
		$('#workspace').attr('src','index.php?act=setting&op=aboutus');
	}
	$('#iframe_refresh').click(function(){
		var fr = document.frames ? document.frames("workspace") : document.getElementById("workspace").contentWindow;;
		fr.location.reload();
	});

});


function openItem(args){
	//cookie
	
	if($.cookie('<?php echo COOKIE_PRE?>sys_key') === null){
		location.href = 'index.php?act=login&op=login';
		return false;
	}

	spl = args.split(',');
	op  = spl[0];
	try {
		act = spl[1];
		nav = spl[2];
	}
	catch(ex){}
	if (typeof(act)=='undefined'){var nav = args;}
	$('.actived').removeClass('actived');
	$('#nav_'+nav).parent('li').addClass('actived');

	$('.selected').removeClass('selected');	

	//show
	$('#mainMenu ul').css('display','none');
	$('#sort_'+nav).css('display','block');	

	if (typeof(act)=='undefined'){
		//顶部菜单事件
		var html = $('#sort_'+nav+'>li').first().html();
		
		str = html.match(/openItem\('(.*)'\)/ig);
		arg = str[0].split("'");
		spl = arg[1].split(',');
		op  = spl[0];
		act = spl[1];
		nav = spl[2];
		first_obj = $('#sort_'+nav+'>li').first().children('a');
		$(first_obj).addClass('selected');		
		//crumbs
		$('#crumbs').html('<span>'+$('#nav_'+nav+' > span').html()+'</span><span class="arrow">&nbsp;</span><span>'+$(first_obj).text()+'</span>');		
	}else{
		//左侧菜单事件
		//location
		$.cookie('now_location_nav',nav);
		$.cookie('now_location_act',act);
		$.cookie('now_location_op',op);
//		$("#item_"+op).addClass('selected');//使用name，不使用ID，因为ID有重复的
        
		$("a[name='item_"+op+act+"']").addClass('selected');
		//crumbs
		$('#crumbs').html('<span>'+$('#nav_'+nav+' > span').html()+'</span><span class="arrow">&nbsp;</span><span>'+$('#item_'+op).html()+'</span>');
	}
	
	src = 'index.php?act='+act+'&op='+op;
	$('#workspace').attr('src',src);

}

$(function(){
		bindAdminMenu();
		})
		function bindAdminMenu(){
	
		$("[nc_type='parentli']").click(function(){
			var key = $(this).attr('dataparam');
			if($(this).find("dd").css("display")=="none"){
				$("[nc_type='"+key+"']").slideDown("fast");
				$(this).find('dt').css("background-position","-322px -170px");
				$(this).find("dd").show();
			}else{
				$("[nc_type='"+key+"']").slideUp("fast");
				$(this).find('dt').css("background-position","-483px -170px");
				$(this).find("dd").hide();
			}
		});
	}
</script>
<script type="text/javascript"> 
//显示灰色JS遮罩层 
function showBg(ct,content){ 
var bH=$("body").height(); 
var bW=$("body").width(); 
var objWH=getObjWh(ct); 
$("#pagemask").css({width:bW,height:bH,display:"none"}); 
var tbT=objWH.split("|")[0]+"px"; 
var tbL=objWH.split("|")[1]+"px"; 
$("#"+ct).css({top:tbT,left:tbL,display:"block"}); 
$(window).scroll(function(){resetBg()}); 
$(window).resize(function(){resetBg()}); 
} 
function getObjWh(obj){ 
var st=document.documentElement.scrollTop;//滚动条距顶部的距离 
var sl=document.documentElement.scrollLeft;//滚动条距左边的距离 
var ch=document.documentElement.clientHeight;//屏幕的高度 
var cw=document.documentElement.clientWidth;//屏幕的宽度 
var objH=$("#"+obj).height();//浮动对象的高度 
var objW=$("#"+obj).width();//浮动对象的宽度 
var objT=Number(st)+(Number(ch)-Number(objH))/2; 
var objL=Number(sl)+(Number(cw)-Number(objW))/2; 
return objT+"|"+objL; 
} 
function resetBg(){ 
var fullbg=$("#pagemask").css("display"); 
if(fullbg=="block"){ 
var bH2=$("body").height(); 
var bW2=$("body").width(); 
$("#pagemask").css({width:bW2,height:bH2}); 
var objV=getObjWh("dialog"); 
var tbT=objV.split("|")[0]+"px"; 
var tbL=objV.split("|")[1]+"px"; 
$("#dialog").css({top:tbT,left:tbL}); 
} 
} 

//关闭灰色JS遮罩层和操作窗口 
function closeBg(){ 
$("#pagemask").css("display","none"); 
$("#dialog").css("display","none"); 
} 
</script>
<script type="text/javascript"> 
$(function(){   
    var $li =$("#skin li");   
		$li.click(function(){   
		$("#"+this.id).addClass("selected").siblings().removeClass("selected");
		$("#cssfile").attr("href","<?php echo ADMIN_TEMPLATES_URL;?>/css/"+ (this.id) +".css");   
        $.cookie( "MyCssSkin" ,  this.id , { path: '/', expires: 10 });  

        $('iframe').contents().find('#cssfile2').attr("href","<?php echo ADMIN_TEMPLATES_URL;?>/css/"+ (this.id) +".css"); 
    });   

    var cookie_skin = $.cookie( "MyCssSkin");   
    if (cookie_skin) {   
		$("#"+cookie_skin).addClass("selected").siblings().removeClass("selected");
		$("#cssfile").attr("href","<?php echo ADMIN_TEMPLATES_URL;?>/css/"+ cookie_skin +".css"); 
		$.cookie( "MyCssSkin" ,  cookie_skin  , { path: '/', expires: 10 }); 
    }   
});
</script>
</head>

<body style="margin: 0px;" scroll="no">
<table style="width: 100%;" id="frametable" height="100%" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2" height="90" class="mainhd"><div class="layout-header"> <!-- Title/Logo - can use text instead of image -->
          <div id="title"><a href="index.php"></a></div>
          <!-- Top navigation -->
          <div id="topnav" class="top-nav">
            <ul>
              <li class="adminid" title="<?php echo $lang['nc_hello'];?>:<?php echo $output['admin_info']['name'];?>"><?php echo $lang['nc_hello'];?>&nbsp;:&nbsp;<strong><?php echo $output['admin_info']['name'];?></strong></li>
              <li><a href="index.php?act=index&op=logout" title="<?php echo $lang['nc_logout'];?>"><span><?php echo $lang['nc_logout'];?></span></a></li>
              <li><a href="<?php echo BASE_SITE_URL;?>" target="_blank" title="<?php echo $lang['nc_homepage'];?>"><span><?php echo $lang['nc_homepage'];?></span></a></li>
            </ul>
          </div>
          <!-- End of Top navigation --> 
          <!-- Main navigation -->
          <nav id="nav" class="main_nav">
            <ul>
              <li class='actived' onclick="javascript:openItem('setting');"><i class="i01"></i><a href="javascript:void(0);" id='nav_setting' onclick="javascript:openItem('setting');"><?php echo $lang['index_layout_setting'];?></a></li>
              <li onclick="javascript:openItem('store');"><i class="i05" ></i><a href="javascript:void(0);" id='nav_store' onclick="javascript:openItem('store');"><span><?php echo $lang['index_layout_seller_manage'];?></span></a></li>
              <li onclick="javascript:openItem('goods');"><i class="i02" ></i><a href="javascript:void(0);" id='nav_goods' onclick="javascript:openItem('goods');"><span><?php echo $lang['index_layout_goods_manage'];?></span></a> </li>
              <li onclick="javascript:openItem('member');"><i class="i03" ></i><a href="javascript:void(0);" id='nav_member' onclick="javascript:openItem('member');"><span><?php echo $lang['index_layout_member_manage'];?></span></a> </li>
              <li onclick="javascript:openItem('groupbuy');"><i class="i08"></i><a href="javascript:void(0);" id='nav_groupbuy' onclick="javascript:openItem('groupbuy');"><span><?php echo $lang['index_layout_groupbuy_manage'];?></span></a> </li>
              <li onclick="javascript:openItem('coupon');"><i class="i07"></i><a href="javascript:void(0);" id='nav_coupon' onclick="javascript:openItem('coupon');"><span><?php echo $lang['index_layout_discount_manage'];?></span></a> </li>
              <li onclick="javascript:openItem('website')"><i class="i10"></i><a href="javascript:void(0);" id='nav_website' onclick="javascript:openItem('website')"><?php echo $lang['index_layout_website_running'];?></a></li>
              <li onclick="javascript:openItem('circle')"><i class="i09"></i><a href="javascript:void(0);" id='nav_circle' onclick="javascript:openItem('circle')"><?php echo $lang['index_layout_circle'];?></a></li>
            </ul>
          </nav>
        </div></td>
    </tr>
    <tr>
      <td class="menutd" valign="top" width="161"><div id="mainMenu" class="main-menu">
          <ul id='sort_setting' style="display:block;">
            <li><a href="javascript:void(0);" class="selected" id="item_base_informationsetting" name='item_base_informationsetting' onclick="javascript:openItem('base_information,setting,setting')"><?php echo $lang['index_layout_site_setting'];?></a></li>
            <li><a href="javascript:void(0);"  id="item_seo_informationsetting" name='item_seo_informationsetting' onclick="javascript:openItem('seo_information,setting,setting')"><?php echo $lang['index_layout_SEO_setting'];?></a></li>
            <!--  
			  <li><a href="javascript:void(0);"  id="item_short_message" name='item_short_message' onclick="javascript:openItem('short_message,setting,setting')">短信设置</a></li>
			  -->
            <li><a href="javascript:void(0);"  id="item_email_informationsetting" name='item_email_informationsetting' onclick="javascript:openItem('email_information,setting,setting')"><?php echo $lang['index_layout_Email_setting'];?></a></li>
            <li><a href="javascript:void(0);"  id="item_admin_listadmin" name='item_admin_listadmin' onclick="javascript:openItem('admin_list,admin,setting')"><?php echo $lang['index_layout_admin_manage'];?></a></li>
            <li><a href="javascript:void(0);"  id="item_paymentpayment" name='item_paymentpayment' onclick="javascript:openItem('payment,payment,setting')"><?php echo $lang['index_layout_paymenttype'];?></a></li>
            <li><a href="javascript:void(0);"  id="item_cache_clearcache" name='item_cache_clearcache' onclick="javascript:openItem('cache_clear,cache,setting')">清理缓存</a></li>
            <li><a href="javascript:void(0);"  id="item_aboutussetting" name='item_aboutussetting' onclick="javascript:openItem('aboutus,setting,setting')"><?php echo $lang['index_layout_about us'];?></a></li>
            <!--  
              <li><a href="javascript:void(0);"  id="item_loginsetting" name='item_loginsetting' onclick="javascript:openItem('qqlogin,setting,setting')">登陆方式</a></li>
              -->
          </ul>
          <ul id='sort_store' style="display:none;">
            <li><a href="javascript:void(0);" class="selected" id="item_storeliststore" name='item_storeliststore' onclick="javascript:openItem('storelist,store,store')"><?php echo $lang['index_layout_seller_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_storeclassstore" name='item_storeclassstore' onclick="javascript:openItem('storeclass,store,store')"><?php echo $lang['index_layout_seller_class'];?></a></li>
            <!--  
			  <li><a href="javascript:void(0);" id="item_appointlist" name='item_appointlist' onclick="javascript:openItem('appointlist,appoint,store')">预约管理</a></li>
			  -->
            <li><a href="javascript:void(0);" id="item_commentlistcomment" name='item_commentlistcomment' onclick="javascript:openItem('commentlist,comment,store')"><?php echo $lang['index_layout_comment_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_arealistarea" name='item_arealistarea' onclick="javascript:openItem('arealist,area,store')"><?php echo $lang['index_layout_area_manage'];?></a></li>
            <!--<li><a href="javascript:void(0);" id="item_brandlistbrand" name='item_brandlistbrand' onclick="javascript:openItem('brandlist,brand,store')"><?php echo $lang['index_layout_brand_manage'];?></a></li>-->
          </ul>
          <ul id='sort_goods' style="display:none;">
            <li><a href="javascript:void(0);" id="item_goodsgoods" name="item_goodsgoods" onclick="javascript:openItem('goods,goods,goods');" class="selected"><?php echo $lang['index_layout_goods_manage'];?></a></li>
          </ul>
          <ul id='sort_member' style="display:none;">
            <li><a href="javascript:void(0);" onclick="javascript:openItem('member,member,member')" class="selected" id="item_membermember" name="item_membermember"><?php echo $lang['index_layout_member_manage'];?></a></li>
            <li><a href="javascript:void(0);" onclick="javascript:openItem('list,predeposit,member')" id="item_listpredeposit" name="item_listpredeposit">预存款</a></li>
          </ul>
          <ul id='sort_groupbuy' style="display:none;">
            <li><a href="javascript:void(0);" class="selected" id="item_groupbuygroupbuy" name="item_groupbuygroupbuy" onclick="javascript:openItem('groupbuy,groupbuy,groupbuy');"><?php echo $lang['index_layout_groupbuy_manage'];?></a></li>
            <li><a href="javascript:void(0);" id='item_groupbuyordergroupbuy' name='item_groupbuyordergroupbuy' onclick="javascript:openItem('groupbuyorder,groupbuy,groupbuy');"><?php echo $lang['index_layout_goupbuy_order'];?></a></li>
            <li><a href="javascript:void(0);" id='item_groupbuyrefundgroupbuy' name='item_groupbuyrefundgroupbuy' onclick="javascript:openItem('groupbuyrefund,groupbuy,groupbuy');">退款管理</a></li>
          </ul>
          <ul id='sort_coupon' style="display:none;">
            <li><a href="javascript:void(0);" class="selected" id="item_couponcoupon" name="item_couponcoupon" onclick="javascript:openItem('coupon,coupon,coupon');"><?php echo $lang['index_layout_coupon_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_coupon_downloadcoupon" name="item_coupon_downloadcoupon" onclick="javascript:openItem('coupon_download,coupon,coupon');"><?php echo $lang['index_layout_coupon_download'];?></a></li>
          </ul>
          <ul id='sort_website' style="display:none;">
            <li><a href="javascript:void(0);" class="selected" id="item_activityactivity" name="item_activityactivity" onclick="javascript:openItem('activity,activity,website');"><?php echo $lang['index_layout_activity_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_adv_positionadv" name="item_adv_positionadv" onclick="javascript:openItem('adv_position,adv,website');"><?php echo $lang['index_layout_ad_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_article_class" name="item_article_classarticle_class" onclick="javascript:openItem('article_class,article_class,website');"><?php echo $lang['index_layout_article_class'];?></a></li>
            <li><a href="javascript:void(0);" id="item_document" name="item_documentdocument" onclick="javascript:openItem('document,document,website');"><?php echo $lang['index_layout_system_article'];?></a></li>
            <li><a href="javascript:void(0);" id="item_article" name="item_articlearticle" onclick="javascript:openItem('article,article,website');"><?php echo $lang['index_layout_article_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_navigation" name="item_navigationnavigation" onclick="javascript:openItem('navigation,navigation,website');"><?php echo $lang['index_layout_page_index'];?></a></li>
            <li><a href="javascript:void(0);" id="item_settle_manage" name="item_settle_managesettle" onclick="javascript:openItem('settle_manage,settle,website');">结算管理</a></li>
            <li><a href="javascript:void(0);" id="item_gift_manage" name="item_gift_managegift" onclick="javascript:openItem('gift_manage,gift,website');">积分商城</a></li>
          </ul>
          <ul id='sort_circle' style="display:none;">
            <li><a href="javascript:void(0);" class="selected" id="item_indexcircle_setting" name="item_indexcircle_setting" onclick="javascript:openItem('index,circle_setting,circle');"><?php echo $lang['index_layout_circle_setting'];?></a></li>
            <li><a href="javascript:void(0);" id="item_indexcircle_memberlevel" name="item_indexcircle_memberlevel" onclick="javascript:openItem('index,circle_memberlevel,circle');"><?php echo $lang['index_layout_membertitle_setting'];?></a></li>
            <li><a href="javascript:void(0);" id="item_class_listcircle_class" name="item_class_listcircle_class" onclick="javascript:openItem('class_list,circle_class,circle');"><?php echo $lang['index_layout_circle_class_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_circle_listcircle_manage" name="item_circle_listcircle_manage" onclick="javascript:openItem('circle_list,circle_manage,circle');"><?php echo $lang['index_layout_circle_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_theme_listcircle_theme" name="item_theme_listcircle_theme" onclick="javascript:openItem('theme_list,circle_theme,circle');"><?php echo $lang['index_layout_circle_coversation_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_member_listcircle_member" name="item_member_listcircle_member" onclick="javascript:openItem('member_list,circle_member,circle');"><?php echo $lang['index_layout_circle_member_manage'];?></a></li>
            <li><a href="javascript:void(0);" id="item_inform_listcircle_inform" name="item_inform_listcircle_inform" onclick="javascript:openItem('inform_list,circle_inform,circle');">圈子举报管理</a></li>
            <li><a href="javascript:void(0);" id="item_adv_managecircle_setting" name="item_adv_managecircle_setting" onclick="javascript:openItem('adv_manage,circle_setting,circle');"><?php echo $lang['index_layout_circle_firstpage_ad'];?></a></li>
            <li><a href="javascript:void(0);" id="item_indexcircle_cache" name="item_indexcircle_cache" onclick="javascript:openItem('index,circle_cache,circle');"><?php echo $lang['index_layout_update_circle_cache'];?></a></li>
          </ul>
        </div>
        
        <!--
        <div class="copyright">
          <p>Powered By <em><a href="http://www.shopnc.net" target="_blank"><font class="blue">Shop</font><font class="orange">NC</font></a></em></p>
          <p>&copy;2007-2013 <a href="http://www.shopnc.net/" target="_blank">ShopNC Inc.</a></p>
        </div>--></td>
      <td valign="top" width="100%"><iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="100%" scrolling="yes" onload="window.parent"></iframe></td>
    </tr>
  </tbody>
</table>
</body>
</html>
