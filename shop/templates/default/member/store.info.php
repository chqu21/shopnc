<div class="layout clearfix">
<div class="mainbox setup_box">
  <div class="hd">
    <h3><?php echo $lang['nc_shop_info'];?></h3>
    <span>(<i class="c1">*</i><?php echo $lang['nc_required_item'];?>)</span></div>
  <div class="con">
    <p class="con_hints"><?php echo $lang['nc_create_store_tip'];?></p>
    <div class="form_box">
      <form action="index.php?act=storedetail" id="apply_form" enctype="multipart/form-data" method="post">
        <ul>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_store_name'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" id="store_name" name="store_name" class="w400 input_plain" maxlength="20">
			  <label for='store_name' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
          <li>
              <div class="tit">&nbsp;</div>
              <div class="pt"><label for="" class="ptinfo">商户名称是店铺的名称，显示在店铺详情，最多20个字符</label></div>
            </li>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_othername'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" id="alisa" name="alisa" class="w230 input_plain" maxlength="20">
			  <label for='alisa' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
		  <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_member_store_email'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" id="email" name="email" class="w230 input_plain">
			  <label for='email' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_category'];?>：</label>
            </div>
            <div class="pt sb">
				<?php if(!empty($output['class_list'])){?>
				<select name='class'>
					<option value=''><?php echo $lang['nc_select'];?></option>
					<?php foreach($output['class_list'] as $classkey=>$classval){?>
					<option value="<?php echo $classval['class_id'];?>"><?php echo $classval['class_name'];?></option>
					<?php }?>
				</select>
				<?php }?>
				<select name='s_class' id='s_class'>
					<option value=''><?php echo $lang['nc_select'];?></option>
				</select>
				<label for='s_class' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
          <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_address'];?>：</label>
            </div>
            <div class="pt sb">
				<?php if(!empty($output['area_list'])){?>
				<select name='city'>
					<option value='' nc_area_number=''><?php echo $lang['nc_select'];?></option>
					<?php foreach($output['area_list'] as $areakey=>$areaval){?>
					<option value="<?php echo $areaval['area_id'];?>" nc_area_number="<?php echo $areaval['area_number'];?>"><?php echo $areaval['area_name'];?></option>
					<?php }?>
				</select>
				<?php }?>
				<select name='area'>
					<option value=''><?php echo $lang['nc_select'];?></option>
				</select>	
				<select name='mall' id='mall'>
					<option value=''><?php echo $lang['nc_select'];?></option>
				</select>
				<label for='mall' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
          
          <li>
            <div class="tit">
              <label for="">&nbsp;</label>
            </div>
            <div class="pt">
              <input type="text" id="address" name="address" class="w400 input_plain">
			  <label for='address' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li> 
          
          <li id="brand" style="display:none;">
            <div class="tit">
              <label for=""><?php echo $lang['nc_store_login_brand_name'];?>：</label>
            </div>
            <div class="pt">
				<select name="brand_id">
					<?php if(!empty($output['brand'])){?>
					<?php foreach($output['brand'] as $val){?>
					<option value="<?php echo $val['brand_id'];?>"><?php echo $val['brand_name'];?></option>
					<?php }?>
					<?php }?>
				</select>
            </div>
          </li>   
               
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_store_pic'];?>：</label>
            </div>
            <div class="pt">
              <input type="file" id="pic" name="pic" class="w230 input_plain">
              <label for='pic' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
                  
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_nearby'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" maxlength="20" id="side" name="side" class="w400 input_plain">
            </div>
          </li> 
                  
		  <li>
            <div class="tit"> <i class="required">*</i>
              <label for=""><?php echo $lang['nc_telephone'];?>：</label>
            </div>
            <div class="pt">
			  <!--
              <label id="area_number"><?php echo $lang['nc_area_number'];?></label>
			  <input type="hidden" name="area_number">
			  &nbsp;-&nbsp;-->
			  <input type="text" maxlength="20" id="telephone" name="telephone" class="w150 input_plain">
			  <label for='telephone' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>  
          
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_business_hour'];?>：</label>
            </div>
            <div class="pt">
			   <input type="text" maxlength="50" id="business_hour" name="business_hour" class="w400 input_plain">
            </div>
          </li> 
          <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">营业时间为商户经营时间设置，最多50个字符</label>
              </div>
          </li>             
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_bus'];?>：</label>
            </div>
            <div class="pt">
			   <input type="text" maxlength="50" id="bus" name="bus" class="w400 input_plain">
            </div>
          </li>   
          
          <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">商铺周边交通信息或者换乘方式，最多50个字符</label>
              </div>
          </li>
          
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_subway'];?>：</label>
            </div>
            <div class="pt">
			   <input type="text" maxlength="50" id="subway" name="subway" class="w400 input_plain">
            </div>
          </li>  
          <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">商铺周边地铁信息，最多50个字符</label>
              </div>
            </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_description'];?>：</label>
            </div>
            <div class="pt">
			   <textarea id="description" name="description" style="width: 364px; height: 92px;"></textarea>
            </div>
          </li> 
        </ul>
		<div class="btn_box"> 
			<span class="f_btn">
				<input type='hidden' name='store_id' value="<?php echo $_SESSION['store_id'];?>">
				<button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_now_open_shop'];?></button>
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
	$("select[name=class]").change(function(){
		var class_id = $(this).val();
		$.ajax({
			type:'GET',
			url:'index.php?act=storedetail&op=ajax&type=class&class_id='+class_id,
			success:function(json){
				var html = '<option value="">'+'<?php echo $lang['nc_select'];?>'+'</option>'; 
				if(json){
					var data = eval("("+json+")");
					$.each(data,function(i,val){
						html+='<option value="'+val.class_id+'">'+val.class_name+'</option>';
					});
				}
				$("select[name=s_class]").html(html);
			}
		});
	});

	$("select[name=city]").change(function(){
		var area_id = $(this).val();
		//var area_number = $("select[name=city] option:selected").attr('nc_area_number');

		//if(area_number==''){
		//	$('#area_number').html('<?php echo $lang['nc_area_number'];?>');
		//	$("input[name=area_number]").val();
		//}else{
		//	$('#area_number').html(area_number);
		//	$("input[name=area_number]").val(area_number);
		//}
		$.ajax({
			type:'GET',
			url:'index.php?act=storedetail&op=ajax&type=area&area_id='+area_id,
			success:function(json){
				var html = '<option value="">'+'<?php echo $lang['nc_select'];?>'+'</option>'; 
				var mall = '<option value="">'+'<?php echo $lang['nc_select'];?>'+'</option>'; 
				if(json){
					var data = eval("("+json+")");
					$.each(data,function(i,val){
						html+='<option value="'+val.area_id+'">'+val.area_name+'</option>';
					});
				}
				$("select[name=area]").html(html);
				$("select[name=mall]").html(mall);
			}
		});
	});
	
	$("select[name=area]").change(function(){
		var area_id = $(this).val();
		$.ajax({
			type:'GET',
			url:'index.php?act=storedetail&op=ajax&type=area&area_id='+area_id,
			success:function(json){
				var html = '<option value="">'+'<?php echo $lang['nc_select'];?>'+'</option>'; 
				if(json){
					var data = eval("("+json+")");		
					$.each(data,function(i,val){
						html+='<option value="'+val.area_id+'">'+val.area_name+'</option>';
					});	
				}
				$("select[name=mall]").html(html);
			}			
		});
	});

	$("input[name=brand_store]").click(function(){
		if($(this).val() == '1'){
			$('#brand').show();
		}else{
			$('#brand').hide();
		}
	});
	
    $("#apply_form").validate({
        errorPlacement: function(error, element){
           var error_td = element.parent('div');
            error_td.append(error);
        },
        rules: {
            store_name: {
				required:true
            },
			alisa:{
				required:true
			},
			email:{
				required:true,
				email:true
			},
			s_class:{
				required:true		
			},
			mall:{
				required:true			
			},
			pic:{
				accept : 'jpg|jpeg|gif|png'
			},
			telephone:{
				required:true,
				//number:true
			}
        },
        messages: {
            store_name: {
				required:'<?php echo $lang['nc_store_name_not_null'];?>'
            },
			alisa:{
				required:'<?php echo $lang['nc_alisa_name_not_null']?>'
			},
			email:{
				required:'<?php echo $lang['nc_member_store_email_is_not_null'];?>',
				email:'<?php echo $lang['nc_member_store_email_format_is_wrong'];?>'					
			},
			s_class:{
				required:'<?php echo $lang['nc_class_name_not_null']?>'		
			},
			mall:{
				required:'<?php echo $lang['nc_area_name_not_null']?>'			
			},
			pic:{
				accept:'图片格式不正确'
			},
			telephone:{
				required:'<?php echo $lang['nc_telephone_not_null'];?>',
				//number:'<?php echo $lang['nc_telephone_is_number'];?>'
			}
        }
    });
});
</script>