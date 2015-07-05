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
    }  
    else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}
function submit_delete(id){
    if(confirm('<?php echo $lang['nc_ensure_del'];?>')) {
        $('#list_form').attr('method','post');
        $('#list_form').attr('action','index.php?act=microshop&op=goods_class_drop');
        $('#class_id').val(id);
        $('#list_form').submit();
    }
}
</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storelist"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="index.php?act=store&op=storelist&state=1"><span><?php echo $lang['nc_admin_create_shop'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_close_store'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
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
            <li><?php //echo $lang['microshop_goods_class_tip1'];?></li>
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
          <th class="w200"><?php echo $lang['nc_admin_store_store_name'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_store_address'];?></th>
		  <th class="w200"><?php echo $lang['nc_admin_store_telephone'];?></th>
          <th class="w48"><?php echo $lang['nc_admin_store_click'];?></th>
          <th class="w60"><?php echo $lang['nc_admin_store_commend_count'];?></th>
          <th class="w200"><?php echo $lang['nc_admin_store_person_consume'];?></th>
		  <th class="w48"><?php echo $lang['nc_admin_store_state'];?></th>
		  <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td><?php echo $val['store_name'];?></td>
		  <td><?php echo $val['address'];?></td>
		  <td><?php echo $val['telephone'];?></td>
		  <td><?php echo $val['store_click'];?></td>
		  <td><?php echo $val['comment_count'];?></td>
		  <td><?php echo $val['person_consume'];?></td>
		  <td><?php if($val['store_state'] == 3){ echo '关闭'; }?></td>
		  <td class='align-center'><a href="javascript:if(confirm('您确定要开启该店铺吗？'))window.location.href='index.php?act=store&op=storestate&store_id=<?php echo $val['store_id'];?>&state=2';"><?php echo $lang['nc_admin_store_start'];?></a></td>
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
          <td></td>
          <td id="batchAction" colspan="15">
            <div class="pagination"><?php echo $output['show_page'];?></div>
          </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
