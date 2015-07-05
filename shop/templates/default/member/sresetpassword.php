<div class="layout clearfix">
	<div class="merchant-con clearfix ml300" style="width:510px;">
		<form method='post' id="reset_from">
			<div class="usernm">
		            <h2 style="width:65px;">新&nbsp;&nbsp;密&nbsp;&nbsp;码:</h2>
		            <input type="password" class="text" name='new_password' id='new_password'>
					<label for="new_password" generated="true" class="error error_reg"  style="display:none;"></label>
		    </div>
			<div class="password">
		            <h2 style="width:65px;">确认密码:</h2>
		            <input type="password" class="text" name="sure_password" id="sure_password">
					<label class="error error_reg" for="sure_password" generated="true"  style="display:none;"></label>
		    </div>
		          
			<div class="merchant_login_btn clearfix" >
				<input type='submit' value='' class="new_login" style="width:313px;">
			</div>
		</form>
	</div>
</div>
<script type='text/javascript'>
$(function(){
    $("#reset_from").validate({
        rules : {
            new_password : {
                required : true,
                minlength: 6,
				maxlength: 20
            },
            sure_password : {
                required : true,
                equalTo  : '#new_password'
            }
        },
        messages : {
           new_password  : {
                required : '<?php echo $lang['nc_password_is_not_null'];?>',
                minlength: '<?php echo $lang['nc_password_range'];?>',
				maxlength: '<?php echo $lang['nc_password_range'];?>'
            },
            sure_password : {
                required : '<?php echo $lang['nc_password_is_not_null'];?>',
                equalTo  : '<?php echo $lang['nc_password_not_same'];?>'
            }	
        }
    });
});
</script>
