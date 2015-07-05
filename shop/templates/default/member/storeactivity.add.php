<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_store_activity_add']?></h3>
    </div>
    <div class="con">
      <div class="form_box">    
        <form method="post" enctype="multipart/form-data" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_activity_name'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="activity_name" id="activity_name" maxlength="50" value=""/>
				
				<label for='activity_name' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">活动名称最多为50个字符</label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_activity_time'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w120 input_plain"  type="text" name="start_time" id="start_time" maxlength="20" value=""/>
                &nbsp;-&nbsp;
                <input class="w120 input_plain"  type="text" name="end_time" id="end_time" maxlength="20" value=""/>
				<label for="start_time" class="error msg_invalid" style='display:none;'></label>
				<label for="end_time" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
			<li>
              <div class="tit">
                <label for="">报名截止时间：</label>
              </div>
              <div class="pt">
				<input class="w120 input_plain"  type="text" name="apply_time" id="apply_time" />
				<label for="apply_time" class="error msg_invalid" style='display:none;'></label>
			  </div>				
			</li>
			<li>
			  <div class="tit">
                <label for="">报名项：</label>
              </div>
              <div class="pt">
				<p id="apply_item"><input class="w120 input_plain apply_item"  type="text" name="apply_item[]" maxlength="20" value=""/>&nbsp;&nbsp;</p>
			  </div>		
			</li>
			<li>
			  <div class="tit">&nbsp;</div>
              <div class="pt">
				<label><a href="javascript:;" id="apply_add" style="color:red;">[添加]</a>&nbsp;&nbsp;报名项为会员参见活动的时候，选择参加活动的项目，商家最多可以填写5个</label>
			  </div>		
			</li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_activity_pic'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="" type="file" name="activity_pic" id="activity_pic"/>
				<label for="activity_pic" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_activity_description'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <?php showEditor('description','','600px','300px','','false',false);?>
              </div>
            </li>
          </ul>
          <div class="btn_box"> <span class="f_btn">
            <input type="button" class="btn_txt J_submit" value="<?php echo $lang['nc_save'];?>" onclick="javascript:submitactivity();"/>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">

function submitactivity(){
	$('#apply_form').submit();
}

$(function(){

	$('#start_time').datepicker({dateFormat: 'yy-mm-dd'});
	$('#end_time').datepicker({dateFormat: 'yy-mm-dd'});
	$('#apply_time').datepicker({dateFormat: 'yy-mm-dd'});

	jQuery.validator.methods.endDate = function(value, element) {
        var startDate = $("#start_time").val();
        var date1 = new Date(Date.parse(startDate.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };

	jQuery.validator.methods.nowDate = function(value, element) {
		return new Date() <= new Date(Date.parse(value.replace(/-/g, "/")));
    };

	jQuery.validator.methods.applyDate = function(value,element) {
		var startDate = $("#start_time").val();
		var endDate = $("#end_time").val();

        var start = new Date(Date.parse(startDate.replace(/-/g, "/")));
        var end = new Date(Date.parse(endDate.replace(/-/g, "/")));
		var date = new Date(Date.parse(value.replace(/-/g, "/")));

		return date>start && date<end; 
	}

	$('#apply_add').click(function(){
		
		var i = $('.apply_item').size();

		if(i>4){
			alert('不能超过5个报名项！');
			return false;
		}

		var html = '<input class="w120 input_plain apply_item"  type="text" name="apply_item[]" maxlength="20" value=""/>&nbsp;&nbsp;';
		$('#apply_item').append(html);
	});

    $("#apply_form").validate({
        rules: {
            activity_name: {
				required:true
            },
			start_time:{
				required:true,
				nowDate:true
			},
			end_time:{
				required:true,
				endDate :true
			},
			apply_time:{
				applyDate:true	
			},
			activity_pic:{
				required:true,
				accept:'jpg|png|gif'
			}
        },
        messages: {
        	activity_name: {
				required:'<?php echo $lang['nc_member_store_activity_name_is_not_null'];?>'
            },
			start_time:{
				required:'<?php echo $lang['nc_member_store_activity_time_is_not_null'];?>',
				nowDate:'大于当前时间'
			},
			end_time:{
				required:'<?php echo $lang['nc_member_store_activity_time_is_not_null'];?>',
				endDate:'<?php echo $lang['nc_member_start_is_not_than_end'];?>'
			},
			apply_time:{
				applyDate:'报名截止时间大于开始时间，小于结束时间'
			},
			activity_pic:{
				required:'活动图片不能为空',
				accept:'图片格式不正确'
			}
        }
    });
});
//]]>
</script>