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
    if(confirm('<?php echo $lang['nc_admin_adv_operation'];?>')) {
        $('#form_rec').attr('method','post');
        $('#form_rec').attr('action','index.php?act=adv&op=del');
			
        $('#ap_id').val(id);
        $('#form_rec').submit();
    }
}
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_website_adv_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=adv&op=adv_add"><span><?php echo $lang['nc_add'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <!-- 广告查询 -->
  <form method="post" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><?php echo $lang['nc_admin_website_adv_type'];?></th>
          <td>
          	<select name='ap_class'>
          		<option value=""><?php echo $lang['nc_please_choose'];?></option>
          		<option value="1" <?php if($output['ap_class'] == '1'){ echo 'selected';}?>><?php echo $lang['nc_admin_website_adv_words'];?></option>
          		<option value="2" <?php if($output['ap_class'] == '2'){ echo 'selected';}?>><?php echo $lang['nc_admin_website_adv_pic'];?></option>
          	</select>
          </td>
          <th><?php echo $lang['nc_admin_website_adv_title'];?></th>
          <td><input type="text" value="<?php echo $output['ap_name'];?>" name="ap_name" class="txt"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12">
        	<div class="title">
	            <h5><?php echo $lang['nc_prompts'];?></h5>
	            <span class="arrow"></span>
            </div>
        </th>
      </tr>
      <tr>
      	<td>
      		<ul>
      			<li><?php echo $lang['nc_admin_website_adv_help'];?></li>
      			<li><?php echo $lang['nc_admin_website_adv_help1'];?></li>
      		</ul>
      	</td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="form_rec"> 
  	<input id="ap_id" name="ap_id" type="hidden" />
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th>&nbsp;</th>
          <th><?php echo $lang['nc_admin_website_adv_title'];?></th>
          <th><?php echo $lang['nc_admin_website_adv_type'];?></th>
          <th><?php echo $lang['nc_admin_website_adv_use'];?></th>
          <th><?php echo $lang['nc_admin_website_adv_height'];?></th>
          <th><?php echo $lang['nc_admin_website_adv_width'];?></th>
          <th class="align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){?>
        <?php foreach($output['list'] as $k => $v){ ?>
        <tr class="hover edit">
          <td class="w24"><input type="checkbox" name="ap_id[]" value="<?php echo $v['ap_id'];?>" class="checkitem"></td>
          <td><?php echo $v['ap_name'];?></td>
          <td>
              <?php 
              	if($v['ap_class'] == 1){
              		echo $lang['nc_admin_website_adv_words'];
              	}elseif($v['ap_class'] == 2){
              		echo $lang['nc_admin_website_adv_pic'];
              	}
              ?>
          </td>
          <td>
	          <?php 
	          	if($v['is_use'] == '1'){
	          		echo $lang['nc_yes'];
	          	}elseif($v['is_use'] == '0'){
	          		echo $lang['nc_no'];
	          	}
	          ?>
          </td>
          <td><?php echo $v['ap_height'];?></td>
          <td><?php echo $v['ap_width'];?></td>
          <td class="w180 align-center">
          	<a href="index.php?act=adv&op=edit_adv&ap_id=<?php echo $v['ap_id'];?>"><?php echo $lang['nc_edit'];?></a>| 
          	<a href="javascript:if(confirm('<?php echo $lang['nc_admin_adv_operation'];?>'))window.location = 'index.php?act=adv&op=del&ap_id=<?php echo $v['ap_id'];?>';"><?php echo $lang['nc_del'];?></a>| 
          	<a nctype="jscode" rec_id="<?php echo $v['ap_id'];?>" href="javascript:void(0)"><?php echo $lang['nc_ps_code'];?></a>
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
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <tr class="tfoot" id="dataFuncs">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16" id="batchAction">
          	<label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp; 
            <a href="JavaScript:void(0);" class="btn" onclick="javascript:submit_delete_batch();"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script>
$(function(){
	$('a[nctype="jscode"]').click(function(){
		copyToClipBoard($(this).attr('rec_id'));return ;		
	});

	function copyToClipBoard(id){
	    if(window.clipboardData)
	    { 
	        // the IE-manier
	        window.clipboardData.clearData();
	        window.clipboardData.setData("Text", "<\?php echo rec("+id+");?>");
	        alert("<?php echo $lang['rec_ps_clip_succ'];?>!");
	    }
	    else if(navigator.userAgent.indexOf("Opera") != -1)
	    {
	        window.location = "<\?php echo rec("+id+");?>";
	        alert("<?php echo $lang['rec_ps_clip_succ'];?>!");
	    }
	    else
	    {
	        ajax_form('copy_rec', '<?php echo $lang['nc_ps_code'];?>', 'index.php?act=adv&op=rec_code&rec_id='+id);
	    }
	}
});
</script>