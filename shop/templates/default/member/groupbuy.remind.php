<div class="mainbox setup_box setup-com">
<div class="hd"><h3>团购提醒</h3></div>
<div class="con">
<div class="form_table">
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th>店铺名称</th>
			<th>添加时间</th>
			<th><?php echo $lang['nc_op'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><?php echo $val['store_name'];?></td>
			<td><?php echo date("Y-m-d",$val['add_time']);?></td>
			<td><a href="index.php?act=memberaccount&op=delremind&remind_id=<?php echo $val['remind_id'];?>">删除</a></td>
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
		window.location.href = 'index.php?act=memberaccount&op=comment&s_type='+s_type+'&s_content='+s_content;
	});
})
</script>