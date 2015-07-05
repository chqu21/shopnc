<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3>编辑优惠券</h3>
    </div>
    <div class="con">
      <div class="form_box">
        <form method="post" enctype="multipart/form-data" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_coupon_name'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="coupon_name" id="coupon_name" value="<?php echo $output['coupon']['coupon_name'];?>" maxlength="50" />
				<label for='coupon_name' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">优惠券名称最多为50个字符</label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_the_period_validity'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w120 input_plain"  type="text" name="coupon_start_time" id="coupon_start_time" maxlength="20" value="<?php echo date("Y-m-d",$output['coupon']['coupon_start_time']);?>"/>
                &nbsp;-&nbsp;
                <input class="w120 input_plain"  type="text" name="coupon_end_time" id="coupon_end_time" maxlength="20" value="<?php echo date("Y-m-d",$output['coupon']['coupon_end_time']);?>"/>
				<label for="coupon_start_time" class="error msg_invalid" style='display:none;'></label>
				<label for="coupon_end_time" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_coupon_pic'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="" type="file" name="coupon_pic" id="coupon_pic" value=""/>
                <span style='margin-left:100px;'></span> 
				<label for="coupon_pic" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
            <?php if(!empty($output['coupon']['coupon_pic'])){?>
			<li>
              <div class="tit">
              	<label for=""><?php echo '已上传'.$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
				<img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.$output['coupon']['coupon_pic'];?>">
			  </div>
            </li>
            <?php }?>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_short_message'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="short_message" id="short_message" value="<?php echo $output['coupon']['short_message'];?>" maxlength="100" />
				<label for="short_message" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="">短信内容最多为100个字符</label>
              </div>
            </li>
			<!--
			<li>
              <div class="tit">
                <label for="">下载方式:</label>
              </div>
              <div class="pt">
				&nbsp;&nbsp;<input type="radio" name="download_type" value="1" <?php if($output['coupon']['download_type']==1){ echo 'checked';}?>>&nbsp;打印&nbsp;&nbsp;
				<input type="radio" name="download_type" value="2" <?php if($output['coupon']['download_type']==2){ echo 'checked';}?>>&nbsp;短信
              </div>
            </li>
			-->
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_coupon_des'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <?php showEditor('coupon_des',stripslashes(htmlspecialchars_decode($output['coupon']['coupon_des'])),'600px','300px','','true',false);?>
              </div>
            </li>
          </ul>
          <div class="btn_box"> <span class="f_btn">
			<input type='hidden' name='coupon_id' value="<?php echo $output['coupon']['coupon_id'];?>">
            <input type="button" class="btn_txt J_submit" value="<?php echo $lang['nc_save'];?>"  onclick="javascript:couponsubmit();"/>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">

function couponsubmit(){
	$('#apply_form').submit();
}

$(function(){
	$('#coupon_start_time').datepicker({dateFormat: 'yy-mm-dd'});
	$('#coupon_end_time').datepicker({dateFormat: 'yy-mm-dd'});

	jQuery.validator.methods.nowDate = function(value, element) {
		return new Date() <= new Date(Date.parse(value.replace(/-/g, "/")));
    };
    
    jQuery.validator.methods.endDate = function(value, element) {
        var startDate = $("#coupon_start_time").val();
        var date1 = new Date(Date.parse(startDate.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };	

    $("#apply_form").validate({
        rules: {
            coupon_name: {
				required:true
            },
			coupon_start_time:{
				required:true,
				nowDate:true	
			},
			coupon_end_time:{
				required : true,
				endDate : true
			},
			<?php if(!empty($output['coupon']['coupon_pic'])){?>
			coupon_pic:{
				required:true,
				accept:'jpg|png|gif'		
			},
			<?php }?>
			short_message:{
				required : true	
			}
        },
        messages: {
            coupon_name: {
				required:'<?php echo $lang['nc_member_store_coupon_name_is_not_null'];?>'
            },
			coupon_start_time:{
				required:'<?php echo $lang['nc_member_store_coupon_start_is_not_null'];?>',
				nowDate:'<?php echo '开始时间大于当前时间';?>'
			},
			coupon_end_time:{
				required:'<?php echo $lang['nc_member_store_coupon_end_is_not_null'];?>',
				endDate:'结束时间大于开始时间'
			},
			<?php if(!empty($output['coupon']['coupon_pic'])){?>
			coupon_pic:{
				required:'<?php echo $lang['nc_member_store_coupon_pic_is_not_null'];?>',
				accept:'图片格式不正确'
			},
			<?php }?>
			short_message:{
				required:'短信内容不能为空'
			}
        }
    });
});
//]]>
</script>