<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="author" content="ShopNC">
<meta name="copyright" content="ShopNC Inc. All Rights Reserved">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offline.css">
<style>
html, body, div, ul, ol, li, dl, dt, dd, h1, h2, h3, h4, h5, h6, pre, form, p, blockquote, fieldset, input {
	margin: 0;
	padding: 0;
}
ul, ol {
	list-style: none outside none;
}
fieldset, img {
	border: medium none;
}
caption, th {
	text-align: left;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
body {
	background: #FFFFFF;
	color: #333333;
	font: 12px/1 "Microsoft YaHei";
}
input, select, textarea {
	font: 12px/1 Tahoma, Helvetica, Arial, "宋体", sans-serif;
}
a {
	outline: medium none;
}
a:link, a:visited, a:active {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
i, cite, em {
	font-style: normal;
}
html {
	min-height: 101%;
}
.clearfix:after {
	clear: both;
	content: ".";
	display: block;
	height: 0;
	line-height: 0;
	visibility: hidden;
}
.clearfix {
	display: inline-block;
}
html[xmlns] .clearfix {
	display: block;
}
* + html .clearfix {
	height: 1%;
}
time {
	color: #777777;
}
article, aside, dialog, footer, header, section, footer, nav, figure, menu {
	display: block;
}

</style>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type='text/javascript'>
//图片比例缩放控制
function DrawImage(ImgD,FitWidth,FitHeight){
	var image=new Image();
	image.src=ImgD.src;
	if(image.width>0 && image.height>0)
    {
		if(image.width/image.height>= FitWidth/FitHeight)
        {
            if(image.width>FitWidth)
            {
                ImgD.width=FitWidth;
                ImgD.height=(image.height*FitWidth)/image.width;
            }
            else
            {
                ImgD.width=image.width;  
                ImgD.height=image.height;  
            }
		}
        else
        {
	       if(image.height>FitHeight)
           {
                ImgD.height=FitHeight;
                ImgD.width=(image.width*FitHeight)/image.height;
	       }
           else
           {
                ImgD.width=image.width;
                ImgD.height=image.height;
            }
		}  
	}
}
$(function(){
	$('.print').bind('click',function(){
		window.print();
	});
});
</script>
</head>

<body>
<div id="print_view">
  <div class="info">
    <p><?php echo $lang['nc_coupon_print_printcouponsone'];?></p>
    <a href="javascript:void(0)" title="<?php echo $lang['nc_coupon_print_printcoupons'];?>" class="print"><?php echo $lang['nc_coupon_print_printcoupons'];?></a>
  </div>      
  <div id="print_box">
    <div id="divToPrint">
	  <?php for($i=1;$i<7;$i++){?>
      <div class="ticket">
        <p><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COUPON_PATH.DS.str_replace('.jpg_small','',$output['coupon_info']['coupon_pic']);?>"></span></p>
        <span class="ncs-print-cat"></span> 
	  </div>
	  <?php }?>
    </div>
  </div>
</div>
</body>
</html>
