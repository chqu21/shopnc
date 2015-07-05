<div class="mainbox setup_box setup_account">
  <div class="hd">
    <h3><?php echo $lang['nc_member_account_info'];?></h3>
  </div>
  <div class="con">
    <p class="con_hints"><?php echo $lang['nc_member_password_tip'];?></p>
    <div class="form_box">
      <form method='post' action='' id='password_form'>
        <ul>
          <li>
            <div class="tit">
              <label><?php echo $lang['nc_member_current_password'];?>：</label>
            </div>
            <div class="pt">
			  <input type='password' name='current_password' id='current_password' class="input_plain c2 focus" >
              <label style="display:none;" class="error msg_invalid" for="current_password"></label>
            </div>
          </li>
          <li>
            <div class="tit">
              <label><?php echo $lang['nc_member_new_password'];?>：</label>
            </div>
            <div class="pt">
			  <input type='password' name='new_password' id='new_password' class="input_plain c2 focus">
              <label style="display:none;" class="error msg_invalid" for="new_password"></label>
            </div>
          </li>
          <li>
            <div class="tit">
              <label><?php echo $lang['nc_member_confirm_password'];?>：</label>
            </div>
            <div class="pt">
			  <input type='password' name='confirm_password' class="input_plain c2 focus" id='confirm_password'>
              <label style="display:none;" class="error msg_invalid" for="confirm_password"></label>
            </div>
          </li>
        </ul>
        <div class="btn_box">
          <span class="f_btn">
           <button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_save'];?></button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		$("#password_form").validate({
			rules:{
				current_password:{
					required:true
				},
				new_password:{
					required:true,
					minlength: 6,
					maxlength: 20
				},
				confirm_password:{
					required:true,
					equalTo:'#new_password'
				}
			},
			messages:{
				current_password:{
					required:'<?php echo $lang['nc_member_current_password_is_not_null'];?>'
				},
				new_password:{
					required:'<?php echo $lang['nc_member_new_password_is_not_null'];?>',
					minlength:'<?php echo $lang['nc_member_password_range'];?>',
					maxlength:'<?php echo $lang['nc_member_password_range'];?>'
				},
				confirm_password:{
					required:'<?php echo $lang['nc_member_confirm_password_is_not_null'];?>',
					equalTo:'<?php echo $lang['nc_member_password_not_same'];?>'
				}
			}
		});
	});	
</script>