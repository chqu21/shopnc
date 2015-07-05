<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.flexslider-min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js" charset="utf-8"></script>
<style type='text/css'>
.flex-active {
	background-color: #E64D5E;
}
</style>
<script type="text/javascript">
$(window).load(function() {
	$(function() {
    $(".login-target").click(function() {
        var target = $(this).hasClass("login-target-normal") ? true : false;
        $(this).toggleClass("login-target-normal");
        if (target){
            $(".login-dcode").addClass("hide");
            $(".login-nomal").removeClass("hide")
        }else{
            $(".login-dcode").removeClass("hide");
            $(".login-nomal").addClass("hide")
        }
    });
});
	//首页左侧分类菜单
	$(".category ul.menu").find("li").each(
		function() {
			$(this).hover(
				function() {
				    var cat_id = $(this).attr("cat_id");
					var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
					menu.show();
					$(this).addClass("hover");
					if(menu.attr("hover")>0) return;
					menu.masonry({itemSelector: 'dl'});
					var menu_height = menu.height();
					if (menu_height < 60) menu.height(80);
					menu_height = menu.height();
					var li_top = $(this).position().top;
					if ((li_top > 60) && (menu_height >= li_top)) $(menu).css("top",-li_top+50);
					if ((li_top > 150) && (menu_height >= li_top)) $(menu).css("top",-li_top+90);
					if ((li_top > 240) && (li_top > menu_height)) $(menu).css("top",menu_height-li_top+120);
					if (li_top > 300 && (li_top > menu_height)) $(menu).css("top",60-menu_height);
					if ((li_top > 40) && (menu_height <= 120)) $(menu).css("top",-5);
					menu.attr("hover",1);
				},
				function() {
					$(this).removeClass("hover");
				    var cat_id = $(this).attr("cat_id");
					$(this).find("div[cat_menu_id='"+cat_id+"']").hide();
				}
			);
		}
	);
	$('.flexslider').flexslider();
	
	$('#all-category li').each(function(){
		$(this).hover(
			function(){
				var nctype = $(this).attr('nc');
				$(this).addClass('list-hover');
				$("div[nc="+nctype+"]").show();
			},
			function(){
				var nctype = $(this).attr('nc');
				$(this).removeClass('list-hover');
				$("div[nc="+nctype+"]").hide();
			}
		);
	});
	
	$(".cat-menu").each(function(){
		$(this).hover(
			function(){
				$(this).show();
			},
			function(){
				$(this).hide();
			}
		);
	});

	var morli = $(".areaall li:gt(0)");
	$(morli).hide();
	$(".more_area").click(function(){
		$(this).hide();
		$(".close_area").show();
		$(morli).slideToggle("slow",function(){ });
	});
	$(".close_area").click(function(){
		$(this).hide();
		$(".more_area").show();
		$(morli).slideToggle("slow",function(){ });
	});

});
</script>

<div id='content' style='background-color: rgb(237, 237, 237);'>
  <div class="nclife_top">
    <div class="flexslider">
      <ul class="slides">
        <li style="width: 100%; float: left; margin-right: -100%;"><?php echo rec(5);?></li>
        <li style="width: 100%; float: left; margin-right: -100%; display:none;"><?php echo rec(6);?></li>
        <li style="width: 100%; float: left; margin-right: -100%; display:none;"><?php echo rec(7);?></li>
        <li style="width: 100%; float: left; margin-right: -100%; display:none;"><?php echo rec(8);?></li>
      </ul>
    </div>
  </div>
  <div class="section-main">
    <div class="category">
      <ul class="menu">
        <?php if(!empty($output['class_root'])){ ?>
        <?php foreach ($output['class_root'] as $k=>$v){ ?>
        <li class="<?php echo ($k+1)%2==1 ? 'odd':'even';?>" cat_id="<?php echo $v['class_id']; ?>">
          <div class="class"> <span class="ico"><img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/class/<?php echo $v['class_image']; ?>"></span>
            <h4><a href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>"><?php echo $v['class_name']; ?></a></h4>
            <span class="recommend-class">
            <?php if(!empty($output['class_menu'][$v['class_id']])){ ?>
            <?php foreach ($output['class_menu'][$v['class_id']] as $ck=>$cv){ if($ck <= 2){?>
            <a title="<?php echo $cv['class_name']; ?>" href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>&class_id_1=<?php echo $cv['class_id']; ?>"><?php echo $cv['class_name']; ?></a>
            <?php }}} ?>
            </span><span class="arrow"></span> </div>
          <div cat_menu_id="<?php echo $v['class_id']; ?>" class="sub-class">
            <dl>
              <dt>
                <h3><a href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>"><?php echo $v['class_name']; ?></a></h3>
              </dt>
              <dd class="goods-class">
                <?php if(!empty($output['class_menu'][$v['class_id']])){ ?>
                <?php foreach ($output['class_menu'][$v['class_id']] as $ck=>$cv){ ?>
                <a title="<?php echo $cv['class_name']; ?>" href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>&class_id_1=<?php echo $cv['class_id']; ?>"><?php echo $cv['class_name']; ?></a>
                <?php }} ?>
              </dd>
            </dl>
          </div>
        </li>
        <?php }}?>
      </ul>
    </div>
  </div>
</div>
<div class="life_cont">
  <div class="top-coupon">
    <ul class="c-list">
      <?php if(!empty($output['coupon_list'])){ $i=1?>
      <?php foreach ($output['coupon_list'] as $k=>$v){ if($i<=3){ $i++; ?>
      <li> <a hidefocus="" target="_blank" href="index.php?act=coupon&op=detail&coupon_id=<?php echo $v['coupon_id']; ?>" class="item">
        <div class="c-box"> <span class="txt1"><?php echo $v['coupon_name']; ?></span> <span class="txt2"><?php echo $v['store_name']; ?></span> </div>
        <div class="c-img"> <img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/coupon/<?php echo $v['coupon_pic']; ?>" alt="<?php echo $v['coupon_name']; ?>"> </div>
        </a> </li>
      <?php }}} ?>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="nc_sortlist mt10">
    <div class="nc_sortbox clearfix">
      <div class="areabox">
        <h2><?php echo $lang['nc_mall'];?>：</h2>
        <span class="item current"><a href="#"><?php echo $lang['nc_all'];?></a></span>
        <?php if(!empty($output['area_list'])){?>
        <ul class="areaall clearfix">
          <?php foreach($output['area_list'] as $areak=>$areav){?>
          <li>
            <div class="titbox"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $areav['area_id'];?>"><?php echo $areav['area_name'];?></a></div>
            <?php if(!empty($areav[0])){?>
            <div class="txtbox">
              <?php $n = 1;?>
              <?php foreach($areav[0] as $areakk=>$areavv){?>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $areav['area_id'];?>&mall_id=<?php echo $areavv['area_id'];?>"><?php echo $areavv['area_name'];?><!-- <span>(<?php echo $areavv['number'];?>)</span> --></a>
              <?php if($n==count($areav[0]))break;?>
              <em>|</em>
              <?php $n++;?>
              <?php }?>
            </div>
            <?php }?>
          </li>
          <?php }?>
        </ul>
        <?php }?>
        <span class="more_area"><?php echo $lang['nc_more'];?></span> <span class="close_area" style='display:none;'><?php echo $lang['nc_pack_up'];?></span> </div>
    </div>
  </div>
  <div class="category_list mt20">
    <div class="life_box_new">
      <div class="life_header">
        <h2>推荐店铺&nbsp;<span>/&nbsp;<em>New Store</em></span></h2>
        <a class="cat_more" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list"><?php echo $lang['nc_more']?>&gt;&gt;</a> </div>
      <div class="nc_box clearfix">
        <ul class="store_new">
          <?php if(!empty($output['recommend_store'])){ ?>
          <?php foreach ($output['recommend_store'] as $val){ ?>
          <li> <a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><img src="<?php echo ($val['pic']!='' && $val['pic'] != '上传失败')?BASE_SITE_URL.'/data/upload/shop/store/'.$val['pic']:TEMPLATE_SITE_URL.'/images/shopnopic.png'; ?>" /></a>
            <p class="store_tit"><?php echo $val['store_name']; ?></p>
            <div class="store_txt">
              <div class="remark-item star<?php echo $val['store_score']; ?>"></div>
              <span class="fr">人均<strong class="stress"> ¥<?php echo $val['person_consume']; ?> </strong> </span> </div>
          </li>
          <?php }} ?>
        </ul>
      </div>
    </div>
    <div class="life_header mt20">
      <h2>热门分类&nbsp;<span>/&nbsp;<em>Categories</em></span></h2>
      <a class="cat_more" href="index.php?act=index&op=list" target="_blank">更多分类&gt;&gt;</a> </div>
    <div class="category_box">
      <div class="ct_box">
        <?php if(!empty($output['class_root'])){ $i = 1;?>
        <?php foreach ($output['class_root'] as $k=>$v){ if($v['class_recommend']==1 && $i<=6){ ?>
        <div class="ct_box_li"> <span class="ct-ico"><img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/class/<?php echo $v['class_image']; ?>" width="62px" height="62px"></span>
          <div class="ct_r ct0<?php echo $i; ?>">
            <div class="ct_title">
              <h2><?php echo $v['class_name']; ?></h2>
              <a href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>"></a></div>
            <ul>
              <?php if(!empty($output['class_menu'][$v['class_id']])){ ?>
              <?php foreach ($output['class_menu'][$v['class_id']] as $ck=>$cv){ if($cv['class_recommend']==1){ ?>
              <li><a href="index.php?act=index&op=list&class_id=<?php echo $v['class_id']; ?>&class_id_1=<?php echo $cv['class_id']; ?>"><?php echo $cv['class_name']; ?></a></li>
              <li>|</li>
              <?php }}} ?>
            </ul>
          </div>
        </div>
        <?php $i++; }}} ?>
      </div>
    </div>
    <div class="life_box_new mt20">
      <div class="life_header">
        <h2><?php echo $lang['nc_coupon'];?>&nbsp;<span>/&nbsp;<em>Coupons</em></span></h2>
        <a class="cat_more" href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list"><?php echo $lang['nc_more']?>&gt;&gt;</a> </div>
      <div class="coupon_inner clearfix">
        <?php if(!empty($output['coupon_list'])){?>
        <ul>
          <?php foreach($output['coupon_list'] as $ck=>$cv){?>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $cv['coupon_id'];?>" class="box"><img class="left" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.str_replace('.jpg_small','',$cv['coupon_pic']);?>" /><span class="scissors"></span>
            <p class="q_mall"><?php echo $cv['coupon_name'];?></p>
            <div class="q_info">
              <p class="q_time"> <?php echo $lang['nc_end_time'];?> <?php echo date('Y.m.d',$cv['coupon_end_time']);?>
              <p class="q_btn"><?php echo $lang['nc_home_see'];?></p>
            </div>
            </a></li>
          <?php }?>
        </ul>
        <?php }?>
      </div>
    </div>
    <div class="life_box_new mt20">
      <div class="life_header d1">
        <h2><?php echo $lang['nc_index_groupbuy'];?>&nbsp;<span>/&nbsp;<em>Group</em></span></h2>
        <a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy" class="cat_more"><?php echo $lang['nc_index_more'];?>&gt;&gt;</a> </div>
      <div class="group_inner clearfix">
        <?php if(!empty($output['grouplist'])){?>
        <ul class="group-con">
          <?php foreach($output['grouplist'] as $groupbuy){?>
          <li><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $groupbuy['group_id'];?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$groupbuy['group_pic']);?>"></a>
            <h3><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $groupbuy['group_id'];?>"><span class="group-con-tit"><strong><?php echo number_format(($groupbuy['group_price']/$groupbuy['original_price'])*10,1); ?>折</strong>[<?php echo $groupbuy['store_name'];?>]<?php echo $groupbuy['group_name'];?></span></a> </h3>
            <div class="price">
              <div class="pr-f"><em>￥</em><span class="dnum fs1"><?php echo $groupbuy['group_price']; ?></span><span class="snum"><!--<?php echo $lang['nc_index_value'];?>-->￥<?php echo intval($groupbuy['original_price']); ?></span></div>
              <a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $groupbuy['group_id'];?>">
              <div class="btn"></div>
              </a> </div>
            <div class="time">
              <div class="time_box"><span class="icon"></span>
                <p class="process" endtime="<?php echo $groupbuy['end_time'];?>"></p>
              </div>
              <div class="num_box"> <span class="buy_num"><?php echo $groupbuy['buyer_num']; ?></span>人已经购买&nbsp;</div>
            </div>
          </li>
          <?php }?>
        </ul>
        <?php }?>
      </div>
    </div>
    <div class="life_box_new">
      <div class="life_header">
        <h2><?php echo $lang['nc_index_latestcomments'];?>&nbsp;<span>/&nbsp;<em>Comment</em></span></h2>
      </div>
      <div class="nc_box clearfix">
        <div class="comment_list">
          <?php if($output['commentlist']){ ?>
          <ul>
            <?php foreach($output['commentlist'] as $comment){  ?>
            <li><a target="_blank" class="pic fl" href="<?php echo BASE_SITE_URL;?>/index.php?act=membershow&mid=<?php echo $comment['member_id'];?>" target="_blank"> <img src="<?php if(!empty($comment['avatar'])){ echo BASE_SITE_URL.'/data/upload/shop/member/'.$comment['avatar']; }else{ echo UPLOAD_SITE_URL.'/shop/member/member.png';}?>" /></a>
              <div class="comment_con">
                <h2><a href="<?php echo BASE_SITE_URL;?>/index.php?act=membershow&mid=<?php echo $comment['member_id'];?>" target="_blank"><?php echo $comment['member_name'];?></a>@<a href="index.php?act=store&op=detail&id=<?php echo $comment['store_id']; ?>" target="_blank"><?php echo $comment['store_name']; ?></a><!--<span class="time"><?php echo date("Y-m-d",$comment['add_time']);?></span>--> </h2>
                <p class="comment_info"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $comment['store_id'];?>"><?php echo $comment['comment'];?></a></p>
              </div>
            </li>
            <?php }?>
          </ul>
          <?php }?>
        </div>
        <div class="user_tab">
          <div class="user_tab_header">
            <h2><?php echo $lang['nc_index_commentsonastore'];?></h2>
          </div>
          <?php if(!empty($output['memberlist'])){?>
          <?php $membernum = 1;?>
          <?php foreach($output['memberlist'] as $member){?>
          <dl>
            <em class="n1"><?php echo $membernum;?></em>
            <dt><a href="<?php echo BASE_SITE_URL;?>/index.php?act=membershow&mid=<?php echo $member['member_id'];?>" target="_blank"><img class="left" src="<?php if(!empty($member['avatar'])){ echo BASE_SITE_URL.'/data/upload/shop/member/'.$member['avatar']; }else{ echo UPLOAD_SITE_URL.'/shop/member/member.png';}?>"/></a></dt>
            <dd class="ut_nm"><?php echo $member['member_name'];?></dd>
          </dl>
          <?php $membernum++;?>
          <?php }?>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="ad10"><?php echo rec(9);?></div>
    <div id="faq">
      <?php if(is_array($output['article_list']) && !empty($output['article_list'])){ ?>
      <?php foreach ($output['article_list'] as $k=>$article_class){ ?>
      <?php if(!empty($article_class)){ ?>
      <ul class="s<?php echo ''.$k+1;?>">
        <h3>
          <?php if(is_array($article_class['class'])) echo $article_class['class']['ac_name'];?>
        </h3>
        <?php if(is_array($article_class['list']) && !empty($article_class['list'])){ ?>
        <?php foreach ($article_class['list'] as $article){ ?>
        <li><a href="<?php if($article['article_url'] != '')echo $article['article_url'];else echo ncUrl(array('act'=>'article','article_id'=>$article['article_id']) ,'article');?>" title="<?php echo $article['article_title']; ?>"> <?php echo str_cut($article['article_title'],13);?> </a></li>
        <?php }?>
        <?php }?>
      </ul>
      <?php }?>
      <?php }?>
      <?php }?>
      <?php if($GLOBALS['setting_config']['weixin_account'] != '' && $GLOBALS['setting_config']['weixin_qrcode'] != ''){ ?>
      <div class="weixin_code">
        <div class="wxcode-img"> <img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/common/<?php echo $GLOBALS['setting_config']['weixin_qrcode']; ?>" width="130px"> </div>
        <span>微信账号：
      <?php echo $GLOBALS['setting_config']['weixin_account']; ?></span> </div>
      <?php } ?>
      <div class="clear"></div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		var time = parseInt("<?php echo TIMESTAMP;?>");
		$('.process').each(function(){
			var lag = parseInt($(this).attr('endtime')) - time;
			if(lag>0){
			   var second = Math.floor(lag % 60);    
			   var minite = Math.floor((lag / 60) % 60);
			   var hour = Math.floor((lag / 3600) % 24);
			   var day = Math.floor((lag / 3600) / 24);
			   $(this).html('<span>'+day+'</span>'+'<?php echo $lang['nc_day'];?>'+'<span>'+hour+'</span>'+'<?php echo $lang['nc_hour'];?>'+'<span>'+minite+"</span>"+'<?php echo $lang['nc_minute'];?>'+'<span>'+second+'</span>'+'<?php echo $lang['nc_second'];?>');
			}
		});
		function updateEndTime(){
			time++;		
			$(".process").each(function(){
				var lag = parseInt($(this).attr('endTime')) - time;
				if(lag>0){
				    var second = Math.floor(lag % 60);    
				    var minite = Math.floor((lag / 60) % 60);
				    var hour = Math.floor((lag / 3600) % 24);
				    var day = Math.floor((lag / 3600) / 24);
					$(this).html('<span>'+day+'</span>'+'<?php echo $lang['nc_day'];?>'+'<span>'+hour+'</span>'+'<?php echo $lang['nc_hour'];?>'+'<span>'+minite+"</span>"+'<?php echo $lang['nc_minute'];?>'+'<span>'+second+'</span>'+'<?php echo $lang['nc_second'];?>');
				}else{
				}
			});
			setTimeout(updateEndTime,1000);
		}
		setTimeout(updateEndTime,1000);
	});
</script>