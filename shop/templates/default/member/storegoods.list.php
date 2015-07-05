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
        alert('请选择要删除的商品');
    }
}

function submit_delete(id){
    if(confirm('<?php echo $lang['nc_member_store_goods_sure_delete'];?>')) {
        $('#list_form').attr('method','post');
		$('#list_form').attr('action','index.php?act=storegoods&op=del_goods');
        $('#goods_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_store_goods_manage'];?></h3>
      </div>
    </div>
    <div class="con—box-search">
    <form method="post">
      <input type="button" onclick="javascript:location.href = 'index.php?act=storegoods&op=addgoods';" value="<?php echo $lang['nc_member_store_goods_add_goods'];?>" class="tgyz">
      <span class="tit-hd" id="">商品名称：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="goods_name" value="<?php echo $output['goods_name'];?>">
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
	<form id="list_form" method='post'>
	<input id="goods_id" name="goods_id" type="hidden" />
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_goods_name'];?></th>
            <th class="w65" scope="col"><?php echo $lang['nc_member_store_goods_price'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_store_goods_add_time'];?></th>
			<th class="w50" scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center"><input type="checkbox" value="<?php echo $val['goods_id'];?>" class="checkitem"></td>
            <td><?php echo $val['goods_name'];?></td>
            <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['goods_price'];?></span>元</td>
            <td><?php echo date("Y-m-d H:i:s",$val['add_time']);?></td>
			<td>
				<a href="index.php?act=storegoods&op=edit_goods&goods_id=<?php echo $val['goods_id'];?>"><?php echo $lang['nc_edit'];?></a>&nbsp;|&nbsp;
				<a href="javascript:if(confirm('确认删除吗？'))window.location.href='index.php?act=storegoods&op=del_goods&goods_id=<?php echo $val['goods_id'];?>';"><?php echo $lang['nc_delete'];?></a>
			</td>
          </tr>
		  <?php }?>
		  <?php }else{?>
		  <tr>
			<td colspan="20" class="norecord"><i>&nbsp;</i><?php echo $lang['nc_record'];?></td>
		  </tr>
		  <?php }?>
        </tbody>
      </table>
    </div>
    <div class="cb_bg">
    	<div class="cb_bg_l">
        	<input class="checkbox checkall"  type="checkbox">全选
      		<input type="button" style="padding-left:22px; margin-left:10px;" class="input_delete"  onclick="javascript:submit_delete_batch();" value="删除" name="">
  		</div>
   		<div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
    </form>
  </div>
</div>
