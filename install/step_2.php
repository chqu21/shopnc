<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $html_title;?></title>
<link href="css/install.css" rel="stylesheet" type="text/css">
<script src="../data/resource/js/jquery.js"></script>
<script>
$(document).ready(function(){
	$('#next').click(function(){
		$('#install_form').submit();
	});
});
</script>
</head>

<body>
<?php ECHO $html_header;?>
<div class="main">
  <div class="step-box" id="step2">
    <div class="text-nav">
      <h1>Step.2</h1>
      <h2>选择安装方式</h2>
      <h5>根据需要选择系统模块完全或手动安装</h5>
    </div>
    <div class="procedure-nav">
      <div class="schedule-ico"><span class="a"></span><span class="b"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-point-now"><span class="a"></span><span class="b"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-point-bg"><span class="a"></span><span class="b"></span><span class="c"></span><span class="d"></span></div>
      <div class="schedule-line-now"><em></em></div>
      <div class="schedule-line-bg"></div>
      <div class="schedule-text"><span class="a">检查安装环境</span><span class="b">选择安装方式</span><span class="c">创建数据库</span><span class="d">安装</span></div>
    </div>
  </div>
  <form method="get" id="install_form" action="index.php">
  <input type="hidden" value="3" name="step">
    <div class="select-install">
      <label>
      <input type="radio" name="iCheck" value="full" id="radio-1" class="green-radio" checked >
      <h4>完全安装 ShopNC本地生活v2.1</h4>
      </label>
    </div>
    <div class="btn-box"><a href="index.php?step=1" class="btn btn-primary">上一步</a><a id="next" href="javascript:void(0);" class="btn btn-primary">下一步</a></div>
  </form>
</div>
<?php ECHO $html_footer;?>
</body>
</html>
