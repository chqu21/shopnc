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
        
        if(type == 'del'){
       		$('#list_form').attr('action','index.php?act=groupbuy&op=del');
        }else if(type == 'recommend'){
        	$('#list_form').attr('action','index.php?act=groupbuy&op=recommend&type=1');
        }else if(type == 'audit_yes'){
        	$('#list_form').attr('action','index.php?act=groupbuy&op=batch_audit&state=2');
        }else if(type == 'audit_no'){
        	$('#list_form').attr('action','index.php?act=groupbuy&op=batch_audit&state=3');
        }else{
        	$('#list_form').attr('action','index.php?act=groupbuy&op=recommend');
        }
        
        $('#group_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_groupbuy_manage'];?></h3>
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
		  <th><label for="groupbuy_state">团购名称:</label></th>
		  <td>
			<input type="text" name="group_name" value="<?php echo $output['group_name'];?>">
		  </td>
		  <th><label for="groupbuy_state"><?php echo $lang['nc_admin_groupbuy_state'];?>:</label></th>
		  <td>
			  <select name='groupbuy_state'>
			    <option value=""><?php echo $lang['nc_please_choose'];?>...</option>
				<option value="1" <?php if($output['groupbuy_state']==1){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_soon_start'];?></option>
				<option value="2" <?php if($output['groupbuy_state']==2){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_now'];?></option>
				<option value="3" <?php if($output['groupbuy_state']==3){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_already_end'];?></option>
			  </select>
		  </td>
		  <th><label><?php echo $lang['nc_admin_groupbuy_audit'];?>:</label></th>
		  <td>
		  	<select name="audit">
		  		<option value=""><?php echo $lang['nc_please_choose'];?>...</option>
		  		<option value="1" <?php if($output['is_audit']==1){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_wait_audit'];?></option>
		  		<option value="2" <?php if($output['is_audit']==2){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_audit_yes'];?></option>
		  		<option value="3" <?php if($output['is_audit']==3){ echo 'selected';}?>><?php echo $lang['nc_admin_groupbuy_audit_no'];?></option>
		  	</select>
		  </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
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
            <li><?php echo $lang['nc_admin_groupbuy_help'];?></li>
            <li><?php echo $lang['nc_admin_groupbuy_help1'];?></li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="group_id" name="group_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th class="w200"><?php echo $lang['nc_admin_groupbuy_name'];?></th>
		  <th class="w120"><?php echo $lang['nc_admin_groupbuy_time'];?></th>
		  <th class="w120"><?php echo $lang['nc_admin_groupbuy_store_name'];?></th>
		  <th class="w48">过期退款<th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_original_price'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_price'];?></th>
          <th class="w48"><?php echo $lang['nc_admin_groupbuy_buyer_count'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_buyer_limit'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_buyer_num'];?></th>
		  <th class="w48">分佣比例</th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_audit'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_state'];?></th>
		  <th class="w150 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td><input type="checkbox" value="<?php echo $val['group_id'];?>" class="checkitem"></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id']; ?>" target="_blank"><?php echo $val['group_name'];?></a></td>
		  <td><?php echo date("Y-m-d",$val['start_time']);?>&nbsp;~&nbsp;<?php echo date("Y-m-d",$val['end_time']);?></td>
		  <td><?php echo $val['store_name'];?></td>
		  <td><?php if($val['is_refund']==1){ echo '是';}else{ echo '否';}?></td>
		  <td></td>
		  <td><?php echo $val['original_price'];?></td>
		  <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['group_price'];?></span>元</td>
		  <td><?php echo $val['buyer_count'];?></td>
		  <td><?php echo $val['buyer_limit'];?></td>
		  <td><?php echo $val['buyer_num'];?></td>
		  <td><?php echo $val['settle'];?>%</td>
		  <td>
		  	<?php if($val['is_audit'] == 1){?>
		  	<?php echo $lang['nc_admin_groupbuy_wait_audit'];?>
		  	<?php }elseif($val['is_audit'] == 2){?>
		  	<?php echo $lang['nc_admin_groupbuy_audit_yes'];?>
		  	<?php }else{?>
		  	<?php echo $lang['nc_admin_groupbuy_audit_no'];?>
		  	<?php }?>
		  </td>
		  <td>
	  		<?php if($val['start_time']>time()){?>
			<?php echo $lang['nc_admin_groupbuy_soon_start'];?>
			<?php }elseif(($val['start_time']<=time()) && ($val['end_time']>time())){?>
			<?php echo $lang['nc_admin_groupbuy_now'];?>
			<?php }elseif($val['end_time']<time()){?>
			<?php echo $lang['nc_admin_groupbuy_already_end'];?>
			<?php }?>
		  </td>
		  <td class='align-center'>
		  	<a href="index.php?act=groupbuy&op=groupbuyvoucher&group_id=<?php echo $val['group_id'];?>"><?php echo $lang['nc_admin_groupbuy_view_voucher'];?></a>
		    <?php if($val['is_open'] == 1){?>
		  	&nbsp;|&nbsp;<a href="javascript:if(confirm('您确定停用该团购吗？'))window.location.href='index.php?act=groupbuy&op=state&is_open=2&group_id=<?php echo $val['group_id'];?>';"><?php echo $lang['nc_stop'];?></a>
		  	<?php }else{?>
		  	&nbsp;|&nbsp;<a href="javascript:if(confirm('您确定启用该团购吗？'))window.location.href='index.php?act=groupbuy&op=state&is_open=1&group_id=<?php echo $val['group_id'];?>';"><?php echo $lang['nc_use'];?></a>
		  	<?php }?>
		  	&nbsp;|&nbsp;
		  	<?php if($val['is_audit'] == 1){ ?>
		  	<a href="index.php?act=groupbuy&op=audit&group_id=<?php echo $val['group_id'];?>"><?php echo $lang['nc_admin_groupbuy_audit'];?></a>
		  	<?php }else{ ?>
		  	<span style="color:#ccc"><?php echo $lang['nc_admin_groupbuy_audit'];?></span>
		  	<?php } ?>
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
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15">
          	<span class="all_checkbox"><label for="checkall_1"><?php echo $lang['nc_select_all'];?></label></span>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('recommend');"><span><?php echo $lang['nc_recommend'];?></span></a>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('not_recommend');"><span><?php echo $lang['nc_not_recommend'];?></span></a>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('audit_yes');"><span>审核通过</span></a>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('audit_no');"><span>审核不通过</span></a>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
