<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offlinestore.css">
<style>
.dialog_body { width:580px;}
</style>
<div class="live_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>">首页</a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_appointment'];?>
	</div>
    <div class="mainbox clearfix" style="width:1090px;">
    	<!-- query -->
		<div class="main-local" style="margin-bottom:15px;width:958px;">
			<div class="list_nav">    
			  <span class="tit"><?php echo $lang['nc_store_class'];?>:</span>
			  <?php if(!empty($output['class_root'])){?>
			  <ul id="J_list" class="list" >
				<li class="<?php if(empty($output['class_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['class_root'] as $rk=>$rv){?>
				<li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $rv['class_name']?></a></li>
				<?php }?>
			  </ul>
			  <?php }?>
			  <?php if(isset($output['class_id'])){?>
			  <div class="list_navtab">
				<?php if(!empty($output['class_menu'][$output['class_id']])){?>
				<ul id="J_list" class="list" >
				  <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
				  <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>"><?php echo $cv['class_name'];?></a></li>
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
				<li class="<?php if(empty($output['area_id'])){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $lang['nc_all'];?></a></li>
				<?php foreach($output['area_list'] as $mk=>$mv){?>
				<li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mv['area_name'];?></a></li>
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
				  <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=appointment&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>"><?php echo $mmmv['area_name'];?></a></li>
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
	  <?php if(!empty($output['appoint'])){?>
      <ul class="apt-ul">
		<?php foreach($output['appoint'] as $appoint){?>
        <li>
          <div class="apt-img"> 
			<a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $appoint['store_id'];?>"><img src="<?php echo ($appoint['appointment_pic']!='' && $appoint['appointment_pic']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_APPOINT_PATH.DS.$appoint['appointment_pic']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" ></a>
		  </div>
          <div class="apt-cont">
            <dl>
              <dt><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $appoint['store_id'];?>"><?php echo $appoint['store_name'];?></a></dt>
              <dd><?php echo $lang['nc_appointment_phone'];?>&nbsp;:&nbsp;<?php echo $appoint['telephone'];?></dd>
              <dd class="count"><span><?php echo $appoint['number']?></span><?php echo $lang['nc_appointment_order'];?></dd>
              <dd class="apt-info"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $appoint['store_id'];?>"><?php echo $lang['nc_appointment_descript'];?><span class="apt-down"></span></a></dd>
              <div class="apt-btn"> 
				<a store_id="<?php echo $appoint['store_id'];?>" class="apt-btn-txt"><?php echo $lang['nc_appointment_my_order'];?></a>
			  </div>
            </dl>
          </div>
        </li>
		<?php }?>
      </ul>
	  <div class="page_box" style="margin-right:100px;"><?php echo $output['show_page']; ?></div>
	  <?php }else{?>
	  <div class="group-erro-info" style="float:left;"><span><?php echo $lang['nc_record'];?></span></div>
	  <?php }?>
    </div>
  </div>
</div>
<div id="appointment" style="display:none;">
</div>
<script type="text/javascript">
	var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script type="text/javascript">
	$(function(){
		$('.apt-info').click(function(){
			$('.apt-desc-list').show();
		});

		$('.apt-btn-txt').click(function(){
			var member_id   =   '<?php if(isset($_SESSION['member_id'])){echo $_SESSION['member_id'];}else{ echo '0';}?>';
			if(member_id<1){
				alert('<?php echo $lang['nc_appointment_list_login first'];?>');
				return false;
			}
			var store_id = $(this).attr('store_id');
			ajax_form('appointment', '<?php echo $lang['nc_appointment_list_appointment online'];?>', '<?php echo BASE_SITE_URL;?>/index.php?act=appointment&op=order&store_id='+store_id,'500px');
		});
	});

	
</script>