<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php require BASE_TPL_PATH.'/layout/top.php';?>
<script type="text/javascript">
<?php if (!empty($output['url'])){?>
	window.setTimeout("javascript:location.href='<?php echo $output['url'];?>'", <?php echo $time;?>);
<?php }else{ ?>
	window.setTimeout("javascript:history.back()", <?php echo $time;?>);
<?php }?>
</script>
<div class="life_body">
  <div id="main-wrap">
    <div class="group-msg-box clearfix">
      <div class="group-msg ">
      	<?php if($output['msg_type'] == 'succ'){?>
      	<i class="ok-msg"></i>
      	<?php }else{?>
      	<i class="error-msg"></i>
      	<?php }?>
      	<span><?php echo $output['msg'];?></span>
      </div>
    </div>
  </div>
</div>
<?php require BASE_TPL_PATH.'/layout/footer.php';?>
