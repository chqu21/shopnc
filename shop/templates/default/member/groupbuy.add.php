<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_store_group_manage'];?></h3>
    </div>
    <div class="con">
      <div class="form_box">
        <form method="post" enctype="multipart/form-data" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_name'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="group_name" id="group_name" maxlength="50"/>
                
				<label for='group_name' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">团购名称是团购列表页面、展示页面的标题，最多为50个字符</label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_start_time'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="w120 input_plain"  type="text" name="start_time" id="start_time" maxlength="20" value=""/>
				<label for="start_time" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_end_time'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="w120 input_plain"  type="text" name="end_time" id="end_time" maxlength="20" value=""/>
				<label for="end_time" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_original_price'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
				<input class="w60 input_plain"  type="text" name="original_price" id="original_price" maxlength="7" value=""/>
				<label for="original_price" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_group_price'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
				<input class="w60 input_plain"  type="text" name="group_price" id="group_price" maxlength="7" value=""/>
				<label for="group_price" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for="buyer_count">团购总数：</label>
              </div>
              <div class="pt">
				<input class="w60 input_plain"  type="text" name="buyer_count" id="buyer_count" maxlength="7" value=""/>
				<label for="buyer_count" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_buyer_limit'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
				<input class="w60 input_plain"  type="text" name="buyer_limit" id="buyer_limit" maxlength="7" value=""/>
				<label for="buyer_limit" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo '过期退款'.$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
				<input type="radio" name="is_refund" value="1" checked>&nbsp;是&nbsp;&nbsp;
				<input type="radio" name="is_refund" value="2">&nbsp;否
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_pic'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
				<input type="file" name="groupbuy_pic" id='groupbuy_pic'>
				<label for="groupbuy_pic" class="error msg_invalid" style='display:none;'></label>	
				<label for=""><?php echo $lang['nc_member_store_groupbuy_pic_size'];?></label>
			  </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_help'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <?php showEditor('group_help','','600px','300px','','true',false);?>
              </div>
            </li>
			<li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_group_intro'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <?php showEditor('group_intro','','600px','300px','','true',false);?>
              </div>
            </li>
          </ul>
          <div class="btn_box"> <span class="f_btn">
            <input type="button" class="btn_txt J_submit" value="<?php echo $lang['nc_save'];?>" onclick="javascript:groupbuysubmit();"/>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">
function groupbuysubmit(){
	$('#apply_form').submit();
}

$(function(){
	$('#start_time').datepicker({dateFormat: 'yy-mm-dd'});
	$('#end_time').datepicker({dateFormat: 'yy-mm-dd'});

	jQuery.validator.methods.nowDate = function(value, element) {
		return new Date() <= new Date(Date.parse(value.replace(/-/g, "/")));
    };

	jQuery.validator.methods.endDate = function(value, element) {
        var startDate = $("#start_time").val();
        var date1 = new Date(Date.parse(startDate.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };

	jQuery.validator.methods.grouplimit = function(value, element) {
		var buyer_count = parseInt($('#buyer_count').val());
		return buyer_count > value;
    };

	jQuery.validator.methods.groupprice = function(value, element) {
		var original_price = parseInt($('#original_price').val());
		return original_price > value;
    };

    $("#apply_form").validate({
        rules: {
            group_name: {
				required:true
            },
			start_time:{
				required : true,
				nowDate:true
			},
			end_time:{
				required:true,
				endDate:true
			},
			original_price:{
				required:true,
				number : true,
                min : 0.01,
                max : 1000000
			},
			group_price:{
				required:true,
				number : true,
                min : 0.01,
                max : 1000000,
				groupprice:true
			},
			groupbuy_pic:{
				required:true,
				accept : 'jpg|jpeg|gif|png'
			},
			buyer_count:{
				required:true,
				number : true,
			},
			buyer_limit:{
				required:true,
				number : true,
				grouplimit:true
			}
        },
        messages: {
            group_name: {
				required:'<?php echo $lang['nc_member_store_group_name_is_not_null'];?>',
            },
			start_time:{
				required:'<?php echo $lang['nc_member_store_start_time_is_not_null'];?>',
				nowDate:'开始时间大于当前时间'
			},
			end_time:{
				required:'<?php echo $lang['nc_member_store_end_time_is_not_null'];?>',
				endDate:'结束时间大于开始时间'
			},
			original_price:{
				required:'<?php echo $lang['nc_member_store_original_price_is_not_null'];?>',
				number:'<?php echo $lang['nc_member_store_original_price_is_not_format'];?>',
				min:'<?php echo $lang['nc_member_store_original_price_is_not_format'];?>',
				max:'<?php echo $lang['nc_member_store_original_price_is_not_format'];?>'
			},
			group_price:{
				required:'团购价格不能为空',
				number:'<?php echo $lang['nc_member_store_groupbuy_price_is_not_format'];?>',
				min:'<?php echo $lang['nc_member_store_groupbuy_price_is_not_format'];?>',
				max:'<?php echo $lang['nc_member_store_groupbuy_price_is_not_format'];?>',
				groupprice:'团购价格小于原价'
			},
			groupbuy_pic:{
				required:'<?php echo $lang['nc_member_store_groupbuy_pic_is_not_null'];?>',
				accept:'<?php echo $lang['nc_member_store_groupbuy_pic_format'];?>'
			},
			buyer_count:{
				required:'团购总数不能为空',
				number:'<?php echo $lang['nc_member_store_groupbuy_num_is_not_format'];?>',
			},
			buyer_limit:{
				required:'购买上限不能为空',
				number:'<?php echo $lang['nc_member_store_groupbuy_limit_is_not_format'];?>',
				grouplimit:'不能超过团购总数'
			}
        }
    });
});
//]]>
</script>