<div class="mainbox setup_box setup-com">
<div class="hd"><h3>我的退款</h3></div>
<div class="con">
<div class="form_table">
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th><?php echo $lang['nc_member_order_sn'];?></th>
			<th><?php echo $lang['nc_member_store_name'];?></th>
			<th>退款金额</th>
			<th>退款状态</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><?php echo $val['order_sn'];?></td>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
			<td><?php echo $val['refund_price'];?></td>
			<td><?php if($val['audit']==1){ echo '待审核';}elseif($val['audit']==2){ echo '审核通过';}elseif($val['audit']==3){ echo '审核不通过';}?></td>
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
		var s_type = $('select[name="s_type"]').val();
		var s_state = $('select[name="s_state"]').val();
		window.location.href = 'index.php?act=memberorder&op=list&s_type='+s_type+'&s_content='+s_content+'&s_state='+s_state;
	});
})
</script>