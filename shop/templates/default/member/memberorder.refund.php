<div class="mainbox setup_box setup_account">
<div class="hd"><h3>申请退款</h3></div>
<div class="con">
<div class="form_box">
	<form method='post' action='' id='detail_form'>
		<ul>
          <li>
            <div class="tit">
              <label>团购名称：</label>
            </div>
            <div class="pt">
				<?php echo $output['order']['item_name'];?>
            </div>
          </li>
          <li>
            <div class="tit">
              <label>团购码：</label>
            </div>
            <div class="pt">
				<?php if(!empty($output['order_pwd'])){?>
				<?php foreach($output['order_pwd'] as $order_pwd){?>
				<p>
					<?php if($order_pwd['state']==1){?>
					<input type="checkbox" name="order_pwd[]" value="<?php echo $order_pwd['order_group_id'];?>" class="order_pwd">
					<?php }?>
					<?php echo $order_pwd['order_pwd'];?>&nbsp;&nbsp;
					<?php if($order_pwd['state']==1){ echo '未使用';}elseif($order_pwd['state']==2){ echo '已使用';}elseif($order_pwd['state']==3){ echo '已锁定';}?>
				</p>
				<?php }?>
				<?php }?>
            </div>
          </li>
		  <li>
            <div class="tit">
              <label>订单金额：</label>
            </div>
            <div class="pt">
				￥<?php echo $output['order']['price'];?>
            </div>
          </li>
		  <li>
            <div class="tit">
              <label>退款金额：</label>
            </div>
            <div class="pt">
				￥<span id="refund">0.00</span>
            </div>
          </li>

		  <li>
            <div class="tit">
              <label>退款方式：</label>
            </div>
            <div class="pt">
				平台审核通过后，系统会将申请退款的金额退回到会员账号预存款中。
            </div>
          </li>
		</ul>
		<div class="btn_box">
          <span class="f_btn">
			<input type="hidden" name="order_pwd">
			<input type="hidden" name="order_id" value="<?php echo $output['order']['order_id'];?>">
			<input type="hidden" name="refund_price">
			<input type="hidden" name="price" value="<?php echo $output['groupbuy']['group_price'];?>">
			<input type='button' value="申请" class='btn_txt J_submit' id="apply_refund">
          </span>
        </div>
	</form>
</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('.order_pwd').click(function(){
		var i = 0;
		$('.order_pwd').each(function(){
			if($(this).prop('checked')){	
				i++;
			}
		});
		
		var price = $("input[name=price]").val();
		var refundprice = price*i;
		$('input[name=refund_price]').val(refundprice);
		$('#refund').html(refundprice);
	});	
	
	$('#apply_refund').click(function(){

		var i = 0;
		var refundid = '';
		$('.order_pwd').each(function(){
			if($(this).prop('checked')){	
				refundid+=$(this).val()+',';
				i++;
			}
		});
		
		if(i<=0){
			alert('请选择退款项目');
			return false;
		}

		$('input[name=order_pwd]').val(refundid);
		$('form').submit();
	});

});						
</script>