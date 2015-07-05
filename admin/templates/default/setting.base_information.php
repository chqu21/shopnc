<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['web_set'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['base_information'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="old_site_logo" value="<?php echo $output['list_setting']['site_logo'];?>" />
    <input type="hidden" name="old_member_logo" value="<?php echo $output['list_setting']['member_logo'];?>" />
    <input type="hidden" name="old_seller_logo" value="<?php echo $output['list_setting']['seller_logo'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_name"><?php echo $lang['web_name'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_name" name="site_name" value="<?php echo $output['list_setting']['site_name'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['web_name_notice'];?></span></td>
        </tr>
        <!--站点logo-->
        <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo $lang['site_logo'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.$output['list_setting']['site_logo']);?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_site_logo' id='txt_site_logo' class='type-file-text' />
            <input type='button' name='but_site_logo' id='but_site_logo' value='' class='type-file-button' />
            <input name="site_logo" type="file" class="type-file-file" id="site_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">180px * 50px</span></td>
        </tr>
        <!--会员中心logo-->
         <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo $lang['member_center_logo'];?>:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.$output['list_setting']['member_logo']);?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_member_logo' id='txt_member_logo' class='type-file-text' />
            <input type='button' name='but_member_logo' id='but_member_logo' value='' class='type-file-button' />
            <input name="member_logo" type="file" class="type-file-file" id="member_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">160px * 25px</span></td>
        </tr>
        <!--卖家中心logo-->        
         <tr>
          <td colspan="2" class="required"><label for="site_logo"><?php echo $lang['seller_center_logo'];?>:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.$output['list_setting']['seller_logo']);?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_seller_logo' id='txt_seller_logo' class='type-file-text' />
            <input type='button' name='but_seller_logo' id='but_seller_logo' value='' class='type-file-button' />
            <input name="seller_logo" type="file" class="type-file-file" id="seller_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">345px * 37px</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="icp_number">网站官方微信账号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="weixin_account" name="weixin_account" value="<?php echo $output['list_setting']['weixin_account'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <!--网站官方微信二维码图片-->        
         <tr>
          <td colspan="2" class="required"><label for="site_logo">网站官方微信二维码图片:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.$output['list_setting']['weixin_qrcode']);?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_weixin_qrcode' id='txt_weixin_qrcode' class='type-file-text' />
            <input type='button' name='but_weixin_qrcode' id='but_weixin_qrcode' value='' class='type-file-button' />
            <input name="weixin_qrcode" type="file" class="type-file-file" id="weixin_qrcode" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">用户扫描该二维码来关注网站官方微信公共账号</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="icp_number"><?php echo $lang['icp_number'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="icp_number" name="icp_number" value="<?php echo $output['list_setting']['icp_number'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['icp_number_notice'];?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="statistics_code"><?php echo $lang['flow_static_code'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="statistics_code" rows="6" class="tarea" id="statistics_code"><?php echo $output['list_setting']['statistics_code'];?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['flow_static_code_notice'];?></span></td>
        </tr> 
        <tr>
          <td colspan="2" class="required"><label for="time_zone"> <?php echo $lang['time_zone_set'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select id="time_zone" name="time_zone">
              <option value="-12">(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11">(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10">(GMT -10:00) Hawaii</option>
              <option value="-9">(GMT -09:00) Alaska</option>
              <option value="-8">(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
              <option value="-7">(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
              <option value="-6">(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
              <option value="-5">(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
              <option value="-4">(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-3.5">(GMT -03:30) Newfoundland</option>
              <option value="-3">(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
              <option value="-2">(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
              <option value="-1">(GMT -01:00) Azores, Cape Verde Islands</option>
              <option value="0">(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
              <option value="1">(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
              <option value="2">(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
              <option value="3">(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
              <option value="3.5">(GMT +03:30) Tehran</option>
              <option value="4">(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
              <option value="4.5">(GMT +04:30) Kabul</option>
              <option value="5">(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="5.5">(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="5.75">(GMT +05:45) Katmandu</option>
              <option value="6">(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
              <option value="6.5">(GMT +06:30) Rangoon</option>
              <option value="7">(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
              <option value="8">(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
              <option value="9">(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
              <option value="9.5">(GMT +09:30) Adelaide, Darwin</option>
              <option value="10">(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
              <option value="11">(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
              <option value="12">(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
            </select></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['set_sys_use_time_zone'];?>+8</span></td>
        </tr> 
        
        <tr>
          <td colspan="2" class="required"><?php echo $lang['default_city'];?>:</td>
        </tr>             
        <tr class="noborder">
          <td class="vatop rowform onoff">
			<?php $area = unserialize($output['list_setting']['default_city']);?>
          	<select name="default_city">
          	<?php if(!empty($output['city'])){?>
          	<?php foreach($output['city'] as $city){?>
          	<option value="<?php echo $city['area_id'];?>" <?php if($city['area_id'] == $area['area_id']){ echo 'selected';}?>><?php echo $city['area_name'];?></option>
          	<?php }?>
          	<?php }?>
          	</select>
          </td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
                    
        <tr>
          <td colspan="2" class="required"><?php echo $lang['site_state'];?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="site_status1" class="cb-enable <?php if($output['list_setting']['site_status'] == '1'){ ?>selected<?php } ?>" ><span><?php echo $lang['open'];?></span></label>
            <label for="site_status0" class="cb-disable <?php if($output['list_setting']['site_status'] == '0'){ ?>selected<?php } ?>" ><span><?php echo $lang['close'];?></span></label>
            <input id="site_status1" name="site_status" <?php if($output['list_setting']['site_status'] == '1'){ ?>checked="checked"<?php } ?>  value="1" type="radio">
            <input id="site_status0" name="site_status" <?php if($output['list_setting']['site_status'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['nc_site_open_and_close'];?></span></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label for="closed_reason"><?php echo $lang['closed_reason'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="closed_reason" rows="6" class="tarea" id="closed_reason" ><?php echo $output['list_setting']['closed_reason'];?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['closed_reason_notice'];?></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="ios_app_url">iOS应用下载地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="ios_app_url" name="ios_app_url" value="<?php echo $output['list_setting']['ios_app_url'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">请填写包含http://的完整URL</span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="android_app_url">安卓应用下载地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="android_app_url" name="android_app_url" value="<?php echo $output['list_setting']['android_app_url'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">请填写包含http://的完整URL</span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="qrcode_app_url">应用下载地址二维码图片:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
            	<div class="type-file-preview">
            		<img src="<?php echo BASE_SITE_URL.'/data/upload/'.(ATTACH_COMMON_PATH.DS.$output['list_setting']['qrcode_app_url']);?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_qrcode_app_url' id='txt_qrcode_app_url' class='type-file-text' />
            <input type='button' name='but_qrcode_app_url' id='but_qrcode_app_url' value='' class='type-file-button' />
            <input name="qrcode_app_url" type="file" class="type-file-file" id="qrcode_app_url" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">用户扫描该二维码来下载手机应用</span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="qrcode_app_url">团购券过期提醒时间:</label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><input id="remind_groupbuy" name="remind_groupbuy" value="<?php echo $output['list_setting']['remind_groupbuy'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">设置该数值，服务器定时服务配置，有效期在该数值内，系统会向会员发送团购券到期提醒</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">是否开启店铺二级域名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="enabled_subdomain1" class="cb-enable <?php if($output['list_setting']['enabled_subdomain'] == '1'){ ?>selected<?php } ?>" ><span><?php echo $lang['open'];?></span></label>
            <label for="enabled_subdomain0" class="cb-disable <?php if($output['list_setting']['enabled_subdomain'] == '0'){ ?>selected<?php } ?>" ><span><?php echo $lang['close'];?></span></label>
            <input id="enabled_subdomain1" name="enabled_subdomain" <?php if($output['list_setting']['enabled_subdomain'] == '1'){ ?>checked="checked"<?php } ?>  value="1" type="radio">
            <input id="enabled_subdomain0" name="enabled_subdomain" <?php if($output['list_setting']['enabled_subdomain'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['nc_site_open_and_close'];?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">受限制二级域名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="subdomain_refuse" name="subdomain_refuse" value="<?php echo $output['list_setting']['subdomain_refuse'];?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">可以在这里设置不允许商户使用的二级域名，请以英文逗号分隔</span></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo $lang['nc_save'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
// 模拟网站LOGO上传input type='file'样式
$(function(){
	$("#site_logo").change(function(){
		$("#txt_site_logo").val($(this).val());
	});
	$("#member_logo").change(function(){
		$("#txt_member_logo").val($(this).val());
	});
	$("#seller_logo").change(function(){
		$("#txt_seller_logo").val($(this).val());
	});
	$("#seller_logo").change(function(){
		$("#txt_seller_logo").val($(this).val());
	});
	$("#qrcode_app_url").change(function(){
		$("#txt_qrcode_app_url").val($(this).val());
	})
	$("#weixin_qrcode").change(function(){
		$("#txt_weixin_qrcode").val($(this).val());
	})
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();	
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("<?php echo $lang['default_img_wrong'];?>");
				$(this).attr('value','');
			return false;
		}
	});
	
$('#time_zone').attr('value','<?php echo $output['list_setting']['time_zone'];?>');	


    $('form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            remind_groupbuy: {
                number : true,
            },
        },
        messages : {
            remind_groupbuy: {
                number : "团购提醒天数不能为空",
            },
        }
    });

});
</script>