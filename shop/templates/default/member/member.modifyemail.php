<div class="mainbox setup_box setup_account">
<div class="hd"><h3><?php echo $lang['nc_member_account_info'];?></h3></div>
<div class="con">
<p class="col_hints"><?php echo $lang['nc_member_email_tele_tip'];?></p>
<div class="form_box">
	<form method='post' action='' id='detail_form'>
		<ul>
          <li>
            <div class="tit">
              <label><?php echo $lang['nc_member_email'];?>：</label>
            </div>
            <div class="pt">
			  <input type='text' name='email' class="input_plain c2 focus" id='email' value="<?php echo $output['memberinfo']['email'];?>">
              <label style="display:none;" class="error msg_invalid" for="email"></label>
            </div>
          </li>
           <li>
            <div class="tit">
              <label><?php echo $lang['nc_member_telephone'];?>：</label>
            </div>
            <div class="pt">
			  <input type='text' name='mobile' id='mobile' class="input_plain c2 focus" value="<?php echo $output['memberinfo']['mobile'];?>">
              <label style="display:none;" class="error msg_invalid" for="mobile"></label>
            </div>
          </li>
		</ul>
		<div class="btn_box">
          <span class="f_btn">
			<input type='submit' value="<?php echo $lang['nc_save'];?>" class='btn_txt J_submit'>
          </span>
        </div>
	</form>
</div>
</div>
</div>
<script type='text/javascript'>
	$(function(){
		jQuery.validator.addMethod("phones", function(value, element) {
			return this.optional(element) || /^[1][3-8]+\d{9}/i.test(value);
		}, "phone number please");
		$("#detail_form").validate({
			rules:{
				email:{
					required:true,
					email:true
				},
				mobile:{
					required:true,
					number:true,
					phones:true
				}
			},
			messages:{
				email:{
					required:'<?php echo $lang['nc_member_email_is_not_null'];?>',
					email:'<?php echo $lang['nc_member_email_is_invalid'];?>'
				},
				mobile:{
					required:'<?php echo $lang['nc_member_telephone_is_not_null'];?>',
					number:'<?php echo $lang['nc_member_telephone_is_number'];?>',
					phones :'手机格式不正确!'
				}
			}
		});
	});	
</script>