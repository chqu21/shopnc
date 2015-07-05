<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_brand_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=brand&op=brandlist"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_add']?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" action="index.php?act=brand&op=addbrand" enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="brand_name"><?php echo $lang['nc_admin_brand_name'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="brand_name" name="brand_name" class="txt"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="brand_pic"><?php echo $lang['nc_admin_brand_pic'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <span class="type-file-box">
            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
            <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="brand_pic" type="file" class="type-file-file" id="brand_pic" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
		  </td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label class="validation" for="brand_sort"><?php echo $lang['nc_admin_brand_sort'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="brand_sort" name="brand_sort" class="txt"></td>
        </tr>
		<tr>
          <td colspan="2">
			<label class="validation" for="brand_des"><?php echo $lang['nc_admin_brand_des'];?>:</label>
		  </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<textarea name="brand_des"></textarea>
		  </td>
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
<script type="text/javascript">
$(function(){
	$("#brand_pic").change(function(){
		$("#textfield1").val($(this).val());
	});
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("<?php echo $lang['default_img_wrong'];?>");
				$(this).attr('value','');
			return false;
		}
	});
	
	$('#submitBtn').click(function(){
		$('form').submit();
	});
});
</script>