<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_member_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=member&op=member" class=""><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=member&op=member_degree" class=""><span>会员等级</span></a></li>
        <li><a href="javascript:void(0);" class="current"><span>分数设置</span></a></li>
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
            <li>您可以在这里手动修改会员与网站各种交互活动所获得的贡献值与积分值（可以设置为0）</li>
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
          <th class="w200">项目名称</th>
		  <th class="w200">获得贡献值</th>
		  <th class="w200">获得积分值</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
          <td><?php echo $val['ss_name'];?></td>
		  <td><input class="ss_score" ss_type="ss_contribution" ss_id="<?php echo $val['ss_id']; ?>" value="<?php echo intval($val['ss_contribution']); ?>" type="text" /></td>
		  <td><input class="ss_score" ss_type="ss_point" ss_id="<?php echo $val['ss_id']; ?>" value="<?php echo intval($val['ss_point']); ?>" type="text" /></td>
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
	$('.ss_score').change(function(){
		var ss_type = $(this).attr('ss_type');
		var ss_id = $(this).attr('ss_id');
		var value = $(this).val();
		$.getJSON('index.php?act=member&op=score_setting&ss_id='+ss_id+'&ss_type='+ss_type+'&value='+value+'&ajax_submit=ok', function(result){
			if(!result.done){
	            alert('分数修改失败');
	        }
		});
	});
})
</script>