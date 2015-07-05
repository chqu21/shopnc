<?php defined('InShopNC') or exit('Access Invalid!'); ?>
<div class="mainbox setup_box setup-com">
<div class="hd"><h3>我的会员卡</h3></div>
<div class="con">
<div class="form_table">
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th>卡号</th>
			<th>店铺名称</th>
			<th>消费总额</th>
			<th>状态</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><?php echo $val['card_number']; ?></td>
			<td><?php echo $val['store_name']; ?></td>
			<td><span class="font1"><?php echo $val['total_price']; ?></span>元</td>
			<td><?php echo $val['is_use']==1?'未开启':'已激活'; ?></td>
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