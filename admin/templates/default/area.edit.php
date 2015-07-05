<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=area&op=arealist"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);" class='current'><span><?php echo $lang['nc_edit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=area&op=area_edit">
	<input type='hidden' name='area_id' value="<?php echo $output['area_info']['area_id'];?>">
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="area_name"><?php echo $lang['nc_admin_area_name'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="area_name" id="area_name" class="txt" value="<?php echo $output['area_info']['area_name'];?>"></td>
          <td class="vatop tips"><?php echo $lang['offline_area_name_error'];?></td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="first_letter"><?php echo $lang['nc_admin_first_letter'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<select name='first_letter'>
				<?php foreach($output['letter'] as $lk=>$lv){?>
				<option value='<?php echo $lv;?>' <?php if($lv==$output['area_info']['first_letter']){ echo 'selected';}?>><?php echo $lv;?></option>
				<?php }?>
			</select>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label for="area_number"><?php echo $lang['nc_admin_area_number'].$lang['nc_colon'];?></label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $output['area_info']['area_number'];?>" name="area_number" id="area_number" class="txt"></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label for="post"><?php echo $lang['nc_admin_post'].$lang['nc_colon'];?></label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $output['area_info']['post'];?>" name="post" id="post" class="txt"></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label for="post">排序<?php echo $lang['nc_colon'];?></label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><input type="text" name="area_sort" id="area_sort" class="txt" value="<?php echo $output['area_info']['area_sort'];?>"></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="area_class"><?php echo $lang['nc_admin_up_area'].$lang['nc_colon'];?></label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['parent_area_name'];?>
		  </td>
        </tr>
        
       	<?php if($output['area_info']['parent_area_id'] == '0'){?>
  		<tr class="noborder">
          <td colspan="2" class="required"><label for="area_class"><?php echo $lang['nc_admin_area_is_hot'].$lang['nc_colon'];?></label></td>
        </tr>    
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="hot1" class="cb-enable <?php if($output['area_info']['hot_city'] == '1'){ echo 'selected';}?>" ><span><?php echo $lang['open'];?></span></label>
            <label for="hot0" class="cb-disable <?php if($output['area_info']['hot_city'] == '0'){ echo 'selected';}?>" ><span><?php echo $lang['close'];?></span></label>
            <input id="hot1" name="is_hot"  value="1" type="radio">
            <input id="hot0" name="is_hot"  checked="checked" value="0" type="radio">
          </td>
        </tr>  
        <?php }?> 
        
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a id="submit" href="javascript:void(0)" class="btn"><span><?php echo $lang['nc_save'];?></span></a></td>
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
            area_name: {
                required : true
            },
			area_number:{
				number: true	
			},
			post:{
				number: true	
			},
			area_sort:{
				required:true,
				number:true
			}
        },
        messages : {
            area_name: {
                required : '区域名称不能为空'
            },
			area_number:{
				number:'区域编号必须为数字'
			},
			post:{
				number:'邮编必须为数字'
			},
			area_sort:{
				required:'区域排序不能为空',
				number:'区域排序必须是数字'
			}
        }
    });
});
</script> 
