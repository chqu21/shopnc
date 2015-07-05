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
      <h3>退款管理</h3>
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
            <li>退款管理显示订单号、店铺名称、会员名称、退款金额、状态</li>
			<li>对会员申请退款项进行审核</li>
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
          <th class="w200">订单号</th>
		  <th class="w120">店铺名称</th>
		  <th class="w120">会员名称</th>
		  <th class="w48">退款金额</th>
		  <th class="w48">状态</th>
		  <th class="w48">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><?php echo $val['order_sn'];?></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo $val['member_name'];?></td>
		  <td><?php echo $val['refund_price'];?></td>
		  <td><?php if($val['audit']==1){ echo '待审核';}elseif($val['audit']==2){ echo '审核通过';}elseif($val['audit']==3){ echo '审核不通过';}?></td>
		  <td>
			<?php if($val['audit']==1){?>
			<a href="index.php?act=groupbuy&op=refundaudit&refund_id=<?php echo $val['refund_id'];?>">审核</a>
			<?php }else{?>
			已审核
			<?php }?>
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
