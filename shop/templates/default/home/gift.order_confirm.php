<form method="post" id="gift_form" action="index.php?act=gift&op=order">
	<div class="dialo-con clearfix" style="width:540px;">
	  <div class="dialo-box">
		<div class="dialo-boxbd">
		  <ul>
		  	<li>
			  <div class="c-tit">
				<label>兑换数量：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="go_num" class="c-plain" id="go_num" style="width:50px">&nbsp;件
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label>收货地址：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="go_address" class="c-plain" id="go_address" style="width:300px" value="<?php echo $output['minfo']['province']; ?> <?php echo $output['minfo']['city']; ?> <?php echo $output['minfo']['district']; ?> <?php echo $output['minfo']['address']; ?>">
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label>收货人：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="go_contact" class="c-plain" id="go_contact" value="<?php echo $output['minfo']['shipped_to_name']; ?>">
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label>联系电话：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="go_phone" class="c-plain" id="go_phone" value="<?php echo $output['minfo']['telephone']; ?>">
			  </div>
			</li>
			<li>
			  <div class="c-tit">
				<label>邮政编码：</label>
			  </div>
			  <div class="pt">
				<input type="text" name="go_zipcode" class="c-plain" id="go_zipcode" value="<?php echo $output['minfo']['zipcode']; ?>">
			  </div>
			</li>
		  </ul>
		</div>
	  </div> 
	  <div class="apt-btn"> 
		<input type="hidden" name="sg_id" value="<?php echo $output['sg_info']['sg_id'];?>">
		<a class="apt-btn-txt" id="apt-btn-txt">提交订单</a>
	  </div>             
	</div>
</form>
<script type="text/javascript">
$(function(){
	$('.apt-btn-txt').click(function(){
		var sg_limit_num = '<?php echo $output['sg_info']['sg_limit_num']; ?>';
		var go_num = $('#go_num').val();
		if(parseInt(sg_limit_num) != 0 && parseInt(sg_limit_num) < parseInt(go_num))     {
			alert('该礼品最多允许兑换'+sg_limit_num+'件');
		}else{
			$('#gift_form').submit();
		}
	});
});
</script>