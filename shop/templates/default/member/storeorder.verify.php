<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_store_password_verify']?></h3>
    </div>
    <div class="con">
      <div class="form_box">  
        <form method="post" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_please_groupbuy_password'].$lang['nc_colon'] ;?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="order_passwd" id="order_passwd" maxlength="20" value=""/>
              </div>
            </li>
          </ul>
          <div class="btn_box"> <span class="f_btn">
            <input type="submit" class="btn_txt J_submit" value="验证" />
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>