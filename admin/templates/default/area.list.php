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
        $('#list_form').attr('action','index.php?act=area&op=area_drop');
        $('#area_id').val(id);
        $('#list_form').submit();
    }
}

</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="index.php?act=area&op=area_add"><span><?php echo $lang['nc_add'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="area_name"><?php echo $lang['nc_admin_area_name'];?></label></th>
          <td><input type="text" value="<?php echo $output['area_name'];?>" name="area_name" id="area_name" class="txt" value="<?php if(isset($output['area_name'])){ echo $output['area_name'];}?>"></td>
		  <th><label for="first_letter"><?php echo $lang['nc_admin_first_letter'];?></label></th>
		  <td>
			  <select name='first_letter'>
			    <option value=""><?php echo $lang['nc_please_choose'];?>...</option>
				<?php foreach($output['letter'] as $l){?>
				<option value='<?php echo $l;?>' <?php if($l==$output['first_letter']){ echo 'selected';}?>><?php echo $l;?></option>
				<?php }?>
			  </select>
		  </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
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
            <span class="arrow"></span></div>
		</th>
      </tr>
      <tr>
        <td>
		  <ul>
            <li><?php echo $lang['nc_admin_area_help'];?></li>
            <li><?php echo $lang['nc_admin_area_help1'];?></li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="area_id" name="area_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th><?php echo $lang['nc_admin_area_name'];?></th>
		  <th><?php echo $lang['nc_admin_first_letter'];?></th>
		  <th><?php echo $lang['nc_admin_area_number'];?></th>
		  <th><?php echo $lang['nc_admin_post'];?></th>
		  <th><?php echo $lang['nc_admin_hot_city'];?></th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
		<?php if(empty($val['parent_area_id'])) { ?>
        <tr class="hover edit">
          <td><input type="checkbox" value="<?php echo $val['area_id'];?>" class="checkitem">
          <?php if($val['have_child'] == 1){ ?>
          <img fieldid="<?php echo $val['area_id'];?>" status="open" nc_type="flex" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-expandable.gif" deep="1">
          <?php }else{ ?>
          <img fieldid="<?php echo $val['area_id'];?>" status="close" nc_type="flex" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-item.gif" deep="1">
          <?php } ?>
          </td>
          <td><?php echo $val['area_name']?>&nbsp;<a class="btn-add-nofloat marginleft" href="index.php?act=area&op=area_add&area_id=<?php echo $val['area_id'];?>"><span><?php echo $lang['nc_store_add_new_class'];?></span></a></td>
		  <td><?php echo $val['first_letter'];?></td>
		  <td><?php echo $val['area_number'];?></td>
		  <td><?php echo $val['post'];?></td>
		  <td>
		  <?php if($val['hot_city'] == '1'){?>
		  <?php echo $lang['nc_yes'];?>
		  <?php }else{?>
		  <?php echo $lang['nc_no'];?>
		  <?php }?>
		  </td>
		  <td class='align-center'>
		  	<a href="index.php?act=area&op=area_edit&area_id=<?php echo $val['area_id'];?>"><?php echo $lang['nc_edit'];?></a> | 
            <a href="javascript:submit_delete(<?php echo $val['area_id'];?>)"><?php echo $lang['nc_del'];?></a>
          </td>
        </tr>
		<?php }?>
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
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall_1"><?php echo $lang['nc_select_all'];?></label>
            </span>&nbsp;&nbsp; <a href="javascript:void(0)" class="btn" onclick="submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"><?php echo $output['show_page'];?></div>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
<script type="text/javascript">
var ADMIN_TEMPLATES_URL = '<?php echo BASE_SITE_URL; ?>/admin/templates/default';
var RESOURCE_SITE_URL = '<?php echo BASE_SITE_URL; ?>/data/resource';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.area.js" charset="utf-8"></script>