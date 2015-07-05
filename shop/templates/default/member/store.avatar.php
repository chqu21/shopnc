<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" id="cssfile2" />
<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3>修改头像</h3>
    </div>
    <?php if($output['newfile'] == ''){?>
<form method="post" enctype="multipart/form-data" action='<?php echo BASE_SITE_URL;?>/index.php?act=storesetting&op=upload' id="form_avaster">
	<input type="hidden" name="form_submit" value="ok" />
	<div class="mainbox setup_box setup-avatar">
	  <div class="con clearfix">
		<div class="avatar_box clearfix">
		  <div class="tit">
			<h5>当前头像：</h5>
		  </div>
		  <div class="avatar_photo">
			<ul>
			  <li class="photo_large"><img  class="avatar" alt="<?php echo $lang['nc_member_title_avatar'];?>" src="<?php if(!empty($_SESSION['store_avatar'])){ echo BASE_SITE_URL.'/data/upload/shop/member/'.$_SESSION['store_avatar'];}else{ echo SHOP_TEMPLATES_URL.'/images/lsimg/avatar_photo.png';}?>"></li>
			</ul>
		  </div>
		  <div class="tit" style="margin-top:30px">
			<h5>更换头像：</h5>
		  </div>
		  <div class="con_hints">
			<input type="file" name="uploadimg" id="uploadimg">
			<span class="text_info" style="width:100%;">（支持JPG、PNG、GIF、BMP格式的图片文件，请根据系统操作提示进行裁剪并保存，如未看到变化刷新页面即可。）</span> 
		  </div>
		</div>
	   </div>
	</div>
</form>
<?php }else{ ?>
<form action="index.php?act=storesetting&op=cut" id="form_cut" method="post">
	<div class="mainbox setup_box setup-avatar" style="padding-top:50px">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" id="x1" name="x1" />
    <input type="hidden" id="x2" name="x2" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="y1" name="y1" />
    <input type="hidden" id="y2" name="y2" />
    <input type="hidden" id="h" name="h" />
    <input type="hidden" id="newfile" name="newfile" value="<?php echo $output['newfile'];?>" />
    
    <div class="pic-cut-120">
      <div class="work-title">工作区域</div>
      <div class="work-layer">
        <p><img id="nccropbox" src="<?php echo BASE_SITE_URL.'/data/upload/shop/member/'.$output['newfile'].'?'.microtime(); ?>"/></p>
      </div>
      <div class="thumb-title">裁剪预览</div>
      <div class="thumb-layer">
        <p><img id="preview" src="<?php echo BASE_SITE_URL.'/data/upload/shop/member/'.$output['newfile'].'?'.microtime(); ?>"/></p>
      </div>
      <div class="cut-help">
        <h4>操作帮助</h4>
        <p>请在工作区域放大缩小及移动选取框，选择要裁剪的范围，裁切宽高比例固定；裁切后的效果为右侧预览图所显示；保存提交后生效。</p><br>
        <span class="f_btn"><button class="btn_txt J_submit" type="submit">保存</button></span>
      </div>
    </div>
    </div>
  </form>
<?php } ?>
    </div>
</div>
<script type="text/javascript">
$(function(){
	<?php if ($output['newfile'] != ''){?>
	function showPreview(coords)
	{
		if (parseInt(coords.w) > 0){
			var rx = 120 / coords.w;
			var ry = 120 / coords.h;
			$('#preview').css({
				width: Math.round(rx * <?php echo $output['width'];?>) + 'px',
				height: Math.round(ry * <?php echo $output['height'];?>) + 'px',
				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
				marginTop: '-' + Math.round(ry * coords.y) + 'px'
			});
		}
		$('#x1').val(coords.x);
		$('#y1').val(coords.y);
		$('#x2').val(coords.x2);
		$('#y2').val(coords.y2);
		$('#w').val(coords.w);
		$('#h').val(coords.h);
	}
    $('#nccropbox').Jcrop({
	aspectRatio:1,
	setSelect: [ 0, 0, 120, 120 ],
	minSize:[50, 50],
	allowSelect:0,
	onChange: showPreview,
	onSelect: showPreview
    });
	$('#ncsubmit').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			$('#form_cut').submit();
		}
	});
	<?php }else{ ?>
	$('#uploadimg').change(function(){
		var filepatd=$(this).val();
		var extStart=filepatd.lastIndexOf(".");
		var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("file type error");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		$("#form_avaster").submit(); 
	});
	<?php } ?>
})
</script>