<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_website_adv_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=adv"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_add'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="link_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ap_name"><?php echo $lang['nc_admin_website_adv_title'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<input type="text" name="ap_name" id="ap_name" class="txt" value="<?php echo $output['adv']['ap_name']?>">
          </td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required">
          	<label for="sg_description"><?php echo $lang['nc_admin_website_adv_content'];?>:</label>
          </td>
        </tr>        
        <tr class="noborder">
          <td class="vatop rowform">
          	<textarea id="sg_description" name="ap_intro" class="tarea"><?php echo $output['adv']['ap_intro'];?></textarea>
          </td>
          <td class="vatop tips"></td>
        </tr>
        
        <tr class="noborder">
          <td colspan="2" class="required"><label for="ap_link"><?php echo $lang['nc_admin_website_adv_link'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="ap_link" id="ap_link" class="txt" value="<?php echo $output['adv']['link']?>">
            </td>
          <td class="vatop tips"></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required">
          	<label><?php echo $lang['nc_admin_website_adv_type'];?>:</label>
          </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<select name="ap_class" id="ap_class">
          	  <option value="2" <?php if($output['adv']['ap_class'] == 2){ echo 'selected';}?>><?php echo $lang['nc_admin_website_adv_pic'];?></option>
              <option value="1" <?php if($output['adv']['ap_class'] == 1){ echo 'selected';}?>><?php echo $lang['nc_admin_website_adv_words'];?></option> 
            </select>
		  </td>
          <td class="vatop tips"><?php echo $lang['ap_select_showstyle'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_website_adv_is_use'];?>:</td>
        </tr>
        <tr class="noborder">
			<td class="vatop rowform">
				<ul>
	              <li>
	                <input name="is_use" type="radio" value="1" <?php if($output['adv']['is_use'] == '1'){ echo 'checked';}?>>
	                <label><?php echo $lang['nc_yes'];?></label>
	              </li>
	              <li>
	                <input type="radio" name="is_use" value="0" <?php if($output['adv']['is_use'] == '0'){ echo 'checked';}?>>
	                <label><?php echo $lang['nc_no'];?></label>
	              </li>
	            </ul>
            </td>
            <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="default_pic">
        <tr>
          <td colspan="2" class="required">
          	<label class="validation" for="change_default_pic"><?php echo $lang['nc_admin_website_adv_pic']; ?></label>
          </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.ATTACH_ADV_PATH.DS.$output['adv']['default_content'];?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
            <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="default_pic" type="file" class="type-file-file" id="site_logo" size="30" hidefocus="true">
            </span>
          </td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tbody id="ap_width_media">
        <tr>
          <td colspan="2" class="required"><label class="validation" for="ap_width_media_input"><?php echo $lang['nc_admin_website_adv_width'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $output['adv']['ap_width'];?>" name="ap_width_media"  class="txt" id="ap_width_media_input" ></td>
          <td class="vatop tips"><?php echo $lang['adv_pix'];?></td>
        </tr>
	  </tbody>
      <tbody id="ap_height">
        <tr>
          <td colspan="2" class="required"><label class="validation" for="ap_height_input"><?php echo $lang['nc_admin_website_adv_height'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $output['adv']['ap_height'];?>" name="ap_height" class="txt" id="ap_height_input"></td>
          <td class="vatop tips"><?php echo $lang['adv_pix'];?></td>
        </tr>
      </tbody>

      <tbody id="default_word">
        <tr>
          <td colspan="2" class="required"><label for="default_word" class="validation"><?php echo $lang['nc_admin_website_adv_words'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="default_word" value="" name="default_word" class="txt">
            </td>
          <td class="vatop tips"><?php echo $lang['ap_show_defaultword_when_nothing']; ?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" >
          	<input type='hidden' name='ap_id' value="<?php echo $output['adv']['ap_id'];?>">
          	<a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_save'];?></span></a>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
$(function(){
	$("#ap_width_word").hide();
	$("#default_word").hide();
	$("#ap_class").change(function(){
	// $("label").remove();
	if($("#ap_class").val() == '1'){
		$("#ap_height").hide();
		$("#ap_width_media").hide();
		$("#default_pic").hide();
		$("#default_word").show();
		$("#ap_width_word").show();
		$("#ap_display").show();
	}else if($("#ap_class").val() == '0'||$("#ap_class").val() == '3'){
		$("#ap_height").show();
		$("#ap_width_media").show();
		$("#default_pic").show();
		$("#default_word").hide();
		$("#ap_width_word").hide();
		$("#ap_display").show();
	}else{
		$("#ap_height").show();
		$("#ap_width_media").show();
		$("#default_pic").show();
		$("#default_word").hide();
		$("#ap_width_word").hide();
		$("#ap_display").hide();
	}
  });
});
</script> 
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#link_form").valid()){
     $("#link_form").submit();
	}
	});
});
//
$(document).ready(function(){
	
	$('#link_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
        	ap_name : {
                required : true
            },
            ap_link:{
				url : true
           	},
			ap_width_media:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
			ap_height:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
			ap_width_word :{
				required :function(){return $("#ap_class").val()==1;},
				digits	 :true,
				min:1
			},
			default_word  :{
				required :function(){return $("#ap_class").val()==1;}
			},
			change_default_pic:{
				required :true
			}
        },
        messages : {
        	ap_name : {
                required : '<?php echo $lang['ap_can_not_null']; ?>'
            },
            ap_link : {
				url : '<?php echo $lang['ap_link_format_is_wrong'];?>'
            },
            ap_width_media	:{
            	required   : '<?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<?php echo $lang['ap_input_digits_pixel'];?>'
            },
            ap_height	:{
            	required   : '<?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<?php echo $lang['ap_input_digits_pixel'];?>'
            }, 
            ap_width_word	:{
            	required   : '<?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<?php echo $lang['ap_input_digits_pixel'];?>'
            },            
            default_word	:{
            	required   : '<?php echo $lang['ap_default_word_can_not_null']; ?>'
            }
        }
    });
});
</script>