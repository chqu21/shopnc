<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>积分商城</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=gift&op=gift_manage" class=""><span>礼品管理</span></a></li>
        <li><a href="index.php?act=gift&op=gift_add" class=""><span>新增礼品</span></a></li>
        <li><a href="javascript:void(0);" class="current"><span>订单管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>会员名称</th>
          <td><input type="text" value="<?php echo $output['member_name'];?>" name="member_name" class="txt" ></td>
          <td>
			  <select name='go_state'>
				<option value="" <?php if($output['go_state']==''){ ?>selected<?php } ?>>全部订单</option>
				<option value="1" <?php if($output['go_state']==1){ ?>selected<?php } ?>>已下单</option>
				<option value="2" <?php if($output['go_state']==2){ ?>selected<?php } ?>>已发货</option>
				<option value="3" <?php if($output['go_state']==3){ ?>selected<?php } ?>>已收货</option>
			  </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <!-- 操作说明 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        	<ul>
            	<li>在这里可以看到会员兑换礼品的详细日志记录信息</li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="goods_id" name="goods_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200">会员名</th>
          <th>礼品名称</th>
          <th class="w132">礼品积分</th>
		  <th class="w132">兑换数量</th>
		  <th class="w132">总积分</th>
		  <th class="w132">下单时间</th>
		  <th class="w132">最后状态变更</th>
		  <th class="w84">订单状态</th>
		  <th class="w120 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['gift_order']) && is_array($output['gift_order'])){ ?>
        <?php foreach($output['gift_order'] as $val){ ?>
        <tr class="hover edit">
          <td><?php echo $val['member_name'];?></td>
		  <td><?php echo $val['sg_name'];?></td>
		  <td><?php echo $val['go_unit_point'];?></td>
		  <td><?php echo $val['go_num'];?></td>
		  <td><?php echo $val['go_total_point'];?></td>
		  <td><?php echo date("Y-m-d H:i:s",$val['go_add_time']);?></td>
		  <td><?php echo date("Y-m-d H:i:s",$val['go_change_time']);?></td>
		  <td><?php echo $val['go_state']==1?'已下单':($val['go_state']==2?'已发货':'已收货'); ?></td>
		  <td class='align-center'><a href="index.php?act=gift&op=order_detail&go_id=<?php echo $val['go_id']; ?>" >查看订单</a>
		  <?php if($val['go_state'] == 1){ ?>
		  &nbsp;|&nbsp;<a href="javascript:if(confirm('确认发货吗？'))window.location='index.php?act=gift&op=order_ship&go_id=<?php echo $val['go_id']; ?>';" >确认发货</a>
		  <?php } ?>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>