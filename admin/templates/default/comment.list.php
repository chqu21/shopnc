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
    if(confirm('<?php echo $lang['nc_admin_comment_operation'];?>')) {
        $('#list_form').attr('method','post');
        if(type == 'del'){
       		$('#list_form').attr('action','index.php?act=comment&op=del');
        }else if(type == 'recommend'){
        	$('#list_form').attr('action','index.php?act=comment&op=recommend&type=1');
        }else{
        	$('#list_form').attr('action','index.php?act=comment&op=recommend');
        }
       
        $('#comment_id').val(id);
        $('#list_form').submit();
    }
}

</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_comment_manage'];?></h3>
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
				<option value="store_name" <?php if($output['s_type']=='store_name'){ ?>selected<?php } ?>>商铺名称</option>
				<option value="comment" <?php if($output['s_type']=='comment'){ ?>selected<?php } ?>>评论内容</option>
				<option value="parking" <?php if($output['s_type']=='parking'){ ?>selected<?php } ?>>停车情况</option>
			  </select>
          </td>
          <td><input type="text" value="<?php echo $output['s_content'];?>" name="s_content" class="txt" ></td>
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
	            <li><?php echo $lang['nc_admin_comment_help1'];?></li>
	            <li><?php echo $lang['nc_admin_comment_help2'];?></li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="comment_id" name="comment_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th><?php echo $lang['nc_admin_comment_store_name'];?></th>
		  <th><?php echo $lang['nc_admin_comment_member_name'];?></th>
		  <th><?php echo $lang['nc_admin_comment_person_cost'];?></th>
		  <th><?php echo $lang['nc_admin_comment_parking'];?></th>
		  <th><?php echo $lang['nc_admin_comment_recommend'];?></th>
		  <th style="width:40%"><?php echo $lang['nc_admin_comment_comment'];?></th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><input type="checkbox" value="<?php echo $val['comment_id'];?>" class="checkitem"></td>
          <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo $val['member_name'];?></td>
		  <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['person_cost'];?></span>元</td>
		  <td><?php echo $val['parking'];?></td>
		  <td><?php if($val['is_recommend'] == 1){ echo $lang['nc_yes'];}else{ echo $lang['nc_no'];}?></td>
		  <td><?php echo $val['comment'];?></td>
		  <td class='align-center'><a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=comment&op=del&comment_id=<?php echo $val['comment_id'];?>';"><?php echo $lang['nc_del'];?></a></td>
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
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            </span>&nbsp;&nbsp; <a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('del');"><span><?php echo $lang['nc_del'];?></span></a>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('recommend');"><span><?php echo $lang['nc_recommend'];?></span></a>
           	&nbsp;<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch('not_recommend');"><span><?php echo $lang['nc_not_recommend'];?></span></a>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
