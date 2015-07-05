<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js" charset="utf-8"></script>
<div id="main-wrap">
  <div class="left_pic"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/lsimg/1.jpg"></div>
  <div class="login_page">
    <div class="page_hd">
      <h2><?php echo $lang['nc_login'];?><span>&nbsp;User Login</span></h2>
    </div>
    <form id='login_form' method="post">
      <dl class="login_bd">

        <dt><?php echo $lang['nc_username'];?></dt>

        <dd><span class="ipt01 in_b">
          <input type="text" placeholder="<?php echo $lang['nc_input_username'];?>"name="member_name" id="member_name">
          </span> </dd>
        <dd><span class="ipt02 in_b">
          <input type="password" id="password" autocomplete="off" name="password" placeholder="<?php echo $lang['nc_password'];?>" >
          </span></dd>

        <dd class="clearfix" style=" margin:10px 0;"> 
        	<span class="ipt07 in_b" style="padding-left:10px;">
            <input type="text" title="" size="10" maxlength="4" placeholder="<?php echo $lang['nc_captcha_is_not_null'];?>" style="width:170px;" name="captcha" id="captcha">
            </span>
            <p class="yzm"> <img border="0" class="fl" id="codeimage" name="codeimage" title="" src="index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>"><br>
              <a href="javascript:void(0);" onclick="javascript:document.getElementById('codeimage').src='index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><?php echo $lang['nc_change_image'];?></a></p>
            
        </dd>
          <dd class="box_err  clearfix">
         <!-- <label for="" generated="true" class="error_login"></label>-->
         <label for="member_name" generated="true" class="error error_reg"  style="display:none;"></label>
         <label for="password" generated="true" class="error error_reg"  style="display:none;"></label>
         <label for="captcha" generated="true" class="error error_reg"  style="display:none;"></label>
        </dd>
        <dd class="submit clearfix">
		  <input type="hidden" value="<?php echo $_GET['ref_url']?>" name="ref_url">
          <input type="submit" class="btn-regist" id="loginSubmit" name="Submit" value="<?php echo $lang['nc_member_login'];?>">
        </dd>
      </dl>
    </form>
    <div class="btn_r"><span><?php echo $lang['nc_not_register_account'];?></span><a class="btn_com"  href="<?php echo BASE_SITE_URL;?>/index.php?act=login&op=register"></a> <a class="fw" style="font-size:12px" target="_blank" href="<?php echo BASE_SITE_URL;?>/index.php?act=login&op=forget_password"><?php echo $lang['nc_forget_password'];?></a> </div>
  </div>
</div>
<!--  
<?php if($GLOBALS['setting_config']['qq_isuse'] == 1){?>
<a href="<?php echo BASE_SITE_URL;?>/api.php?act=toqq">qq</a>
<?php }?>

<?php if($GLOBALS['setting_config']['sina_isuse'] == 1){?>
<a href="<?php echo BASE_SITE_URL;?>/api.php?act=tosina">weibo</a>
<?php }?>
-->
<script>
$(document).ready(function(){
	$('input[name="Submit"]').click(function(){
        if($("#login_form").valid()){
        	$("#login_form").submit();
        } else{
        	document.getElementById('codeimage').src='<?php echo SHOP_SITE_URL?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
        }
    });
	$("#login_form").validate({
        errorPlacement: function(error, element){
			error.appendTo('.error_login');
        },
		rules: {
			member_name: "required",
			password: "required",
            captcha : {
                required : true,
                remote   : {
                    url : 'index.php?act=seccode&op=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    }
                }
            }
		},
		messages: {
			member_name: "<?php echo $lang['nc_login_username_is_not_null'];?>",
			password: "<?php echo $lang['nc_login_password_is_not_null'];?>",
		    captcha : {
                required : '<?php echo $lang['nc_captcha_is_not_null'];?>',
		   		remote	 : '<?php echo $lang['nc_captcha_is_wrong'];?>'
            }
		}
	});
});
</script>