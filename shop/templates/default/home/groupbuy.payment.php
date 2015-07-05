<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>"><?php echo $lang['nc_home'];?></a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_groupbuy']?> </div>
    <div class="layout_left02 clearfix">
      <div class="group-buy-form">
        <h2><?php echo $lang['nc_groupbuy_payment_only3steps'];?></h2>
        <ol class="buy-process-bar">
          <li class="step-first">1.<?php echo $lang['nc_groupbuy_payment_submitorders'];?> <span class="highlight"></span> <span class="arrow"></span> </li>
          <li class="current"> 2.<?php echo $lang['nc_groupbuy_payment_choosepayment'];?> <span class="highlight"></span> <span class="arrow"></span> </li>
          <li class="step-last"> 3.<?php echo $lang['nc_groupbuy_payment_buysuccess'];?> </li>
        </ol>
        <div class="group-order-list">
          <ul>
            <li><span><?php echo $lang['nc_groupbuy_payment_projectname'];?>：</span><?php echo $output['order']['item_name'];?></li>
            <li><span><?php echo $lang['nc_groupbuy_payment_goodsquantity'];?>：</span><?php echo $output['order']['number'];?></li>
            <li><span><?php echo $lang['nc_groupbuy_payment_yourtel']?>：</span><?php echo $lang['nc_groupbuy_payment_afterthesuccess'];?>：<?php echo $output['order']['mobile'];?>，<?php echo $lang['nc_groupbuy_payment_passwordexpenses'];?></li>
          </ul>
        </div>
        <div class="pay-choice">
          <p><?php echo $lang['nc_groupbuy_payment_amountpayable'];?>:<span class="money">¥<?php echo $output['order']['price'];?></span></p>
        </div>
        <div class="paybox clearfix">
        <form action="<?php echo BASE_SITE_URL;?>/index.php?act=payment" method="post">
          <p>
          	<input type="hidden" name="order_sn" value="<?php echo $output['order']['order_sn'];?>">
          </p>
          <p><input class="pb-txt" type='radio' name='payment' value='predeposit' checked><lable><?php echo $lang['nc_groupbuy_payment_balance'];?>：<?php echo $output['member']['predeposit'];?><?php echo $lang['nc_groupbuy_payment_usebalance'];?><?php echo $output['order']['price'];?>(<a href="<?php echo BASE_SITE_URL;?>/index.php?act=memberpredeposit&op=charge"><?php echo $lang['nc_groupbuy_payment_recharge'];?></a>)</lable></p>
          <p id="show_paypwd">支付密码：<input type="password" name="pay_password" style="border:1px solid #ccc;height:20px;padding-left:5px" /><?php if($output['member']['pay_password'] == ''){ ?>（您需要设置一个支付密码：<a href="index.php?act=memberaccount&op=modifypaypwd&from_orderpay_id=<?php echo intval($_GET['order_id']); ?>">点击设置</a>）<?php } ?></p>
          <p><input class="pb-txt" type='radio' name='payment' value='otherpayment'><?php echo $lang['nc_groupbuy_payment_otherpayment'];?></p>
          <p id='otherpayment' style="display:none;">
          	<?php if(!empty($output['payment'])){?>
          	<?php foreach($output['payment'] as $payment){?>
          	&nbsp;<input type='radio' name='otherpayment' value="<?php echo $payment['payment_code'];?>"><?php echo $payment['payment_name'];?><br/>
          	<?php }?>
          	<?php }?>
          </p>
          <p>
          	<div class="btn-bar-box mt20" style="width:660px;">
	        	<span class="btn-bar">
	               <input type='submit'class="btn-bar-txt"  value='<?php echo $lang['nc_groupbuy_payment_confirmpayment'];?>'>
		  		</span>
	  		</div>  
          </p>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		$('input[name=payment]').click(function(){
			if($('input[value=otherpayment]').attr('checked')){
				$('#otherpayment').show();
				$('#show_paypwd').hide();
			}else{
				$('#otherpayment').hide();
				$('#show_paypwd').show();
			}
		});					
	});
</script>