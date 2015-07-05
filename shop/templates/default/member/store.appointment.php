<div class="layout clearfix">
<div class="mainbox setup_box">
  <div class="hd">
    <h3><?php echo $lang['nc_member_appointment'];?></h3>
    <span>(<i class="c1">*</i><?php echo $lang['nc_required_item'];?>)</span>
  </div>
  <div class="con">
    <div class="form_box">
      <form id="apply_form" enctype="multipart/form-data" method="post">
        <ul>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_member_appointment_open'];?>：</label>
            </div>
            <div class="pt fi">
				<input class="rp" type='radio' name='is_appointment' value='2' <?php if($output['store']['is_appointment'] ==2 ){ echo 'checked';}?>>
				<label for=""><?php echo $lang['nc_member_store_use'];?></label>
				<input class="rp" type='radio' name='is_appointment' value='1' <?php if($output['store']['is_appointment'] ==1 ){ echo 'checked';}?>>
				<label for=""><?php echo $lang['nc_member_store_stop'];?></label>
            </div>
          </li> 
		  <div class='card_detail'> 
		  
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_appointment_photo'];?>：</label>
            </div>
            <div class="pt">
				<input type='file' name='appointment_pic'>
				<label for='card_pic' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li> 
          <?php if(!empty($output['store']['appointment_pic'])){?>
          <li>
            <div class="tit">
            	<label for="">已上传：</label>
            </div>
            <div class="pt">
				<img src="<?php echo BASE_SITE_URL.DS.'data/upload/shop/appointment'.DS.$output['store']['appointment_pic'];?>">
            </div>
          </li> 
          <?php }?>
		  </div>
        </ul>
		<div class="btn_box"> 
			<input type='hidden' name='store_id' value="<?php echo $output['info']['store_id'];?>">
			<span class="f_btn">
				<button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_save'];?></button>
			</span> 
		</div>
      </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
var SITE_URL = '<?php echo BASE_SITE_URL; ?>';
$(function(){	
	$("input[name=is_card]").click(function(){
		if($(this).val() == 1){
			$('.card_detail').show();
		}else{
			$('.card_detail').hide();
		}
	});

    $("#apply_form").validate({
        errorPlacement: function(error, element){
           var error_td = element.parent('div');
            error_td.append(error);
        },
        submitHandler:function(form){
            ajaxpost('apply_form', '', '', 'onerror');
        },
        rules: {
        	card_pic:{
				accept:'jpg|png|gif'
			}
        },
        messages: {
        	card_pic:{
				accept:'<?php echo $lang['nc_pic_format_wrong'];?>'
			}
        }
    });
});
</script>