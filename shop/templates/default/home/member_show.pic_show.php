<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="home_top">
  <div class="pic"><a title="" href="#"><img src="<?php if(!empty($output['minfo']['avatar'])){ echo UPLOAD_SITE_URL.'/shop/member/'.$output['minfo']['avatar'];}else{ echo UPLOAD_SITE_URL.'/shop/member/member.png';}?>"></a> </div>
  <div class="txt">
    <div class="tit">
      <h2 class="name"><?php echo $output['minfo']['member_name']; ?></h2>
    </div>
  </div>
  <span class="user-groun mt10"><i class="<?php echo $output['minfo']['gender']==1?'man':'woman'; ?>"></i><?php echo $output['minfo']['area_name']; ?></span>
  <div class="nav">
    <ul>
      <li><a class="col-link" href="index.php?act=membershow&mid=<?php echo intval($_GET['mid']); ?>">首页</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=comment&mid=<?php echo intval($_GET['mid']); ?>">点评</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>">收藏</a></li>
      <li class="cur"><a class="col-link" href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">图片</a></li>
    </ul>
  </div>
</div>

<div class="home-container">
  <div class="container">
 <div class="aside fr">
      <?php require_once("member_show_info.php");?>
    </div>
   <div class="main fl">
   <div class="pic-b-box">
   <h1 class="title"><a title="<?php echo $output['pic_info']['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $output['pic_info']['store_id']; ?>" target="_blank"><?php echo $output['pic_info']['store_name']; ?></a></h1>
   <div class="pic-title">
<span>上传于 <?php echo date('Y-m-d H:i:s',$output['pic_info']['add_time']); ?></span>
<span style="float:right;"><a href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">返回图片列表»</a></span>

		</div>
<!--<div class="pic-return">
	<a href="/shanghai/food">返回图片列表</a>
	<span>»</span>
</div>-->
<div class="pic-box"><a href="<?php echo BASE_SITE_URL.'/data/upload/shop/comment/'.str_replace('.jpg_small', '', $output['pic_info']['pic_name']); ?>" target="_blank">
							<img width="700" title="点击看大图" src="<?php echo BASE_SITE_URL.'/data/upload/shop/comment/'.str_replace('.jpg_small', '', $output['pic_info']['pic_name']); ?>">
	                  	</a></div>
  </div> 
   
   
   </div>
  
  </div>
    </div>