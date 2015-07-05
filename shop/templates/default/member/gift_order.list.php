<div class="mainbox setup_box setup-com">
<div class="hd"><h3>积分兑换</h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<select name="s_type">
<option value="sg_name" <?php if($_GET['s_type'] == 'sg_name'){ ?>selected<?php } ?>>礼品名称</option>
<option value="go_sn" <?php if($_GET['s_type'] == 'go_sn'){ ?>selected<?php } ?>>订单编号</option>
</select>
<input type="text" value="<?php echo $_GET['s_content']; ?>" id="s_content" class="input_plain c2 focus" name="s_content" style="width:200px">
<select name="s_state">
<option value="" <?php if($_GET['s_state'] == ''){ ?>selected<?php } ?>>全部订单</option>
<option value="1" <?php if(intval($_GET['s_state']) == 1){ ?>selected<?php } ?>>已下单</option>
<option value="2" <?php if(intval($_GET['s_state']) == 2){ ?>selected<?php } ?>>已发货</option>
<option value="3" <?php if(intval($_GET['s_state']) == 3){ ?>selected<?php } ?>>已收货</option>
</select>
<label class="submit-border"><input type="button" value="搜索" style="cursor:pointer" id="search" class="submit"/></label>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th>订单编号</th>
			<th>礼品名称</th>
			<th>兑换数量</th>
			<th>消耗积分</th>
			<th>下单时间</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['gift_order_list'])){?>
		<?php foreach($output['gift_order_list'] as $val){?>
		<tr>
			<td><?php echo $val['go_sn'];?></td>
			<td><a href="index.php?act=gift&op=detail&sg_id=<?php echo $val['sg_id']; ?>" target="_blank"><?php echo $val['sg_name'];?></a></td>
			<td><?php echo $val['go_num'];?></td>
			<td><span class="font1"><?php echo $val['go_total_point'];?></span></td>
			<td><?php echo date('Y-m-d H:i:s',$val['go_add_time']); ?></td>
			<td><?php echo $val['go_state']==1?'已下单':($val['go_state']==2?'已发货':'已收货'); ?></td>
			<td><?php if($val['go_state'] == 2){ ?><a href="javascript:if(confirm('确认收货吗？'))window.location='index.php?act=memberaccount&op=gift_receive&go_id=<?php echo $val['go_id']; ?>';">确认收货</a><?php } ?></td>
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
		window.location.href = 'index.php?act=memberaccount&op=giftorder&s_type='+s_type+'&s_content='+s_content+'&s_state='+s_state;
	});
})
</script>