<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_input_consume_record']?></h3>
    </div>
    <div class="con">
      <div class="form_box">  
        <form method="post" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for="card_number"><?php echo $lang['nc_member_store_card_number'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w200 input_plain" type="text" name="card_number" id="card_number" value=""/>
                <label for='card_number' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="price"><?php echo $lang['nc_member_store_price'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w200 input_plain" type="text" name="price" id="price" value=""/>
                <label for='price' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_person_number'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w50 input_plain" type="text" name="person_number" id="person_number" value=""/>
                <label for='person_number' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
          </ul>
          <div class="btn_box"> 
          	<span class="f_btn">
            	<input type="submit" class="btn_txt J_submit" value="<?php echo $lang['nc_save'];?>" />
            </span> 
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function(){
		$("#apply_form").validate({
			rules:{
				card_number:{
					required:true
				},
				price:{
					required:true,
	                min : 0.01,
	                max : 1000000
				},
				person_number:{
					required:true,
					number:true
				}
			},
			messages:{
				card_number:{
					required:'<?php echo $lang['nc_member_card_number_is_not_exists'];?>'
				},
				price:{
					required:'<?php echo $lang['nc_member_price_is_not_exists'];?>',
					min:'<?php echo $lang['nc_member_price_is_more_than'];?>',
					max:'<?php echo $lang['nc_member_price_is_more_than'];?>'
				},
				person_number:{
					required:'<?php echo $lang['nc_member_person_consume_is_not_exits'];?>',
					number:'<?php echo $lang['nc_member_person_consume_is_number'];?>'
				}
			}
		});
	});
</script>