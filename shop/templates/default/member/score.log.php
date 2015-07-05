<div class="mainbox setup_box setup-com">
<div class="hd"><h3>我的积分</h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<select id="s_state">
<option value="" <?php if($_GET['s_state'] == ''){ ?>selected<?php } ?>>全部</option>
<option value="1" <?php if(intval($_GET['s_state']) == 1){ ?>selected<?php } ?>>贡献值</option>
<option value="2" <?php if(intval($_GET['s_state']) == 2){ ?>selected<?php } ?>>积分</option>
</select>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th>类型</th>
			<th>分值变动</th>
			<th>当前总分</th>
			<th>变更时间</th>
			<th>变更说明</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['score_log'])){?>
		<?php foreach($output['score_log'] as $val){?>
		<tr>
			<td><?php echo $val['pl_type']==1?'贡献值':'积分';?></td>
			<td><?php echo $val['pl_change_score'];?></td>
			<td><?php echo $val['pl_total_score'];?></td>
			<td><?php echo date('Y-m-d H:i:s',$val['pl_time']);?></td>
			<td><?php echo $val['pl_note'];?></td>
		</tr>
		<?php }?>
		<?php }else{?>
		<tr>
			<td colspan='20' height="100" style="text-align:center; vertical-align:central;">暂无相关数据</td>
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
	$('#s_state').change(function(){
		var s_state = $(this).val();
		window.location.href = 'index.php?act=memberaccount&op=scorelog&s_state='+s_state;
	});
})
</script>