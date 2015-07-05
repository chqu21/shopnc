<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_groupbuy_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=groupbuy"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_admin_groupbuy_voucher'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
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
            <li><?php echo $lang['nc_admin_groupbuy_voucher_tips'];?></li>
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
          <th class="w200"><?php echo $lang['nc_admin_groupbuy_voucher_order_sn'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_voucher_store_name'];?></th>
		  <th class="w120"><?php echo $lang['nc_admin_groupbuy_voucher_item_name'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_voucher_member_name'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_groupbuy_voucher_pwd'];?></th>
          <th class="w48"><?php echo $lang['nc_admin_groupbuy_voucher_state'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_groupbuy_voucher_use_time'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><?php echo $val['order_sn'];?></td>
		  <td><?php echo $val['store_name'];?></td>
		  <td><?php echo $val['item_name'];?></td>
		  <td><?php echo $val['member_name'];?></td>
		  <td><?php echo $val['order_pwd'];?></td>
		  <td>
		  	<?php if($val['state'] == 1){?>
			  	<?php if($output['endtime'] < time()){?>
			  	<?php echo $lang['nc_admin_groupbuy_voucher_is_over_due'];?>
			  	<?php }else{?>
			  	<?php echo $lang['nc_admin_groupbuy_voucher_is_not_use'];?>
			  	<?php }?>
		  	<?php }elseif($val['state'] == 2){?>
		  		<?php echo $lang['nc_admin_groupbuy_voucher_is_use'];?>
		  	<?php }?>
		  </td>
		  <td><?php if(!empty($val['use_time'])){ echo date("Y-m-d H:i",$val['use_time']); } ?></td>
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
          <td></td>
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
