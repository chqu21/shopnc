<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
function ajax_settle(){
	$.getJSON('index.php?act=settle&op=ajax_settle', function(result){
        if(result.done){
            alert('结算操作已完成');
            window.location.href='index.php?act=settle&op=settle_manage';
        }else{
        	alert(result.msg);
        }
    });
}
</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>结算管理</h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>商铺名称</th>
          <td><input type="text" value="<?php echo $output['store_name'];?>" name="store_name" class="txt" ></td>
          <th>结算状态</th>
          <td>
			  <select name='state'>
			    <option value="">全部结算单</option>
				<option value="1" <?php if($output['state'] == 1){ ?>selected<?php } ?>>已出账</option>
				<option value="2" <?php if($output['state'] == 2){ ?>selected<?php } ?>>已审核</option>
				<option value="3" <?php if($output['state'] == 3){ ?>selected<?php } ?>>已确认</option>
				<option value="4" <?php if($output['state'] == 4){ ?>selected<?php } ?>>已支付</option>
				<option value="5" <?php if($output['state'] == 5){ ?>selected<?php } ?>>已完成</option>
			  </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td><td></td><td></td>
          <td><a href="javascript:ajax_settle();" class="btn-add tooltip">开始结算</a></td>
        </tr>
      </tbody>
    </table>
  </form>
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
            <li>点击“开始结算”按钮将对截至昨日的未结算订单进行批量结算汇总</li>
            <li>已消费的团购订单才会被结算</li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="class_id" name="class_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200">结算单号</th>
          <th class="w200">商铺名称</th>
		  <th class="w200">起始日期</th>
		  <th class="w200">结束日期</th>
          <th class="w200">订单金额</th>
          <th class="w200">结算金额</th>
		  <th class="w200">结算日期</th>
		  <th class="w60">结算状态</th>
		  <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['settle_list']) && is_array($output['settle_list'])){ ?>
        <?php foreach($output['settle_list'] as $val){ ?>
        <tr class="hover edit">
          <td><?php echo $val['settle_sn'];?></td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
		  <td><?php echo date('Y-m-d',$val['date_start']);?></td>
		  <td><?php echo date('Y-m-d',$val['date_end']);?></td>
		  <td><?php echo $val['amount'];?>元</td>
		  <td><?php echo $val['final_pay'];?>元</td>
		  <td><?php echo date('Y-m-d H:i:s',$val['settle_time']);?></td>
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
		  <td class='align-center'>
		  	<?php if($val['state'] == 1 || $val['state'] == 3){ ?>
		  	<a href="javascript:if(confirm('您确定进行此操作吗？'))window.location.href='index.php?act=settle&op=settle_state_change&settle_id=<?php echo $val['settle_id'];?>&new_state=<?php if($val['state'] == 1){ ?>2<?php }else{ ?>4<?php } ?>';"><?php if($val['state'] == 1){ ?>审核<?php }else{ ?>支付<?php } ?></a>
		  	<?php }else{
		  	switch ($val['state']){
		  		case 2:
		  			echo '已审核，等待商家确认';
		  			break;
		  		case 4:
		  			echo '已支付，等待商家确认';
		  			break;
		  	}
		  	} ?>&nbsp;&nbsp;<a href="index.php?act=settle&op=settle_detail&settle_id=<?php echo $val['settle_id']; ?>">明细</a>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['settle_list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
