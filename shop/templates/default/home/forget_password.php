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
.forget {
	width: 400px;
	margin: 10px auto;
}
.forget .title {
	height: 35px;
	line-height: 20px;
	font-size: 14px;
}
.forget li {
	line-height: 30px;
	font-family: "Microsoft YaHei";
	color: #666;
	margin-left: 15px;
	font-size: 14px;
}
.inline-block {
	display: inline-block;
}
</style>
<div id="main-wrap">
  <div class="left_pic"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/lsimg/1.jpg"></div>
  <div class="login_page">
    <div class="page_hd">
      <h2><?php echo $lang['nc_forget'];?><span>&nbsp;Forget Password</span></h2>
    </div>
    <div class="register_bd">
      <form method="post" id="forget_from">
        <dl class="login_bd">
          <dt></dt>
          <dd><span class="ipt03 in_b">
            <input type="text" placeholder="<?php echo $lang['nc_input_username'];?>"name="member_name" id="member_name">
            </span>
            <label for="member_name" generated="true" class="error error_reg"  style="display:none;"></label>
          </dd>
        </dl>
        <dl>
          <dt></dt>
          <dd> <span class="ipt06 in_b">
            <input type="text" title="" placeholder="<?php echo $lang['nc_email'];?>" name="email" id="email">
            </span>
            <label class="error error_reg" for="email" generated="true"  style="display:none;"></label>
          </dd>
        </dl>
               <dl> <dt></dt><dd>
				<input type="submit" name="Submit" value="<?php echo $lang['nc_login_submit'];?>" class="btn-regist" title="<?php echo $lang['nc_login_submit'];?>">
			  </dd></dl>   
      </form>
    </div>
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
            member_name : {
                required : true,
                lettersmin : true,
                lettersmax : true,
                lettersonly : true,
                remote   : {
                    url :'index.php?act=login&op=check_member',
                    type:'get',
                    data:{
                        member_name : function(){
                            return $('#member_name').val();
                        },
						option:'forget'
                    }
                }
            },
            email : {
                required : true,
                email    : true,
                remote   : {
                    url : 'index.php?act=login&op=check_email',
                    type: 'get',
                    data:{
						member_name : function(){
                            return $('#member_name').val();
                        },
                        email : function(){
                            return $('#email').val();
                        },
						option:'forget'
                    }
                }
            }
        },
        messages : {
            member_name : {
                required : '<?php echo $lang['nc_username_is_not_null'];?>',
                lettersmin : '<?php echo $lang['nc_username_range'];?>',
                lettersmax : '<?php echo $lang['nc_username_range'];?>',
				lettersonly: '<?php echo $lang['nc_username_lettersonly'];?>',
				remote	 : '<?php echo $lang['nc_username_not_exists'];?>'
            },
            email : {
                required : '<?php echo $lang['nc_email_is_not_null'];?>',
                email    : '<?php echo $lang['nc_email_invalid'];?>',
				remote	 : '<?php echo $lang['nc_email_not_exists'];?>'
            }
        }
    });
});
</script>