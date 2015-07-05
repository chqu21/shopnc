<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js" charset="utf-8"></script>
<style type="text/css">
#search, #navBar {
	display: none !important;
}

 /*屏蔽头部搜索及导航菜单*/
</style>
<div id="main-wrap">
  <div class="left_pic"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/lsimg/1.jpg"></div>
  <div class="register_page">
    <div class="page_hd">
      <h2><?php echo $lang['nc_register'];?><span>&nbsp;<?php echo $lang['nc_en_register'];?></span></h2>
    </div>
    <div class="register_bd">
      <form id='register_form' method='post'>
        <dl>
          <dt></dt>
          <dd> <span class="ipt03 in_b">
            <input type="text" placeholder="<?php echo $lang['nc_username'];?>" name="member_name" id="member_name">
            </span>
            <label for="member_name" generated="true" class="error error_reg"  style="display:none;"></label>
          </dd>
        </dl>
        <dl>
          <dt></dt>
          <dd> <span class="ipt04 in_b">
            <input type="password" title="" placeholder="<?php echo $lang['nc_password'];?>" name="password" id="password">
            </span>
            <label class="error error_reg" for="password" generated="true"  style="display:none;"></label>
          </dd>
        </dl>
        <dl>
          <dt></dt>
          <dd> <span class="ipt05 in_b">
            <input type="password" title="" placeholder="<?php echo $lang['nc_confrim_password'];?>" name="password_confirm" id="password_confirm">
            </span>
            <label class="error error_reg" for="password_confirm" generated="true"  style="display:none;"></label>
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
        <dl>
          <dt></dt>
          <dd> <span class="ipt08 in_b">
            <input type="text" placeholder="<?php echo $lang['nc_register_mobile'];?>" name="mobile" id="mobile">
            </span>
            <label class="error error_reg" for="mobile" generated="true"  style="display:none;"></label>
          </dd>
        </dl>
        <dl style="position:relative;">
          <dt></dt>
          <dd>
          	<div class="ipt10 mr9" id="cityletter_container"><span class='cityletter'>A</span><i class="city_down" data="c_city_letter"></i></div>
            <div class="ipt10" id="cityname_container"><span class='cityname'><?php echo $output['area'][0]['area_name'];?></span><i class="city_down" data="c_city"></i></div>
            <input type="hidden" name="city_id" id="city_id" value="<?php echo $output['area'][0]['area_id'];?>">
            <label class="error error_reg" for="city_id" generated="true"  style="display:none;"></label>
          </dd>
          <div id="c_city_letter" style="top:50px; left:0;display: none;" class="slt_wrap slt_box slt_body">
            <div class="slt_list">
              <ul class="u_city_letter">
                <li data-id="A">A</li>
                <li data-id="B">B</li>
                <li data-id="C">C</li>
                <li data-id="D">D</li>
                <li data-id="E">E</li>
                <li data-id="F">F</li>
                <li data-id="G">G</li>
                <li data-id="H">H</li>
                <li data-id="I">I</li>
                <li data-id="J">J</li>
                <li data-id="K">K</li>
                <li data-id="L">L</li>
                <li data-id="M">M</li>
                <li data-id="N">N</li>
                <li data-id="O">O</li>
                <li data-id="P">P</li>
                <li data-id="Q">Q</li>
                <li data-id="R">R</li>
                <li data-id="S">S</li>
                <li data-id="T">T</li>
                <li data-id="U">U</li>
                <li data-id="V">V</li>
                <li data-id="W">W</li>
                <li data-id="X">X</li>
                <li data-id="Y">Y</li>
                <li data-id="Z">Z</li>
              </ul>
            </div>
          </div>
          <div id="c_city" style="top:50px; left:187px;display: none;" class="slt_wrap slt_box slt_body">
            <div class="slt_list">
              <ul class="u_city">
                <?php if(!empty($output['area'])){?>
                <?php foreach($output['area'] as $area){?>
                <li data-id="<?php echo $area['area_id'];?>"><?php echo $area['area_name']; ?></li>
                <?php }?>
                <?php }?>
              </ul>
            </div>
          </div>
        </dl>
        <dl>
          <dt></dt>
          <dd> <span class="ipt07 in_b" style="padding-left:10px;">
            <input type="text" title="" size="10" maxlength="4" placeholder="<?php echo $lang['nc_captcha_is_not_null'];?>" style="width:170px;" name="captcha" id="captcha">
            </span>
            <p class="yzm"> <img border="0" class="fl" id="codeimage" name="codeimage" title="" src="index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>"><br>
              <a href="javascript:void(0);" onclick="javascript:document.getElementById('codeimage').src='index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><?php echo $lang['nc_change_image'];?></a></p>
            <label for="captcha" generated="true" class="error error_reg"  style="display:none;"></label>
          </dd>
        </dl>
        <dl>
          <dt></dt>
          <dd class="ment">
            <label for="">
              <input type="checkbox" checked="checked" value="1" id="clause"  name="agree">
              <?php echo $lang['nc_view_and_agree'];?> <a title="<?php echo $lang['nc_view_and_agree'];?>" href="index.php?act=document&code=agreement"><?php echo $lang['nc_service_protocal'];?></a> </label>
            <label for="agree" generated="true" class="error"  style="display:none;"><?php echo $lang['nc_must_agree'];?></label>
          </dd>
          <dd>
            <input type="submit" title="<?php echo $lang['nc_buynow_register'];?>" class="btn-regist" value="<?php echo $lang['nc_buynow_register'];?>" name="Submit">
          </dd>
        </dl>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript'>
$(function(){
	$('#cityletter_container').click(function(){
		$('#c_city_letter').show();
	});
	$('#cityname_container').click(function(){
		$('#c_city').show();
	});
	$('.u_city li').live("click",function(){
		var area 		=	$(this).attr('data-id');
		var area_name	=	$(this).html();
		$('input[name=city_id]').val(area);
		$('.cityname').html(area_name);
		$('#c_city').hide();
	});
	$('.u_city_letter li').click(function(){
		var letter	=	$(this).html();
		$.getJSON('index.php?act=login&op=ajax_getcity&letter='+letter, function(result){
	        if(result.done){
		        $('.u_city').html('');
		        $('.cityname').html(result.data[0]['area_name']);
		        $('input[name=city_id]').val(result.data[0]['area_id']);
	        	for(var i=0,l=result.data.length;i<l;i++){
	        		$('.u_city').append('<li data-id="'+result.data[i]['area_id']+'">'+result.data[i]['area_name']+'</li>');
	        	}
	        }else{
	            alert('暂无该字母开头的城市');
	        }
	    });
		$('.cityletter').html(letter);
		$('#c_city_letter').hide();
	});
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[^:%,'\*\"\s\<\>\&]+$/i.test(value);
	}, "Letters only please"); 
	jQuery.validator.addMethod("lettersmin", function(value, element) {
		return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length>=3);
	}, "Letters min please"); 
	jQuery.validator.addMethod("lettersmax", function(value, element) {
		return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length<=15);
	}, "Letters max please");

	jQuery.validator.addMethod("phones", function(value, element) {
		return this.optional(element) || /^[1][3-8]+\d{9}/i.test(value);
	}, "phone number please"); 
	$('input[name="Submit"]').click(function(){
        if($("#register_form").valid()){
        	$("#register_form").submit();
        } else{
        	document.getElementById('codeimage').src='<?php echo SHOP_SITE_URL?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
        }
    });
    $("#register_form").validate({
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
                        }
                    }
                }
            },
            password : {
                required : true,
                minlength: 6,
				maxlength: 20
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },
            email : {
                required : true,
                email    : true,
                remote   : {
                    url : 'index.php?act=login&op=check_email',
                    type: 'get',
                    data:{
                        email : function(){
                            return $('#email').val();
                        }
                    }
                }
            },
            mobile:{
            	required : true,
				phones:true
            },
            city_id:{
            	required : true,
            	number : true
            },
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
            },
            agree : {
                required : true
            }
        },
        messages : {
            member_name : {
                required : '<?php echo $lang['nc_username_is_not_null'];?>',
                lettersmin : '<?php echo $lang['nc_username_range'];?>',
                lettersmax : '<?php echo $lang['nc_username_range'];?>',
				lettersonly: '<?php echo $lang['nc_username_lettersonly'];?>',
				remote	 : '<?php echo $lang['nc_username_exists'];?>'
            },
            password  : {
                required : '<?php echo $lang['nc_password_is_not_null'];?>',
                minlength: '<?php echo $lang['nc_password_range'];?>',
				maxlength: '<?php echo $lang['nc_password_not_same'];?>'
            },
            password_confirm : {
                required : '<?php echo $lang['nc_password_is_not_null'];?>',
                equalTo  : '<?php echo $lang['nc_password_not_same'];?>'
            },
            email : {
                required : '<?php echo $lang['nc_email_is_not_null'];?>',
                email    : '<?php echo $lang['nc_email_invalid'];?>',
				remote	 : '<?php echo $lang['nc_email_exists'];?>'
            },
            mobile:{
            	required : '<?php echo $lang['nc_register_mobileis_is_not_null'];?>',
				phones :'手机格式不正确!'
            },
            city_id:{
            	required : '<?php echo $lang['nc_register_city_is_not_null'];?>',
            	number : '<?php echo $lang['nc_register_city_is_not_null'];?>'
            },
            captcha : {
                required : '<?php echo $lang['nc_captcha_is_not_null'];?>',
		   		remote	 : '<?php echo $lang['nc_captcha_is_wrong'];?>'
            },
            agree : {
                required : '<?php echo $lang['nc_must_agree'];?>'
            }
        }
    });
});
</script>