<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>退款管理</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=groupbuy&op=groupbuyrefund"><span>管理</span></a></li>
		<li><a href="javascript:void(0);" class="current"><span>审核</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name='form1'>
    <table class="table tb-type2">
      <tbody>     
        <tr>
          <td colspan="2" class="required">订单号:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['refund']['order_sn'];?></td>
        </tr>
		<tr>
          <td colspan="2" class="required">会员名称:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['refund']['member_name'];?></td>
        </tr>
		<tr>
          <td colspan="2" class="required">店铺名称:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['refund']['store_name'];?></td>
        </tr>
		<tr>
          <td colspan="2" class="required">团购名称:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order']['item_name'];?></td>
        </tr>
		<tr>
          <td colspan="2" class="required">退款金额:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['refund']['refund_price'];?></td>
        </tr>
		<tr>
          <td colspan="2" class="required">团购券:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php
				if(!empty($output['order_pwd'])){
					foreach($output['order_pwd'] as $order_pwd){
						echo $order_pwd['order_pwd'].'<br>';
					}
				}	
			?>
		  </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2">
          	<input type="hidden" name="refund_id" value="<?php echo $output['refund']['refund_id'];?>">
			<input type="hidden" name="is_refund" value="">
          	<a href="JavaScript:void(0);" class="btn" onclick="javascript:refundform('2');"><span>退款</span></a>
			<a href="JavaScript:void(0);" class="btn" onclick="javascript:refundform('3');"><span>拒绝</span></a>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script type="text/javascript">
	function refundform(refund){
		
		$("input[name=is_refund]").val(refund);
		$('form').submit();
		
	}

</script>

