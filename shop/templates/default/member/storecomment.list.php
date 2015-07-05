<script type="text/javascript">
function submit_delete_batch(){
    /* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if(items != '') {
        items = items.substr(0, (items.length - 1));
        submit_delete(items);
    }  
    else {
        alert('<?php echo $lang['nc_member_store_select_items'];?>');
    }
}

function submit_delete(id){
    if(confirm('<?php echo $lang['nc_member_store_confirm_delete'];?>')) {
        $('#list_form').attr('method','post');
		$('#list_form').attr('action','index.php?act=storecomment&op=del_comment');
        $('#comment_id').val(id);
        $('#list_form').submit();
    }
}

</script>
<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3>评论管理</h3>
      </div>
    </div>
	<div class="con—box-search">
    <form method="post">
      <span class="tit-hd" id="">评论内容：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="comment" value="<?php echo $output['comment'];?>">
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">
	  <form id="list_form" method='post'>
	  <input id="comment_id" name="comment_id" type="hidden" />
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_comment_store_name'];?></th>
            <th class="w65" scope="col"><?php echo $lang['nc_member_store_comment_member_name'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_store_comment_comment'];?></th>
            <th class="w70" scope="col"><?php echo $lang['nc_member_store_comment_add_time'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_member_store_comment_person_cost'];?></th>
			<th class="w50" scope="col"><?php echo $lang['nc_member_store_comment_parking'];?></th>
			<th class="w50" scope="col"><?php echo $lang['nc_member_store_comment_amount_score'];?></th>
			<th class="w50" scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td><?php echo $val['store_name'];?></td>
            <td><?php echo $val['member_name'];?></td>
            <td><a href="index.php?act=store&op=detail&id=<?php echo $_SESSION['store_id'];?>"><?php if(mb_strlen($val['comment'],'utf-8')>20){ echo mb_substr($val['comment'],0,20,'utf-8').'...'; }else{ echo $val['comment'];}?></a></td>
            <td><?php echo date("Y-m-d H:i",$val['add_time']);?></td>
            <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['person_cost'];?></span>元</td>
			<td><?php echo $val['parking'];?></td>
			<td><?php echo $val['amount_score'];?></td>
			<td><a href="index.php?act=storecomment&op=explain&comment_id=<?php echo $val['comment_id'];?>" style="color:#E64D5E">解释说明</a></td>
          </tr>
		  <?php }?>
		  <?php }else{?>
		  <tr>
			<td colspan="20" class="norecord"><i>&nbsp;</i><?php echo $lang['nc_record'];?></td>
		  </tr>
		  <?php }?>
        </tbody>
      </table>
      </form>
    </div>
        <div class="cb_bg">
        <div class="cb_bg_l">
  	    </div>
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
