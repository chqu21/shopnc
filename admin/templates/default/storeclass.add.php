<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_class'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storeclass"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);"  class="current"><span><?php if($output['op']=='add'){ echo $lang['nc_add'];}else{ echo $lang['nc_edit'];} ?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=store&op=<?php echo $output['op'];?>">
    <input name="class_id" type="hidden" value="<?php echo $output['class_info']['class_id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="class_name"><?php echo $lang['nc_store_class_name'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php if(isset($output['class_info']['class_name'])) echo $output['class_info']['class_name'];?>" name="class_name" id="class_name" class="txt"></td>
          <td class="vatop tips"><?php echo $lang['class_name_error'];?></td>
        </tr>
        <?php if(empty($output['class_info']) || $output['class_info']['parent_class_id'] > 0) { ?>
        <tr>
          <td colspan="2" class="required"><label for="parent_class_id"><?php echo $lang['nc_store_parent_class'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select id="parent_class_id" name="parent_class_id" class="valid" >
              <option value="0">无上级分类</option>
              <?php if(!empty($output['list']) && is_array($output['list'])) {?>
              <?php foreach($output['list'] as $key=>$val) {?>
              <option value="<?php echo $val['class_id'];?>" <?php if($output['class_info']['parent_class_id'] == $val['class_id'] || intval($_GET['parent_class_id']) == $val['class_id']) echo 'selected';?>><?php echo $val['class_name'];?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td class="vatop tips"></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="2" class="required"><label for="class_image"><?php echo $lang['nc_store_image'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
           <span class="type-file-box">
            <input name="old_class_image" type="hidden" value="<?php echo $output['class_info']['class_image'];?>" />
            <input name="class_image" type="file" class="type-file-file" id="class_image" size="30" hidefocus="true" nc_type="microshop_goods_class_image">
            </span><br><br>
            <?php if(!empty($output['class_info']['class_image'])) { ?>
              <img src="<?php echo UPLOAD_SITE_URL.'/shop/class/'.$output['class_info']['class_image'];?>">
              <?php } ?>
            </td>
          <td class="vatop tips">建议上传图标尺寸为：62px*62px</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="class_sort" class="validation"><?php echo $lang['nc_sort'].$lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="class_sort" name="class_sort" type="text" class="txt" value="<?php echo !isset($output['class_info'])?'255':$output['class_info']['class_sort'];?>" /></td>
          <td class="vatop tips"><?php echo $lang['class_sort_explain'];?></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="class_sort" ><?php echo '首页推荐'.$lang['nc_colon']; ?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="is_audit1" class="cb-enable <?php if($output['class_info']['class_recommend'] == 1){ ?>selected<?php } ?>"><span>是</span></label>
            <label for="is_audit2" class="cb-disable <?php if($output['class_info']['class_recommend'] == 0){ ?>selected<?php } ?>" ><span>否</span></label>
            <input id="is_audit1" name="is_recommend" <?php if($output['class_info']['class_recommend'] == 1){ ?>checked<?php } ?> value="1" type="radio">
            <input id="is_audit2" name="is_recommend" <?php if($output['class_info']['class_recommend'] == 0){ ?>checked<?php } ?> value="0" type="radio">
          </td>
          <td class="vatop tips">
          	<span class="vatop rowform"><?php echo $lang['nc_site_open_and_close'];?></span>
          </td>
        </tr>
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

    //文件上传
    var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />";
    $(textButton).insertBefore("#class_image");
    $("#class_image").change(function(){
        $("#textfield1").val($("#class_image").val());
    });

    $("#submit").click(function(){
        $("#add_form").submit();
    });

    $("input[nc_type='microshop_goods_class_image']").live("change", function(){
		var src = getFullPath($(this)[0]);
		$(this).parent().prev().find('.low_source').attr('src',src);
		$(this).parent().find('input[class="type-file-text"]').val($(this).val());
	});


    $('#add_form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            class_name: {
                required : true,
                maxlength : 10
            },
            class_sort: {
                required : true,
                digits: true,
                max: 255,
                min: 0
            }
        },
        messages : {
            class_name: {
                required : "<?php echo $lang['nc_store_class_name_length'];?>",
                maxlength : jQuery.validator.format("<?php echo $lang['nc_store_class_name_length'];?>")
            },
            class_sort: {
                required : "<?php echo $lang['nc_store_class_sort_is_not_null'];?>",
                digits: "<?php echo $lang['nc_store_class_sort_range'];?>",
                max : jQuery.validator.format("<?php echo $lang['nc_store_class_sort_range'];?>"),
                min : jQuery.validator.format("<?php echo $lang['nc_store_class_sort_range'];?>")
            }
        }
    });
});
</script> 
