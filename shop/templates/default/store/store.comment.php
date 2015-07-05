<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js" charset="utf-8"></script>
<script type='text/javascript'>
  $(function(){
	$("#pinterest").imagesLoaded( function(){
		$("#pinterest").masonry({
			itemSelector : '.item'
		});
	});
});
</script>
<?php if(!empty($output['list'])){?>
<div class="commend-goods-list">
  <ul id="pinterest">
    <?php foreach($output['list'] as $key=>$value) {?>
    <li class="item">
      <?php if(!empty($value['photo'])){?>
      <?php $photo = explode(',',$value['photo']);?>
	  <?php $photo = array_slice($photo,0,2);?>
      <?php foreach($photo as $p){?>
      <div class="picture"> <a class="box_img" href="javascript:void(0);"><img src="<?php echo UPLOAD_SITE_URL;?>/shop/comment/<?php echo $p;?>"> </a> </div>
      <?php }?>
      <?php }?>
      <div class="description"> <?php echo $value['comment'];?> </div>
      <div class="box_data">
        <p class="fl"><em><?php echo $lang['nc_store_person_cost'];?></em><span><?php echo $value['person_cost'];?></span></p>
      </div>
      <div class="box_user"> <span class="fr color9"><?php echo date("Y-m-d",$value['add_time']);?></span> <a href="javascript:void(0);"> <img width="32" height="32" alt="" src="<?php echo UPLOAD_SITE_URL;?>/shop/member/<?php echo $value['avatar'];?>"> <span><?php echo $value['member_name'];?></span> </a> </div>
    </li>
    <?php } ?>
    <div class="clear"></div>
  </ul>
  <div class="clear"></div>
</div>

<div class="page_box pb"> <?php echo $output['show_page'];?> </div>
<?php }else{?>
<div class="shop_activitie">
<div class="pic_box"><span class="font-msg"><?php echo $lang['nc_record'];?></span></div></div>
<?php }?>
