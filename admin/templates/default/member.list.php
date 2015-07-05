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
        $('#list_form').attr('action','index.php?act=member&op=drop');
        $('#member_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_member_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=member&op=member_degree" class=""><span>会员等级</span></a></li>
        <li><a href="index.php?act=member&op=score_setting" class=""><span>分数设置</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><?php echo $lang['nc_admin_member_name'];?></th>
          <td><input type="text" value="<?php echo $output['member_name']; ?>" name="member_name" class="txt" ></td>
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
            <li><?php echo $lang['nc_admin_member_help'];?></li>
            <li><?php echo $lang['nc_admin_member_help1'];?></li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="member_id" name="member_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th class="w200"><?php echo $lang['nc_admin_member_name'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_email'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_gender'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_nickname'];?></th>
          <th class="w48"><?php echo $lang['nc_admin_mobile'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_comment_num'];?></th>
		  <th class="w48">登录次数</th>
		  <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td><input type="checkbox" value="<?php echo $val['member_id'];?>" class="checkitem"></td>
		  <td><?php echo $val['member_name'];?></td>
		  <td><?php echo $val['email'];?></td>
		  <td><?php if($val['gender'] == 1){ echo $lang['nc_admin_man']; }else{ echo $lang['nc_admin_women']; }?></td>
		  <td><?php echo $val['nickname'];?></td>
		  <td><?php echo $val['mobile'];?></td>
		  <td><?php echo $val['comment_num'];?></td>
		  <td><?php echo $val['login_num'];?></td>
		  <td class='align-center'>
		  <a href="index.php?act=member&op=resetpasswd&member_id=<?php echo $val['member_id'];?>">重置密码</a>&nbsp;|&nbsp;
		  <a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=member&op=drop&member_id=<?php echo $val['member_id'];?>';"><?php echo $lang['nc_del'];?></a></td>
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
            </span>&nbsp;&nbsp; <a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
