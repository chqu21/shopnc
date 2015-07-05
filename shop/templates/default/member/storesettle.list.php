<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3>结算管理</h3>
      </div>
    </div>
    <div class="con—box-search">
    <form method="post">
      <span class="tit-hd" id="">状态：</span>
      <select name='state'>
	    <option value="">全部结算单</option>
		<option value="1" <?php if($output['state'] == 1){ ?>selected<?php } ?>>已出账</option>
		<option value="2" <?php if($output['state'] == 2){ ?>selected<?php } ?>>已审核</option>
		<option value="3" <?php if($output['state'] == 3){ ?>selected<?php } ?>>已确认</option>
		<option value="4" <?php if($output['state'] == 4){ ?>selected<?php } ?>>已支付</option>
		<option value="5" <?php if($output['state'] == 5){ ?>selected<?php } ?>>已完成</option>
	  </select>
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w140" scope="col">结算单号</th>
            <th class="w80" scope="col">起始日期</th>
            <th class="w80" scope="col">结束日期</th>
            <th class="w80" scope="col">订单金额</th>
            <th class="w80" scope="col">结算金额</th>
            <th class="w140" scope="col">结算日期</th>
            <th class="w65" scope="col">结算状态</th>
            <th class="w50" scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
          <?php if(!empty($output['settle_list'])){?>
          <?php foreach($output['settle_list'] as $key=>$val){?>
          <tr>
            <td><?php echo $val['settle_sn'];?></td>
            <td><?php echo date("Y-m-d",$val['date_start']);?></td>
            <td><?php echo date("Y-m-d",$val['date_end']);?></td>
            <td><?php echo $val['amount']; ?>元</td>
            <td><?php echo $val['final_pay']; ?>元</td>
            <td><?php echo date("Y-m-d H:i:s",$val['settle_time']);?></td>
            <td>
			  <?php 
			  switch ($val['state']){
			  	case 1:
			  		echo '已出账';
			  		break;
			  	case 2:
			  		echo '已审核';
			  		break;
			  	case 3:
			  		echo '已确认';
			  		break;
			  	case 4:
			  		echo '已支付';
			  		break;
			  	case 5:
			  		echo '已完成';
			  		break;
			  }
			  ?>
			</td>
            <td>
            <?php if($val['state'] == 2 || $val['state'] == 4){ ?>
		  	<a style="color:#3399CC" href="javascript:if(confirm('您确定进行此操作吗？'))window.location.href='index.php?act=storesettle&op=settle_state_change&settle_id=<?php echo $val['settle_id'];?>&new_state=<?php if($val['state'] == 2){ ?>3<?php }else{ ?>5<?php } ?>';"><?php if($val['state'] == 1){ ?>确认<?php }else{ ?>收款<?php } ?></a>
		  	<?php }else{
		  	switch ($val['state']){
		  		case 1:
		  			echo '已出账，等待平台审核';
		  			break;
		  		case 3:
		  			echo '已确认，等待平台付款';
		  			break;
		  	}
		  	} ?>
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
