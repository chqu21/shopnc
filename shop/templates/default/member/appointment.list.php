<div class="mainbox setup_box setup-com">
<div class="hd"><h3><?php echo $lang['nc_member_appointment_manage'];?></h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<label>商户名称：</label>
<input type="text" value="<?php echo $_GET['s_content']; ?>" id="s_content" class="input_plain c2 focus" name="s_content" style="width:200px">
<label class="submit-border"><input type="button" value="搜索" style="cursor:pointer" id="search" class="submit"/></label>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<tr>
			<th><?php echo $lang['nc_member_store_name'];?></th>
            <th><?php echo $lang['nc_member_appointtime'];?></th>
			<th><?php echo $lang['nc_member_appoint_person_num'];?></th>			
			<th><?php echo $lang['nc_member_appoint_person'];?></th>
			<th><?php echo $lang['nc_member_appoint_phone'];?></th>
			<th><?php echo $lang['nc_op'];?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<tr>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a>&nbsp;<?php if($val['type'] == 2){ echo "<font color=\"#FF0000\">[".$lang['nc_member_order_type_group']."]</font>";}?></td>
			<td><?php echo date("Y-m-d H:i:s",$val['appointtime']);?></td>
            <td><?php echo $val['person_num'];?></td>
			<td><?php echo $val['contact'];?></td>
			<td><?php echo $val['mobile'];?></td>
			<td>				
				<a href="index.php?act=memberappointment&op=appointdetail&appoint_id=<?php echo $val['id'];?>"><?php echo $lang['nc_more_info'];?></a>
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
		window.location.href = 'index.php?act=memberappointment&op=list&s_content='+s_content;
	});
})
</script>