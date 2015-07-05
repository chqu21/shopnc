<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>">首页</a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_groupbuy']?> </div>
    <div class="mainbox">
      <div class="layout_left02 clearfix">
		<!-- query -->
		<div class="main-local">
			<div class="list_nav">    
			  <span class="tit"><?php echo $lang['nc_store_class'];?>:</span>
			  <?php if(!empty($output['class_root'])){?>
			  <ul id="J_list" class="list" >
				<li class="<?php if(empty($output['class_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['class_root'] as $rk=>$rv){?>
				<li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $rv['class_name']?></a></li>
				<?php }?>
			  </ul>
			  <?php }?>
			  <?php if(isset($output['class_id'])){?>
			  <div class="list_navtab">
				<?php if(!empty($output['class_menu'][$output['class_id']])){?>
				<ul id="J_list" class="list" >
				  <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
				  <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $cv['class_name'];?></a></li>
				  <?php }?>
				</ul>
				<?php }?>
			  </div>
			  <?php }?>
			</div>
			<div class="dotted-line"></div>
			<div class="list_nav"> 
			  <span class="tit"><?php echo $lang['nc_store_mall'];?>:</span>
			  <?php if(!empty($output['area_list'])){?>
			  <ul id="J_list" class="list" >
				<li class="<?php if(empty($output['area_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['area_list'] as $mk=>$mv){?>
				<li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mv['area_name'];?></a></li>
				<?php }?>
			  </ul>
			  <?php }?>
			  <?php if(isset($output['area_id'])){?>
			  <div class="list_navtab">
				<?php if(!empty($output['area_list'])){?>
				<ul id="J_list" class="list">
				  <?php foreach($output['area_list'] as $mmk=>$mmv){?>
				  <?php if($mmv['area_id']==$output['area_id']){?>
				  <?php foreach($mmv[0] as $mmmk=>$mmmv){?>
				  <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mmmv['area_name'];?></a></li>
				  <?php }?>
				  <?php }?>
				  <?php }?>
				</ul>
				<?php }?>
			  </div>
			  <?php }?>
			</div>
		</div>
		<div class="sort_box">
        <div class="button_box"> 
        	<a class="<?php if($_GET['orderby'] != '' && $_GET['sort'] != ''){ echo 'sort1';}else{ echo 'sort2';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>" title="<?php echo $lang['nc_store_default_order']?>"><?php echo $lang['nc_store_default_order'];?></a> 
        	<a class="<?php if($_GET['orderby'] == 'buyer_num'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&orderby=buyer_num&sort=<?php if($_GET['sort']=='asc'){ ?>desc<?php }else{ ?>asc<?php } ?>" title="销售量">销售量<i class="<?php if($_GET['orderby'] == 'buyer_num' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
        	<a class="<?php if($_GET['orderby'] == 'end_time'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&orderby=end_time&sort=<?php if($_GET['sort']=='asc'){ ?>desc<?php }else{ ?>asc<?php } ?>" title="有效期">有效期<i class="<?php if($_GET['orderby'] == 'end_time' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a>
        	<a class="<?php if($_GET['orderby'] == 'group_price'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&orderby=group_price&sort=<?php if($_GET['sort']=='asc'){ ?>desc<?php }else{ ?>asc<?php } ?>" title="价格">价格<i class="<?php if($_GET['orderby'] == 'group_price' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
        </div>
      	</div>
		<!-- query end -->
        <div class="group-bd">
          <?php if(isset($output['list']) && !empty($output['list'])){?>
          <ul>
            <?php foreach($output['list'] as $key=>$val){?>
            <li class="mb20 ml20"> <a class="gif-pic" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id'];?>"> <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$val['group_pic']);?>" > </a>
              <h3> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id'];?>"> <span class="group-tit">[<?php echo $val['store_name'];?>]<?php echo $val['group_name'];?></span> </a> </h3>
              <div class="price">
                <div class="pr-f"> <span class="z1 fs1">￥<?php echo $val['group_price'];?></span><em><?php echo $lang['nc_groupbuy_original_price'];?>：￥<?php echo intval($val['original_price']); ?></em> </div>
                <a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id'];?>">
                <div class="btn"></div>
                </a> </div>
              <div class="group-ft">
                <p class="time fl process" endtime="<?php echo $val['end_time'];?>"><?php if(time() >= $val['end_time']){ ?>已结束<?php } ?></p>
                <p class="num fr"><span><?php echo $val['buyer_num'];?></span><?php echo $lang['nc_groupbuy_already_groupbuy'];?></p>
              </div>
            </li>
            <?php }?>
          </ul>
          <?php }else{?>
          <div class="group-no-record"><span><?php echo $lang['nc_record'];?></span></div>
          <?php }?>
        </div>
        <div class="page_box"><?php echo $output['show_page']; ?></div>
      </div>
      <div class="sidebar">
        <div class="hot-group clearfix mb10">
          <div class="hot-group-hd">
            <h2><?php echo $lang['nc_groupbuy_hot_group'];?></h2>
            <a href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=list"><?php echo $lang['nc_groupbuy_group_more'];?>&gt;&gt;</a> </div>
          <?php if(!empty($output['hotgroupbuy'])){?>
          <ul class="recom-ul">
            <?php foreach($output['hotgroupbuy'] as $hot){?>
            <li> <a class="thumb" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $hot['group_id'];?>"> <img width="220" height="125" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$hot['group_pic']);?>"> </a>
              <h6> <a title="" href="<?php echo BASE_SITE_URL;?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $hot['group_id'];?>"><?php echo $hot['group_name'];?></a> </h6>
              <div class="recom-worth"> <span class="Price-font price">¥<?php echo $hot['group_price'];?></span>市场价&nbsp;<del>¥<?php echo $hot['original_price'];?></del> </div> </li>
            <?php }?>
          </ul>
          <?php }?>
        </div>
        <div class="cp_ad mb10"><?php echo rec(14);?></div>
      </div>
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