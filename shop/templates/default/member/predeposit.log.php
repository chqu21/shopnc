<div class="mainbox setup_box setup-com">
  <div class="hd hd-h">
    <h3>预存款明细</h3>
    <div class="btn_box btn_st1"></div>
  </div>
  <div class="con">
    <div class="form_table">
      <table class="ui_table ui_table_inbox" width='100%'>
        <thead>
          <tr>
            <th>类型</th>
            <th>描述</th>
            <th>时间</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($output['list'])){?>
          <?php foreach($output['list'] as $val){?>
          <tr>
			<td><?php if($val['type']==1){ echo '添加';}else{ echo '减少';}?></td>
			<td><?php echo $val['content'];?></td>
			<td><?php echo date("Y-m-d H:i",$val['add_time']);?></td>
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
