<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>">首页</a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_member_coupon'];?> </div>
    <div class="mainbox">
      <div class="layout_left02 clearfix">
      <!-- query -->
		<div class="main-local">
			<div class="list_nav">    
			  <span class="tit"><?php echo $lang['nc_store_class'];?>:</span>
			  <?php if(!empty($output['class_root'])){?>
			  <ul id="J_list" class="list" >
				<li class="<?php if(empty($output['class_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['class_root'] as $rk=>$rv){?>
				<li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $rv['class_name']?></a></li>
				<?php }?>
			  </ul>
			  <?php }?>
			  <?php if(isset($output['class_id'])){?>
			  <div class="list_navtab">
				<?php if(!empty($output['class_menu'][$output['class_id']])){?>
				<ul id="J_list" class="list" >
				  <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
				  <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $cv['class_name'];?></a></li>
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
				<li class="<?php if(empty($output['area_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['area_list'] as $mk=>$mv){?>
				<li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mv['area_name'];?></a></li>
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
				  <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mmmv['area_name'];?></a></li>
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
        	<a class="<?php if($_GET['orderby'] != '' && $_GET['sort'] != ''){ echo 'sort1';}else{ echo 'sort2';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id']; ?>&area_id=<?php echo $output['area_id']; ?>&mall_id=<?php echo $output['mall_id']; ?>&class_id=<?php echo $output['class_id']; ?>&class_id_1=<?php echo $output['class_id_1']; ?>" title="<?php echo $lang['nc_store_default_order']?>"><?php echo $lang['nc_store_default_order'];?></a> 
        	<a class="<?php if($_GET['orderby'] == 'download_count'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id']; ?>&area_id=<?php echo $output['area_id']; ?>&mall_id=<?php echo $output['mall_id']; ?>&class_id=<?php echo $output['class_id']; ?>&class_id_1=<?php echo $output['class_id_1']; ?>&orderby=download_count&sort=<?php if($_GET['sort']=='asc'){ ?>desc<?php }else{ ?>asc<?php } ?>" title="下载量">下载量<i class="<?php if($_GET['orderby'] == 'download_count' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
        	<a class="<?php if($_GET['orderby'] == 'coupon_end_time'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list&city_id=<?php echo $output['city_id']; ?>&area_id=<?php echo $output['area_id']; ?>&mall_id=<?php echo $output['mall_id']; ?>&class_id=<?php echo $output['class_id']; ?>&class_id_1=<?php echo $output['class_id_1']; ?>&orderby=coupon_end_time&sort=<?php if($_GET['sort']=='asc'){ ?>desc<?php }else{ ?>asc<?php } ?>" title="有效期">有效期<i class="<?php if($_GET['orderby'] == 'coupon_end_time' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
        </div>
      </div> <div class="main_content">
        <?php if(!empty($output['list'])){?>
        <?php $num = 1;?>
        <?php foreach($output['list'] as $ck=>$cv){?>
       
        <div class="coupon_list mb20 rebox"> 
          <!--<div class="rank"><strong><?php echo $num;?></strong> <img src="<?php echo OFFLINESHOP_TEMPLATES_PATH;?>/images/cp_icon.png" /> </div>-->
          <div class="cpl_block">
            <div class="cp_img_block"> <a class="cp_img" href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $cv['coupon_id'];?>"> <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.str_replace('.jpg_small','',$cv['coupon_pic']);?>" onload="javascript:DrawImage(this,210,133);"/></a> <!--<span class="txt_bg"><a href="javascript:void(0);"><?php echo $cv['store_name'];?></a></span>--> </div>
            <h2 class="cp_tit"><?php echo $cv['coupon_name'];?></h2>
            <ul>
              <li class="c_icon1"><?php echo $lang['nc_coupon_already'];?><span><?php echo $cv['view_count'];?></span><?php echo $lang['nc_coupon_person_view'];?></li>
              <li class="c_icon2"><?php echo $lang['nc_coupon_already'];?><span><?php echo $cv['download_count'];?></span><?php echo $lang['nc_coupon_person_download'];?></li>
              <li class="c_icon3"><span class="cp_time"><?php echo $lang['nc_coupon_valid_date'];?><?php echo date("Y.m.d",$cv['coupon_end_time']);?></span></li>
            </ul>
          </div>
          <div class="cp_btn_block"> 
          	<span class="cp_btn"><strong><a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $cv['coupon_id'];?>"><?php echo $lang['nc_coupon_go'];?></a></strong></span>
            <!--  
            <p><?php echo $lang['nc_coupon_remind_number'];?>：<span class="cp_num"><?php echo $cv['limit'];?></span>&nbsp;<?php echo $lang['nc_coupon_number'];?></p>
          	-->
          </div>
        </div>
       
        <?php $num++;?>
        <?php }?>
        <?php }else{?>
        <div class="coupon-no"><span><?php echo $lang['nc_record'];?></span></div>
		<?php } ?>
        </div>
        <div class="page_box"><?php echo $output['show_page'];?> </div>
      </div>
      <div class="sidebar">
        <div class="cp_last mb10">
          <div class="cp_last_tit">
            <h2><?php echo $lang['nc_coupon_draw_info'];?></h2>
          </div>
          <div class="cp_last_cont">
            <?php if(!empty($output['download'])){?>
            <ul>
              <?php foreach($output['download'] as $download){?>
              <li class="cp_roll"> <a href="index.php?act=coupon&op=detail&coupon_id=<?php echo $download['coupon_id'];?>" target="_blank"> <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.$download['coupon_pic'];?>" />
                <div class="cp_info">
                  <p class="txt">
                  <a href="index.php?act=coupon&op=detail&coupon_id=<?php echo $download['coupon_id'];?>" target="_blank">
                    <?php if(!empty($download['member_name'])){ echo $download['member_name'];}else{ echo $lang['nc_member_coupon_viewer'];}?>
                  </a>
                  </p>
                  <p class="txt">
                  <a href="index.php?act=coupon&op=detail&coupon_id=<?php echo $download['coupon_id'];?>" target="_blank">
                  <?php echo $lang['nc_coupon_draw_coupon'];?><?php echo $download['coupon_name'];?>
                  </a>
                  </p>
                </div>
                </a> </li>
              <?php }?>
            </ul>
            <?php }?>
          </div>
        </div>
        <div class="cp_ad mb10"><?php echo rec(10);?></div>
      </div>
    </div>
  </div>
</div>
