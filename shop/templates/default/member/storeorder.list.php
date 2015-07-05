<script type="text/javascript">
	function verify(){
		location.href='index.php?act=storeorder&op=verify'
	}
</script>
<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3>订单管理</h3>
      </div>
    </div>
    <div class="con—box-search">
    <form method="post">
      <input class="tgyz" type="button" value="<?php echo $lang['nc_member_store_password_verify'];?>" onclick="javascript:verify();">
      <span class="tit-hd" id="">订单编号：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="order_sn" value="<?php echo $output['order_sn'];?>">
      <span class="tit-hd" id="">状态：</span>
      <select name="state">
      	<option value=""><?php echo $lang['nc_select'];?></option>
        <option value="1" <?php if($output['state'] == 1){ echo 'selected';}?>><?php echo $lang['nc_member_store_no_payment'];?></option>
        <option value="2" <?php if($output['state'] == 2){ echo 'selected';}?>><?php echo $lang['nc_member_store_payment'];?></option>
        <option value="3" <?php if($output['state'] == 3){ echo 'selected';}?>><?php echo $lang['nc_member_store_consume'];?></option>
        <option value="4" <?php if($output['state'] == 4){ echo 'selected';}?>>已退款</option>
      </select>
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_order_sn'];?></th>
            <th class="w65" scope="col"><?php echo $lang['nc_member_store_member_name'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_store_add_time'];?></th>
            <th scope="col"><?php echo $lang['nc_member_store_item_name'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_member_store_item_number'];?></th>
            <th class="w80" scope="col"><?php echo $lang['nc_member_store_item_price'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_member_store_item_state'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
          <?php if(!empty($output['list'])){?>
          <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center"></td>
            <td><?php echo $val['order_sn'];?></td>
            <td><?php echo $val['member_name'];?></td>
            <td><?php echo date("Y-m-d H:i",$val['add_time']);?></td>
            <td><a href="index.php?act=groupbuy&op=detail&group_id=<?php echo $val['item_id'];?>" target="_blank" style="color:#3399CC"><?php echo $val['item_name'];?></a></td>
            <td><?php echo $val['number'];?></td>
            <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['price'];?></span>元</td>
            <td><?php if($val['state'] == 1){?>
              <?php echo $lang['nc_member_store_no_payment'];?>
              <?php }elseif($val['state'] == 2){?>
              <?php echo $lang['nc_member_store_payment'];?>
              <?php }elseif($val['state'] == 3){?>
              <?php echo $lang['nc_member_store_consume'];?>
              <?php }else{?>
			  <?php echo '已退款';?>
			  <?php }?>
			  </td>
            <td>
			<a href="index.php?act=storeorder&op=order_detail&order_id=<?php echo $val['order_id']?>"><?php echo $lang['nc_detail'];?></a>
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
      <!--  
      <input id="CheckAllBox" class="checkbox" type="checkbox" onclick="CheckAll()">全选
      <input type="submit" style="padding-left:22px; margin-left:10px;" class="input_delete" onclick="return CheckDel();">
      -->
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
