<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_member_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=member&op=member" class=""><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="javascript:void(0);" class="current"><span>会员等级</span></a></li>
        <li><a href="index.php?act=member&op=score_setting" class=""><span>分数设置</span></a></li>
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
            <li>您可以在这里手动修改会员等级所需贡献值，请注意合理设置数值区间</li>
            <li>修改等级最大贡献值后系统会自动计算并更新下一级的最小贡献值</li>
          </ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <input id="member_id" name="member_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w200">等级名称</th>
		  <th class="w200">最小贡献值</th>
		  <th class="w200">最大贡献值</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td><input class="md_name" md_id="<?php echo $val['md_id']; ?>" value="<?php echo $val['md_name']; ?>" type="text" /></td>
		  <td><?php echo intval($val['md_from']); ?></td>
		  <td><?php if($val['md_id']<7){ ?><input class="md_to" md_id="<?php echo $val['md_id']; ?>" value="<?php echo intval($val['md_to']); ?>" type="text" /><?php } ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript">
$(function(){
	$('.md_name').change(function(){
		var md_id = $(this).attr('md_id');
		var md_name = $(this).val();
		$.getJSON('index.php?act=member&op=member_degree&type=name&md_id='+md_id+'&md_name='+md_name+'&ajax_submit=ok', function(result){
			if(!result.done){
	            alert('等级名称修改失败');
	        }else{
		        window.location.href = 'index.php?act=member&op=member_degree';
	        }
		});
	});
	$('.md_to').change(function(){
		var md_id = $(this).attr('md_id');
		var md_to = $(this).val();
		$.getJSON('index.php?act=member&op=member_degree&type=to&md_id='+md_id+'&md_to='+md_to+'&ajax_submit=ok', function(result){
			if(!result.done){
	            alert('等级贡献值修改失败');
	        }else{
	        	window.location.href = 'index.php?act=member&op=member_degree';
	        }
		});
	});
})
</script>