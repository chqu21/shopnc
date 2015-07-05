<div class="mainbox setup_box">
<div class="hd">
  <h3><?php echo $lang['nc_member_predeposit_charge'];?></h3>
  <span>(<i class="c1">*</i><?php echo $lang['nc_member_required_item'];?>)</span></div>
<div class="con">
  <div class="form_box">
	<form id="basic_info" method="post" action="<?php echo BASE_SITE_URL;?>/index.php?act=memberpredeposit&op=charge">
	  <ul>
	  	<li>
		  <div class="tit"><i class="c1">*</i>
			<label><?php echo $lang['nc_member_predeposit_payment_name'];?>：</label>
		  </div>
		  <div class="pt">
			<select name="payment" class="select-box">
				<option value=''><?php echo $lang['nc_select']?></option>
				<?php if(!empty($output['list'])){?>
				<?php foreach($output['list'] as $val){?>
				<option value="<?php echo $val['payment_id'];?>"><?php echo $val['payment_name'];?></option>
				<?php }?>
				<?php }?>
			</select>
			<label for='payment' class='error msg_invalid' style='display:none;'></label>
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label><?php echo $lang['nc_member_predeposit_charge_price'];?>：</label>
		  </div>
		  <div class="pt">
			<input type="text" value="<?php echo $output['member']['charge_price'];?>" id="charge_price" maxlength="24" class="input_plain c2 focus" name="charge_price">
			<label for='charge_price' class='error msg_invalid' style='display:none;'></label>
		  </div>
		</li>
		<li>
		  <div class="tit">
			<label for=""><?php echo $lang['nc_member_predeposit_charge_des'];?>：</label>
		  </div>
		  <div class="pt">
			<textarea id="J_sign" class="tp c2" rows="5" cols="" name="charge_des"><?php echo $output['member']['charge_des'];?></textarea>
		  </div>
		</li>
	  </ul>
	  <div class="btn_box"> <span class="f_btn">
		<button type="submit" class="btn_txt J_submit"><?php echo $lang['nc_save'];?></button>
		</span> </div>
	</form>
  </div>
</div>
</div>

<script type='text/javascript'>
	$(function(){
		$('#basic_info').validate({
			errorPlacement: function(error, element){
			   var error_td = element.parent('div');
				error_td.append(error);
			},
			rules:{
				payment:{
					required:true
				},
				charge_price:{
					required:true,
					number:true,
					min:0.01,
					max:1000000
				}
			},
			messages:{
				payment:{
					required:'<?php echo $lang['nc_member_predeposit_payment_is_not_null'];?>'
				},
				charge_price:{
					required:'<?php echo $lang['nc_member_predeposit_payment_charge_is_not_null'];?>',
					number:'<?php echo $lang['nc_member_predeposit_payment_charge_format_is_wrong'];?>',
					min:'<?php echo $lang['nc_member_predeposit_charge_price_range'];?>',
					max:'<?php echo $lang['nc_member_predeposit_charge_price_range'];?>'
				}
			}
		});
	});
</script>