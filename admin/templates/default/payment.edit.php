<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_payment_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=payment&op=payment"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_edit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><?php echo $lang['nc_admin_payment_name'];?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['payment']['payment_name'];?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_payment_alipay_account'];?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <input type="hidden" name="config_name" value="alipay_service,alipay_account,alipay_key,alipay_partner" />
          	<input type="hidden" name="alipay_service" value="create_direct_pay_by_user" />
            <input name="alipay_account" id="alipay_account" value="<?php echo $output['config_array']['alipay_account'];?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_payment_alipay_key'];?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="alipay_key" id="alipay_key" value="<?php echo $output['config_array']['alipay_key'];?>" class="txt" type="text"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_payment_alipay_partner'];?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input name="alipay_partner" id="alipay_partner" value="<?php echo $output['config_array']['alipay_partner'];?>" class="txt" type="text"></td>
          <td class="vatop tips"><a href="https://b.alipay.com/order/pidKey.htm?pid=2088001525694587&product=fastpay" target="_blank">get my key and partner ID</a></td>
        </tr>
       	<tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_payment_use'];?>: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="payment_state1" class="cb-enable <?php if($output['payment']['payment_state'] == '1'){ ?>selected<?php } ?>" ><span><?php echo $lang['nc_yes'];?></span></label>
            <label for="payment_state2" class="cb-disable <?php if($output['payment']['payment_state'] == '2'){ ?>selected<?php } ?>" ><span><?php echo $lang['nc_no'];?></span></label>
            <input type="radio" <?php if($output['payment']['payment_state'] == '1'){ ?>checked="checked"<?php }?> value="1" name="payment_state" id="payment_state1">
            <input type="radio" <?php if($output['payment']['payment_state'] == '2'){ ?>checked="checked"<?php }?> value="2" name="payment_state" id="payment_state2"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2">
          	<input type="hidden" name="payment_id" value="<?php echo $output['payment']['payment_id'];?>" />
          	<a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_save'];?></span></a>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表
$(function(){$("#submitBtn").click(function(){
    if($("#add_form").valid()){
     $("#add_form").submit();
	}
	});
});
//
function selectAll(name){
    if($('#'+name).attr('checked') == true) {
        $('.'+name).attr('checked',true);
    }
    else {
        $('.'+name).attr('checked',false);
    }
}
$(document).ready(function(){
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            admin_password : {
                required : true,
				minlength: 6,
				maxlength: 20
            },
			admin_confirm_password:{
				required: true,	
				equalTo:'#admin_password'
			}
        },
        messages : {
            admin_password : {
                required : '<?php echo $lang['nc_admin_admin_password_is_not_null'];?>',
				minlength: '<?php echo $lang['nc_admin_admin_password_range'];?>',
				maxlength: '<?php echo $lang['nc_admin_admin_password_range'];?>'
            },
			admin_confirm_password:{
				required: '<?php echo $lang['nc_admin_password_confirm_is_not_null']?>',
				equalTo:'<?php echo $lang['nc_admin_password_confirm'];?>'
			}
			
        }
	});
});
</script> 
