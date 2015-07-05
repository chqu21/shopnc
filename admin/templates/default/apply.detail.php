<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storelist"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_apply_store'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=3"><span><?php echo $lang['nc_close_store'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <!-- 操作说明 -->
  <form id="add_form" method="post" enctype="multipart/form-data">
    <input name="store_id" type="hidden" value="<?php echo $output['store_info']['store_id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_store_name'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['store_info']['store_name'];?></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_alisa'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['store_info']['alisa'];?></td>
        </tr>
		
		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_category'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $output['store_info']['class_name'];?>-<?php echo $output['store_info']['s_class_name'];?></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_pic'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['store_info']['pic'];?>">
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_side'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['side'];?>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_telephone'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['telephone'];?>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_address'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['address'];?>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_bus'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['bus'];?>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_subway'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['subway'];?>
		  </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_store_description'].$lang['nc_colon'];?></label>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<?php echo $output['store_info']['description'];?>
		  </td>
        </tr>

		<tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_store_create_apply'];?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
			<label for="state2" class="cb-enable selected" ><span><?php echo $lang['open'];?></span></label>
            <label for="state3" class="cb-disable" ><span><?php echo $lang['close'];?></span></label>
            <input id="state2" name="store_state" value="2" type="radio" checked>
            <input id="state3" name="store_state" value="3" type="radio">
		  </td>
        </tr>

		<tr class='close_reason' style='display:none;'>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_store_close_reason'];?>:</td>
        </tr>
        <tr class="noborder close_reason" style='display:none; height:auto;'>
          <td class="vatop rowform onoff" style='height:auto;'>
			<textarea name='close_reason'></textarea>
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

<script type='text/javascript'>
	$(function(){
		$("#submit").click(function(){
			$('#add_form').submit();
		});
		$("label[for=state2]").click(function(){
			$(".close_reason").hide();
		});

		$("label[for=state3]").click(function(){
			$(".close_reason").show();
		});
	});
</script>
