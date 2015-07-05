<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
         $(function(){
             var oPic=$('#slider_pic').find('ul');
             var oImg=oPic.find('li');
            var oLen=oImg.length;
             var oLi=oImg.width();
             var prev=$("#prev");
             var next=$("#next");
           
           oPic.width(oLen*210);//计算总长度
             var iNow=0;
             var iTimer=null;
             prev.click(function(){
                  if(iNow>0){  
                   iNow--;

                  }
                 ClickScroll();
             })
             next.click(function(){
                 if(iNow<oLen-3){ 
                     iNow++
                 }
                 ClickScroll();
             })
 
             function ClickScroll(){
 
                iNow==0? prev.addClass('btn-prev-off'): prev.removeClass('btn-prev-off');
                 iNow==oLen-3?next.addClass("btn-next-off"):next.removeClass("btn-next-off");
                 
                 oPic.animate({left:-iNow*210})
             }
 
         })
function add_fav(fav_id,fav_type){
	$.getJSON('index.php?act=store&op=ajax_collect&fav_type='+fav_type+'&fav_id='+fav_id, function(result){
        if(result.done){
            $('#store_fav_num').html('('+result.num+')');
        	alert('收藏成功！');
        }else{
            alert(result.msg);
        }
    });
}
function give_flower(comment_id){
	$.getJSON('index.php?act=store&op=ajax_give_flower&comment_id='+comment_id, function(result){
        if(result.done){
            $('#f_num_'+comment_id).html(result.num);
        	alert('鲜花赠送成功！');
        }else{
            alert(result.msg);
        }
    });
}
 
   </script>

<div class="home_top">
  <div class="pic"><a title="" href="#"><img src="<?php if(!empty($output['minfo']['avatar'])){ echo UPLOAD_SITE_URL.'/shop/member/'.$output['minfo']['avatar'];}else{ echo UPLOAD_SITE_URL.'/shop/member/member.png';}?>"></a> </div>
  
  <div class="txt">
    <div class="tit">
      <h2 class="name"><?php echo $output['minfo']['member_name']; ?></h2>
    </div>
  
  <span class="user-groun mt10"><i class="<?php echo $output['minfo']['gender']==1?'man':'woman'; ?>"></i><?php echo $output['minfo']['area_name']; ?></span>
  <div class="nav">
    <ul>
      <li class="cur"><a class="col-link" href="index.php?act=membershow&mid=<?php echo intval($_GET['mid']); ?>">首页</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=comment&mid=<?php echo intval($_GET['mid']); ?>">点评</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>">收藏</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">图片</a></li>
    </ul>
  </div>
  </div>
</div>
<div class="home-container">
  <div class="container">
    <div class="aside fl">
      <?php require_once("member_show_info.php");?>
    </div>
    <div class="main fr">
      <div class="modebox mode-hd dot-comm">
        <div class="hd">
          <h3>点评</h3>
        </div>
        <div class="con">
        <?php if(!empty($output['comment_list'])){ ?>
          <div class="pic-txt">
            <ul>
              <?php foreach ($output['comment_list'] as $key=>$val){ if($key<=4){?>
              <li>
                <div class="txt">
                  <div class="tit">
                    <h6><a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name']; ?></a></h6>
                    <div class="remark-item star<?php echo $val['amount_score']; ?>"></div>
                    <em class="col-exp">人均¥<?php echo $val['person_cost']; ?></em></div>
                  <div class="txt-c"><?php echo $val['comment']; ?></div>
                  <div class="share_info"> <span class="col-exp"><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></span> <span class="col-right"><a href="javascript:give_flower(<?php echo $val['comment_id']; ?>);">送鲜花(<span id="f_num_<?php echo $val['comment_id']; ?>"><?php echo $val['flower_num']; ?></span>)</a> <em class="sep">|</em> <a href="javascript:add_fav(<?php echo $val['comment_id']; ?>,'comment');">收藏</a><em class="sep">|</em><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>#share">我也去过，说说我的感受</a></span> </div>
                </div>
              </li>
              <?php }} ?>
            </ul>
          </div>
          <div class="more"><a href="index.php?act=membershow&op=comment&mid=<?php echo intval($_GET['mid']); ?>">全部点评(<?php echo $output['cnum']; ?>) »</a></div>
          <?php }else{ ?>
          <div class="empty-txt"><p>暂无任何点评</p></div>
          <?php } ?>
        </div>
      </div>
      <div class="modebox mode-hd dot-photo">
        <div class="hd">
          <h3>图片</h3>
        </div>
        <div class="pic-box">
         <?php if(!empty($output['pic_list'])){ ?>
          <div class="slider"><span class="prev btn-prev-off" id="prev"></span><span class="next" id="next"></span>
            <div id="slider_pic">
              <ul>
              	<?php foreach ($output['pic_list'] as $val){ ?>
                <li><a href="index.php?act=membershow&op=pic_show&cp_id=<?php echo $val['cp_id']; ?>&mid=<?php echo intval($_GET['mid']); ?>"><img src="<?php echo BASE_SITE_URL.'/data/upload/shop/comment/'.$val['pic_name']; ?>" width="180" height="112" /></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="more"><a href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">全部图片(<?php echo $output['pnum']; ?>)»</a></div>
          <?php }else{ ?>
          <div class="empty-txt"><p>暂无上传图片</p></div>
          <?php } ?>
        </div>
      </div>
      <div class="modebox mode-hd collect">
        <div class="hd">
          <h3>收藏</h3>
        </div>
        <div class="con">
        <?php if(!empty($output['fav_list'])){ ?>
        <div class="collect-list">
            <ul>
              <?php foreach ($output['fav_list'] as $key=>$val){ if($key<=3){?>
              <li>
                <h6><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>"><?php echo $val['store_name']; ?></a></h6>
                <p class="coll-star"><span class="remark-item star<?php echo $val['store_score']; ?>"></span></p>
                <p class="col-exp"><?php echo $val['class_name']; ?><br><?php echo $val['area_name']; ?></p>
              </li>
              <?php }else{break;}} ?>
            </ul>
          </div>
          <div class="more"><a href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>">全部收藏(<?php echo $output['fnum']; ?>)»</a></div>
          <?php }else{ ?>
          <div class="empty-txt"><p>暂无任何收藏</p></div>
          <?php } ?>
          
        </div>
      </div>
    </div>
  </div>
</div>
