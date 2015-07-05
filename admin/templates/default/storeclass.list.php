<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".class_parent").click(function(){
            if($(this).attr("status") == "open") {
                $(this).attr("status","close");
                $(this).attr("src","<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-collapsable.gif");
                $("."+$(this).attr("class_id")).show();
            } else {
                $(this).attr("status","open");
                $(this).attr("src","<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-expandable.gif");
                $("."+$(this).attr("class_id")).hide();
            }
        });
        //行内ajax编辑
        $('.inline_edit').blur(function(){
            var class_id = $(this).attr("class_id");
            var value = $(this).val();
            var type = $(this).attr("edit_type");
            var old_value = $(this).attr("old_value");
            $.getJSON('index.php?act=store&op=ajax_update_class&type='+type+'&class_id='+class_id+'&value='+value, function(result){
            	if(result.done == false){
                	$(this).val(old_value);
                	alert(result.msg);
            	}
            });
        });
    });
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
        $('#list_form').attr('action','index.php?act=store&op=drop');
        $('#class_id').val(id);
        $('#list_form').submit();
    }
}
function ajax_set_recommend(stat,class_id){
	$.getJSON('index.php?act=store&op=ajax_recommend&class_id='+class_id+'&stat='+stat, function(result){
		if(result.done){
			if(stat == 1){
				var stat_show = '是';
				var rechange_tip = '取消推荐';
				var new_rcstat = 0;
			}else{
				var stat_show = '否';
				var rechange_tip = '设为推荐';
				var new_rcstat = 1;
			}
			$('#re_stat_'+class_id).html(stat_show);
			$('a[re_change="'+class_id+'"]').html("["+rechange_tip+"]").attr("href","javascript:ajax_set_recommend("+new_rcstat+","+class_id+");");
        }else{
            alert('分类推荐状态修改失败');
        }
	});
}
</script>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_class'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="index.php?act=store&op=add"><span><?php echo $lang['nc_add'];?></span></a></li>
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
        <td><ul>
            <li><?php echo $lang['nc_admin_store_class_help1'];?></li>
            <li><?php echo $lang['nc_admin_store_class_help2'];?></li>
			<li><?php echo $lang['nc_admin_store_class_help3'];?></li>
			<li>二级分类的分佣比例为空不设置，则默认采用一级分类的分佣比例</li>
          </ul></td>
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
          <th class="w48"></th>
          <th class="w48"><?php echo $lang['nc_sort'];?></th>
          <th class="w48">分佣比例(%)</th>
          <th><?php echo $lang['nc_store_class_name'];?></th>
          <th>首页推荐</th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <?php if(empty($val['parent_class_id'])) { ?>
        <tr class="hover edit">
          <td><input type="checkbox" value="<?php echo $val['class_id'];?>" class="checkitem">
            <img class="class_parent" class_id="<?php echo 'class_id'.$val['class_id'];?>" status="open" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-expandable.gif"></td>
          <td class="w48 sort">
          	<input type="text" edit_type="class_sort" value="<?php echo $val['class_sort'];?>" oldvalue="<?php echo $val['class_sort'];?>" class="inline_edit" class_id="<?php echo $val['class_id']; ?>" />
          </td>
          <td class="w48 sort">
          	<input type="text" edit_type="class_settle" value="<?php echo $val['class_settle'];?>" oldvalue="<?php echo $val['class_settle'];?>" class="inline_edit" class_id="<?php echo $val['class_id']; ?>" />
          </td>
          <td class="name">
          <input type="text" edit_type="class_name" value="<?php echo $val['class_name'];?>" oldvalue="<?php echo $val['class_name'];?>" class="inline_edit" class_id="<?php echo $val['class_id']; ?>" /> <a class="btn-add-nofloat marginleft" href="index.php?act=store&op=add&parent_class_id=<?php echo $val['class_id'];?>"><span><?php echo $lang['nc_store_add_new_class'];?></span></a></td>
          <td><span id="re_stat_<?php echo $val['class_id'];?>"><?php echo $val['class_recommend']==0?'否':'是'; ?></span><a re_change="<?php echo $val['class_id'];?>" class="marginleft" href="javascript:ajax_set_recommend(<?php echo $val['class_recommend']==0?1:0; ?>,<?php echo $val['class_id'];?>);">[<?php echo $val['class_recommend']==0?'设为推荐':'取消推荐'; ?>]</a></td>
          <td class="align-center"><a href="index.php?act=store&op=edit&class_id=<?php echo $val['class_id'];?>"><?php echo $lang['nc_edit'];?></a> | <a href="javascript:submit_delete(<?php echo $val['class_id'];?>)"><?php echo $lang['nc_del'];?></a></td>
        </tr>
        <?php foreach($output['list'] as $val1){ ?>
        <?php if($val1['parent_class_id'] == $val['class_id']) { ?>
        <tr class="hover edit <?php echo 'class_id'.$val['class_id'];?>" style="display:none;">
          <td class="w48"><input type="checkbox" value="<?php echo $val1['class_id'];?>" class="checkitem"></td>
          <td class="w48 sort">
          	<input type="text" edit_type="class_sort" value="<?php echo $val1['class_sort'];?>" oldvalue="<?php echo $val1['class_sort'];?>" class="inline_edit" class_id="<?php echo $val1['class_id']; ?>" />
          </td>
          <td class="w48 sort">
          	<input type="text" edit_type="class_settle" value="<?php echo $val1['class_settle'];?>" oldvalue="<?php echo $val1['class_settle'];?>" class="inline_edit" class_id="<?php echo $val1['class_id']; ?>" />
          </td>
          <td class="name">
          <input type="text" edit_type="class_name" value="<?php echo $val1['class_name'];?>"  oldvalue="<?php echo $val1['class_name'];?>" class="inline_edit" class_id="<?php echo $val1['class_id']; ?>" />
          </td>
          <td><span id="re_stat_<?php echo $val1['class_id'];?>"><?php echo $val1['class_recommend']==0?'否':'是'; ?></span><a re_change="<?php echo $val1['class_id'];?>" class="marginleft" href="javascript:ajax_set_recommend(<?php echo $val1['class_recommend']==0?1:0; ?>,<?php echo $val1['class_id'];?>);">[<?php echo $val1['class_recommend']==0?'设为推荐':'取消推荐'; ?>]</a></td>
          <td class="w200 align-center">
              <a href="index.php?act=store&op=edit&class_id=<?php echo $val1['class_id'];?>"><?php echo $lang['nc_edit'];?></a> | 
              <a href="javascript:submit_delete(<?php echo $val1['class_id'];?>)"><?php echo $lang['nc_del'];?></a>
          </td>
        </tr>
        <?php } ?>
        <?php } ?>
        <?php } ?>
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
