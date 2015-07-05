<div class="layout clearfix">
<div class="mainbox setup_box">
  <div class="hd">
    <h3><?php echo $lang['nc_member_store_member_card'];?></h3>
    <span>(<i class="c1">*</i><?php echo $lang['nc_required_item'];?>)</span>
  </div>
  <div class="con">
    <p class="con_hints"><?php echo $lang['nc_member_store_member_card_tips'];?></p>
    <div class="form_box">
      <form id="apply_form" enctype="multipart/form-data" method="post">
        <ul>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_member_store_member_card_use'];?>：</label>
            </div>
            <div class="pt fi">
				<input class="rp" type='radio' name='is_card' value='1' <?php if($output['info']['is_card']=='1'){ echo 'checked';}?>>
				<label for=""><?php echo $lang['nc_member_store_use'];?></label>
				<input class="rp" type='radio' name='is_card' value='0' <?php if($output['info']['is_card']=='0'){ echo 'checked';}?> >
				<label for=""><?php echo $lang['nc_member_store_stop'];?></label>
            </div>
          </li> 
		  <div class='card_detail'>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_store_member_card_discount'];?>：</label>
            </div>
            <div class="pt">
			   <input type="text" maxlength="20" id="card_discount" name="card_discount" class="w50 input_plain" value="<?php echo $output['info']['card_discount'];?>">折
               <label for='card_discount' class='error msg_invalid' style='display:none;'></label>	
            </div>
          </li> 
          
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_store_member_card_des'];?>：</label>
            </div>
            <div class="pt">
			   <textarea style="width: 364px; height: 92px;"  name='card_des' maxlength="200"><?php echo $output['info']['card_des'];?></textarea>  
            </div>
          </li> 
          
          <li>
            <div class="tit">
              <label for="">&nbsp;</label>
            </div>
            <div class="pt">
			   <label for="" class="ptinfo">会员卡描述用于说明会员卡，最多200个字符</label>	   
            </div>
          </li>       
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_store_member_card_pic'];?>：</label>
            </div>
            <div class="pt">
				<input type='file' name='card_pic'>
				<label for='card_pic' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li> 
          <?php if(!empty($output['info']['card_pic'])){?>
          <li>
            <div class="tit">
            	<label for="">已上传：</label>
            </div>
            <div class="pt">
				<img src="<?php echo BASE_SITE_URL.DS.'data/upload/shop/card'.DS.$output['info']['card_pic']; ?>">
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
	var is_card = '<?php echo $output['info']['is_card']?>';
	if(is_card == 1){
		$('.card_detail').show();
	}else{
		$('.card_detail').hide();
	}
	
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
        	card_discount:{
				required:true,
        		max:10,
        		min:0
            },
        	card_pic:{
				accept:'jpg|png|gif'
			}
        },
        messages: {
        	card_discount:{
        		required:'折扣不能为空',
				max:'折扣的数值区间0-10',
				min:'折扣的数值区间0-10'
            },
        	card_pic:{
				accept:'<?php echo $lang['nc_pic_format_wrong'];?>',
			}
        }
    });
});
</script>