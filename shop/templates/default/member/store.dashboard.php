<!--<?php defined('InShopNC') or exit('Access Invalid!');?>-->

<div id="index_wrap" class="index_cont">
  <div class="con—hd-index">
    <h3><a href="#">商户管理中心</a><span><em>&gt;</em>首页</span></h3>
  </div>
  <div class="store-info">
    <div class="si-l">
      <div class="pic"><a href="index.php?act=store&op=detail&id=<?php echo $_SESSION['store_id']; ?>"><img src="<?php echo ($output['store_info']['logo']!='' && $output['store_info']['logo']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['store_info']['logo']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" width="185" /></a></div>
      <div class="txt">
        <h2 class="name"><?php echo $_SESSION['account']; ?></h2>
      </div>
      <div class="store_infolist">
        <ul>
          <li><em>店铺名称：</em><span><a href="index.php?act=store&op=detail&id=<?php echo $_SESSION['store_id']; ?>"><?php echo $output['store_info']['store_name']; ?></a></span></li>
          <li><em>店铺等级：</em><span class="remark-item star<?php echo $output['store_info']['store_score']; ?>"></span></li>
          <li><em>入驻时间：</em><span class="call"><?php echo date('Y-m-d',$output['store_info']['add_time']); ?></span></li>
          <li><em>会员数：</em><span class="call"><?php echo $output['member_num']; ?></span></li>
          <li><em>浏览量：</em><span class="call"><?php echo $output['store_info']['store_click']; ?></span></li>
          <li><em>点评数：</em><span class="call"><?php echo $output['store_info']['comment_count']; ?></span></li>
        </ul>
      </div>
    </div>
    <div class="si-r">
      <ul>
        <li> <a class="box1" href="index.php?act=storeorder"><span class="txt1">订单数量</span> <span class="txt2"><?php echo $output['order_num']; ?></span> </a> </li>
        <li> <a class="box1 box1-1" href="index.php?act=storegroupbuy"> <span class="txt1">团购数量</span> <span class="txt2"><?php echo $output['group_num']; ?></span> </a> </li>
        <li> <a class="box1" href="index.php?act=storecoupon"> <span class="txt1">优惠券数量</span> <span class="txt2"><?php echo $output['coupon_num']; ?></span> </a> </li>
        <li> <a class="box1 box1-1" href="index.php?act=storeactivity"> <span class="txt1">活动数量</span><span class="txt2"><?php echo $output['activity_num']; ?></span> </a> </li>
      </ul>
    </div>
  </div>
  <div class="nav_icon">
     <a href="index.php?act=storeorder"><span class="nav-icon navic01"></span> <span class="txt">订单管理</span></a>
     <a href="index.php?act=storegroupbuy"><span class="nav-icon navic02"></span> <span class="txt">团购管理</span></a>
     <a href="index.php?act=storegoods"><span class="nav-icon navic03"></span> <span class="txt">商品管理</span></a>
     <a href="index.php?act=storecoupon"><span class="nav-icon navic04"></span> <span class="txt">优惠券管理</span></a>
     <a href="index.php?act=storecomment"><span class="nav-icon navic05"></span> <span class="txt">评论管理</span></a>
     <a href="index.php?act=storeactivity"><span class="nav-icon navic06"></span> <span class="txt">活动管理</span></a>
     <a href="index.php?act=storesettle"><span class="nav-icon navic07"></span> <span class="txt">结算管理</span></a>
     <a href="index.php?act=storesetting&op=appointmentlist"><span class="nav-icon navic08"></span> <span class="txt">预约管理</span></a>
  </div>
</div>
