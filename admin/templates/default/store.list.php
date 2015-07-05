<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
function submit_delete_batch(){
    /* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if(items != '') {
        items = items.substr(0, (items.length - 1));
        submit_delete(items);
    }  
    else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}
function submit_delete(id){
    if(confirm('<?php echo $lang['nc_ensure_del'];?>')) {
        $('#list_form').attr('method','post');
        $('#list_form').attr('action','index.php?act=microshop&op=goods_class_drop');
        $('#class_id').val(id);
        $('#list_form').submit();
    }
}
function ajax_set_recommend(stat,store_id){
	$.getJSON('index.php?act=store&op=ajax_store_recommend&store_id='+store_id+'&stat='+stat, function(result){
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
			$('#re_stat_'+store_id).html(stat_show);
			$('a[re_change="'+store_id+'"]').html("["+rechange_tip+"]").attr("href","javascript:ajax_set_recommend("+new_rcstat+","+store_id+");");
        }else{
            alert('店铺首页推荐状态修改失败');
        }
	});
}
</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=1"><span><?php echo $lang['nc_admin_create_shop'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=3"><span><?php echo $lang['nc_close_store'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><?php echo $lang['nc_admin_store_store_name'];?></th>
          <td><input type="text" value="<?php echo $output['store_name'];?>" name="store_name" class="txt" ></td>
          <th><?php echo $lang['nc_store_store_audit'];?></th>
          <td>
			  <select name='audit'>
			    <option value=""><?php echo $lang['nc_please_choose'];?>...</option>
				<option value="1" <?php if($output['audit'] == 1){ ?>selected<?php } ?>><?php echo $lang['nc_store_store_audit_wait'];?></option>
				<option value="2" <?php if($output['audit'] == 2){ ?>selected<?php } ?>><?php echo $lang['nc_store_store_audit_yes'];?></option>
				<option value="3" <?php if($output['audit'] == 3){ ?>selected<?php } ?>><?php echo $lang['nc_store_store_audit_no'];?></option>
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
        <th colspan="12" class="nobg">
        	<div class="title">
	            <h5><?php echo $lang['nc_prompts'];?></h5>
	            <span class="arrow"></span>
            </div>
        </th>
      </tr>
      <tr>
        <td>
		  <ul>
            <li><?php echo $lang['nc_store_manage_help1'];?></li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="class_id" name="class_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200"><?php echo $lang['nc_admin_store_store_name'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_store_address'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_store_telephone'];?></th>
          <th class="w48"><?php echo $lang['nc_admin_store_click'];?></th>
          <th class="w60"><?php echo $lang['nc_admin_store_commend_count'];?></th>
          <th class="w84"><?php echo $lang['nc_admin_store_person_consume'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_store_state'];?></th>
		  <th class="w108"><?php echo $lang['nc_store_store_audit'];?></th>
		  <th class="w108">首页推荐</th>
		  <th class="w270 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo $val['address'];?></td>
		  <td><?php echo $val['telephone'];?></td>
		  <td><?php echo $val['store_click'];?></td>
		  <td><?php echo $val['comment_count'];?></td>
		  <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['person_consume'];?></span>元</td>
		  <td><?php if($val['store_state'] == 2){ echo $lang['nc_admin_store_start'];}?></td>
		  <td>
		  	<?php if($val['is_audit'] == 1){?>
		  	<?php echo $lang['nc_store_store_audit_wait'];?>
		  	<?php }elseif($val['is_audit'] == 2){?>
		  	<?php echo $lang['nc_store_store_audit_yes'];?>
		  	<?php }else{?>
		  	<?php echo $lang['nc_store_store_audit_no'];?>
		  	<?php }?>
		  </td>
		  <td><span id="re_stat_<?php echo $val['store_id'];?>"><?php echo $val['store_recommend']==0?'否':'是'; ?></span><a re_change="<?php echo $val['store_id'];?>" class="marginleft" href="javascript:ajax_set_recommend(<?php echo $val['store_recommend']==0?1:0; ?>,<?php echo $val['store_id'];?>);">[<?php echo $val['store_recommend']==0?'设为推荐':'取消推荐'; ?>]</a></td>
		  <td class='align-center'>
		  	<a target='_blank' href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $val['store_id'];?>"><?php echo $lang['nc_view'];?></a> 
		  	<?php if($val['store_state'] == 2){?>
		  	<a href="javascript:if(confirm('您确实要关闭该店铺吗？'))window.location.href='index.php?act=store&op=storestate&store_id=<?php echo $val['store_id'];?>';"><?php echo $lang['nc_admin_store_close'];?></a>
		  	<?php }?>
		  	<?php if($val['is_audit'] == 1){ ?>
		  	<a href="index.php?act=store&op=audit&store_id=<?php echo $val['store_id'];?>"><?php echo $lang['nc_store_store_audit'];?></a>
		  	<?php }else{ ?>
		  	<span style="color:#ccc"><?php echo $lang['nc_store_store_audit'];?></span>
		  	<?php } ?>
		  	<a href="index.php?act=store&op=change_pwd&store_id=<?php echo $val['store_id'];?>">修改密码</a>
			<?php if(!empty($val['qr_code']) && $val['is_qr_saft']==1){?>
			<a href="index.php?act=store&op=audit_qr&store_id=<?php echo $val['store_id'];?>">二维码审核</a>
			<?php }?>
		  </td>
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
          <!--  
          	<input type="checkbox" class="checkall" id="checkall_1">
          	<span class="all_checkbox">
          	<label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            </span>&nbsp;&nbsp; 
            <a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
          -->
          </td>
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div></td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
