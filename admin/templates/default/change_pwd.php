<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storelist&state=2" ><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=1"><span><?php echo $lang['nc_admin_create_shop'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=3"><span><?php echo $lang['nc_close_store'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span>修改商户密码</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" action="index.php?act=store&op=change_pwd">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="account"><?php echo $lang['nc_admin_store_account'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['member_name']; ?><input type="hidden" name="member_name" value="<?php echo $output['member_name']; ?>" ></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="password">新密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="password" name="password" class="txt"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="re_password">重复新密码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="re_password" name="re_password" class="txt"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_save'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表
$(function(){
	$("#submitBtn").click(function(){
	    if($("#add_form").valid()){
	     $("#add_form").submit();
		}
	});
});
$(document).ready(function(){
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            password : {
                required : true
            },
            re_password : {
                required : true
            }
        },
        messages : {
            password : {
                required : '新密码必须填写'
            },
            re_password : {
            	required : '确认密码必须填写'
            }
        }
	});
});
</script> 
