<div class="mainbox setup_box setup-com">
<div class="hd"><h3><?php echo $lang['nc_member_coupon_manage'];?></h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<label>优惠券名称：</label>
<input type="text" value="<?php echo $_GET['s_content']; ?>" id="s_content" class="input_plain c2 focus" name="s_content" style="width:200px">
<label class="submit-border"><input type="button" value="搜索" style="cursor:pointer" id="search" class="submit"/></label>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th><?php echo $lang['nc_member_coupon_name'];?></th>
			<th><?php echo $lang['nc_member_download_type'];?></th>
			<th><?php echo $lang['nc_member_download_time'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><a href="index.php?act=coupon&op=detail&coupon_id=<?php echo $val['coupon_id'];?>" target="_blank"><?php echo $val['coupon_name'];?></a></td>
			<td><?php if($val['download_type'] == 1){ echo $lang['nc_member_download_type_print'];}else{ echo $lang['nc_member_download_type_message'];}?></td>
			<td><?php echo date("Y-m-d H:i",$val['download_time']);?></td>
		</tr>
		<?php }?>
		<?php }else{?>
		<tr>
			<td colspan='20' height="100" style="text-align:center; vertical-align:central;">暂无相关记录</td>
		</tr>
		<?php }?>
	</tbody>
</table>
<div class="page_box"> <?php echo $output['show_page'];?></div>
</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('#search').click(function(){
		var s_content = $('#s_content').val();
		window.location.href = 'index.php?act=membercoupon&op=list&s_content='+s_content;
	});
})
</script>