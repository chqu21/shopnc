<script>
$(function() {
    $("#toggle").click(function() {
        $(this).text($("#content").is(":hidden") ? "收起" : "展开");
        $("#content").slideToggle();
    });
});
function add_fav(fav_id,fav_type){
	$.getJSON('index.php?act=store&op=ajax_collect&fav_type='+fav_type+'&fav_id='+fav_id, function(result){
        if(result.done){
            $('#store_fav_num').html('('+result.num+')');
        	alert('收藏成功！');
        }else{
            alert(result.msg);
        }
    });
}
function give_flower(comment_id){
	$.getJSON('index.php?act=store&op=ajax_give_flower&comment_id='+comment_id, function(result){
        if(result.done){
            $('#f_num_'+comment_id).html(result.num);
        	alert('鲜花赠送成功！');
        }else{
            alert(result.msg);
        }
    });
}
function show_pic(e,sign){
	var x = e.clientX;
	var y = e.clientY;
	$('#bp_'+sign).css({"visibility":"visible","top":y,"left":x});
}
function hide_pic(sign){
	$('#bp_'+sign).css("visibility","hidden");
}

$(function (){
      $(".more_area").click(function (){
          $(this).toggleClass("close_area");
          if($(this).hasClass("close_area")){
            $(this).text('收起');
          }else{
            $(this).text('更多');
          }
          $(".shop_pic_list").toggleClass("expend");
      });
  });

</script>
<style type="text/css">
.thumbnail{
position: relative;
z-index: 0;
}
.thumbnail:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail span{
position: fixed; background:#FFF;
padding:10px;
left: 1000px; top:-500px;
border:1px solid #DBDBDB;
visibility: hidden;

text-decoration: none; width:500px;
}
.thumbnail span img{ float:left;
border-width: 0;
width:500px;
}
.thumbnail span b{line-height:25px;color:#666666; font-weight:normal;float:left; margin-top:5px;}
</style>
<div id="content" >
  <div class="ls_layout">
    <div class="sitenav">
      <h2>当前位置：</h2>
      
      <a href="index.php?act=index">首页</a>&nbsp;»&nbsp;<a href="index.php?act=index&op=list&class_id=<?php echo $output['storeinfo']['class_id']; ?>"><?php echo $output['class_name']; ?></a>&nbsp;»&nbsp;<a href="index.php?act=index&op=list&class_id=<?php echo $output['storeinfo']['class_id']; ?>&class_id_1=<?php echo $output['storeinfo']['s_class_id']; ?>"><?php echo $output['sub_class_name']; ?></a>&nbsp;»&nbsp;<?php echo $output['storeinfo']['store_name']; ?></div>
    <div class="store_info">
      <div class="store_info_con">
        <div class="store-tit">
          <div class="store_name">
            <h1 class="store_title"><?php echo $output['storeinfo']['store_name']; ?></h1>
          </div>
          <div class="remark_box"> <span class="remark-item star<?php echo $output['final_score']; ?>"></span>
            <div class="remark_taste"> <a class="col-num" href="#">(<em><?php echo $output['comment_num']; ?></em>)</a> <em class="sep">|</em><span>人均<strong class="stress"> ¥<?php echo intval($output['storeinfo']['person_consume']); ?> </strong></span></div>
          </div>
        </div>
        <div class="store-txt">
          <div class="store_info_pic"><img src="<?php echo ($output['storeinfo']['pic']!='' && $output['storeinfo']['pic'] != '上传失败')?BASE_SITE_URL.'/data/upload/shop/store/'.$output['storeinfo']['pic']:TEMPLATE_SITE_URL.'/images/shopnopic.png'; ?>" /></div>
          <div class="store_info_txt">
            <div class="store_location">
              <ul>
                <li><em>地址：</em><span><?php echo $output['area_name'].$output['storeinfo']['address']; ?></span></li>
                <li><em>电话：</em><span class="call"><?php echo $output['storeinfo']['telephone']; ?></span></li>
                <li><em>靠近：</em><span class="call"><?php echo $output['storeinfo']['side']; ?></span></li>
                <li><em>营业时间：</em><span class="call"><?php echo $output['storeinfo']['business_hour']; ?></span></li>
              </ul>
            </div>
            <div class="shop_desc_list">
              <ul>
                <li> <em class="tit02">标签：</em>
                <?php if(!empty($output['label_list'])){ ?>
                <?php foreach ($output['label_list'] as $k=>$v){ if($k<=5){?>
                <span class="shop_tag"><a href="javascript:void(0);"><?php echo $v['label_name']; ?></a><em class="col_em">(<?php echo $v['label_num']; ?>)</em></span>
                <?php }}} ?>
                </li>
              </ul>
            </div>
            <!--<div class="book-select">
              <div class="book-d"> <span class="book-date">2014-01-17 星期五</span>
                <div class="book-date-warp"></div>
              </div>
              <div class="book-s"> <a class="book-slet" href="#"><span>18:00</span></a> </div>
              <div class="book-s"> <a class="book-slet" href="#"><span>4人</span></a> </div>
              <div class="apt-btn" style="float:left; margin:0 20px 0 0;"> <a href="#" title="" target="_blank" class="apt-btn-txt">我要订座</a></div>
            </div>-->

			<!-- JiaThis Button BEGIN -->
			<!--
			<div class="jiathis_style">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_renren"></a>
				<a class="jiathis_button_xiaoyou"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
			</div>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>-->
			<!-- JiaThis Button END -->

            <div class="store-action">
              <div class="apt-btn" style="float:left; margin:0 20px 0 0;"> <a href="#share" title="" class="apt-btn-txt">写点评</a></div>
              <?php if($output['storeinfo']['is_appointment'] == 2){ ?>
              <a href="javascript:void(0);" title="" id="make_appointment">我要订座</a><em class="sep">|</em>
              <?php } ?>
              <a href="index.php?act=store&op=activity&id=<?php echo $output['storeinfo']['store_id']; ?>" >商铺活动</a><em class="sep">|</em>
              <a href="javascript:add_fav(<?php echo $output['storeinfo']['store_id']; ?>,'store');"><span class="nc-collect"></span>收藏</a> <em class="sep_l" id="store_fav_num">(<?php echo $output['fav_num']; ?>)</em><em class="sep_l">|</em> <span><a href="index.php?act=store&op=groupbuyremind&id=<?php echo $output['storeinfo']['store_id'];?>"><em class="tuan-warn"></em>开团提醒</a></span><!--  <em class="sep_l">|</em> <span><a href="#"><em class="separator"></em>微信分享</a></span> <em class="sep_l">|</em> <a href="#">发送到手机</a>--> </div>
              <?php if($output['storeinfo']['qr_code'] != ''){ ?>
              <div class="qr_box">
              <div class="qr_icon"></div>
              <div class="qr_bg">
			  <?php if(!empty($output['storeinfo']['qr_code']) && $output['storeinfo']['is_qr_saft']==2){?>
			  <img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/qr_code/<?php echo $output['storeinfo']['qr_code']; ?>" width="153px" height="153px" />              
			  <span>（扫码关注本店微信公共号）</span>
			  <?php }?>
              </div>
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="store_box">
      <div class="store_box_l">
        <div class="store-group-list">
          <ul>
          <?php if(!empty($output['groupbuy_list'])){ ?>
          <?php foreach ($output['groupbuy_list'] as $val){ ?>
            <li><a class="sg" target="_blank" href="index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id']; ?>"><i class="igcon"></i><strong class="price">￥<?php echo intval($val['group_price']); ?></strong>价值<?php echo intval($val['original_price']); ?>元！ <?php echo mb_substr($val['group_name'],0,34,'utf-8'); ?><span class="col-num"><?php echo $val['buyer_num']; ?>人已购买 &nbsp;</span></a></li>
          <?php }} ?>
          <?php if(!empty($output['coupon_list'])){ ?>
          <?php foreach ($output['coupon_list'] as $val){ ?>
            <li><a class="sg" target="_blank" href="index.php?act=coupon&op=detail&coupon_id=<?php echo $val['coupon_id']; ?>"><i class="iqcon"></i><?php echo mb_substr($val['coupon_name'],0,34,'utf-8'); ?><span class="col-num"><?php echo $val['download_count']; ?>人已下载 &nbsp;</span></a></li>
          <?php }} ?>
          </ul>
        </div>
        <div class="shop_intro_list mt20">
          <div class="shop_intro_hd">
            <h3 class="mr20"> <strong>店铺</strong>介绍</h3>
          </div>
          <div class="shop_info02 font6"><?php echo $output['storeinfo']['description']; ?></div>
        </div>
        <div class="shop_tabs">
          <div class="shop_tabs_hd">
            <ul>
              <li class="selected"><a href="javascript:void(0);">商品图片</a></li>
            </ul>
            <span class="more_area"><?php echo $lang['nc_more'];?></span> <span class="close_area" style='display:none;'><?php echo $lang['nc_pack_up'];?>收起</span> </div>
          <div class="shop_pic_list areaall">
          	<?php if(!empty($output['goods_list'])){ ?>
          	<?php foreach ($output['goods_list'] as $k=>$val){ ?>
            <div class="shop_pic_box <?php if($k>=4){ ?>toggleItme<?php } ?>"><a href="javascript:void(0);" class="thumbnail" onmouseover="show_pic(event,'<?php echo 'goods_'.$k; ?>')" onmouseout="hide_pic('<?php echo 'goods_'.$k; ?>')"><img class="goods_small_pic" src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/goods/<?php echo $val['goods_pic']; ?>"><span id="bp_<?php echo 'goods_'.$k; ?>"><img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/goods/<?php echo $val['goods_pic']; ?>" border="0"><b>商品价格：<strong style="color:#CC0000;font-size:18px"><?php echo intval($val['goods_price']); ?></strong>元<br>商品简介：<?php echo $val['goods_content']!=''?$val['goods_content']:'无'; ?></b></span></a>
              <p class="shop_pic_tit"><?php echo $val['goods_name']; ?></p>
            </div>
            <?php }} ?>
          </div>
        </div>
        <div class="layout_l">
          <div class="shop_tabs_hd mb10">
            <ul>
              <li class="selected"><a href="javascript:void(0);" name="comment_anchor">网友点评</a></li>
            </ul>
            <select name="c_sort" style="float:right;margin:10px" id="c_sort">
            	<option value="comment_time" <?php if(trim($_GET['c_sort'])=='comment_time'){ ?>selected<?php } ?>>点评时间</option>
            	<option value="member_degree" <?php if(trim($_GET['c_sort'])=='member_degree'){ ?>selected<?php } ?>>会员等级</option>
            	<option value="flower_num" <?php if(trim($_GET['c_sort'])=='flower_num'){ ?>selected<?php } ?>>鲜花数量</option>
            	<option value="fav_num" <?php if(trim($_GET['c_sort'])=='fav_num'){ ?>selected<?php } ?>>收藏数量</option>
            </select>
 		  </div>
          <div class="share_box">
            <ul>
              <?php if(!empty($output['comment_list'])){ ?>
          	  <?php foreach ($output['comment_list'] as $k=>$val){ ?>
              <li class="share_list mb15 clearfix">
              <div class="nc-pic">
              <a class="sh_img" href="index.php?act=membershow&mid=<?php echo $val['member_id']; ?>" target="_blank"><img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/member/<?php echo $val['avatar']!=''?$val['avatar']:'member.png'; ?>">
              </a>
              
              <p class="name"><a href="index.php?act=membershow&mid=<?php echo $val['member_id']; ?>" class="topic_nm" target="_blank"><?php echo $val['member_name']; ?></a></p>
              <p><?php echo $val['md_name']; ?></p>
              </div>
              
              
                <div class="share_cont">
                  <dl>
                    <dt class="mb15"><div class="remark-item star<?php echo $val['amount_score']; ?>" ></div><span>人均<strong class="stress"> ¥<?php echo intval($val['person_cost']); ?> </strong></span>
                    <span class="share_time"><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></span>
                    
                    </dt>
                    <dd class="mb15">
                      <p class="list_detail"><?php echo $val['comment']; ?></p>
                    </dd>
                    <dd class="mb30">
                    <?php if($val['photo'] != ''){ ?>
                    <?php 
                    $photo_list = explode(',', $val['photo']); 
                    foreach ($photo_list as $pk=>$pv){
                    ?>
                    <a href="javascript:void(0);" class="mr5 thumbnail" onmouseover="show_pic(event,'<?php echo $k.$pk; ?>')" onmouseout="hide_pic('<?php echo $k.$pk; ?>')"><img width="100px" class="t-img hover_pic" src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/comment/<?php echo $pv; ?>"><span id="bp_<?php echo $k.$pk; ?>"><img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/comment/<?php echo str_replace('.jpg_small','',$pv); ?>" border="0"></span></a>
                    <?php } ?>
                    <?php unset($photo_list); } ?>
                    </dd>
                    <?php if($val['parking'] != ''){ ?>
                    <dd class="mb5"><p class="info">停车信息：<?php echo $val['parking']; ?></p></dd>
                    <?php } ?>
                    <?php if($val['comment_explain'] != ''){ ?>
                    <dd class="mb5"><p class="info" style="color:#FF6500">解释说明：<?php echo $val['comment_explain']; ?></p></dd>
                    <?php } ?>
                    <dd class="share_info">当前店铺：<a href="#" title="米兰婚纱店"><strong><?php echo $val['store_name']; ?></strong></a>
					<span class="col-right"><a href="javascript:give_flower(<?php echo $val['comment_id']; ?>);">送鲜花(<span id="f_num_<?php echo $val['comment_id']; ?>"><?php echo $val['flower_num']; ?></span>)</a>
                    <em class="sep">|</em>
                    <a href="javascript:add_fav(<?php echo $val['comment_id']; ?>,'comment');">收藏</a><em class="sep">|</em><a href="#share">我也去过，说说我的感受</a></span>
					</dd>
                  </dl>
                  <span class="left_arrow"><span></span></span> </div>
              </li>
              <?php }} ?>
            </ul>
          </div>
          <div class="page_box"><?php echo $output['show_page'];?></div>
        </div>
      </div>
      <div class="shop_intro_conr">
        <div class="shop_map_wrap mb10">
          <div class="shop_intro_hd mb10" >
            <h3 class="mr20"> <strong><?php echo $lang['nc_store_detail_store'];?></strong><?php echo $lang['nc_store_intro_map'];?></h3>
          </div>
          <div class="shop_map" id="container" style=" width:278px;height:300px; margin: 0 auto;"></div>
          <div class="shop_route">
            <ul>
              <li><em class="tit"><?php echo $lang['nc_store_intro_the bus route'];?>：</em><span><?php echo $output['storeinfo']['bus'];?></span></li>
              <li><em class="tit"><?php echo $lang['nc_store_intro_subway line'];?>：</em><span><?php echo $output['storeinfo']['subway'];?></span></li>
            </ul>
          </div>
        </div>
        <div class="shopnear mb10">
          <div class="shop_intro_hd mb10">
            <h3 class="mr20"> <strong><?php echo $lang['nc_store_intro_nearby'];?></strong><?php echo $lang['nc_store_detail_store'];?></h3>
          </div>
          <div class="shopnear_bd">
            <?php if(!empty($output['sidestore'])){?>
            <?php foreach($output['sidestore'] as $s){?>
            <dl>
              <dt> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $s['store_id']; ?>" title="<?php echo $s['store_name'];?>"> <img class="fl mr10" src="<?php echo ($s['logo']!='' && $s['logo']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$s['logo']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" width="100px"></a> </dt>
              <dd class="fl">
                <h4> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $s['store_id']; ?>" title="<?php echo $s['store_name'];?>"><?php echo $s['store_name'];?></a> </h4>
                <p class="mb10 color6"><?php echo $lang['nc_store_detail_address'];?>:<?php echo $s['address'];?></p>
              </dd>
            </dl>
            <?php }?>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div id='share' class="fl">
  <?php if($_SESSION['is_login'] == '1'){?>
  <div class="share_update bg1 mt20">
    <div class="share_update_box">
      <div class="share_update_hd">

        <h3 class="mb20 ml15"><?php echo $lang['nc_store_detail_beginning of my share'];?></h3> 

      </div>
      <div class="share_login clearfix">
		<div class="upshareimg"></div>
	    <iframe name="ifm" style='display:none;'></iframe>
		<form method="post"enctype="multipart/form-data" action="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=upload&id=<?php echo $output['storeinfo']['store_id'];?>" target='ifm' id='uploadform'>
			<div class="upshare">
				<input type='hidden' name='picname'>
				<input type="hidden" id="picnumber" value="0">
				<a href="javascript:void(0);" class="btn-add">
					<input type="file" class="fileupload" name='uploadimg'/>
				</a>
				<span class="color1"><?php echo $lang['nc_store_detail_support batch upload'];?></span>
				<!--  
				<input type='file' name='uploadimg' style='display:none;'>
				<input type='hidden' name='picname'>
				<a class="upshare_btn">添加图片</a><span class="color1">支持批量上传，最多可添加20个文件，单个文件最大5M</span>
				-->
			</div>
		</form>
		<form id="comment" method="post" action="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=addcomment&id=<?php echo $output['storeinfo']['store_id'];?>" novalidate="novalidate">
        <div class="share_cont_block">
          <div class="sh_bd">
          	<input type="hidden" name="picname" value="">
            <textarea class="placeholder" style="height: 178px; width: 681px;" name="commentContent" id="commentContent" cols="30" rows="10" placeholder="最多只能输入200字符" maxlength="200"></textarea>
          </div>
          <div class="share-rj">总体评价：<input type="radio" value="1" name="score">1分<input type="radio" value="2" name="score" style="margin-left:5px">2分<input type="radio" value="3" name="score" style="margin-left:5px">3分<input type="radio" value="4" name="score" style="margin-left:5px">4分<input type="radio" value="5" name="score" style="margin-left:5px">5分</div>
		  <div class="share-rj"><?php echo $lang['nc_store_detail_consumption per person'];?>：<input type='text' name='person_cost' id='person_cost'></div>
		  <div class="share-tc"><?php echo $lang['nc_store_detail_parking information'];?>：<input type='text' name='parking' id='parking'></div>
          <div class="share-tag">
			 <span><?php echo $lang['nc_store_detail_tab'];?>：</span>
			 <div class="share-tag-list">
			 	  <?php $output['storeinfo']['label'] = unserialize($output['storeinfo']['label']); ?>
				  <?php if(!empty($output['storeinfo']['label'])){?>
				  <?php foreach($output['storeinfo']['label'] as $label){?>
				  <a class="share-tag-label label_select" label_id="<?php echo $label['label_id'];?>"><?php echo $label['label_name'];?></a>
				  <?php }?>
				  <?php }?>
			  </div>
		  </div>
          <div class="sh_sub"><a class="sh_sub_a">&nbsp;&nbsp;发&nbsp;布&nbsp;&nbsp;</a></div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php }else{?>
  <div class="share_update bg1 mt20 ">
    <div class="share_update_box">
      <div class="share_update_hd">
        <h3 class="mb20 ml15"><?php echo $lang['nc_store_detail_beginning of my share'];?></h3>
      </div>
      <div class="share_login clearfix"> 
		<!--<span><a href="javascript:void(0);" class="img_none"><img src="<?php echo BASE_SITE_URL;?>/shop/templates/default/images/lsimg/ls03.jpg"  alt=""></a></span>-->
        <div class="sl_box"><span class="left_arrow"><span></span></span>
          <div class="sl_login color2"> <strong><?php echo $lang['nc_store_detail_replay to'];?><a href="<?php echo BASE_SITE_URL;?>/index.php?act=login"><?php echo $lang['nc_login']?></a><?php echo $lang['nc_store_detail_or']?><a href="<?php echo BASE_SITE_URL;?>/index.php?act=login&op=register"><?php echo $lang['nc_store_detail_immediate account registration'];?></a></strong> </div>
        </div>
      </div>
    </div>
  </div>
  <?php }?>
  </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		$('.shop_tabs_hd ul li').click(function(){
			$('.shop_tabs_hd ul li').removeClass('selected');
			$(this).addClass('selected');
			var nc = $(this).attr('nc_type');
			$('div[nc_type=store_pic]').hide();
			$('div[nc_type=store_env]').hide();
			$('div[nc_type=price_table]').hide();
			$('div[nc_type='+nc+']').show();
		});
		$('#c_sort').change(function(){
			var sort_val = $(this).val();
			var store_id = '<?php echo intval($_GET['id']); ?>';
			window.location.href = '<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id='+store_id+'&c_sort='+sort_val+'#comment_anchor';
		});
	});
</script> 
<script type="text/javascript">
var cityName = '<?php echo $output['cityname']?>';
var address = '<?php echo $output['storeinfo']['address']?>';
var store_name = '<?php echo $output['storeinfo']['offline_store_name']?>';  
var map = "";
var localCity = "";
var opts = {width : 150,height: 50,title : "<?php echo $lang['nc_store_intro_shop name'];?>:"+store_name}
function initialize() {
	map = new BMap.Map("container");
	localCity = new BMap.LocalCity();
	
	map.enableScrollWheelZoom(); 
	map.addControl(new BMap.NavigationControl());  
	map.addControl(new BMap.ScaleControl());  
	map.addControl(new BMap.OverviewMapControl()); 
	localCity.get(function(cityResult){
	  if (cityResult) {
	  	var level = cityResult.level;
	  	if (level < 13) level = 13;
	    map.centerAndZoom(cityResult.center, level);
	    cityResultName = cityResult.name;
	    if (cityResultName.indexOf(cityName) >= 0) cityName = cityResult.name;
	    	    	getPoint();
	    	  }
	});
}
 
function loadScript() {
	var script = document.createElement("script");
	script.src = "http://api.map.baidu.com/api?v=1.2&callback=initialize";
	document.body.appendChild(script);
}
function getPoint(){
	var myGeo = new BMap.Geocoder();
	myGeo.getPoint(address, function(point){
	  if (point) {
	    setPoint(point);
	  }
	}, cityName);
}
function setPoint(point){
	  if (point) {
	    map.centerAndZoom(point, 16);
	    var marker = new BMap.Marker(point);
	    var infoWindow = new BMap.InfoWindow("<?php echo $lang['nc_store_intro_detailed address'];?>:"+address, opts);  
			marker.addEventListener("click", function(){          
			   this.openInfoWindow(infoWindow);  
			});
	    map.addOverlay(marker);
			marker.openInfoWindow(infoWindow);
	  }
}
loadScript();
</script> 
<script type="text/javascript" src="<?php echo BASE_SITE_URL; ?>/data/resource/js/jquery.validation.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL; ?>/data/resource/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo BASE_SITE_URL; ?>/data/resource/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo BASE_SITE_URL; ?>/data/resource/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL; ?>/data/resource/js/jquery-ui/i18n/zh-CN.js"></script>
<script type='text/javascript'>
	$(function(){
		$("#comment").validate({
			rules: {
				person_cost: {
					required:true,
					min:0.01,
					max:100000
				},
			},
			messages: {
				person_cost: {
					required:'人均消费不能为空',
					min:'人均消费在0.01-100000之间',
					max:'人均消费在0.01-100000之间'
				},
			}
		});

		$('.upshare_btn').click(function(){
			$('input[name=uploadimg]').val('');
			$('input[name=uploadimg]').click();
		});

		$('input[name=uploadimg]').change(function(){
			var pic_number = parseInt($('#picnumber').val());
			if(pic_number>4){//最大上传5张图片
				alert('最多上传5张图');
				return false;
			}
			$('#uploadform').submit();
		});

		$('.delimg').live('click',function(){//删除图片
			var pic_number = parseInt($('#picnumber').val());
			$('#picnumber').val(eval(pic_number-1));
			$(this).parent().parent().remove();

			var picname = $('input[name=picname]').val();
			var delpic	= $(this).attr('picname');
			$('input[name=picname]').val(picname.replace(delpic,''));
		});

		$('.sh_sub_a').click(function(){
			var number = parseInt($('picnumber').val());
			if(number>4){//最大上传5张图片
				alert('最多上传5张图');
				return false;
			}

			var tags = '';//标签
			$(".share-tag-list").find('.share-active').each(function(){
				tags+= $(this).attr('label_id')+',';
			});

			$('#comment').submit();
			return false;
		});

		$(".label_select").toggle(function(){
			$(this).addClass('share-active');
		},function(){
			$(this).removeClass('share-active');
		});

		$('#make_appointment').click(function(){
			var member_id   =   '<?php if(isset($_SESSION['member_id'])){echo $_SESSION['member_id'];}else{ echo '0';}?>';
			if(member_id<1){
				alert('<?php echo $lang['nc_appointment_list_login first'];?>');
				return false;
			}
			var store_id = <?php echo $output['storeinfo']['store_id']; ?>;
			ajax_form('appointment', '<?php echo $lang['nc_appointment_list_appointment online'];?>', '<?php echo BASE_SITE_URL;?>/index.php?act=appointment&op=order&store_id='+store_id,'500px');
		});
	});

	function callback(filename){
		var filestr	=	$('input[name=picname]').val();
		$('input[name=picname]').val(filestr+filename+',');
		var path = '<?php echo BASE_SITE_URL; ?>'+'/data/upload/shop/comment/';
		var html = '<dl><dt><img src="'+path+filename+'"></dt><dd><img src="<?php echo BASE_SITE_URL; ?>/shop/templates/default/images/del.jpg" class="delimg" picname="'+filename+'"></dd></dl>';
		$('.upshareimg').append(html);
		var pic_number = parseInt($('#picnumber').val());
		$('#picnumber').val(eval(pic_number+1));
	}
</script>