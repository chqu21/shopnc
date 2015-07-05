<form method="post" id="appointment_from" action="index.php?act=appointment&op=order">
	<div class="dialo-con clearfix" style="width:540px;">
	  <div class="dialotit"><i class="dialo-logo"></i>
		<h4><?php echo $output['store']['store_name'];?></h4>
	  </div>
	  <div class="dialo-box">
		<div class="dialo-boxbd">
		  <ul>
			<li>
			  <div class="c-tit">
				<label for=""><?php echo $lang['nc_appointment_member_num'];?>：</label>
			  </div>
			  <div class="pt">
				<select class="dialo-select" name="person_num">
				  <option selected value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				</select>
			  </div>
			  <?php echo $lang['nc_person'];?>
			</li>
			<li>
			  <div class="c-tit">
				<label><?php echo $lang['nc_appointment_member_time'];?>：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="appointtime" class="c-plain" id="appointtime" value="<?php echo date("Y-m-d");?>">
				<select class="dialo-select" name="hour">
					<?php for($i=0;$i<24;$i++){?>
					<option value="<?php if(strlen($i) == 1){ echo '0'.$i;}else{ echo $i;}?>" <?php if($i==12){ echo 'selected';}?>><?php if(strlen($i) == 1){ echo '0'.$i;}else{ echo $i;}?></option>
					<?php }?>
				</select>
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label><?php echo $lang['nc_appointment_member_phone'];?>：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="mobile" class="c-plain" id="mobile">
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label><?php echo $lang['nc_appointment_member_contact']?>：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="contact" class="c-plain" id="contact">
			  </div>
			</li>
		  </ul>
		</div>
	  </div> 
	  <div class="apt-btn"> 
		<input type="hidden" name="store_id" value="<?php echo $output['store']['store_id'];?>">
		<a class="apt-btn-txt" id="apt-btn-txt"><?php echo $lang['nc_appointment_my_order'];?></a>
	  </div>             
	</div>
</form>
<style>
	label.error{
		color:#F00;
		margin-left:1em;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	jQuery.validator.addMethod("phones", function(value, element) {
			return this.optional(element) || /^[1][3-8]+\d{9}/i.test(value);
		}, "phone number please"); 
		$('#appointtime').datepicker({dateFormat: 'yy-mm-dd',minDate:'0'});		
		
		$('#apt-btn-txt').click(function(){
			$("#appointment_from").submit();
		});
	    $("#appointment_from").validate({
        rules: {
            appointtime: {
				required:true
            },
			mobile:{
				required : true,
				phones:true
			},
			contact:{
				required:true	
			}
        },
        messages: {
            appointtime: {
				required:'<?php echo $lang['nc_member_appointment_appointtime_is_not_null'];?>'
            },
			mobile:{
				required:'<?php echo $lang['nc_member_appointment_mobile_is_not_null'];?>',
				phones :'<?php echo  $lang['nc_member_appointment_mobile_is_fail'];?>'
			},
			contact:{
				required:'<?php echo $lang['nc_member_appointment_contact_is_not_null'];?>'
			}
        }
    });
});
</script>
