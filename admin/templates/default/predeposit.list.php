<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>预存款</h3>
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
          <th>会员名称</th>
          <td><input type="text" value="<?php echo $output['member_name'];?>" name="member_name" class="txt" ></td>
		  <th><label>支付状态:</label></th>
		  <td>
		  	<select name="state">
		  		<option value=""><?php echo $lang['nc_please_choose'];?>...</option>
		  		<option value="1" <?php if($output['state']==1){ echo 'selected';}?>>未支付</option>
		  		<option value="2" <?php if($output['state']==2){ echo 'selected';}?>>已支付</option>
		  	</select>
		  </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <form id="list_form" method='post'>
    <input id="group_id" name="group_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w120">充值单号</th>
          <th class="w120">会员名称</th>
          <th class="w120">支付方式</th>
          <th class="w120">充值金额(元)</th>
          <th class="w120">充值描述</th>
          <th class="w120">创建时间</th>
          <th class="w60">支付状态</th>
		  <th class="w60 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
        	<td><?php echo $val['pdr_sn']; ?></td>
        	<td><?php echo $val['member_name']; ?></td>
        	<td><?php echo $val['payment_name']; ?></td>
        	<td><?php echo $val['charge_price']; ?></td>
        	<td><?php echo $val['charge_des']; ?></td>
        	<td><?php echo date('Y-m-d H:i:s',$val['charge_time']); ?></td>
        	<td><?php echo $val['state']==1?'未支付':'已支付'; ?></td>
        	<td class='align-center'><?php if($val['state'] == 1){ ?><a href="javascript:if(confirm('您确定要删除吗？'))window.location.href='index.php?act=predeposit&op=del&pre_id=<?php echo $val['pre_id']; ?>';">删除</a><?php } ?></td>
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
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>