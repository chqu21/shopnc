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
      <li class="cur"><a class="col-link" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>">收藏</a></li>
      <li><a class="col-link" href="index.php?act=membershow&op=pic&mid=<?php echo intval($_GET['mid']); ?>">图片</a></li>
    </ul>
  </div>
</div>
<div class="home-container">
  <div class="container">
    <div class="aside fr">
      <?php require_once("member_show_info.php");?>
      <div class="mdbox hot-merchants">
      <div class="hd"><h4>人气商户</h4></div>
      <div class="shophot_bd">
      <ul>
      <?php if(!empty($output['hot_store'])){ ?>
      <?php foreach ($output['hot_store'] as $val){ ?>
      		  <li>
                <h4> <a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>"><?php echo $val['store_name']; ?></a></h4>
                <p class="mb10 color6">地址:<?php echo $val['area_name'].$val['address']; ?></p>
              </li>
      <?php }} ?>
      </ul>
      </div>
      </div>
    </div>
    <div class="main fl">
      <div class="cbox p-tabs-box">
        <div class="sc-tabs tabbar"> <a class="<?php if(trim($_GET['type'])=='' || trim($_GET['type'])=='store'){ ?>current<?php } ?>" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>&type=store">收藏商户(<?php echo $output['snum']; ?>)</a> <em class="line">|</em> <a class="<?php if(trim($_GET['type'])=='comment'){ ?>current<?php } ?>" href="index.php?act=membershow&op=fav&mid=<?php echo intval($_GET['mid']); ?>&type=comment">收藏点评(<?php echo $output['cnum']; ?>)</a> </div>
        <div class="sc-tab-show">
<!--          <div class="term-list">-->
<!--            <ul>-->
<!--              <li> <em class="tit"><a href="#">全部分类</a></em> <span class=""><a href="#" title="">美食(109)</a></span> <span class="cur"><a href="#" title="">休闲娱乐(9)</a></span> <span class=""><a href="#" title="">购物(2)</a></span> <span class=""><a href="#" title="">运动健身(1)</a></span> </li>-->
<!--              <li> <em class="tit"><a href="#">全部城市</a></em> <span class=""><a href="#" title="">天津(9)</a></span> </li>-->
<!--            </ul>-->
<!--          </div>-->
          <div class="con">
            <div class="pic-txt favor-list">
              <ul>
              	<?php if(trim($_GET['type']) == '' || trim($_GET['type']) == 'store'){ ?>
              	<?php if(!empty($output['store_list'])){ ?>
              	<?php foreach ($output['store_list'] as $val){ ?>
              	<li class="odd">
                  <div class="txt">
                    <div class="tit">
                      <h6><a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name']; ?></a></h6>
                    </div>
                    <div class="txt-c">
                    <div class="mode-tc re-exp"><div class="remark-item star<?php echo $val['store_score']; ?>"></div><em class="col-exp">人均：¥<?php echo $val['person_consume']; ?></em></div>
                      <div class="mode-tc addres">
                        <p><span class="city">[<?php echo $val['area_name']; ?>]</span><?php echo $val['address']; ?><span class="tel"><?php echo $val['telephone']; ?></span></p>
                      </div>
                      <div class="mode-tc info"> <span class="col-exp"><i class="time"><?php echo date('Y-m-d H:i:s',$val['fav_time']); ?></i>收藏</span> <em class="line">|</em> <a href="javascript:add_fav(<?php echo $val['store_id']; ?>,'store');">点击收藏</a> </div>
                    </div>
                  </div>
                </li>
                <?php } ?>
              	<?php }else{ ?>
              	  <div class="mbox empty">
			        <div class="pic"><i class="em-icon comm-icon"></i></div>
			        <div class="txt">
			          <p>暂时还没有收藏任何商铺</p>
			        </div>
			      </div>
              	<?php } ?>
                <?php }else{ ?>
                <?php if(!empty($output['comment_list'])){ ?>
              	<?php foreach ($output['comment_list'] as $val){ ?>
                <li>
                  <div class="tit">
                    <h6><a title="<?php echo $val['store_name']; ?>" href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>"><?php echo $val['store_name']; ?></a></h6>
                    <div class="remark-item star<?php echo $val['store_score']; ?>"></div>
                    <em class="col-exp">人均：¥<?php echo $val['person_consume']; ?></em> </div>
                  <div class="txt-c">
                    <div class="mode-nc addres">
                      <p class="col-exp"><?php echo $val['address']; ?></p>
                    </div>
                    <div class="mode-nc com-entry mb10"><?php echo $val['comment']; ?></a></div>
                    <div class="share_info mb10"> <span class="col-exp"><?php echo date('Y-m-d H:i:s',$val['fav_time']); ?>收藏</span> <span class="col-right"><a href="javascript:give_flower(<?php echo $val['comment_id']; ?>);">送鲜花(<span id="f_num_<?php echo $val['comment_id']; ?>"><?php echo $val['flower_num']; ?></span>)</a> <em class="sep">|</em> <a href="javascript:add_fav(<?php echo $val['comment_id']; ?>,'comment');">收藏</a><em class="sep">|</em><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>#share">我也去过，说说我的感受</a></span> </div>
                  </div>
                </li>
                <?php }?>
                <?php }else{ ?>
              	  <div class="mbox empty">
			        <div class="pic"><i class="em-icon comm-icon"></i></div>
			        <div class="txt">
			          <p>暂时还没有收藏任何点评</p>
			        </div>
			      </div>
              	<?php } ?>
                <?php } ?>
              </ul>
            </div>
            <?php if(!empty($output['store_list']) || !empty($output['comment_list'])){ ?>
            <div class="page_box"> <?php echo $output['show_page'];?></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
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