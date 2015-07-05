<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
<meta name="description" content="<?php echo $output['seo_description']; ?>" />
<meta name="author" content="ShopNC">
<meta name="copyright" content="ShopNC Inc. All Rights Reserved">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offline.css">
<script type='text/javascript'>
	$(function(){
		$('#sendBtn').click(function(){
			$.ajax({
				type:'GET',
				url:'<?php echo BASE_SITE_URL;?>/index.php?act=coupon&op=sendmsg&phone='+$('#phone').val()+'&coupon_id='+$('#coupon_id').val()+'&captcha='+$('#captcha').val()+'&nchash='+$('#nchash').val(),
				success:function(data){
					var result = eval("("+data+")");
					if(result.result == 'fail'){
						alert(result.msg);
					}else if(result.result == 'succ'){
						alert(result.msg);
					}
					return false;
				}
			});
		});
	});
</script>
</head>
<body>

<div class='short_block'>
  <div class="short_wrap">
    <div class="s_cont clearfix">
      <div class="s_cont_inner">
        <div class="s_tips_title"><?php echo $lang['nc_coupon_ajax_receivemessages'];?>:</div>
        <div class="s_notice"><?php echo $output['coupon_info']['short_message'];?></div>
        <p class="s_note"><?php echo $lang['nc_coupon_ajax_writetel'];?></p>
        <dl class="form_block">
          <dt><?php echo $lang['nc_coupon_ajax_enterphone'];?></dt>
          <dd>
            <input type="text" class="form_txt" id="phone" name='phone'>
			<input type="hidden" class="form_txt" id="coupon_id" name='coupon_id' value="<?php echo $output['coupon_info']['coupon_id'];?>">
          </dd>
        </dl>
        <dl class="form_block">
          <dt><?php echo $lang['nc_coupon_ajax_enternum'];?></dt>
          <dd>
            <input type="text" class="form_txt02" name='captcha' id='captcha'>
			<input type="hidden" name='nchash' value="<?php echo $output['nchash'];?>" id="nchash">
			<img src="<?php echo BASE_SITE_URL;?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>" name="codeimage" border="0" id="codeimage" class="fl ml5">
			<a href="javascript:void(0)" class="ml5" onclick="javascript:document.getElementById('codeimage').src='<?php echo BASE_SITE_URL;?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><?php echo $lang['nc_coupon_ajax_change'];?></a>
          </dd>
        </dl>
        <div class="form_btn_block"><span><a class="form_btn" href="javascript:void(0);" id="sendBtn"><?php echo $lang['nc_coupon_ajax_send'];?></a></span><!--<a class="fn" href="#" target="_blank"><?php echo $lang['nc_coupon_ajax_synchronization'];?></a>--></div>
      </div>
    </div>
  </div>
  </div>
 </body>
</html>