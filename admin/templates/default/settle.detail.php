<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
function ajax_settle(){
	$.getJSON('index.php?act=settle&op=ajax_settle', function(result){
        if(result.done){
            alert('结算操作已完成');
            window.location.href='index.php?act=settle&op=settle_manage';
        }else{
        	alert(result.msg);
        }
    });
}
</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>结算管理</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=settle&op=settle_manage"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="javascript:void(0);" class="current"><span>结算单明细</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>商户名称：</th>
          <td><span style="font-weight:bold;font-size:16px"><?php echo $output['settle_info']['store_name']; ?></span></td>
          <th>结算日期：</th>
          <td><span style="font-weight:bold;font-size:16px"><?php echo date('Y-m-d',$output['settle_info']['date_start']); ?>至<?php echo date('Y-m-d',$output['settle_info']['date_end']); ?></span></td>
          <th>订单总额：</th>
          <td><span style="font-weight:bold;font-size:16px"><?php echo $output['settle_info']['amount']; ?>元</span></td>
          <th>结算金额：</th>
          <td><span style="font-weight:bold;font-size:16px"><?php echo $output['settle_info']['final_pay']; ?>元</span></td>
        </tr>
      </tbody>
    </table>
  </form>
  <form id="list_form" method='post'>
    <input id="class_id" name="class_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200">订单编号</th>
          <th class="w200">用户名称</th>
		  <th class="w200">团购名称</th>
		  <th class="w200">下单时间</th>
          <th class="w200">消费时间</th>
          <th class="w200">数量</th>
		  <th class="w200">金额(元)</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['order_list']) && is_array($output['order_list'])){ ?>
        <?php foreach($output['order_list'] as $val){ ?>
        <tr class="hover edit">
          <td><?php echo $val['order_sn']; ?></td>
          <td><?php echo $val['member_name']; ?></td>
          <td><?php echo $val['item_name']; ?></td>
          <td><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></td>
          <td><?php echo date('Y-m-d H:i:s',$val['use_time']); ?></td>
          <td><?php echo $val['number']; ?></td>
          <td><?php echo intval($val['price']); ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['order_list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
