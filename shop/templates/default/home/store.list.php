<div class="life_body">
<div id="main-wrap">
  <div class="sitenav">
    <h2><?php echo $lang['nc_location'].$lang['nc_colon'];?></h2>
    <a href="index.php?act=index"><?php echo $lang['nc_home'];?></a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_store_list'];?>
  </div>
  <div class="mainbox">
    <div class="layout_left02 clearfix">
      <div class="main-local">
        <div class="list_nav">    
          <span class="tit"><?php echo $lang['nc_store_class'];?>:</span>
          <?php if(!empty($output['class_root'])){?>
          <ul id="J_list" class="list" >
            <li class="<?php if(empty($output['class_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $lang['nc_all'];?><span></span></a></li>
            <?php foreach($output['class_root'] as $rk=>$rv){?>
            <li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $rv['class_name']?><!-- <span>(<?php echo $rv['number'];?>) </span>--></a></li>
            <?php }?>
          </ul>
          <?php }?>
          <?php if(isset($output['class_id'])){?>
          <div class="list_navtab">
            <?php if(!empty($output['class_menu'][$output['class_id']])){?>
            <ul id="J_list" class="list" >
              <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
              <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a  href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $cv['class_name'];?><!-- <span>(<?php echo $cv['number'];?>)</span> --></a></li>
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
          	<li class="<?php if(empty($output['area_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $lang['nc_all'];?><span></span></a></li>
            <?php foreach($output['area_list'] as $mk=>$mv){?>
            <li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $mv['area_name'];?><!-- <span>(<?php echo $mv['number'];?>)</span> --></a></li>
            <?php }?>
          </ul>
          <?php }?>
          <?php if(isset($output['area_id'])){?>
          <div class="list_navtab">
            <?php if(!empty($output['area_list'])){?>
            <ul id="J_list" class="list">
              <?php foreach($output['area_list'] as $mmk=>$mmv){?>
              <?php if($mmv['area_id']==$output['area_id']){?>
			  <?php if(!empty($mmv[0])){?>
              <?php foreach($mmv[0] as $mmmk=>$mmmv){?>
              <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $mmmv['area_name'];?><!-- <span>(<?php echo $mmmv['number'];?>)</span>--></a></li>
              <?php }?>
			  <?php }?>
              <?php }?>
              <?php }?>
            </ul>
            <?php }?>
          </div>
          <?php }?>
        </div>
        <div class="dotted-line"></div>
        <div class="list_nav"> <span class="tit"><?php echo $lang['nc_store_person_cost'];?>:</span>
          <ul id="J_list" class="list" >
          	<li class="<?php if(empty($output['pconsume'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $output['class_id_1'];?>"><?php echo $lang['nc_all'];?><span></span></a></li>
            <?php foreach($output['personconsume'] as $pk=>$pv){?>
            <li class="<?php if($pk==$output['pconsume']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $pk;?>"><?php echo $pv;?></a></li>
            <?php }?>
          </ul>
        </div>
      </div>
      <div class="sort_box">
        <div class="button_box"> 
        	<a class="<?php if(isset($output['orderby'])&&isset($output['sort'])){ echo 'sort1';}else{ echo 'sort2';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>" title="<?php echo $lang['nc_store_default_order']?>"><?php echo $lang['nc_store_default_order'];?></a> 
        	<a class="<?php if(isset($output['orderby'])&&$output['orderby']=='person_consume'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=person_consume&sort=<?php echo $output['sort'];?>" title="<?php echo $lang['nc_store_person_cost_order'];?>"><?php echo $lang['nc_store_person_cost_order'];?><i class="<?php if($_GET['orderby'] == 'person_consume' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
        	<a class="<?php if(isset($output['orderby'])&&$output['orderby']=='add_time'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=add_time&sort=<?php echo $output['sort'];?>" title="<?php echo $lang['nc_store_publish_time'];?>"><?php echo $lang['nc_store_publish_time'];?><i class="<?php if($_GET['orderby'] == 'add_time' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a> 
			<a class="<?php if(isset($output['orderby'])&&$output['orderby']=='comment_count'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=comment_count&sort=<?php echo $output['sort'];?>" title="点评数">点评数<i class="<?php if($_GET['orderby'] == 'comment_count' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a>
			<a class="<?php if(isset($output['orderby'])&&$output['orderby']=='groupbuy_num'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo BASE_SITE_URL;?>/index.php?act=index&op=list&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=groupbuy_num&sort=<?php echo $output['sort'];?>" title="团购数">团购数<i class="<?php if($_GET['orderby'] == 'groupbuy_num' && $_GET['sort']=='asc'){ ?>top_img<?php }else{ ?>bottom_img<?php } ?>"></i></a>
        </div>
      </div>
      <div class="main_content">
        <div class="main_content_top">
          <div class="list_tab">
            <ul id="J_tab" class="clearfix">
              <li class="selected"><a href="javascript:void(0);"><?php echo $lang['nc_store_all_store'];?></a></li>
            </ul>
          </div>
        </div>
        <div class="main_content_list">
          <?php if(!empty($output['list'])){?>
          <ul>
            <?php foreach($output['list'] as $storek=>$storev){?>
            <li class="mod">
              <div class="mod_list">
                <div class="mod_list_left"> 
				<a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $storev['store_id'];?>" target="_blank"><span><img src="<?php echo ($storev['logo']!='' && $storev['logo']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$storev['logo']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>"></span></a>
                </div>
                <div class="mod_list_right">
                  <div class="mod_title">    
	               	  <a class="name" href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $storev['store_id'];?>" target="_blank"><?php echo $storev['store_name'];?></a>
	                  <?php if($storev['groupbuy_num']>0){?>
	                  <a class="group-icon" href="index.php?act=groupbuy" target="_blank"></a>
	                  <?php }?>        
	                  <?php if(isset($storev['iscoupon']) && $storev['iscoupon'] == 1){?>
	                  <a class="coupons-icon" href="index.php?act=coupon&op=list" target="_blank"></a>
	                  <?php }?>
	                  <?php if(isset($storev['is_card']) && $storev['is_card'] == 1){?>
	                  <a class="card-icon" href="index.php?act=card" target="_blank"></a>
	                  <?php }?>  
                  </div>
                  <div class="mod_info clearfix">
                    <div class="mod_place_tag">
                      <div class="mod_pingfen">
						<span>
							<label><?php echo $lang['nc_store_telephone'];?>:</label>
							<em style=" font-size:12px; font-weight:normal;color:#666666;"><?php echo $storev['telephone'];?></em>
						</span> 
					  </div>
                      <p><span class="mod_place"><?php echo $lang['nc_store_address'];?>:</span><?php echo $storev['address'];?></p>
                      <div class="mod_tags">
						<span class="tag"><?php echo $lang['nc_store_sign'];?>:</span>
						<?php $label = unserialize($storev['label']);?>
						<?php if(!empty($label)){?>
						<?php foreach($label as $labelval){?>
						<a href="javascript:void(0);"><?php echo $labelval['label_name'];?></a>
						<?php }?>
						<?php }?>
					  </div>
                    </div>
                    <div class="mod_price">￥<strong><?php echo intval($storev['person_consume']); ?></strong></div>
                    <div class="mod_dp">
                      <p>
						<?php echo $lang['nc_store_comment_num'].$lang['nc_colon'];?><a href="javascript:void(0);"><em><?php echo $storev['comment_count'];?></em></a>
					  </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mod_links">
				<a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $storev['store_id'];?>" target="_blank"><?php echo $lang['nc_store_my_comment'];?></a>
				<span class="mod_line ">|</span> 
				<a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $storev['store_id'];?>" target="_blank"><?php echo $lang['nc_store_view_comment'];?></a>
			  </div>
            </li>
            <?php }?>
          </ul>
          <?php }else{?>
          <!--没有搜索到商户-->
          <div class="none_info"><span><?php echo $lang['offline_no_offline_store'];?></span></div>
          <?php }?>
          <div class="page_box"> <?php echo $output['show_page'];?> </div>
        </div>
      </div>
    </div>
    <div class="sidebar">
      <div class="hot_coupon clearfix">
        <div class="hot_ch">
			<h2><?php echo $lang['nc_store_coupon'];?></h2>
			<a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=list"><?php echo $lang['nc_store_more_coupon'];?>&gt;&gt;</a></div>
			<?php if(!empty($output['couponlist'])){?>
			<ul>
			  <?php foreach($output['couponlist'] as $ek=>$ev){?>
			  <li class="hot_abc ha<?php echo $ek<3?1:4;?>"> <em class="e<?php echo $ek<3?1:4;?>"><?php echo $ek+1;?></em>
				<?php if($ek<3){?>
				<div class="hot_img"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.$ev['coupon_pic'];?>" ></div>
				<?php }?>
				<div class="hot_info">
				  <p class="tit1">
					<a href="<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $ev['coupon_id'];?>">
						<?php if($ek<3){ echo mb_substr($ev['coupon_name'],0,12,'utf-8');}else{ echo mb_substr($ev['coupon_name'],0,16,'utf-8');}?>
					</a>
				  </p>
				  
				  <p class="num"><?php echo $lang['nc_store_download_num'].$lang['nc_colon'];?><em><?php echo $ev['download_count']?></em></p>
				</div>
                <div class="price"><!--<?php echo $lang['nc_store_coupon_valid'].$lang['nc_colon'];?><?php echo date("Y-m-d",$ev['coupon_start_time']);?>~<?php echo date("Y-m-d",$ev['coupon_end_time']);?>--></div>
			  </li>
			  <?php }?>
			</ul>
			<?php }?>
      </div>
      <div class="cp_ad mb10"><?php echo rec(13);?></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
