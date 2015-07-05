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
            <th><?php echo $lang['nc_member_store_card_number'];?></th>
            <th>会员名</th>
            <th><?php echo $lang['nc_member_store_price'];?></th>
            <th><?php echo $lang['nc_member_card_consume_add_time'];?></th>
            <th><?php echo $lang['nc_member_person_number'];?></th>
          </tr>
		  <?php if(!empty($output['record'])){?>
		  <?php foreach($output['record'] as $key=>$val){?>
          <tr>
            <td><?php echo $val['card_number'];?></td>
            <td><?php echo $val['member_name'];?></td>
            <td><?php echo $val['price'];?></td>
            <td><?php echo date("Y-m-d H:i",$val['add_time']);?></td>
            <td><?php echo $val['person_number'];?></td>
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
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
