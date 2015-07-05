<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_payment_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
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
          <th><?php echo $lang['nc_admin_payment_name'];?></th>
          <th class="align-center"><?php echo $lang['nc_admin_payment_use'];?></th>
          <th class="align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $k => $v){ ?>
        <tr class="hover">
          <td><?php echo $v['payment_name'];?></td>
          <td class="align-center"><?php if($v['payment_state'] == 1){ echo $lang['nc_use']; }else{ echo $lang['nc_stop'];}?></td>
          <td class="w150 align-center">
			<a href="index.php?act=payment&op=edit&payment_id=<?php echo $v['payment_id'];?>"><?php echo $lang['nc_edit']?></a>
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
          <td></td>
          <td colspan="16"></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
