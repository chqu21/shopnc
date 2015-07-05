<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>">首页</a>&nbsp;&gt;&nbsp;积分商城 </div>
    <div class="mainbox">
      <div class="layout_left02 clearfix">
        <div class="group-bd">
          <?php if(isset($output['gift_list']) && !empty($output['gift_list'])){?>
          <ul>
            <?php foreach($output['gift_list'] as $key=>$val){?>
            <li class="mb20 ml20 clearfix"> <a class="gif-pic" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $val['sg_id'];?>"> <img src="<?php echo BASE_SITE_URL.'/data/upload/shop/gift/'.$val['sg_pic'];?>" > </a>
              <h3> <a href="<?php echo BASE_SITE_URL;?>/iindex.php?act=gift&op=detail&sg_id=<?php echo $val['sg_id'];?>"> <span class="group-tit"><?php echo $val['sg_name'];?></span> </a> </h3>
             <div class="price">
                <div class="pr-f"> <span><?php echo intval($val['sg_point']);?><em style="color:#e73535;">积分</em></span><em>门店价 ￥<?php echo $val['sg_price']; ?></em> </div>
                <a href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $val['sg_id'];?>">
                <div class="btn-gift"></div>
                </a>
                
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
            <h2>推荐兑换</h2>
          </div>
          <?php if(!empty($output['gift_recommend'])){?>
          <ul class="recom-ul">
            <?php foreach($output['gift_recommend'] as $hot){?>
            <li> <a class="thumb" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"> <img width="220" height="125" src="<?php echo BASE_SITE_URL.'/data/upload/shop/gift/'.$hot['sg_pic'];?>"> </a>
              <h6> <a title="" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"><?php echo $hot['sg_name'];?></a> </h6>
              <a class="recom-worth" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"> <span class="Price-font price"><?php echo $hot['sg_point'];?>分</span> <del class="o-price">¥<?php echo $hot['sg_price'];?></del> </a> </li>
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