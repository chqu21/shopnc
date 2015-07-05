<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>会员管理</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=member&op=member"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span>重置密码</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post">
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="passwd">新密码：</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="passwd" id="passwd" class="txt"></td>
          <td class="vatop tips">请填写会员新密码</td>
        </tr>   
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2">
			<input type="hidden" name="member_id" value="<?php echo $output['member_id'];?>">
			<a id="submit" href="javascript:void(0)" class="btn"><span><?php echo $lang['nc_save'];?></span></a>
		  </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
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
            passwd: {
                required : true
            }
        },
        messages : {
            passwd: {
                required : '密码不能为空'
            }
        }
    });
});
</script> 
