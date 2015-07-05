<div class="life_body clearfix">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>">首页</a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_member_card'];?></div>
    <div class="mainbox clearfix" style="width:1090px;">
    <!-- query -->
		<div class="main-local" style="margin-bottom:15px;width:958px;">
			<div class="list_nav">    
			  <span class="tit"><?php echo $lang['nc_store_class'];?>:</span>
			  <?php if(!empty($output['class_root'])){?>
			  <ul id="J_list" class="list" >
				<li class="<?php if(empty($output['class_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['class_root'] as $rk=>$rv){?>
				<li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $rv['class_name']?></a></li>
				<?php }?>
			  </ul>
			  <?php }?>
			  <?php if(isset($output['class_id'])){?>
			  <div class="list_navtab">
				<?php if(!empty($output['class_menu'][$output['class_id']])){?>
				<ul id="J_list" class="list" >
				  <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
				  <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $cv['class_name'];?></a></li>
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
				<li class="<?php if(empty($output['area_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['area_list'] as $mk=>$mv){?>
				<li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mv['area_name'];?></a></li>
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
				  <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=card&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mmmv['area_name'];?></a></li>
				  <?php }?>
				  <?php }?>
				  <?php }?>
				</ul>
				<?php }?>
			  </div>
			  <?php }?>
			</div>
		</div>
		<!-- query end -->
      <?php if(!empty($output['list'])){?>
      <ul class="card-bd">
      	<?php foreach($output['list'] as $card){?>
        <li>
          <div class="card-bd-m"> 
			<img src="<?php echo ($card['card_pic']!='')?BASE_SITE_URL.DS.'data/upload/shop/card'.DS.$card['card_pic']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" width="255px" height="158px" >
            <h2 class="card-hd mt10"><?php echo $card['store_name'];?></h2>
            <p class="card-dis">（<?php echo $lang['nc_member_share'];?><?php echo $card['card_discount']; ?><?php echo $lang['nc_member_discount'];?>）</p>
          </div>
          <?php if(!empty($card['member'])){?>
          <?php $mc = 1;?>
		  <?php foreach($card['member'] as $member){?>
		  <?php if(isset($_SESSION['member_id']) && $_SESSION['member_id'] == $member['member_id']){?>
	      <div class="card-msg mt20">
            <dl style=" display: inline-block; margin: 0 auto;">
              <dt></dt>
              <dd><?php echo $lang['nc_card_list_success'];?><?php echo $card['store_name']?><?php echo $lang['nc_card_list_member'];?></dd>
            </dl>
          </div>	  
		  <?php $mc = 2;break;}?>
		  <?php }?>
		  <?php if($mc == 1){?>
          <div class="b-ml mt10">
            <div class="btn-bar ">
              <a class="btn-bar-txt" store_id="<?php echo $card['store_id'];?>"><?php echo $lang['nc_member_free_member'];?></a>
            </div>
          </div>		  
		  <?php }?>
          <?php }else{?>
          <div class="b-ml mt10">
            <div class="btn-bar ">
              <a class="btn-bar-txt" store_id="<?php echo $card['store_id'];?>"><?php echo $lang['nc_member_free_member'];?></a>
            </div>
          </div>
          <?php }?>
        </li>   
        <?php }?>     
      </ul>
      <?php }else{?>
       <div class="card-error" style="float:left;"><span><?php echo $lang['nc_record'];?></span>
       </div>
      
      <?php }?>
    </div>
  </div>
</div>
<div id='apply_card' style="display: none;"></div>
<script type="text/javascript">
	var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type='text/javascript'>
	$(function(){
		$('.btn-bar-txt').click(function(){
			var member_id   =   '<?php if(isset($_SESSION['member_id'])){echo $_SESSION['member_id'];}else{ echo '0';}?>';
			if(member_id<1){
				alert('<?php echo $lang['nc_card_list_login first'];?>');
				return false;
			}
			var store_id	=	$(this).attr("store_id");
			ajax_form('apply_card', '<?php echo $lang['nc_card_list_applycard'];?>', '<?php echo BASE_SITE_URL;?>/index.php?act=card&op=applycard&store_id='+store_id,'500px');
		});

		$('#ht_cancel').click(function(){
			$('#apply_card').hide();
		});
	});
</script> 
