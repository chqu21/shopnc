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
    }  
    else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}
function submit_delete(id){
    if(confirm('<?php echo $lang['nc_ensure_del'];?>')) {
        $('#list_form').attr('method','post');
        $('#list_form').attr('action','index.php?act=member&op=drop');
        $('#member_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_groupbuy_manage'];?></h3>
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
          <td>
			  <select name='s_type'>
				<option value="order_sn" <?php if($output['s_type']=='order_sn'){ ?>selected<?php } ?>>订单编号</option>
				<option value="member_name" <?php if($output['s_type']=='member_name'){ ?>selected<?php } ?>>会员名称</option>
				<option value="store_name" <?php if($output['s_type']=='store_name'){ ?>selected<?php } ?>>商铺名称</option>
				<option value="item_name" <?php if($output['s_type']=='item_name'){ ?>selected<?php } ?>>团购名称</option>
			  </select>
          </td>
          <td><input type="text" value="<?php echo $output['s_content'];?>" name="s_content" class="txt" ></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <!-- 操作说明 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg">
	        <div class="title">
	            <h5><?php echo $lang['nc_prompts'];?></h5>
	            <span class="arrow"></span>
	        </div>
        </th>
      </tr>
      <tr>
        <td>
		  <ul>
            <li><?php echo $lang['nc_admin_groupbuyorder_help'];?></li>
            <li><?php echo $lang['nc_admin_groupbuyorder_help1'];?></li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="member_id" name="member_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200"><?php echo $lang['nc_admin_order_sn'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_member_name'];?></th>
		  <th class="w120"><?php echo $lang['nc_admin_store_name'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_store_add_time'];?></th>
		  <th class="w200">团购名称</th>
          <th class="w48"><?php echo $lang['nc_admin_store_number'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_price'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_state'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><?php echo $val['order_sn'];?></td>
		  <td><?php echo $val['member_name'];?></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo date("Y-m-d",$val['add_time']);?></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $val['item_id']; ?>" target="_blank"><?php echo $val['item_name'];?></a></td>
		  <td><?php echo $val['number'];?></td>
		  <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['price'];?></span>元</td>
		  <td>
		  	<?php 
		  		if($val['state'] == 1){
		  			echo $lang['nc_admin_state_not_payment'];
		  		}elseif($val['state'] == 2){
		  			echo $lang['nc_admin_state_already_payment'];
		  		}else{
		  			echo $lang['nc_admin_state_consume'];
		  		}
		  	?>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td></td>
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
