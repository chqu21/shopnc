<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storelist&state=2" ><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_admin_create_shop'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=3"><span><?php echo $lang['nc_close_store'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" action="index.php?act=store&op=applycheck">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="account"><?php echo $lang['nc_admin_store_account'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="account" name="account" class="txt"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="password"><?php echo $lang['nc_admin_store_password'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="password" id="password" name="password" class="txt"></td>
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
        	account : {
                required : true,
				remote	: {
                    url :'index.php?act=store&op=checkaccount',
                    type:'get',
                    data:{
                    	admin_name : function(){
                            return $('#account').val();
                        }
                    }
                }
            },
            password : {
                required : true
            }
        },
        messages : {
        	account : {
                required : '<?php echo $lang['nc_store_account_is_not_null'];?>',
                remote : '<?php echo $lang['nc_store_account_is_exists'];?>'
            },
            password : {
                required : '<?php echo $lang['nc_store_password_is_not_null'];?>'
            }
        }
	});
});
</script> 
