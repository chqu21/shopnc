<div class="mainbox setup_box setup-com">
<div class="hd"><h3><?php echo $lang['nc_member_order_pwd'];?></h3></div>
<div class="con">
<div class="form_table">
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th><?php echo $lang['nc_member_item_name'];?></th>
			<th><?php echo $lang['nc_member_order_pwd'];?></th>
			<th><?php echo $lang['nc_member_order_time'];?></th>
			<th><?php echo $lang['nc_member_state'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['order'])){?>
		<?php foreach($output['order'] as $val){?>
		<tr>
			<td><?php echo $val['item_name'];?></td>
			<td><?php echo $val['order_pwd'];?></td>
			<td><?php echo date("Y-m-d H:i",$val['add_time']);?></td>
			<td>
				<?php if($val['state'] == 1){?>
				<?php echo $lang['nc_member_order_pwd_is_no_use'];?>
				<?php }elseif($val['state'] == 2){?>
				<?php echo date("Y-m-d H:i:s",$val['use_time']); ?>&nbsp;&nbsp;
				<?php echo $lang['nc_member_order_pwd_is_use'];?>
				<?php }else{?>
				<?php echo '已锁定';?>
				<?php }?>
			</td>
		</tr>
		<?php }?>
		<?php }else{?>
		<tr>
			<td colspan='20' height="100" style="text-align:center; vertical-align:central;"><?php echo $lang['no_record'];?></td>
		</tr>
		<?php }?>
	</tbody>
</table>
<div class="page_box"> <?php echo $output['show_page'];?></div>
</div>
</div>
</div>