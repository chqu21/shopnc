<?php defined('InShopNC') or exit('Access Invalid!');?>
<script>
$(function (){
	$(".term-list li span").click(function (){
		$(this).addClass("cur").siblings().removeClass("cur");
	  })
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
  </div>
  <span class="user-groun mt10"><i class="<?php echo $output['minfo']['gender']==1?'man':'woman'; ?>"></i><?php echo $output['minfo']['area_name']; ?></span>
  <div class="nav">
    <ul>
      <li><a class="col-link" href="index.php?act=membershow&mid=<?php echo intval($_GET['mid']); ?>">首页</a></li>
      <li class="cur"><a class="col-link" href="index.php?act=membershow&op=comment&mid=<?php echo intval($_GET['mid']); ?>">点评</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>">收藏</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">图片</a></li>
    </ul>
  </div>
</div>
<div class="home-container">
  <div class="container">
    <div class="aside fr">
      <?php require_once("member_show_info.php");?>
    </div>
    <div class="main fl"> 
      <div class="mbox tabs-box">
        <div class="tabs"> <a class="cur" href="index.php?act=membershow&op=comment&mid=<?php echo intval($_GET['mid']); ?>">点评(<?php echo $output['cnum']; ?>)</a> </div>
      </div>
<!--      <div class="mbox term-list">-->
<!--        <ul>-->
<!--          <li> <em class="tit"><a href="#">全部分类</a></em> <span class=""><a title="" href="#">美食(109)</a></span> <span class="cur"><a title="" href="#">休闲娱乐(9)</a></span> <span class=""><a title="" href="#">购物(2)</a></span> <span class=""><a title="" href="#">运动健身(1)</a></span> </li>-->
<!--          <li> <em class="tit"><a href="#">全部城市</a></em> <span class=""><a title="" href="#">天津(9)</a></span> </li>-->
<!--        </ul>-->
<!--      </div>-->
      <div class="mbox com-list">
      <?php if(!empty($output['comment_list'])){ ?>
        <div class="pic-txt">
          <ul>
            <?php foreach ($output['comment_list'] as $val){ ?>
            <li>
              <div class="tit">
                <h6><a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>"><?php echo $val['store_name']; ?></a></h6>
                <div class="remark-item star<?php echo $val['amount_score']; ?>"></div>
                <em class="col-exp">人均：¥<?php echo $val['person_cost']; ?></em> </div>
              <div class="txt-c">
                <div class="mode-nc addres">
                  <p class="col-exp"><?php echo $val['parking']?'停车信息：'.$val['parking']:''; ?></p>
                </div>
                <div class="mode-nc com-entry mb10"><?php echo $val['comment']; ?></div>
                <div class="share_info mb10"> <span class="col-exp">发表于<?php echo date('Y-m-d H:i:s',$val['add_time']); ?></span> <span class="col-right"><a href="javascript:give_flower(<?php echo $val['comment_id']; ?>);">送鲜花(<span id="f_num_70"><?php echo $val['flower_num']; ?></span>)</a> <em class="sep">|</em> <a href="javascript:add_fav(<?php echo $val['comment_id']; ?>,'comment');">收藏</a><em class="sep">|</em><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>#share">我也去过，说说我的感受</a></span> </div>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="page_box"> <?php echo $output['show_page'];?></div>
        <?php }else{ ?>
        <div class="mbox empty">
        <div class="pic"><i class="em-icon comm-icon"></i></div>
        <div class="txt">
          <p>暂时还没有任何点评</p>
        </div>
      </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
