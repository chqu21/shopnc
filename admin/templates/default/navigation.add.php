<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['navigation_index_nav'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=navigation&op=navigation" ><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="navigation_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['navigation_add_type'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul class="nofloat">
              <li class="left w100pre"><span class="radio">
                <input type="radio" checked="checked" value="0" name="nav_type" id="diy" onclick="showType('diy');">
                <label for="diy"><?php echo $lang['navigation_add_custom'];?></label>
                </span></li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="nav_title"><?php echo $lang['navigation_index_title'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="nav_title" id="" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="" for="nav_title"><?php echo $lang['navigation_index_byname'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="nav_byname" id="" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="nav_url"><?php echo $lang['navigation_index_url'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="http://" name="nav_url" id="" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>
            <label for="type"><?php echo $lang['navigation_index_location'];?>:</label>
            </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <input type="radio" value="0" name="nav_location">
                <label><?php echo $lang['navigation_index_top'];?></label>
              </li>
              <li>
                <input type="radio" value="2" name="nav_location">
                <label><?php echo $lang['navigation_index_bottom'];?></label>
              </li>
            </ul></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>
            <label><?php echo $lang['navigation_index_open_new'];?>:</label>
            </label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="nav_new_open1" class="cb-enable selected" ><span><?php echo $lang['nc_yes'];?></span></label>
            <label for="nav_new_open0" class="cb-disable" ><span><?php echo $lang['nc_no'];?></span></label>
            <input id="nav_new_open1" name="nav_new_open" checked="checked" value="1" type="radio">
            <input id="nav_new_open0" name="nav_new_open" value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="nav_sort"><?php echo $lang['nc_sort'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="255" name="nav_sort" id="" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#navigation_form").valid()){
     $("#navigation_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#navigation_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            nav_title : {
                required : true
            },
            nav_sort:{
               number   : true
            }
        },
        messages : {
            nav_title : {
                required : '<?php echo $lang['navigation_add_partner_null'];?>'
            },
            nav_sort  : {
                number   : '<?php echo $lang['navigation_add_sort_int'];?>'
            }
        }
    });
});

function showType(type){
	$('#goods_class_id').css('display','none');
	$('#article_class_id').css('display','none');
	$('#activity_id').css('display','none');
	if(type == 'diy'){
		$('#nav_url').attr('disabled',false);
	}else{
		$('#nav_url').attr('disabled',true);
		$('#'+type+'_id').show();	
	}
}

</script>