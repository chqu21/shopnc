<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_store_member_card'];?></h3>
      </div>
    </div>

    <div class="table—box">
	  
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_member_name'];?></th>
            <th><?php echo $lang['nc_member_store_is_use'];?></th>
            <th><?php echo $lang['nc_member_store_card_number'];?></th>
            <th>消费总额</th>
            <th><?php echo $lang['nc_consume_record'];?></th>
            <th>操作</th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td><?php echo $val['member_name'];?></td>
            <td><?php if($val['is_use'] == 1){ echo $lang['nc_no'];}else{ echo '<span style="color:#E64D5E;font-weight:bold;font-size:14px">'.$lang['nc_yes'].'</span>'; }?></td>
            <td><?php echo $val['card_number'];?></td>
            <td><?php echo $val['total_price'];?></td>
            <td><a href="<?php echo BASE_SITE_URL;?>/index.php?act=storesetting&op=viewconsume&card_id=<?php echo $val['id'];?>"><?php echo $lang['nc_view'];?></a></td>
            <td>
            	<?php if($val['is_use'] == 2){?>
            	<a href="javascript:if(confirm('您确定要关闭该会员卡吗？'))window.location.href='<?php echo BASE_SITE_URL;?>/index.php?act=storesetting&op=card_state&member_id=<?php echo $val['member_id'];?>&is_use=1';">关闭</a>
            	<?php }else{?>
            	<a href="javascript:if(confirm('您确定要激活该会员卡吗？'))window.location.href='<?php echo BASE_SITE_URL;?>/index.php?act=storesetting&op=card_state&member_id=<?php echo $val['member_id'];?>&is_use=2';">激活</a>
            	<?php }?>
            </td>
          </tr>
		  <?php }?>
		  <?php }else{?>
		  <tr>
			<td colspan="20" class="norecord"><i>&nbsp;</i><?php echo $lang['nc_record'];?></td>
		  </tr>
		  <?php }?>
        </tbody>
      </table>
    </div>
    <div class="cb_bg">
      <div style="float:left"><a href="index.php?act=storesetting&op=addconsume"><?php echo $lang['nc_member_input_consume_record'];?></a></div>
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
