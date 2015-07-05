<?php defined('InShopNC') or exit('Access Invalid!');?>
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
    } else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}

function submit_delete(id){
    if(confirm('<?php echo $lang['nc_admin_goods_operation'];?>')) {
        $('#list_form').attr('method','post');
       	$('#list_form').attr('action','index.php?act=goods&op=delgoods');
        
        $('#goods_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_goods_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>商品名称</th>
          <td><input type="text" value="<?php echo $output['goods_name'];?>" name="goods_name" class="txt" ></td>
          <th>店铺名称</th>
          <td><input type="text" value="<?php echo $output['store_name'];?>" name="store_name" class="txt" ></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <!-- 操作说明 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        	<ul>
            	<li><?php echo $lang['nc_admin_goods_help'];?></li>
            	<li><?php echo $lang['nc_admin_goods_help1'];?></li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="goods_id" name="goods_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th><?php echo $lang['nc_admin_goods_name'];?></th>
		  <th><?php echo $lang['nc_admin_goods_price'];?></th>
		  <th><?php echo $lang['nc_admin_goods_store_name'];?></th>
		  <th><?php echo $lang['nc_admin_goods_add_time'];?></th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><input type="checkbox" value="<?php echo $val['goods_id'];?>" class="checkitem"></td>
          <td><?php echo $val['goods_name'];?></td>
		  <td><?php echo $val['goods_price'];?></td>
		  <td><?php echo $val['store_name'];?></td>
		  <td><?php echo date("Y-m-d",$val['add_time']);?></td>
		  <td class='align-center'>
		  	<a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=goods&op=delgoods&goods_id=<?php echo $val['goods_id'];?>';"><?php echo $lang['nc_del'];?></a>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['list']) && is_array($output['list'])){?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15">
          	<span class="all_checkbox">
            	<label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            	<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            </span>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
