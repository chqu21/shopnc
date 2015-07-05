<div class="layout clearfix">
	<div class="merchant-con clearfix ml320" style="width:500px;">
		<form method='post' id='forget_from'>
			<div class="usernm" style="position:relative;">
		            <h2>账号:</h2>
		            <input type="text" class="text" name='account' id='account'>
				    <label for="account" generated="true" class="error error_reg"  style="display:none;"></label>  
		    </div>
			<div class="password" style="position:relative;">
		            <h2>邮箱:</h2>
		            <input type="text" class="text" name="email" id='email'>
					<label class="error error_reg" for="email" generated="true"  style="display:none;"></label>  
		    </div>
			<div class="merchant_login_btn clearfix">
				<input type='submit' value='' class="find_login">
			</div>
          
		</form>
	</div>
</div>
<script type='text/javascript'>
$(function(){
    jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[^:%,'\*\"\s\<\>\&]+$/i.test(value);
	}, "Letters only please"); 
	jQuery.validator.addMethod("lettersmin", function(value, element) {
		return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length>=3);
	}, "Letters min please"); 
	jQuery.validator.addMethod("lettersmax", function(value, element) {
		return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length<=15);
	}, "Letters max please");
    $("#forget_from").validate({
        rules : {
            account : {
                required : true,
                lettersmin : true,
                lettersmax : true,
                lettersonly : true
            },
            email : {
                required : true,
                email    : true
            }
        },
        messages : {
            account : {
                required : '<?php echo $lang['nc_member_store_account_is_not_null'];?>',
                lettersmin : '<?php echo $lang['nc_member_store_account_range'];?>',
                lettersmax : '<?php echo $lang['nc_member_store_account_range'];?>',
				lettersonly: '<?php echo $lang['nc_member_store_account_lettersonly'];?>'
            },
            email : {
                required : '<?php echo $lang['nc_email_is_not_null'];?>',
                email    : '<?php echo $lang['nc_email_invalid'];?>'
            }
        }
    });
});
</script>