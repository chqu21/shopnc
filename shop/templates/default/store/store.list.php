<div id='main-nav'>
  <div id='main-nav-wrap'>
    <ul class="main-nav-left">
      <li class="main-selected-nav"><a target="_top" href="#"><?php echo $lang['nc_first'];?></a><s></s></li>
      <li class="life_nav_1"><a target="_blank" href="#"><?php echo $lang['nc_coupon'];?></a><s></s></li>
      <li class="life_nav_2"><a target="_blank" href="#"><?php echo $lang['nc_groupbuy']?></a><s></s></li>
      <li class="life_nav_3"><a target="_blank" href="#"><?php echo $lang['nc_member_card'];?></a><s></s></li>
      <li class="life_nav_4"><a target="_blank" href="#"><?php echo $lang['nc_community'];?></a><s></s></li>
    </ul>
    <ul class="main-nav-right">
      <li class="life_nav_9"><a target="_top" href="#"><?php echo $lang['nc_merchants_enter'];?></a><s></s></li>
    </ul>
  </div>
</div>
<div class="life_body">
<div id="main-wrap">
  <div class="sitenav">
    <h2>当前位置：</h2>
    <a href="#">淘宝本地生活&nbsp;>&nbsp;</a> <a href="#">天津本地商户&nbsp;>&nbsp;</a> <a href="#">餐饮美食&nbsp;>&nbsp;</a> <a href="#">火锅</a> </div>
  <div class="mainbox">
    <div class="layout_left02 clearfix">
      <div class="main-local">
        <div class="list_nav"> <span class="tit">类目:</span>
          <?php if(!empty($output['class_root'])){?>
          <ul id="J_list" class="list" >
            <?php foreach($output['class_root'] as $rk=>$rv){?>
            <li class="<?php if($rv['class_id']==$output['class_id']){ echo 'current';}?>"><a href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&class_id=<?php echo $rv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $rv['class_name']?><span>(<?php echo $rv['number'];?>)</span></a></li>
            <?php }?>
          </ul>
          <?php }?>
          <?php if(isset($output['class_id'])){?>
          <div class="list_navtab">
            <?php if(!empty($output['class_menu'][$output['class_id']])){?>
            <ul id="J_list" class="list" >
              <?php foreach($output['class_menu'][$output['class_id']] as $ck=>$cv){?>
              <li class="<?php if($cv['class_id']==$output['class_id_1']){ echo 'current';}?>"><a  href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&class_id=<?php echo $output['class_id'];?>&class_id_1=<?php echo $cv['class_id'];?>&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $cv['class_name'];?><span>(<?php echo $cv['number'];?>)</span></a></li>
              <?php }?>
            </ul>
            <?php }?>
          </div>
          <?php }?>
        </div>
        <div class="dotted-line"></div>
        <div class="list_nav"> <span class="tit">商圈:</span>
          <?php if(!empty($output['area_list'])){?>
          <ul id="J_list" class="list" >
            <?php foreach($output['area_list'] as $mk=>$mv){?>
            <li class="<?php if($mv['area_id']==$output['area_id']){ echo 'current';}?>"><a href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $mv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $mv['area_name'];?><span>(<?php echo $mv['number'];?>)</span></a></li>
            <?php }?>
          </ul>
          <?php }?>
          <?php if(isset($output['area_id'])){?>
          <div class="list_navtab">
            <?php if(!empty($output['area_list'])){?>
            <ul id="J_list" class="list">
              <?php foreach($output['area_list'] as $mmk=>$mmv){?>
              <?php if($mmv['area_id']==$output['area_id']){?>
              <?php foreach($mmv[0] as $mmmk=>$mmmv){?>
              <li class="<?php if($mmmv['area_id']==$output['mall_id']){ echo 'current';}?>"><a href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $mmv['area_id']?>&mall_id=<?php echo $mmmv['area_id'];?>&class_id=<?php if(isset($output['class_id'])){ echo $output['class_id'];}?>&class_id_1=<?php if(isset($output['class_id_1'])){ echo $output['class_id_1'];}?>&pconsume=<?php echo $output['pconsume']?>"><?php echo $mmmv['area_name'];?><span>(<?php echo $mmmv['number'];?>)</span></a></li>
              <?php }?>
              <?php }?>
              <?php }?>
            </ul>
            <?php }?>
          </div>
          <?php }?>
        </div>
        <div class="dotted-line"></div>
        <div class="list_nav"> <span class="tit">人均:</span>
          <ul id="J_list" class="list" >
            <?php foreach($output['personconsume'] as $pk=>$pv){?>
            <li class="<?php if($pk==$output['pconsume']){ echo 'current';}?>"><a href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id']?>&area_id=<?php echo $output['area_id'];?>&mall_id=<?php echo $output['mall_id'];?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $pk;?>"><?php echo $pv;?><span></span></a></li>
            <?php }?>
          </ul>
        </div>
      </div>
      <div class="sort_box">
        <div class="button_box"> <a class="<?php if(isset($output['orderby'])&&isset($output['sort'])){ echo 'sort1';}else{ echo 'sort2';}?>" href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>" title="默认排序">默认排序</a> <a class="<?php if(isset($output['orderby'])&&$output['orderby']=='person_consume'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=person_consume&sort=desc" title="人均">人均<i class="bottom_img"></i></a> <a class="<?php if(isset($output['orderby'])&&$output['orderby']=='add_time'){ echo 'sort2';}else{ echo 'sort1';}?>" href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlinestore&op=search_store&city_id=<?php echo $output['city_id'];?>&area_id=<?php echo $output['area_id']?>&mall_id=<?php echo $output['mall_id']?>&class_id=<?php echo $output['class_id']?>&class_id_1=<?php echo $output['class_id_1']?>&pconsume=<?php echo $output['pconsume'];?>&orderby=add_time&sort=desc" title="发布时间">发布时间<i class="bottom_img"></i></a> </div>
      </div>
      <div class="main_content">
        <div class="main_content_top">
          <div class="list_tab">
            <ul id="J_tab" class="clearfix">
              <li class="selected"><a href="#">所有商户</a></li>
            </ul>
          </div>
        </div>
        <div class="main_content_list">
          <?php if(!empty($output['list'])){?>
          <ul>
            <?php foreach($output['list'] as $storek=>$storev){?>
            <li class="mod">
              <div class="mod_list">
                <div class="mod_list_left"> <span><img width="137" height="103" onload="javascript:DrawImage(this,150,103)" src="<?php echo SiteUrl;?>/upload/offline/store/<?php echo $storev['offline_pic'];?>"></span>
                  <div class="mark">1</div>
                </div>
                <div class="mod_list_right">
                  <div class="mod_title"> <a class="name" href="<?php echo OFFLINESHOP_SITEURL;?>/index.php?act=offlineshopstore&op=detail&id=<?php echo $storev['offline_store_id'];?>"><?php echo $storev['offline_store_name'];?></a></div>
                  <div class="mod_info clearfix">
                    <div class="mod_place_tag">
                      <div class="mod_pingfen"> <span>
                        <label>服务:</label>
                        <em>4</em></span> <span>
                        <label>质量:</label>
                        <em>4</em></span> <span>
                        <label>环境:</label>
                        <em>4</em></span> <span>
                        <label>性价比:</label>
                        <em>4</em></span> </div>
                      <p><span class="mod_place">地址:</span><?php echo $storev['address'];?></p>
                      <!--
                    <p><span class="mod_yhinfo">优惠:</span><a href="#" target="_blank">天津:天津今晚大酒店</a> <span class="mod_line">|</span> <a href="#" target="_blank">优惠(28)</a></p>-->
                      <div class="mod_tags"><span class="tag">标签:</span><a href="#" target="_blank">草莓</a><a href="#" target="_blank">香蕉</a><a href="#" target="_blank">葡萄</a> <a href="#" target="_blank">西瓜</a><a href="#" target="_blank">樱桃</a><a href="#" target="_blank">葡萄</a> </div>
                    </div>
                    <div class="mod_price">￥<strong><?php echo $storev['person_consume'];?></strong></div>
                    <div class="mod_dp">
                      <p>好评：<a href="#" target="_blank"><em>95%</em></a>( <a target="_blank"  href="#" >91</a> ) </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mod_links"> <a href="#" target="_blank">我要点评</a> <span class="mod_line ">|</span> <a href="#" target="_blank">查看点评</a> <span class="mod_line ">|</span> <a href="#" data-spm="d1000253" target="_self">搜索附近</a> </div>
            </li>
            <?php }?>
          </ul>
          <?php }else{?>
          <!--没有搜索到商户-->
          <div class="none_info"><?php echo $lang['offline_no_offline_store'];?></div>
          <?php }?>
          <div class="page_box"><?php echo $output['show_page'];?> </div>
        </div>
      </div>
    </div>
    <div class="sidebar">
      <div class="col-sub"><img src='<?php echo OFFLINESHOP_TEMPLATES_PATH;?>/images/lf18.jpg'></div>
      <div class="hot_coupon clearfix">
        <div class="hot_ch">
          <h2>热卖优惠券</h2>
          <a href="#">更多优惠&gt;&gt;</a> </div>
        <?php if(!empty($output['evoucherlist'])){?>
        <ul>
          <?php $i = 1;?>
          <?php $j = 1;?>
          <?php foreach($output['evoucherlist'] as $ek=>$ev){?>
          <li class="hot_abc"><em class="e<?php echo $i;?>"><?php echo $j;?></em>
            <?php if($i<4){?>
            <div class="hot_img"><img src="<?php echo SiteUrl;?>/upload/offline/evoucher/<?php echo $ev['evoucher_pic'];?>" ></div>
            <?php }?>
            <div class="hot_info">
              <p class="tit1"><a href="#">
                <?php if($i<4){ echo mb_substr($ev['evoucher_name'],0,12,'utf-8');}else{ echo mb_substr($ev['evoucher_name'],0,16,'utf-8');}?>
                </a></p>
              <p class="price"><span>¥</span><strong ><?php echo $ev['evoucher_price'];?></strong></p>
              <p class="num">销量：<em><?php echo $ev['evoucher_sales']?></em>件</p>
            </div>
          </li>
          <?php if($i<4){ $i++; }?>
          <?php $j++;?>
          <?php }?>
        </ul>
        <?php }?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
