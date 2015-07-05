<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
function submit_delete_batch(){
    /* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if(items != '') {
        items = items.substr(0, (items.length - 1));
        submit_delete(items);
    } else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}

function submit_delete(id){
    if(confirm('确定进行批量删除吗？')) {
        $('#list_form').attr('method','post');
       	$('#list_form').attr('action','index.php?act=gift&op=gift_del&type=batch');       
        $('#sg_id').val(id);
        $('#list_form').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>积分商城</h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span>礼品管理</span></a></li>
        <li><a href="index.php?act=gift&op=gift_add" class=""><span>新增礼品</span></a></li>
        <li><a href="index.php?act=gift&op=gift_log" class=""><span>订单管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>礼品名称</th>
          <td><input type="text" value="<?php echo $output['sg_name'];?>" name="sg_name" class="txt" ></td>
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
            	<li>可以在这里管理已添加的积分商城礼品信息，可对礼品进行删除操作</li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="sg_id" name="sg_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th class="w300 align-center">礼品名称</th>
          <th>礼品编号</th>
		  <th>积分数</th>
		  <th>库存数量</th>
		  <th>上架状态</th>
		  <th>推荐状态</th>
		  <th>添加时间</th>
		  <th>最后修改时间</th>
          <th class="w84 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['gift_list']) && is_array($output['gift_list'])){ ?>
        <?php foreach($output['gift_list'] as $val){ ?>
        <tr class="hover edit">
          <td><input type="checkbox" value="<?php echo $val['sg_id'];?>" class="checkitem"></td>
          <td><a href="<?php echo BASE_SITE_URL.'/index.php?act=gift&op=detail&sg_id='.$val['sg_id']; ?>" target="_blank"><?php echo $val['sg_name'];?></a></td>
		  <td><?php echo $val['sg_code'];?></td>
		  <td><?php echo $val['sg_point'];?></td>
		  <td><?php echo $val['sg_num'];?></td>
		  <td><?php echo $val['sg_sale']==1?'上架':'下架';?></td>
		  <td><?php echo $val['sg_recommend']==1?'是':'否';?></td>
		  <td><?php echo date("Y-m-d H:i:s",$val['sg_add_time']);?></td>
		  <td><?php echo date("Y-m-d H:i:s",$val['sg_last_change_time']);?></td>
		  <td class='align-center'>
		  	<a href="index.php?act=gift&op=gift_edit&sg_id=<?php echo $val['sg_id'];?>">编辑</a>
		  	&nbsp;|&nbsp;
		  	<a href="javascript:if(confirm('确认要删除这个礼品吗？'))window.location = 'index.php?act=gift&op=gift_del&sg_id=<?php echo $val['sg_id'];?>';"><?php echo $lang['nc_del'];?></a>
		  </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['gift_list']) && is_array($output['gift_list'])){?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15">
          	<span class="all_checkbox">
            	<label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            	<a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            </span>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>