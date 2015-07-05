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
    <div class="main-pic">
      <div class="mbox tabs-box">
        <div class="tabs"> <a href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>" class="cur">全部图片(<?php echo $output['pnum']; ?>)</a> </div>
      </div>
      <?php if(empty($output['pic_list'])){ ?>
      <div class="mdbox02 photos-box pb-pic"> 
        <div class="mbox empty">
        <div class="pic"><i class="em-icon comm-icon"></i></div>
        <div class="txt">
          <p>试试上传第一张图片~还能获得积分哦！</p>
        </div>
        </div>
      </div>
      <?php }else{ ?>
        <div class="photos-list">
          <ul>
          	<?php foreach ($output['pic_list'] as $val){ ?>
            <li>
              <div class="pic"><a href="index.php?act=membershow&op=pic_show&cp_id=<?php echo $val['cp_id']; ?>&mid=<?php echo intval($_GET['mid']); ?>"><img src="<?php echo BASE_SITE_URL.'/data/upload/shop/comment/'.$val['pic_name']; ?>"></a></div>
              <div class="txt">
                <div class="tit">
                  <h6> <a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>"><?php echo $val['store_name']; ?></a> </h6>
                </div>
                <div class="info"> <em class="col-exp"><?php echo date('Y-m-d H:i:s',$val['add_time']); ?>发布</em> </div>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="page_box"> <?php echo $output['show_page'];?></div>
      <?php } ?>
    </div>
  </div>
</div>
