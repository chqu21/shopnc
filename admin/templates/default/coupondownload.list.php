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
    if(confirm('<?php echo $lang['nc_admin_coupon_download_del'];?>')) {
        $('#list_form').attr('method','post');
        $('#list_form').attr('action','index.php?act=coupon&op=downloaddel');
   		    
        $('#coupon_id').val(id);
        $('#list_form').submit();
    }
}

</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_coupon_manage'];?></h3>
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
          <th><?php echo $lang['nc_admin_coupon_name'];?></th>
          <td><input type="text" value="<?php echo $output['coupon_name'];?>" name="coupon_name" class="txt" ></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
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
         	   <li><?php echo $lang['nc_admin_coupon_download_help1'];?></li>
          	</ul>
         </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="coupon_id" name="coupon_id" type="hidden"/>
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th><?php echo $lang['nc_admin_coupon_member_name'];?></th>
		  <th><?php echo $lang['nc_admin_coupon_name'];?></th>
		  <th><?php echo $lang['nc_admin_download_time'];?></th>
		  <th><?php echo $lang['nc_admin_download_type'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td>
	          <?php if(!empty($val['member_name'])){?>
	          <?php echo $val['member_name'];?>
	          <?php }else{?>
	          <?php echo $lang['nc_admin_coupon_viewer'];?>
	          <?php }?>
          </td>
		  <td><a href="<?php echo BASE_SITE_URL; ?>/index.php?act=coupon&op=detail&coupon_id=<?php echo $val['coupon_id']; ?>" target="_blank"><?php echo $val['coupon_name'];?></a></td>
		  <td><?php echo date("Y-m-d",$val['download_time']);?></td>
		  <td><?php if($val['download_type'] == 1){ echo $lang['nc_admin_download_type_print'];}else{ echo $lang['nc_admin_download_type_shortmessage'];}?></td>
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
