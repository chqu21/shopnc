<div class="mainbox setup_box setup-com">
<div class="hd"><h3>评论管理</h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<select name="s_type">
<option value="comment" <?php if($_GET['s_type'] == 'comment'){ ?>selected<?php } ?>>评价内容</option>
<option value="store_name" <?php if($_GET['s_type'] == 'store_name'){ ?>selected<?php } ?>>商户名称</option>
</select>
<input type="text" value="<?php echo $_GET['s_content']; ?>" id="s_content" class="input_plain c2 focus" name="s_content" style="width:200px">
<label class="submit-border"><input type="button" value="搜索" style="cursor:pointer" id="search"  class="submit"/></label>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th><?php echo $lang['nc_member_comment_store_name'];?></th>
			<th><?php echo $lang['nc_member_comment_person_cost'];?></th>
			<th>停车</th>
			<th><?php echo $lang['nc_member_comment_content'];?></th>
			<th>发布时间</th>
			<th><?php echo $lang['nc_op'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
			<td><span class="font1"><?php echo $val['person_cost'];?></span> 元</td>
			<td><span class="font2"><?php echo $val['parking'];?></span></td>
			<td><?php if(mb_strlen($val['comment'],'utf-8')>20){ echo mb_substr($val['comment'],0,20,'utf-8').'...'; }else{ echo $val['comment'];}?></td>
			<td><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></td>
			<td><a href="javascript:if(confirm('确认删除吗？'))window.location.href='index.php?act=memberaccount&op=dropcomment&comment_id=<?php echo $val['comment_id'];?>';"><?php echo $lang['nc_del'];?></a></td>
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