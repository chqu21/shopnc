<div class="mainbox setup_box setup_account">
<div class="hd"><h3><?php echo $lang['nc_member_account_info'];?></h3></div>
<div class="con">
<div class="form_box">
<ul>
<li>
<div class="tit"><?php echo $lang['nc_member_email'];?>：</div>
<div class="pt">
      <p>
       <span><?php echo $output['member']['email'];?></span>
       <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=modifyemail">[<?php echo $lang['nc_edit'];?>]</a>
       </p>
</div>
</li>

<li>
<div class="tit"><?php echo $lang['nc_member_telephone'];?>：</div>
<div class="pt">
      <p>
       <span><?php echo $output['member']['mobile'];?></span>
       <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=modifyemail">[<?php echo $lang['nc_edit'];?>]</a>
      </p>
</div>
</li>

<li>
<div class="tit"><?php echo $lang['nc_member_login_password'];?>：</div>
<div class="pt">
      <p>
       <span>*******</span>
       <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=modifypwd">[<?php echo $lang['nc_edit'];?>]</a>
      </p>
</div>
</li>

<li>
<div class="tit"><?php echo $lang['nc_member_reminding_money'];?>：</div>
<div class="pt">
      <p><span style="font-weight:bold;font-size:14px"><?php echo $output['member']['predeposit'];?></span>元</p>
</div>
</li>
<li>
<div class="tit">预存款支付密码：</div>
<div class="pt">
      <p>
       <span>*******</span>
       <a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=modifypaypwd">[<?php echo $lang['nc_edit'];?>]</a>
      </p>
</div>
</li>
</ul>


</div>
</div>


</div>


