<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_admin_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=admin&op=admin_add" ><span><?php echo $lang['nc_add'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id='form_admin' action='index.php?act=admin&op=admin_del'>
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th><input type="checkbox" class="checkall" id="checkallBottom" name="chkVal"></th>
          <th><?php echo $lang['nc_admin_admin_name'];?></th>
          <th class="align-center"><?php echo $lang['nc_admin_login_time'];?></th>
          <th class="align-center"><?php echo $lang['nc_admin_login_num'];?></th>
          <th class="align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $k => $v){ ?>
        <tr class="hover">
          <td class="w24"><?php if ($v['admin_is_super'] != 1){?>
            <input type="checkbox" name="del_id[]" value="<?php echo $v['admin_id']; ?>" class="checkitem" onclick="javascript:chkRow(this);">
            <?php }else { ?>
            <input name="del_id[]" type="checkbox" value="<?php echo $v['admin_id']; ?>" disabled="disabled">
            <?php }?></td>
          <td><?php echo $v['admin_name'];?></td>
          <td class="align-center"><?php echo $v['admin_login_time'] ? date('Y-m-d H:i:s',$v['admin_login_time']) : $lang['admin_index_login_null']; ?></td>
          <td class="align-center"><?php echo $v['admin_login_num']; ?></td>
          <td class="w150 align-center">
			<a href="index.php?act=admin&op=admin_edit&admin_id=<?php echo $v['admin_id'];?>"><?php echo $lang['nc_edit']?></a>&nbsp;|&nbsp;<a href="javascript:if(confirm('<?php echo $lang['nc_admin_confirm_delete'];?>'))window.location = 'index.php?act=admin&op=admin_del&admin_id=<?php echo $v['admin_id'];?>';"><?php echo $lang['nc_del'];?></a>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><span class="no_icon"><?php echo $lang['nc_no_record'];?></span></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <tr class="tfoot">
          <td><!--<input type="checkbox" class="checkall" id="checkallBottom" name="chkVal">--></td>
          <td colspan="16">
			<!--
			<label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#form_admin').submit();}"><span><?php echo $lang['nc_del'];?></span></a>
			-->
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
