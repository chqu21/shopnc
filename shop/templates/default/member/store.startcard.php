<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_please_start_member_card']?></h3>
    </div>
    <div class="con">
      <div class="form_box">  
        <form method="post" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for="price"><?php echo $lang['nc_member_store_is_use'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input type="radio" name="is_use" value="1">&nbsp;<?php echo $lang['nc_member_store_stop'];?>&nbsp;&nbsp;
                <input type="radio" name="is_use" value="2" checked>&nbsp;<?php echo $lang['nc_member_store_use'];?>
              </div>
            </li>
            <li class="li_card_number">
              <div class="tit">
                <label for="card_number"><?php echo $lang['nc_member_store_card_number'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w200 input_plain" type="text" name="card_number" id="card_number" value=""/>
              </div>
            </li>
          </ul>
          <div class="btn_box"> 
          	<span class="f_btn">
          		<input type="hidden" name="member_id" value="<?php echo $output['member_id'];?>">
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
		$("input[name=is_use]").click(function(){
			if($(this).val() == '1'){
				$('.li_card_number').hide();
			}else{
				$('.li_card_number').show();
			}
		});
	});
</script>