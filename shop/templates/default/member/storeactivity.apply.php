<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php $lang['nc_member_store_activity_manage'];?></h3>
      </div>
    </div>

    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_activity_apply_person'];?></th>
			<th class="w140" scope="col">活动项</th>
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_activity_apply_time'];?></th>
          </tr>
		  <?php if(!empty($output['member'])){?>
		  <?php foreach($output['member'] as $key=>$val){?>
          <tr>
            <td><?php echo $val['member_name'];?></td>
			<td><?php echo $val['activity_item'];?></td>
            <td><?php echo date("Y-m-d H:i",$val['apply_time']);?></td>
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
  </div>
</div>
