<div class="mainbox setup_box setup-com">
<div class="hd"><h3>订单管理</h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<select name="s_type">
<option value="store_name" <?php if($_GET['s_type'] == 'store_name'){ ?>selected<?php } ?>>商户名称</option>
<option value="item_name" <?php if($_GET['s_type'] == 'item_name'){ ?>selected<?php } ?>>团购名称</option>
</select>
<input type="text" value="<?php echo $_GET['s_content']; ?>" id="s_content" class="input_plain c2 focus" name="s_content" style="width:200px">
<select name="s_state">
<option value="" <?php if($_GET['s_state'] == ''){ ?>selected<?php } ?>>全部订单</option>
<option value="1" <?php if(intval($_GET['s_state']) == 1){ ?>selected<?php } ?>>未支付</option>
<option value="2" <?php if(intval($_GET['s_state']) == 2){ ?>selected<?php } ?>>已支付</option>
<option value="3" <?php if(intval($_GET['s_state']) == 3){ ?>selected<?php } ?>>已消费</option>
<option value="4" <?php if(intval($_GET['s_state']) == 4){ ?>selected<?php } ?>>已退款</option>
</select>
<label class="submit-border"><input type="button" value="搜索" style="cursor:pointer" id="search" class="submit"/></label>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th width="10%"><?php echo $lang['nc_member_order_sn'];?></th>
			<th ><?php echo $lang['nc_member_store_name'];?></th>
			<th width="5%"><?php echo $lang['nc_member_order_type'];?></th>
			<th width="20%"><?php echo $lang['nc_member_item_name'];?></th>
			<th width="6%"><?php echo $lang['nc_member_number'];?></th>
			<th width="10%"><?php echo $lang['nc_member_price'];?></th>
			<th width="10%"><?php echo $lang['nc_member_state'];?></th>
			<th><?php echo $lang['nc_op'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><?php echo $val['order_sn'];?></td>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
			<td><?php if($val['order_type'] == 1){ echo '团购';}?></td>
			<td><a href="<?php if($val['order_type'] == 1){ ?>index.php?act=groupbuy&op=detail&group_id=<?php echo $val['item_id']; ?><?php } ?>" target="_blank"><?php echo $val['item_name'];?></a></td>
			<td><?php echo $val['number'];?></td>
			<td><span class="font1"><?php echo $val['price'];?></span> 元</td>
			<td>
			<?php if($val['state'] == 1){ echo '未支付';}elseif($val['state'] == 2){ echo '已支付';}elseif($val['state']==3){ echo '已消费';}else{ echo '已退款';}?>
			<?php if($val['state'] == 1){?>
			<a href="index.php?act=groupbuy&op=grouppayment&order_id=<?php echo $val['order_id'];?>">[支付]</a>
			<?php }?>
			</td>
			<td>
				<?php if($val['state']==2 || $val['state']==3){?>
				<a href="index.php?act=memberorder&op=orderdetail&order_id=<?php echo $val['order_id'];?>">详情</a>
				<?php }?>
				<?php if($val['state'] == 2){?>
				
				<?php if($val['end_time']<time()){?>
				<a href="index.php?act=memberorder&op=orderrefund&order_id=<?php echo $val['order_id'];?>">申请退款</a>
				<?php }else{?>
				<?php if($val['is_refund']==1){?>
				<a href="index.php?act=memberorder&op=orderrefund&order_id=<?php echo $val['order_id'];?>">申请退款</a>
				<?php }?>
				<?php }?>
				<a href="index.php?act=memberorder&op=sendmessage&order_id=<?php echo $val['order_id'];?>">发送短信</a>
				<?php }?>
				<?php if($val['state']==1){?>
				<a href="index.php?act=memberorder&op=cancleorder&order_id=<?php echo $val['order_id'];?>">取消</a>
				<?php }?>
			</td>
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