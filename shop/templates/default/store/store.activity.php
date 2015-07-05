<div id="content" >
  <div class="ls_layout">
    <div class="sitenav">
      <h2>当前位置：</h2>
      <a href="index.php?act=index">首页</a>&nbsp;»&nbsp;<a href="index.php?act=index&op=list&class_id=<?php echo $output['storeinfo']['class_id']; ?>"><?php echo $output['class_name']; ?></a>&nbsp;»&nbsp;<a href="index.php?act=index&op=list&class_id=<?php echo $output['storeinfo']['class_id']; ?>&class_id_1=<?php echo $output['storeinfo']['s_class_id']; ?>"><?php echo $output['sub_class_name']; ?></a>&nbsp;»&nbsp;<a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['storeinfo']['store_id'];?>"><?php echo $output['storeinfo']['store_name']; ?></a>&nbsp;»&nbsp;商铺活动</div>
    <div class="shop_infobox clearfix mb15">
      <div class="shop_img"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['storeinfo']['store_id'];?>"><img src="<?php echo ($output['storeinfo']['logo']!='' && $output['storeinfo']['logo']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['storeinfo']['logo']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" /></a></div>
      <div class="shop_info">
        <h2 class="title"><?php echo $output['storeinfo']['store_name'];?></h2>
        <ul>
          <li><span style="float:left;">店铺评价:</span>
            <div class="remark_box"> <span class="remark-item star<?php echo $output['final_score']; ?>" style=" margin-top:4px;"></span>
              <div class="remark_taste"> <a href="#" class="col-num"><?php echo $output['final_score']; ?>分</a> <em class="sep">|</em><span>人均<strong class="stress"> ¥<?php echo $output['storeinfo']['person_consume'];?> </strong></span></div>
            </div>
          </li>
          <li><span>店铺介绍:</span><?php echo mb_substr($output['storeinfo']['description'],0,55,'utf-8'); ?></li>
          <li><span><?php echo $lang['nc_coupon_store_address'];?>:</span><?php echo $output['storeinfo']['address'];?></li>
          <li><span><?php echo $lang['nc_coupon_store_telephone'];?>:</span><?php echo $output['storeinfo']['telephone'];?></li>
          <!--            <li><span><?php echo $lang['nc_coupon_store_bus'];?> :</span><?php echo $output['storeinfo']['bus'];?></li>-->
        </ul>
      </div>
    </div>
    <div class="store_box">
      <div class="store_box_l">
        <div class="shop_activitie">
          <?php if(!empty($output['list'])){?>
          <?php foreach($output['list'] as $val){?>
          <div class="sa_bd bg2 mb20">
            <div class="actimg"><a class="b_logo" target="_blank" href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['storeinfo']['store_id'];?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['storeinfo']['logo'];?>" alt="<?php echo $output['storeinfo']['store_name'];?>"></a></div>
            <div class="sa_con">
              <h2 class="tit"><a href="javascript:void(0);"><?php echo $val['activity_name'];?></a></h2>
              <p class="info"><?php echo htmlspecialchars_decode(stripslashes($val['description']));?></p>
              <div class="pic"> <a href="javascript:void(0);"><img src="<?php echo UPLOAD_SITE_URL;?>/shop/activity/<?php echo str_replace('.jpg_small','',$val['pic']);?>" /> </a> </div>
              <div class="sa_con_list">
                <ul>
                  <li><?php echo $lang['nc_store_already'];?><em class="tit"><?php echo $val['apply_num'];?></em><?php echo $lang['nc_store_already_person_apply'];?></li>
                  <li><?php echo $lang['nc_store_valid_date'].$lang['nc_colon'];?><em class="tit"><?php echo date('Y-m-d',$val['end_time']);?></em></li>
                  <li>报名截止时间：<?php echo date('Y-m-d',$val['apply_time']);?></li>
               
                </ul>
                <a class="btn" href="javascript:void(0);" onclick='javascript:apply(<?php echo $val['activity_id'];?>);'></a> </div>
<div class="enroll-box"><div class="tit02">报名项：</div>
				  
				  <div class="con02"><?php if(!empty($val['apply_item'])){?>
				<?php $arr = explode(',',$val['apply_item']);?>
				<?php foreach($arr as $val1){?>
				<label class="eb-list"><input type="checkbox" name="activity<?php echo $val['activity_id'];?>" value="<?php echo $val1;?>">&nbsp;<span><?php echo $val1;?></span></label>
				<?php }?>
				<?php }?></div></div>
			  <!--
              <div class="icon-box"><em><?php echo $lang['nc_store_share'].$lang['nc_colon'];?></em>
                <div class="jiathis_style" style="width:auto; padding:0; margin-top:6px;"> <a class="jiathis_button_qzone"></a> <a class="jiathis_button_tsina"></a> <a class="jiathis_button_tqq"></a> <a class="jiathis_button_weixin"></a> <a class="jiathis_button_renren"></a> <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a> <a class="jiathis_counter_style"></a> </div>
                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script> 
              </div>
			  -->
              <div class="sa_avatar">
                <?php if(!empty($val['member'])){?>
                <?php foreach($val['member'] as $v){?>
                <div class="sa_block"><img src="<?php echo BASE_SITE_URL;?>/data/upload/shop/member/<?php echo $v['member_avator'];?>" height='25px' width='25px'/></div>
                <?php }?>
                <?php }?>
              </div>
            </div>
          </div>

          <?php }?>
          <?php }else{?>
          <div class="pic_box"><span class="font-msg"><?php echo $lang['nc_record'];?></span> </div>
          <?php }?>
        </div>
        <div class="page_box"> <?php echo $output['show_page'];?> </div>
      </div>
      <div class="shop_intro_conr">
        <div class="sidebox mb10">
          <div class="shop_intro_hd mb10">
            <h3 class="mr20"> <strong>最新</strong>评论</h3>
          </div>
          <div class="shopnear_bd">
            <ul>
              <?php if(!empty($output['comment_list'])){ ?>
              <?php foreach ($output['comment_list'] as $k=>$val){ ?>
              <li class="item" <?php if($k==0){ ?>style="border:none"<?php } ?>>
                <div class="info"> <span class="remark-item star<?php echo $val['amount_score']; ?>"></span> <span class="date"><?php echo date('Y-m-d',$val['add_time']); ?></span> </div>
                <p class="desc"><?php echo $val['comment']; ?></p>
              </li>
              <?php }} ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	function apply(activity_id){		
		
		var item = '';
		$('input[name=activity'+activity_id+']').each(function(){
			if($(this).prop('checked')){
				item+= encodeURIComponent($(this).val())+',';
			}
		});
		
		$.ajax({
			type:'GET',
			url:'<?php echo BASE_SITE_URL;?>/index.php?act=store&op=apply&id=<?php echo $_GET['id'];?>&activity_id='+activity_id+'&item='+item,
			dataType:'json',
			success:function(data){
				if(data.result == 'succ'){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
					return false;
				}
			}
		});
	}
</script> 
