<div class="mainbox setup_box">
<div class="hd">
  <h3><?php echo $lang['nc_member_title_address'];?></h3>
  <span>(<i class="c1">*</i><?php echo $lang['nc_member_required_item'];?>)</span></div>
<div class="con">
  <p class="con_hints"><?php echo $lang['nc_member_shipping_address_help'];?></p>
  <div class="form_box">
	<form method="post" action="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=address" id='shipping_address'>
	  <ul>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label for=""><?php echo $lang['nc_member_shipping_to_name'];?>：</label>
		  </div>
		  <div class="pt">
			<input type="text" value="<?php echo $output['member']['shipped_to_name']?>" id="shipped_to_name" class="input_plain c2 itxt_s" name="shipped_to_name">
			<label for='shipped_to_name' class='error msg_invalid' style='display:none;'></label>
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label for=""><?php echo $lang['nc_member_address'];?>：</label>
		  </div>
		  <div class="pt">
		  	<span id="area_show"><?php echo $output['member']['province']; ?>&nbsp;&nbsp;<?php echo $output['member']['city']; ?>&nbsp;&nbsp;<?php echo $output['member']['district']; ?><input type="button" id="area_edit" value="编辑" /></span>
		  	<input type="hidden" name="p_val" value="" />
		  	<input type="hidden" name="c_val" value="" />
		  	<input type="hidden" name="d_val" value="" />
		  	<select class="city-select valid" name="province" id="province">
		  	<?php if(!empty($output['area_array'])){ ?>
		  	<option value="0">请选择</option>
		  	<?php foreach ($output['area_array'] as $val){ ?>
		  	<option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
		  	<?php }} ?>
		  	</select>
		  	<select class="city-select valid" name="city" id="city"></select>
		  	<select class="city-select valid" name="district" id="district"></select>
		  	<br><br>
			<input type="text" value="<?php echo $output['member']['address'];?>" id="address" class="input_plain c2 itxt_l" name="address">
			<label for='address' class='error msg_invalid' style='display:none;' maxlength="100"></label>
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label for=""><?php echo $lang['nc_member_zipcode'];?>：</label>
		  </div>
		  <div class="pt">
			<input type="text" value="<?php echo $output['member']['zipcode'];?>" id="zipcode" class="input_plain c2 itxt_s focus" name="zipcode">
			<label for='zipcode' class='error msg_invalid' style='display:none;'></label>    
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label for=""><?php echo $lang['nc_member_telephone'];?>：</label>
		  </div>
		  <div class="pt">
			<input type="text" value="<?php echo $output['member']['telephone'];?>" class="input_plain c2 itxt_s" name="telephone" id="telephone">
			<label for='telephone' class='error msg_invalid' style='display:none;'></label> 
		  </div>
		</li>
	  </ul>
	  <div class="btn_box"> 
		<span class="f_btn">
			<button type="submit" class="btn_txt J_submit"><?php echo $lang['nc_save'];?></button>
		</span>
	  </div>
	</form>
  </div>
</div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/area_array.js" charset="utf-8"></script>
<script type='text/javascript'>
	$(function(){
		$('#province').hide();$('#city').hide();$('#district').hide();
		$('#area_edit').click(function(){
			$('#area_show').hide();
			$('#province').append('<option value="">请选择</option>');
			var id = $(this).val();
			$.each(nc_a[0],function(i,v){
				$('#province').append('<option value="'+v[0]+'">'+v[1]+'</option>');
			});
			$('#province').show();
		});
		$('#province').change(function(){
			$('#city').empty();
			$('#city').append('<option value="">请选择</option>');
			var id = $(this).val();
			$.each(nc_a[id],function(i,v){
				$('#city').append('<option value="'+v[0]+'">'+v[1]+'</option>');
			});
			$('#city').show();
			$('#district').hide();
			$('input[name="p_val"]').val($(this).find("option:selected").text());
		});
		$('#city').change(function(){
			$('#district').empty();
			var id = $(this).val();
			$('#district').append('<option value="">请选择</option>');
			$.each(nc_a[id],function(i,v){
				$('#district').append('<option value="'+v[0]+'">'+v[1]+'</option>');
			});
			$('#district').show();
			$('input[name="c_val"]').val($(this).find("option:selected").text());
		});
		$('#district').change(function(){
			$('input[name="d_val"]').val($(this).find("option:selected").text());
		});
		jQuery.validator.addMethod("phones", function(value, element) {
			return this.optional(element) || /^[1][3-8]+\d{9}/i.test(value);
		}, "phone number please");
		jQuery.validator.addMethod("zipCode", function(value, element) {
			var tel = /^[0-9]{6}$/;
			return this.optional(element) || (tel.test(value));
		}, "邮政编码格式错误");
		$('#shipping_address').validate({
			errorPlacement: function(error, element){
			   var error_td = element.parent('div');
				error_td.append(error);
			},
			submitHandler:function(form){
				ajaxpost('shipping_address', '', '', 'onerror');
			},
			rules:{
				shipped_to_name:{
					required:true
				},
				address:{
					required:true	
				},
				zipcode:{
					required:true,
					zipCode:true			
				},
				telephone:{
					required:true,
					phones:true
				}
			},
			messages:{
				shipped_to_name:{
					required:'<?php echo $lang['nc_member_shipping_name_is_not_null'];?>'
				},
				address:{
					required:'<?php echo $lang['nc_member_address_is_not_null'];?>'	
				},
				zipcode:{
					required:'<?php echo $lang['nc_member_zipcode_is_not_null'];?>',
					zipCode:'邮政编码格式不正确!'
				},
				telephone:{
					required:'联系电话不能为空',
					phones :'手机格式不正确!'
				}
			}
		});
	});
</script>