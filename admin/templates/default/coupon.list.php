<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
function submit_delete_batch(type){
    /* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if(items != '') {
        items = items.substr(0, (items.length - 1));
        submit_delete(items,type);
    }  
    else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}
function submit_delete(id,type){
    if(confirm('确定进行该操作？')) { 
        $('#list_form').attr('method','post');
        if(type=='del'){
        	$('#list_form').attr('action','index.php?act=coupon&op=del');
        }
        if(type=='audit_yes'){
        	$('#list_form').attr('action','index.php?act=coupon&op=batch_audit&state=2');
        }
        if(type=='audit_no'){
        	$('#list_form').attr('action','index.php?act=coupon&op=batch_audit&state=3');
        }
        $('#coupon_id').val(id);
        $('#list_form').submit();
    }
}
function ajax_set_recommend(stat,coupon_id){
	$.getJSON('index.php?act=coupon&op=ajax_recommend&coupon_id='+coupon_id+'&stat='+stat, function(result){
		if(result.done){
			if(stat == 1){
				var stat_show = '是';
				var rechange_tip = '取消推荐';
				var new_rcstat = 0;
			}else{
				var stat_show = '否';
				var rechange_tip = '设为推荐';
				var new_rcstat = 1;
			}
			$('#re_stat_'+coupon_id).html(stat_show);
			$('a[re_change="'+coupon_id+'"]').html("["+rechange_tip+"]").attr("href","javascript:ajax_set_recommend("+new_rcstat+","+coupon_id+");");
        }else{
            alert('优惠券推荐状态修改失败');
        }
	});
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_coupon_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <td>
			  <select name='s_type'>
				<option value="coupon_name" <?php if($output['s_type']=='coupon_name'){ ?>selected<?php } ?>>优惠券名称</option>
				<option value="store_name" <?php if($output['s_type']=='store_name'){ ?>selected<?php } ?>>商铺名称</option>
			  </select>
          </td>
          <td><input type="text" value="<?php echo $output['s_content'];?>" name="s_content" class="txt" ></td>
          <td>审核状态：</td>
          <td>
			  <select name='s_audit'>
				<option value="" <?php if($output['s_audit']==''){ ?>selected<?php } ?>>全部</option>
				<option value="1" <?php if($output['s_audit']==1){ ?>selected<?php } ?>>待审核</option>
				<option value="2" <?php if($output['s_audit']==2){ ?>selected<?php } ?>>审核通过</option>
				<option value="3" <?php if($output['s_audit']==3){ ?>selected<?php } ?>>审核未通过</option>
			  </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <!-- 操作说明 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        	<ul>
            	<li><?php echo $lang['nc_admin_coupon_help'];?></li>
            	<li><?php echo $lang['nc_admin_coupon_help1'];?></li>
            	<li>可以设置是否推荐到首页轮播广告下方进行展示（最多展示3个）</li>
         	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="coupon_id" name="coupon_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th><?php echo $lang['nc_admin_coupon_coupon_name'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_valid_date'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_store_name'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_download_count'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_view_count'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_number'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_audit'];?></th>
		  <th class="w108">首页推荐</th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><input type="checkbox" value="<?php echo $val['coupon_id'];?>" class="checkitem"></td>
          <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $val['coupon_id']; ?>" target="_blank"><?php echo $val['coupon_name'];?></a></td>
		  <td><?php echo date("Y-m-d",$val['coupon_start_time']);?>~<?php echo date("Y-m-d",$val['coupon_end_time']);?></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo $val['download_count'];?></td>
		  <td><?php echo $val['view_count'];?></td>
		  <td><?php echo $val['limit'];?></td>
		  <td><?php if($val['audit'] == 1){ echo $lang['nc_admin_coupon_audit_wait'];}elseif($val['audit'] == 2){ echo $lang['nc_admin_coupon_audit_yes'];}elseif($val['audit'] == 3){ echo $lang['nc_admin_coupon_audit_no'];}?></td>
		  <td><span id="re_stat_<?php echo $val['coupon_id'];?>"><?php echo $val['is_recommend']==0?'否':'是'; ?></span><a re_change="<?php echo $val['coupon_id'];?>" class="marginleft" href="javascript:ajax_set_recommend(<?php echo $val['is_recommend']==0?1:0; ?>,<?php echo $val['coupon_id'];?>);">[<?php echo $val['is_recommend']==0?'设为推荐':'取消推荐'; ?>]</a></td>
		  <td class='align-center'>
		  <?php if($val['audit'] == 1){ ?>
		  <a href="index.php?act=coupon&op=audit&coupon_id=<?php echo $val['coupon_id'];?>"><?php echo $lang['nc_admin_coupon_audit'];?></a>
		  <?php }else{ ?>
		  <span style="color:#ccc"><?php echo $lang['nc_admin_coupon_audit'];?></span>
		  <?php } ?>
		  &nbsp;|&nbsp;<a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=coupon&op=del&coupon_id=<?php echo $val['coupon_id'];?>';"><?php echo $lang['nc_del'];?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td>
          	<input type="checkbox" class="checkall" id="checkall_1">
          </td>
          <td id="batchAction" colspan="15">
          	<span class="all_checkbox">
            	<label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('del');"><span><?php echo $lang['nc_del'];?></span></a>
            	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('audit_yes');"><span>审核通过</span></a>
            	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('audit_no');"><span>审核不通过</span></a>
            </span>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
