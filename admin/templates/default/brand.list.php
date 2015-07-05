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
      <h3><?php echo $lang['nc_admin_brand_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=brand&op=addbrand"><span><?php echo $lang['nc_add']?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
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
          <th><?php echo $lang['nc_admin_brand_name'];?></th>
		  <th><?php echo $lang['nc_admin_brand_sort'];?></th>
		  <th><?php echo $lang['nc_admin_brand_des'];?></th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td><?php echo $val['brand_name'];?></td>
		  <td><?php echo $val['brand_sort'];?></td>
		  <td><?php echo $val['brand_des'];?></td>
		  <td class='align-center'>
		  	<a href="index.php?act=brand&op=brandedit&brand_id=<?php echo $val['brand_id'];?>"><?php echo $lang['nc_edit'];?></a>
		  	&nbsp;|&nbsp;
		  	<a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=brand&op=branddel&brand_id=<?php echo $val['brand_id'];?>';"><?php echo $lang['nc_del'];?></a>
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
          <td>
          	<input type="checkbox" class="checkall" id="checkall_1">
          	<span class="all_checkbox">
            	<label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            	<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            </span>
          </td>
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
