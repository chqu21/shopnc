<div class="mainbox setup_box">
<div class="hd">
  <h3><?php echo $lang['nc_member_base_information'];?></h3>
  <span>(<i class="c1">*</i><?php echo $lang['nc_member_required_item'];?>)</span></div>
<div class="con">
  <p class="con_hints"><?php echo $lang['nc_member_base_help'];?></p>
  <div class="form_box">
	<form id="basic_info" method="post" action="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=account">
	  <ul>
	  	<li>
		  <div class="tit">
			<label>头像：</label>
		  </div>
		  <div class="pt">
			<a href="index.php?act=memberaccount&op=avatar"><img width="64" height="64" class="avatar" alt="<?php echo $lang['nc_member_title_avatar'];?>" src="<?php if(!empty($output['member']['avatar'])){ echo BASE_SITE_URL.'/data/upload/shop/member/'.$output['member']['avatar'];}else{ echo SHOP_TEMPLATES_URL.'/images/lsimg/avatar_photo.png';}?>"></a>
		  </div>
		</li>
		<li>
		  <div class="tit">
			<label><?php echo $lang['nc_member_username'];?>：</label>
		  </div>
		  <div class="pt">
			<label><?php echo $_SESSION['member_name'];?>&nbsp;&nbsp;<font style="color:red;">(用户名用于系统登录，昵称是用户在网站的别名)</font></label>
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label><?php echo $lang['nc_member_nickname'];?>：</label>
		  </div>
		  <div class="pt">
			<input type="text" value="<?php echo $output['member']['nickname'];?>" id="nickname" maxlength="24" class="input_plain c2 focus" name="nickname">&nbsp;&nbsp;<span style="line-height:30px; height:30px;">(昵称不能超过24个字符)</span>
			<label for='nickname' class='error msg_invalid' style='display:none;'></label>
		  </div>
		</li>
		<li>
		  <div class="tit">
			<label><?php echo $lang['nc_member_gender'];?>：</label>
		  </div>
		  <div class="pt fi">
			<select name="gender" class="city-select">
				<option value="0" selected><?php echo $lang['nc_member_secret'];?></option>
				<option value="1" <?php if($output['member']['gender'] == 1){ echo 'selected';}?>><?php echo $lang['nc_member_male'];?></option>
				<option value="2" <?php if($output['member']['gender'] == 2){ echo 'selected';}?>><?php echo $lang['nc_member_female'];?></option>
			</select>
		  </div>
		</li>
		<li>
		  <div class="tit"><i class="c1">*</i>
			<label for=""><?php echo $lang['nc_member_usercity']?>：</label>
		  </div>
		  <div class="pt">
		    <select name="first_letter" class="city-select">
		    	<?php foreach ($output['letter_array'] as $val){ ?>
		    	<option value="<?php echo $val; ?>" <?php if($output['member']['first_letter']==$val){ ?>selected<?php } ?>><?php echo $val; ?></option>
		    	<?php } ?>
		    </select>
		  	<select name='usercity' class="city-select">
		  		<?php if(!empty($output['area'])){?>
		  		<?php foreach($output['area'] as $area){?>
		  		<option value="<?php echo $area['area_id'];?>" <?php if($area['area_id'] == $output['member']['usercity']){ echo 'selected';}?>><?php echo $area['area_name'];?></option>
		  		<?php }?>
		  		<?php }?>
		  	</select>
			<label for='usercity' class='error msg_invalid' style='display:none;'></label>
		  </div>
		</li>
		<li>
		  <div class="tit">
			<label for=""><?php echo $lang['nc_member_introduce'];?>：</label>
		  </div>
		  <div class="pt">
			<textarea id="J_sign" class="tp c2" rows="5" cols="" name="introduce" maxlength="200" style="overflow:auto"><?php echo $output['member']['introduce'];?></textarea>&nbsp;&nbsp;(自我介绍不能超过200个字符)
			<label for='introduce' class='error msg_invalid' style='display:none;'></label>
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
		$('select[name="first_letter"]').change(function(){
			var letter	=	$(this).val();
			$.getJSON('index.php?act=login&op=ajax_getcity&letter='+letter, function(result){
		        if(result.done){
			        $('select[name="usercity"]').html('');
		        	for(var i=0,l=result.data.length;i<l;i++){
		        		$('select[name="usercity"]').append('<option value="'+result.data[i]['area_id']+'">'+result.data[i]['area_name']+'</option>');
		        	}
		        }else{
		            alert('获取城市列表失败');
		        }
		    });
		});
		$('#basic_info').validate({
			errorPlacement: function(error, element){
			   var error_td = element.parent('div');
				error_td.append(error);
			},
			submitHandler:function(form){
				ajaxpost('basic_info', '', '', 'onerror');
			},
			rules:{
				nickname:{
					required:true
				},
				usercity:{
					required:true	
				}
			},
			messages:{
				nickname:{
					required:'<?php echo $lang['nc_nickname_is_not_null'];?>'
				},
				usercity:{
					required:'<?php echo $lang['nc_usercity_is_not_null'];?>'	
				}
			}
		});
	});
</script>