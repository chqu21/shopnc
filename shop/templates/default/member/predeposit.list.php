<div class="mainbox setup_box setup-com">
  <div class="hd hd-h">
    <h3><?php echo $lang['nc_member_predeposit_exchange'];?></h3>
    <div class="btn_box btn_st1"> <span class="f_btn">
      <button class="btn_txt J_submit" type="button" onclick="javascript:location.href='index.php?act=memberpredeposit&op=charge'">充值</button>
      </span> </div>
  </div>
  <div class="con">
    <div class="form_table">
      <table class="ui_table ui_table_inbox" width='100%'>
        <thead>
          <tr>
            <th><?php echo $lang['nc_member_predeposit_payment_name'];?></th>
            <th><?php echo $lang['nc_member_predeposit_charge_price'];?></th>
            <th><?php echo $lang['nc_member_predeposit_charge_time'];?></th>
            <th><?php echo $lang['nc_member_predeposit_state'];?></th>
            <th><?php echo $lang['nc_member_predeposit_charge_des'];?></th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($output['list'])){?>
          <?php foreach($output['list'] as $val){?>
          <tr>
            <td><?php echo $val['payment_name'];?></td>
            <td><span style="font-weight:bold"><?php echo $val['charge_price'];?></span> 元</td>
            <td><?php echo date("Y-m-d H:i:s",$val['charge_time']);?></td>
            <td>
            	<?php if($val['state'] == 1){?>
            	<?php echo $lang['nc_member_predeposit_state_not_payment'];?>
				<!--[<a href="index.php?act=memberpredeposit&op=payment&pre_id=<?php echo $val['pre_id'];?>"><?php echo $lang['nc_member_predeposit_payment'];?></a>]-->
            	<?php }else{?>
            	<?php echo $lang['nc_member_predeposit_state_payment'];?>
            	<?php }?>
            </td>
            <td><?php echo $val['charge_des'];?></td>
          </tr>
          <?php }?>
          <?php }else{?>
          <tr>
            <td colspan='20' height="100" style="text-align:center; vertical-align:central;">暂无相关记录</td>
          </tr>
          <?php }?>
        </tbody>
      </table>
      <div class="page_box"> <?php echo $output['show_page'];?></div>
    </div>
  </div>
</div>
