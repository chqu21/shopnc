<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_shop_info'];?></h3>
      <span>(<i class="c1">*</i><?php echo $lang['nc_required_item'];?>)</span>
      <div class="card-btn-rt">
      <ul>
	      <li class="card-add"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=storesetting&op=card"><?php echo $lang['nc_member_store_member_card'];?></a></li>
	      <li>|</li>
	      <li  class="card-search"><a href="index.php?act=storesetting&op=member"><?php echo $lang['nc_member_store_member_view_member'];?></a></li>
      	  <li>|</li>
      	  <li><a href="index.php?act=storesetting&op=setpassword"><?php echo $lang['nc_member_set_password'];?></a></li>
           <li>|</li>
      	  <li><a href="index.php?act=storesetting&op=appointment"><?php echo $lang['nc_member_appointment'];?></a></li>
		  <li>|</li>
		  <li><a href="index.php?act=storesetting&op=appointmentlist"><?php echo $lang['nc_member_appointment_list'];?></a></li>
		  <li>|</li>
		  <li><a href="index.php?act=storesetting&op=avatar">修改头像</a></li>
      </ul>
   </div>
      
       </div>
    <div class="con">
      <p class="con_hints"><?php echo $lang['nc_create_store_tip'];?></p>
      <div class="form_box">
        <form id="apply_form" enctype="multipart/form-data" method="post">
          <ul>
            <li>
              <div class="tit"> <i class="required">*</i>
             <label for=""><?php echo $lang['nc_store_name'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="store_name" name="store_name" class="w250 input_plain fl" value="<?php echo $output['info']['store_name'];?>">
                
                <label for='store_name' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">&nbsp;</div>
              <div class="pt"><label for="" class="ptinfo">商户名称是店铺的名称，显示在店铺详情，最多20个字符</label></div>
            </li>
            <li>
              <div class="tit"><i class="required">*</i>
                <label for=""><?php echo $lang['nc_othername'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="alisa" name="alisa" class="w230 input_plain" value="<?php echo $output['info']['alisa'];?>">
                <label for='alisa' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>

			<!-- 邮箱 -->
			<li>
              <div class="tit"><i class="required">*</i>
                <label for=""><?php echo $lang['nc_email'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" id="email" name="email" class="w230 input_plain" value="<?php echo $output['info']['email'];?>">
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
                  <option value="<?php echo $classval['class_id'];?>" <?php if($classval['class_id']==$output['info']['class_id']){ echo 'selected';}?>><?php echo $classval['class_name'];?></option>
                  <?php }?>
                </select>
                <?php }?>
                <select name='s_class'>
                  <option value=''><?php echo $lang['nc_select'];?></option>
                </select>
                <span id="settle_show">分佣比例：<?php echo $output['settle_show']; ?>%</span>
                <label for='s_class' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit"> <i class="required">*</i>
                <label for=""><?php echo $lang['nc_address'];?>：</label>
              </div>
              <div class="pt sb">
                <select name='city'>
                  <option value='' nc_area_number=''><?php echo $lang['nc_select'];?></option>
                  <?php if(!empty($output['area_list'])){?>
                  <?php foreach($output['city_list'] as $citykey=>$cityval){?>
                  <option value="<?php echo $cityval['area_id'];?>" nc_area_number="<?php echo $cityval['area_number'];?>" <?php if($cityval['area_id']==$output['info']['city_id']){ echo 'selected';}?>><?php echo $cityval['area_name'];?></option>
                  <?php }?>
                  <?php }?>
                </select>
                <select name='area'>
                  <option value=''><?php echo $lang['nc_select'];?></option>
                  <?php if(!empty($output['area_list'])){?>
                  <?php foreach($output['area_list'] as $areakey=>$areaval){?>
                  <option value="<?php echo $areaval['area_id'];?>" <?php if($areaval['area_id']==$output['info']['area_id']){ echo 'selected';}?>><?php echo $areaval['area_name'];?></option>
                  <?php }?>
                  <?php }?>
                </select>
                <select name='mall'>
                  <option value=''><?php echo $lang['nc_select'];?></option>
                  <?php if(!empty($output['mall_list'])){?>
                  <?php foreach($output['mall_list'] as $mallkey=>$mallval){?>
                  <option value="<?php echo $mallval['area_id'];?>" <?php if($mallval['area_id']==$output['info']['mall_id']){ echo 'selected';}?>><?php echo $mallval['area_name'];?></option>
                  <?php }?>
                  <?php }?>
                </select>
                <label for='mall' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<div id="container1" style="width:400px;height:200px;"></div>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
                <input type="text"  id="address" name="address" class="w400 input_plain fl" value="<?php echo $output['info']['address'];?>">
                <label for='address' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_store_logo'];?>：</label>
              </div>
              <div class="pt">
                <input type="file" id="logo" name="logo" class="w230 input_plain">
                <label for='logo' class='error msg_invalid' style='display:none;'></label>
              </div>
              <?php if(!empty($output['info']['logo'])){?>
              <div class="mt20 ptimg"> <img width="210" height="132" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['info']['logo'];?>"> </div>
              <?php }?>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_store_pic'];?>：</label>
              </div>
              <div class="pt">
                <input type="file" id="pic" name="pic" class="w230 input_plain">
                <label for='pic' class='error msg_invalid' style='display:none;'></label>
              </div>
              <?php if(!empty($output['info']['pic'])){?>
              <div class="mt20 ptimg"> <img width="500px" height="280" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['info']['pic'];?>"> </div>
              <?php }?>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_nearby'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="side" name="side" class="w400 input_plain" value="<?php echo $output['info']['side'];?>">
              </div>
            </li>
            <li>
              <div class="tit">
              <i class="required">*</i>
                <label for=""><?php echo $lang['nc_telephone'];?>：</label>
              </div>
              <div class="pt">
				<!--
                <label id="area_number" class="pt_area"><?php echo $output['tele_area'];?>&nbsp;-&nbsp;</label>
                <input type="hidden" name="area_number" value="<?php echo $output['tele_area'];?>">
                -->
                <input type="text" maxlength="20" id="telephone" name="telephone" class="w150 input_plain" value="<?php echo $output['info']['telephone'];?>">
                <label for='telephone' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_business_hour'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" id="business_hour" name="business_hour" class="w400 input_plain" value="<?php echo $output['info']['business_hour'];?>" maxlength="50">   	
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
                <input type="text" id="bus" name="bus" class="w400 input_plain" value="<?php echo $output['info']['bus'];?>" maxlength="50">
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
                <input type="text" id="subway" name="subway" class="w400 input_plain" value="<?php echo $output['info']['subway'];?>" maxlength="50">
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
                <label for=""><?php echo $lang['nc_store_label'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="store_label" name="store_label" class="w100 input_plain fl">
              <span class="add_btn fl"><a href="javascript:void(0);" class='label_add'><?php echo $lang['nc_store_label_add'];?></a></span></div>
            </li>
            <li style="width:800px; margin-left:130px; display:inline;">
              <div class="pt label_list" id="label_container">
                <?php if(!empty($output['labellist'])){?>
                <?php foreach($output['labellist'] as $label){?>
                <a label_id="<?php echo $label['label_id'];?>" class="tag-label"><i class="label_del">x</i><?php echo $label['label_name'];?></a>
                <?php }?>
                <?php }?>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_wx_account'];?>：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="wx_account" name="wx_account" class="w400 input_plain" value="<?php echo $output['info']['wx_account'];?>">
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_qr_code'];?>：</label>
              </div>
              <div class="pt">
                <input type='file' name='qr_code' id='qr_code' class="w230 input_plain">
                <label for='qr_code' class='error msg_invalid' style='display:none;'></label>
              </div>
              <div class="mt20 ptimg"> <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_QRCODE_PATH.DS.$output['info']['qr_code'];?>"> </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_description'];?>：</label>
              </div>
              <div class="pt">
                <textarea id="description" name="description" style="width: 364px; height: 92px;" maxlength="200"><?php echo $output['info']['description'];?></textarea>
              </div>
            </li>

            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">商铺描述为商铺介绍和说明，最多200个字符</label>
              </div>
            </li>
            
            <li>
              <div class="tit">
                <label for="">SEO标题：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="20" id="seo_title" name="seo_title" class="w400 input_plain" value="<?php echo $output['info']['seo_title'];?>">
              </div>
            </li>
	       	

            <li>
              <div class="tit">
                <label for="">SEO关键字：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="50" id="seo_keyword" name="seo_keyword" class="w400 input_plain" value="<?php echo $output['info']['seo_keyword'];?>">
              </div>
            </li>

     	    <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">用于店铺搜索引擎优化，最多50个字符</label>
              </div>
            </li>     
            	       
            <li>
              <div class="tit">
                <label for="">SEO描述：</label>
              </div>
              <div class="pt">
                <input type="text" maxlength="50" id="seo_description" name="seo_description" class="w400 input_plain" value="<?php echo $output['info']['seo_description'];?>">
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">用于店铺搜索引擎优化，最多50个字符</label>
              </div>
            </li>
            <?php if($GLOBALS['setting_config']['enabled_subdomain'] == '1'){ ?>
			<li>
              <div class="tit">
                <label for="">二级域名：</label>
              </div>
              <div class="pt">
                <input type="text" id="store_subdomain" name="store_subdomain" class="w80 input_plain" value="<?php echo $output['info']['store_subdomain'];?>">
                <label for="" class="ptinfo">（填写您店铺的二级域名词缀，只允许使用英文字符，例如：mystore）</label>
              </div>
            </li>
            <?php } ?>
          </ul>
          <div class="btn_box">
            <input type='hidden' name='store_id' value="<?php echo $output['info']['store_id'];?>">
            <span class="f_btn">
            <button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_save'];?></button>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var SITE_URL = '<?php echo BASE_SITE_URL; ?>';
$(function(){
	
	$("select[name=s_class]").load("index.php?act=storesetting&op=ajax&type=class&class_id="+'<?php echo $output['info']['class_id'];?>','',function(json){
		var html = '<option value="">'+'<?php echo $lang['nc_select'];?>'+'</option>';
		if(json){
			var data = eval("("+json+")");
			$.each(data,function(i,val){
				if(val.class_id == '<?php echo $output['info']['s_class_id'];?>'){
					html+='<option value="'+val.class_id+'" selected >'+val.class_name+'</option>';
				}else{
					html+='<option value="'+val.class_id+'">'+val.class_name+'</option>';
				}
			});
		}
		$("select[name=s_class]").html(html);
	});

	$("select[name=class]").change(function(){
		$('#settle_show').html('');
		var class_id = $(this).val();
		$.ajax({
			type:'GET',
			url:'index.php?act=storesetting&op=ajax&type=class&class_id='+class_id,
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
	
	$("select[name=s_class]").change(function(){
		var s_class = $(this).val();
		$.getJSON('index.php?act=storesetting&op=ajax_get_sc_settle&s_class='+s_class,function(result){
			if(result.done){
				$('#settle_show').html(result.msg);
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
			url:'index.php?act=storesetting&op=ajax&type=area&area_id='+area_id,
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
			url:'index.php?act=storesetting&op=ajax&type=area&area_id='+area_id,
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
	
	$(".label_add").click(function(){
		if($('#store_label').val() == ''){
			return false;
		}
		$.ajax({
			type:'GET',
			url:'index.php?act=storesetting&op=ajax&type=label&name='+encodeURIComponent($('#store_label').val()),
			dataType:'json',
			success:function(json){
				if(json.result == 'true'){
					//location.href = '';
					var label = '<a class="tag-label" label_id="'+json.label+'"><i class="label_del">x</i>'+$('#store_label').val()+"</a>";
					$(".label_list").append(label);
					$('#store_label').val('');
				}else{
					alert(json.label);
					return false;
				}
			}
		});
	});

	$(".label_del").live("click",function(){
		var label_id = $(this).parent().attr('label_id');
		$.ajax({
			type:'GET',
			url:'index.php?act=storesetting&op=ajax&type=dellabel&lable_id='+label_id,
			dataType:'json',
			success:function(json){
				if(json.result){
					$("a[label_id="+label_id+"]").remove();
				}else{
					alert(json.label);
					return false;
				}
			}
		});
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
			logo:{
				accept:'jpg|png|gif'
			},
			pic:{
				accept:'jpg|png|gif'
			},
			telephone:{
				required:true,
				//number:true
			},
			qr_code:{
				accept:true
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
				required:'<?php echo $lang['nc_member_email_is_not_null'];?>',
				email:'<?php echo $lang['nc_member_email_format_is_wrong'];?>'				
			},
			s_class:{
				required:'<?php echo $lang['nc_class_name_not_null']?>'		
			},
			mall:{
				required:'<?php echo $lang['nc_area_name_not_null']?>'			
			},
			logo:{
				accept:'<?php echo $lang['nc_pic_format_wrong'];?>'
			},
			pic:{
				accept:'<?php echo $lang['nc_pic_format_wrong'];?>'
			},
			telephone:{
				required:'<?php echo $lang['nc_telephone_not_null'];?>',
				//number:'<?php echo $lang['nc_telephone_is_number'];?>'
			},
			qr_code:{
				accept:'<?php echo $lang['nc_pic_format_wrong'];?>'
			}
        }
    });
	loadScript();
});


var cityName = '';
var address = '<?php echo str_replace("'",'"',$output['info']['address']);?>';
var store_name = '<?php echo str_replace("'",'"',$output['info']['store_name']);?>';  
var map = "";
var localCity = "";
var opts = {width : 150,height: 50,title : "商铺名称:"+store_name}
function initialize() {
	map = new BMap.Map("container1");
	localCity = new BMap.LocalCity();
	
	map.enableScrollWheelZoom(); 
	map.addControl(new BMap.NavigationControl());  
	map.addControl(new BMap.ScaleControl());  
	map.addControl(new BMap.OverviewMapControl()); 
	localCity.get(function(cityResult){
	  if (cityResult) {
	  	var level = cityResult.level;
	  	if (level < 13) level = 13;
	    map.centerAndZoom(cityResult.center, level);
	    cityResultName = cityResult.name;
	    if (cityResultName.indexOf(cityName) >= 0) cityName = cityResult.name;
	    	    	getPoint();
	    	  }
	});
}
 
function loadScript() {
	var script = document.createElement("script");
	script.src = "http://api.map.baidu.com/api?v=1.2&callback=initialize";
	document.body.appendChild(script);
}
function getPoint(){
	var myGeo = new BMap.Geocoder();
	myGeo.getPoint(address, function(point){
	  if (point) {
	    setPoint(point);
	  }
	}, cityName);
}
function setPoint(point){
	  if (point) {
	    map.centerAndZoom(point, 16);
	    var marker = new BMap.Marker(point);
	    var infoWindow = new BMap.InfoWindow("商铺地址:"+address, opts);  
			marker.addEventListener("click", function(){          
			   this.openInfoWindow(infoWindow);  
			});
	    map.addOverlay(marker);
			marker.openInfoWindow(infoWindow);
	  }
}
</script>