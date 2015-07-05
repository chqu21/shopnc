<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_admin_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=admin&op=admin_list"><span><?php echo $lang['nc_manage'];?></span></a></li>
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
          <td colspan="2" class="required"><label class="validation" for="admin_name"><?php echo $lang['nc_admin_admin_name'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['admininfo']['admin_name'];?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="admin_password"><?php echo $lang['nc_admin_admin_password'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="admin_password" name="admin_password" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label class="validation" for="admin_password"><?php echo $lang['nc_admin_admin_confirm_password'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="admin_confirm_password" name="admin_confirm_password" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2">
          	<input type='hidden' name='admin_id' value="<?php echo $output['admininfo']['admin_id'];?>">
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
