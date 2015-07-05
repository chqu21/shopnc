<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>"><?php echo $lang['nc_home'];?></a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_groupbuy']?> </div>
    <div class="layout_left02 clearfix">
      <div class="group-detail-con">
        <div class="gd-title">
          <h1><?php echo $output['group']['store_name'];?></h1>
          <p class="gd-des"><?php echo $output['group']['group_name'];?></p>
        </div>
        <div class="gd-con">
        <div class="group-pic"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$output['group']['group_pic']);?>" /></div>
        <div class="group-info">
          <div class="prices-box">
            <dl>
              <dt><?php echo $lang['nc_groupbuy_original_price'];?></dt>
              <dd class="prices">￥<?php echo intval($output['group']['original_price']);?></dd>
            </dl>
            <dl>
              <dt><?php echo $lang['nc_groupbuy_discount'];?></dt>
              <dd><?php echo round(($output['group']['group_price']/$output['group']['original_price']),2)*10;?> <?php echo $lang['nc_discount'];?> </dd>
            </dl>
            <dl>
              <dt><?php echo $lang['nc_groupbuy_save'];?></dt>
              <dd>￥<?php echo $output['group']['original_price']-$output['group']['group_price'];?></dd>
            </dl>
          </div>
          <div class="<?php if(time() >= $output['group']['end_time']){ ?>closeed<?php }else{ ?>buy-now<?php } ?>"><strong>¥&nbsp;<?php echo $output['group']['group_price']; ?></strong><a href="<?php echo time() >= $output['group']['end_time']?'javascript:void(0);':BASE_SITE_URL;?>/index.php?act=groupbuy&op=groupbuyorder&group_id=<?php echo $output['group']['group_id'];?>">
            <?php $lang['nc_groupbuy_my_group'];?>
            </a></div>
            <div class="require">
            <h2> <?php echo $lang['nc_groupbuy_already_group_num'];?><em><?php echo $output['group']['buyer_num'];?></em><?php echo $lang['nc_unit'];?> 剩余<?php echo $output['group']['buyer_count']-$output['group']['buyer_num'];?>件</h2>
          </div>
          <div class="time">
            <h3><?php echo $lang['nc_groupbuy_distance_end_time'];?></h3>
            <p class="process" endtime="<?php echo $output['group']['end_time'];?>"></p>
			<p class="comp-deal"><span class="tit">服务承诺</span><span class="tit02"><?php if($output['group']['is_refund']==1){ echo '支持团购退款';}?></span></p>
          </div>
      
        </div>
          </div>
      </div>
      <div class="group-detail-box">
        <div class="side-left">
          <div class="side-left-intro">
            <div class="side-left-hd">
              <h2><?php echo $lang['nc_groupbuy_groupbuy_help'];?></h2>
            </div>
            <div> <?php echo stripslashes(htmlspecialchars_decode($output['group']['group_help']));?> </div>
          </div>
          <div class="side-left-intro">
            <div class="side-left-hd">
              <h2><?php echo $lang['nc_groupbuy_groupbuy_intro'];?></h2>
            </div>
            <div> <?php echo stripslashes(htmlspecialchars_decode($output['group']['group_intro']));?> </div>
          </div>
        </div>
        <div class="side-right">
          <div class="side-list">
            <p><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['storeinfo']['store_id'];?>" target="_blank"><?php echo $output['storeinfo']['store_name'];?></a></p>
            <p><span style=""><?php echo $lang['nc_store_person_cost'];?> ￥<?php echo intval($output['storeinfo']['person_consume']); ?></span></p>
            <p class="dz"><?php echo $output['storeinfo']['address'];?></p>
            <p><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['storeinfo']['store_id'];?>" target="_blank">»<?php echo $lang['nc_groupbuy_detail_tubenosed'];?></a></p>
          </div>
			<!-- JiaThis Button BEGIN -->
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
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
			<!-- JiaThis Button END -->
        </div>
      </div>
      <div class="ad-detail-l mb10"><?php echo rec(16);?></div>
    </div>
    <div class="sidebar">
      <div class="hot-group clearfix mb10">
        <div class="hot-group-hd">
          <h2><?php echo $lang['nc_groupbuy_hot_group'];?></h2>
          <a href="<?php echo BASE_SITE_URL?>/index.php?act=groupbuy&op=list"><?php echo $lang['nc_groupbuy_group_more'];?>&gt;&gt;</a> </div>
        <?php if(!empty($output['hotgroupbuy'])){?>
        <ul class="recom-ul">
          <?php foreach($output['hotgroupbuy'] as $hot){?>
          <li> <a class="thumb" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $hot['group_id'];?>"> <img width="220" height="125" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$hot['group_pic']);?>"> </a>
            <h6> <a title="" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $hot['group_id'];?>"><?php echo $hot['group_name'];?></a> </h6>
            <a class="recom-worth" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $hot['group_id'];?>"> <span class="Price-font price"><?php echo $hot['group_price'];?></span> <del class="o-price">¥<?php echo $hot['original_price'];?></del> </a> </li>
          <?php }?>
        </ul>
        <?php }?>
      </div>
      <div class="cp_ad mb10"><?php echo rec(15);?></div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		var time = parseInt("<?php echo TIMESTAMP;?>");
		var lag = parseInt($('.process').attr('endtime')) - time;
		if(lag>0){
		   var second = Math.floor(lag % 60);    
		   var minite = Math.floor((lag / 60) % 60);
		   var hour = Math.floor((lag / 3600) % 24);
		   var day = Math.floor((lag / 3600) / 24);
		   $('.process').html('<span>'+day+'</span>'+'<?php echo $lang['nc_day'];?>'+'<span>'+hour+'</span>'+'<?php echo $lang['nc_hour'];?>'+'<span>'+minite+"</span>"+'<?php echo $lang['nc_minute'];?>'+'<span>'+second+'</span>'+'<?php echo $lang['nc_second'];?>');
		}
		function updateEndTime(){
			time++;		
			var lag = parseInt($(".process").attr('endTime')) - time;
			if(lag>0){
			    var second = Math.floor(lag % 60);    
			    var minite = Math.floor((lag / 60) % 60);
			    var hour = Math.floor((lag / 3600) % 24);
			    var day = Math.floor((lag / 3600) / 24);
				$(".process").html('<span>'+day+'</span>'+'<?php echo $lang['nc_day'];?>'+'<span>'+hour+'</span>'+'<?php echo $lang['nc_hour'];?>'+'<span>'+minite+"</span>"+'<?php echo $lang['nc_minute'];?>'+'<span>'+second+'</span>'+'<?php echo $lang['nc_second'];?>');
			}else{
			}
			setTimeout(updateEndTime,1000);
		}
		setTimeout(updateEndTime,1000);
	});
</script>