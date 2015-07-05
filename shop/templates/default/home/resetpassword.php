<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js" charset="utf-8"></script>
<style>
.ui-widget-header {
	background: none;
	border-bottom: 1px solid #ECECEC;
	color: #222222;
	font-weight: bold;
	color: #333333;
	font-size: 16px;
	font-family: "Microsoft YaHei";
	height: 35px;
	line-height: 35px;
}
.forget{
	width:400px;
	margin:10px auto;
}
.forget .title{
	height:35px;
	line-height:20px;
	font-size:14px;
}
.forget li {
	line-height:30px;
	font-family: "Microsoft YaHei";
	color:#666;
	margin-left:15px;
	font-size:14px;
}
.inline-block{
	display:inline-block;
}

</style>
<div id="main-wrap">
  <div class="left_pic"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/lsimg/1.jpg"></div>
  <div class="register_page">
   <div class="page_hd">
      <h2><?php echo $lang['nc_resetpassword'];?><span>&nbsp;Reset Password</span></h2>
    </div>
       <div class="register_bd">
    <form id="reset_from" method='post'>
     <dl>
			<dt></dt>
            <dd> 
				<span class="ipt04 in_b">
					<input type="password" title="" placeholder="<?php echo $lang['nc_member_new_password'];?>" name="new_password" id="new_password">
				</span>
				<label class="error error_reg" for="new_password" generated="true"  style="display:none;"></label>

            </dd>
        </dl>
                
        <dl>
			<dt></dt>
            <dd> 
				<span class="ipt05 in_b">
					<input type="password" title="" placeholder="<?php echo $lang['nc_confrim_password'];?>" name="sure_password" id="sure_password">
				</span>
				<label class="error error_reg" for="sure_password" generated="true"  style="display:none;"></label>

            </dd>
        </dl>
              </dl>
               <dl> <dt></dt><dd>
				<input type="submit" name="Submit" value="<?php echo $lang['nc_login_submit'];?>" class="btn-regist" title="<?php echo $lang['nc_login_submit'];?>">
			  </dd></dl>   
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