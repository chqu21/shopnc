<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>"><?php echo $lang['nc_home'];?></a>&nbsp;&gt;&nbsp;<?php echo $lang['nc_groupbuy']?> </div>
    <div class="layout_left02 clearfix">
      <div class="group-buy-form">
        <h2><?php echo $lang['nc_groupbuy_payment_only3steps'];?></h2>
        <ol class="buy-process-bar">
          <li class="step-first current">1.<?php echo $lang['nc_groupbuy_payment_submitorders'];?> <span class="highlight"></span> <span class="arrow"></span> </li>
          <li> 2.<?php echo $lang['nc_groupbuy_payment_choosepayment'];?> <span class="highlight"></span> <span class="arrow"></span> </li>
          <li class="step-last"> 3.<?php echo $lang['nc_groupbuy_payment_buysuccess'];?> </li>
        </ol>
      	<form action="" method="post" id="apply_form">
        <div class="table-section summary-table" >
          <table cellspacing="0">
            <tbody>
              <tr>
                <th class="desc w250"><?php echo $lang['nc_groupbuy_order_project'];?></th>
                <th class="w170"><?php echo $lang['nc_groupbuy_order_quantity'];?></th>
                <th class="w90"><?php echo $lang['nc_groupbuy_order_price'];?></th>
                <th class="total w90"><?php echo $lang['nc_groupbuy_order_amount'];?></th>
              </tr>
              <tr>
                <td class="desc" ><a target="_blank" href="index.php?act=groupbuy&op=detail&group_id=<?php echo $output['group']['group_id'];?>"><?php echo $output['group']['group_name'];?></a></td>
                <td class="quantity">
                  <a hidefocus="true" class="minus minus-disabled" href="javascript:void(0)" id="reduce"></a>
                  <input type="text" value="1" name="quantity" maxlength="4" class="f-text J-quantity" id="quantity" disabled>
                  <a hidefocus="true" class="plus" href="javascript:void(0)" id="add"></a>
				  <input type="hidden" name="q_number" id="q_number" value="1">
				</td>
                <td class="money"> ¥<span id="deal-buy-price"><?php echo $output['group']['group_price'];?></span></td>
                <td class="money total"> ¥<span id="deal-buy-total"><?php echo $output['group']['group_price'];?></span></td>
              </tr>
              <tr>
                <td></td>
                <td class="extra-fee total-fee" colspan="3"><strong><?php echo $lang['nc_groupbuy_payment_amountpayable'];?></strong>： <span class="money"> ¥<strong id="payment"><?php echo $output['group']['group_price'];?></strong> </span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="btn-bar-box">
        	
        	<span class="btn-bar">
	      		<input type="hidden" value="<?php echo $output['group']['group_id'];?>" name="group_id">
		  		<input type="button" value="<?php echo $lang['nc_groupbuy_payment_submitorders'];?>" class="btn-bar-txt" id="buy">
	  		</span>
            <span class="btn-bar-msg">( <?php echo $lang['nc_groupbuy_order_cannotsurpass'];?><font style="color:#e0374a;"><?php echo $output['group']['buyer_limit'];?></font><?php echo $lang['nc_groupbuy_order_ticket'];?>)</span>
	  	</div>
		</form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(function(){
		$('#add').click(function(){
			var num 	= parseInt($('#quantity').val());
			var price	= parseInt($('#deal-buy-price').html());

			if(isNaN(num)){
				alert('<?php echo $lang['nc_groupbuy_order_fillthenumbers'];?>');
				return false;
			}
			$('#quantity').val(num+1);
			$('#q_number').val(num+1);
			var total_num = eval(num+1);
			var total_price = eval(total_num+"*"+price);
			$('#deal-buy-total').html(total_price+'.00');
			$('#payment').html(total_price+'.00');
		});

		$('#reduce').click(function(){
			var num	= parseInt($('#quantity').val());
			var price	= parseInt($('#deal-buy-price').html());
			
			if(isNaN(num)){
				alert('<?php echo $lang['nc_groupbuy_order_fillthenumbers'];?>');
				return false;			
			}

			var total_num = eval(num-1);
			if(total_num<1){
				alert('<?php echo $lang['nc_groupbuy_order_more_than_zero'];?>');
				return false;				
			}
			$('#quantity').val(total_num);
			$('#q_number').val(total_num);
			var total_price = eval(total_num+"*"+price);
			$('#deal-buy-total').html(total_price+'.00');
			$('#payment').html(total_price+'.00');
		});


		$('#buy').click(function(){
			var is_login = '<?php echo $_SESSION['is_login']?>';
			if(is_login!=1){
				alert('<?php echo $lang['nc_groupbuy_order_loginfirst'];?>');
				return false;
			}
			var limit = parseInt('<?php echo $output['group']['buyer_limit'];?>');
			var quantity = parseInt($('#quantity').val());

			if(quantity>limit){
				alert('<?php echo $lang['nc_groupbuy_order_cannotover'];?>');
				return false;
			}
			
			$('#apply_form').submit();
		});

	});

</script>



