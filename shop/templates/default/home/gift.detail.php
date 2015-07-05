<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_SITE_URL;?>/css/offlinestore.css">
<style>
.dialog_body {
	width: 580px;
}
</style>
<div class="life_body">
  <div id="main-wrap">
    <div class="sitenav">
      <h2><?php echo $lang['nc_location'];?>：</h2>
      <a href="<?php echo BASE_SITE_URL;?>"><?php echo $lang['nc_Locallife'];?></a>&nbsp;&gt;&nbsp;积分商城 </div>
    <div class="layout_left02 clearfix">
      <div class="group-detail-con">
        <div class="gd-title" style="padding:10px 5px 20px; color:#333;">
          <p class="gd-des"><?php echo $output['sg_info']['sg_name'];?></p>
        </div>
        <div class="gd-con">
          <div class="group-pic"><img src="<?php echo BASE_SITE_URL.'/data/upload/shop/gift/'.$output['sg_info']['sg_pic']; ?>" /></div>
          <div class="group-info">
            <div class="prices-box">
              <dl>
                <dt><?php echo $lang['nc_groupbuy_original_price'];?></dt>
                <dd class="prices">￥<?php echo intval($output['sg_info']['sg_price']);?></dd>
              </dl>
              <dl>
                <dt>库存</dt>
                <dd><?php echo $output['sg_info']['sg_num']; ?></dd>
              </dl>
              <dl>
                <dt>已兑换</dt>
                <dd><?php echo $output['sg_info']['sg_sale_num']; ?></dd>
              </dl>
            </div>
            <div class="buy-now"><strong><?php echo intval($output['sg_info']['sg_point']); ?>&nbsp;<span>积分</span></strong><a class="gift-btn-txt" sg_id="<?php echo $output['sg_info']['sg_id']; ?>"> 兑换 </a></div>
            <div class="time"> </div>
            <div class="require02">
              <h2>该礼品兑换要求最低会员等级为：<em><?php echo $output['limit_member']!=''?$output['limit_member']:'无限制'; ?></em></h2>
              <h2>该礼品兑换数量限制为：<em><?php echo $output['sg_info']['sg_limit_num']==0?'无限制':$output['sg_info']['sg_limit_num'].'件'; ?></em></h2>
            </div>
          </div>
        </div>
      </div>
      <div class="group-detail-box">
        <div class="side-left">
          <div class="side-left-intro" style="width:100%">
            <div class="side-left-hd">
              <h2>礼品介绍</h2>
            </div>
            <div> <?php echo stripslashes(htmlspecialchars_decode($output['sg_info']['sg_intro']));?> </div>
          </div>
        </div>
      </div>
      <div class="ad-detail-l mb10"><?php echo rec(16);?></div>
    </div>
    <div class="sidebar">
      <div class="hot-group clearfix mb10">
        <div class="hot-group-hd">
          <h2>推荐兑换</h2>
        </div>
        <?php if(!empty($output['gift_recommend'])){?>
        <ul class="recom-ul">
          <?php foreach($output['gift_recommend'] as $hot){?>
          <li> <a class="thumb" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"> <img width="220" height="125" src="<?php echo BASE_SITE_URL.'/data/upload/shop/gift/'.$hot['sg_pic'];?>"> </a>
            <h6> <a title="" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"><?php echo $hot['sg_name'];?></a> </h6>
            <a class="recom-worth" href="<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=detail&sg_id=<?php echo $hot['sg_id'];?>"> <span class="Price-font price"><?php echo $hot['sg_point'];?>分</span> <del class="o-price">¥<?php echo $hot['sg_price'];?></del> </a> </li>
          <?php }?>
        </ul>
        <?php }?>
      </div>
      <div class="cp_ad mb10"><?php echo rec(15);?></div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
</script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script> 
<script type="text/javascript">
$(function(){
	$('.gift-btn-txt').click(function(){
		var sg_id = $(this).attr('sg_id');
		var sg_md = '<?php echo $output['sg_info']['sg_member_degree']; ?>';
		var m_id = '<?php echo $_SESSION['member_id']; ?>';
		if(sg_id != 0 && m_id < sg_md){
			alert('您当前的会员等级无法兑换该礼品');
		}else{
			ajax_form('gift', '积分兑换','<?php echo BASE_SITE_URL;?>/index.php?act=gift&op=order_confirm&sg_id='+sg_id,'500px');
		}
	});
});
</script>