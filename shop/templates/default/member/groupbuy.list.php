<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_store_group_manage'];?></h3>
      </div>
    </div>
	<div class="con—box-search">
    <form method="post">
      <span class="tit-hd" id="">团购名称：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="groupbuy_name" value="<?php echo $output['groupbuy_name'];?>">
      <span class="tit-hd" id="">状态：</span>
      <select name="state">
      	<option value=""><?php echo $lang['nc_select'];?></option>
        <option value="1" <?php if($output['state'] == 1){ echo 'selected';}?>>待审核</option>
        <option value="2" <?php if($output['state'] == 2){ echo 'selected';}?>>审核未通过</option>
        <option value="3" <?php if($output['state'] == 3){ echo 'selected';}?>>还未开始</option>
        <option value="4" <?php if($output['state'] == 4){ echo 'selected';}?>>正在进行</option>
        <option value="5" <?php if($output['state'] == 5){ echo 'selected';}?>>已过期</option>
      </select>
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_group_name'];?></th>
            <th class="w65" scope="col"><?php echo $lang['nc_member_store_group_time'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_store_group_original_price'];?></th>
            <th class="w70" scope="col"><?php echo $lang['nc_member_store_group_group_price'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_member_store_group_buyer_count'];?></th>
            <th class="w80" scope="col"><?php echo $lang['nc_member_store_group_buyer_num'];?></th>
            <th class="w70" scope="col">分佣比例(%)</th>
			<th scope="col"><?php echo $lang['nc_member_store_group_state'];?></th>
			<th scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center"></td>
            <td><a href="index.php?act=groupbuy&op=detail&group_id=<?php echo $val['group_id'];?>" target="_blank" style="color:#3399CC"><?php echo $val['group_name'];?></a></td>
            <td><?php echo date("Y-m-d",$val['start_time']);?>~<?php echo date("Y-m-d",$val['end_time']);?></td>
            <td><?php echo $val['original_price'];?>元</td>
            <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['group_price'];?></span>元</td>
            <td><?php echo $val['buyer_count'];?></td>
            <td><?php echo $val['buyer_num'];?></td>
            <td><?php echo $val['settle'];?></td>
			<td>
				<?php if($val['is_audit'] == 1){?>
					<!-- 待审核 -->
					<?php echo $lang['nc_member_store_groupbuy_wait_audit'];?>
				<?php }elseif($val['is_audit'] == 2){?>
					<!-- 审核通过 -->
					<?php if($val['start_time']>time()){?>
					<?php echo $lang['nc_member_store_soon_start'];?>
					<?php }elseif(($val['start_time']<=time()) && ($val['end_time']>time())){?>
					<?php echo $lang['nc_member_store_groupbuy_now'];?>
					<?php }elseif($val['end_time']<time()){?>
					<?php echo $lang['nc_member_store_groupbuy_already_end'];?>
					<?php }?>
				<?php }else{?>
					<!-- 审核不通过 -->
					<?php echo $lang['nc_member_store_groupbuy_no_audit'];?>
				<?php }?>
			</td>
			<td>
			<?php if($val['is_audit']==1 || $val['is_audit']==3){ ?>
			<a href="index.php?act=storegroupbuy&op=edit&group_id=<?php echo $val['group_id']?>"><?php echo $lang['nc_edit'];?></a>
			&nbsp;|&nbsp;<a href="index.php?act=storegroupbuy&op=delete&group_id=<?php echo $val['group_id']?>"><?php echo $lang['nc_delete'];?></a>
			<?php } ?>
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
	  <input type="button" style="padding-left:25px; margin-left:10px; margin-top:5px;" class="coupon-add" onclick="javascript:location.href='index.php?act=storegroupbuy&op=add'" value="<?php echo $lang['nc_member_store_add_groupbuy'];?>">
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
