<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>积分商城</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=gift&op=gift_manage" class=""><span>礼品管理</span></a></li>
        <li><a href="index.php?act=gift&op=gift_add" class=""><span>新增礼品</span></a></li>
        <li><a href="index.php?act=gift&op=gift_log" class=""><span>订单管理</span></a></li>
        <li><a href="javascript:void(0);" class="current"><span>订单详情</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
    <table class="table tb-type2">
      <tbody>
      	<tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">订单编号</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_sn']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">礼品名称</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['sg_name']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">会员名</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['member_name']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">礼品名称</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['sg_name']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">兑换数量</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_num']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">礼品积分</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_unit_point']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">总积分</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_total_point']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">收货地址</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_address']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">收货人</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_contact']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">电话</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_phone']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">邮编</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_zipcode']; ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">下单时间</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo date('Y-m-d H:i:s',$output['order_info']['go_add_time']); ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">最后状态变更</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo date('Y-m-d H:i:s',$output['order_info']['go_change_time']); ?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="" for="sg_name">订单状态</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['order_info']['go_state']==1?'已下单':($output['order_info']['go_state']==2?'已发货':'已收货'); ?></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <?php if($output['order_info']['go_state'] == 1){ ?>
      <tfoot>
        <tr>
          <td colspan="2"><a id="submit" href="javascript:if(confirm('确认发货吗？'))window.location='index.php?act=gift&op=order_ship&go_id=<?php echo $output['order_info']['go_id']; ?>';" class="btn"><span>确认发货</span></a></td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
</div>
<script>
$(function(){
	$("#sg_pic").change(function(){
        $("#textfield1").val($("#sg_pic").val());
    });
	$("#submit").click(function(){
        $("#add_form").submit();
    });
	$('#add_form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
        	sg_name: {
                required : true
            },
            sg_point: {
                required : true
            },
            sg_num: {
                required : true
            }
            
        },
        messages : {
        	sg_name: {
                required : "请填写礼品名称"
            },
            sg_point: {
                required : "请填写兑换所需积分"
            },
            sg_num: {
                required : "请填写礼品库存数量"
            }
        }
    });
})
</script>