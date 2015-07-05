<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
<meta name="description" content="<?php echo $output['seo_description']; ?>" />
<meta name="author" content="ShopNC">
<meta name="copyright" content="ShopNC Inc. All Rights Reserved">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offline.css">
<script type="text/javascript">
	$(function(){
		$("#hy-txt").click(function(){
			$.ajax({
				url: '<?php echo BASE_SITE_URL;?>/index.php?act=card&op=applycard&type=card&store_id=<?php echo $output['storeinfo']['store_id'];?>',
				type:'get',
				dataType:'json',
				success:function(msg){
					location.href = location.href;
				}
			});
		});
	});
</script>
</head>
<style>
.dialog_body { width:378px; }
</style>
<body>
<div class="hy-con">
  <div class="hy-card-box">
  	<img src="<?php echo BASE_SITE_URL.DS.'data/upload/shop/card'.DS.$output['storeinfo']['card_pic'];?>">
  </div>
  <div class="hy-card-rebate">
    <h4><?php echo $lang['nc_member_member_vip'];?> </h4>
    <ul>
      <li class="reba-item"> <i class="icon-reba"></i>
        <div>
          <h5><?php echo $lang['nc_member_member_vip'];?> <?php echo $output['storeinfo']['card_discount']; ?><?php echo $lang['nc_member_member_discount'];?></h5>
          <p></p>
        </div>
      </li>
      <li class="note">
        <p><?php echo $lang['nc_member_member_instructions'];?>：<?php echo $output['storeinfo']['card_des'];?></p>
      </li>
    </ul>
  </div>
  <div class="hy-btn-box">
  <span class="hyq-btn"><a class="hy-txt" title="<?php echo $lang['nc_card_apply_yes'];?>" href="javascript:void(0);" id="hy-txt"><?php echo $lang['nc_card_apply_yes'];?></a></span>
  <!--
  <span class="hyx-btn"><a class="hyx-txt" title="<?php echo $lang['nc_card_apply_cancel'];?>" href="javascript:void(0);" id="ht_cancel"><?php echo $lang['nc_card_apply_cancel'];?></a></span>-->
  </div>
</div>
</body>
</html>