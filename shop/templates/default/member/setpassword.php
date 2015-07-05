<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_set_password'];?></h3>
      <span>(<i class="c1">*</i><?php echo $lang['nc_required_item'];?>)</span>
      <div class="card-btn-rt"></div>
    </div>
    <div class="con">
      <div class="form_box">
        <form id="apply_form" enctype="multipart/form-data" method="post">
          <ul>
            <li>
              <div class="tit"> <i class="required">*</i>
                <label for=""><?php echo $lang['nc_member_old_password'];?>：</label>
              </div>
              <div class="pt">
                <input type="password" maxlength="20" id="old_password" name="old_password" class="w250 input_plain" value="<?php echo $output['info']['store_name'];?>">
                <label for='old_password' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit"><i class="required">*</i>
                <label for=""><?php echo $lang['nc_member_new_password'];?>：</label>
              </div>
              <div class="pt">
                <input type="password" maxlength="20" id="new_password" name="new_password" class="w250 input_plain" value="<?php echo $output['info']['alisa'];?>">
                <label for='new_password' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit"><i class="required">*</i>
                <label for="sure_password"><?php echo $lang['nc_member_sure_password'];?>：</label>
              </div>
              <div class="pt">
                <input type="password" maxlength="20" id="sure_password" name="sure_password" class="w250 input_plain" value="<?php echo $output['info']['alisa'];?>">
                <label for='sure_password' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
          </ul>
          <div class="btn_box"> 
            <span class="f_btn">
            <button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_update'];?></button>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var SITE_URL = '<?php echo BASE_SITE_URL; ?>';
$(function(){	
    $("#apply_form").validate({
        errorPlacement: function(error, element){
           var error_td = element.parent('div');
            error_td.append(error);
        },
        submitHandler:function(form){
            ajaxpost('apply_form', '', '', 'onerror');
        },
        rules: {
            old_password: {
				required:true,
				remote   : {
                    url : 'index.php?act=storesetting&op=check_password',
                    type: 'get',
                    data:{
                        old_password : function(){
                            return $('#old_password').val();
                        }
                    }
                }
            },
			new_password:{
				required:true,
				minlength: 6,
				maxlength: 20
			},
			sure_password:{
				required:true,
				minlength: 6,
				maxlength: 20,
                equalTo  :'#new_password'
			}			
        },
        messages: {
            old_password: {
				required:'<?php echo $lang['nc_member_old_password_not_null'];?>',
				remote:'<?php echo $lang['nc_member_old_password_fail'];?>'
            },
			new_password:{
				required:'<?php echo $lang['nc_member_new_password_not_null']?>',
				minlength: '<?php echo $lang['nc_member_length_password']?>',
				maxlength: '<?php echo $lang['nc_member_length_password']?>'
			},
			sure_password:{
				required:'<?php echo $lang['nc_member_sure_password_not_null']?>',
				minlength: '<?php echo $lang['nc_member_length_password']?>',
				maxlength: '<?php echo $lang['nc_member_length_password']?>',
                equalTo  :'<?php echo $lang['nc_member_password_comper_not']?>'		
			}			
        }
    });
});
</script>