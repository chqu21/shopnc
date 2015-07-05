<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_website_activity_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
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
            	<li><?php echo $lang['nc_admin_website_activity_help'];?></li>
            	<li><?php echo $lang['nc_admin_website_activity_help1'];?></li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method='post'>
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th class="w48"></th>
          <th><?php echo $lang['nc_admin_website_activity_name'];?></th>
		  <th><?php echo $lang['nc_admin_website_activity_store_name'];?></th>
		  <th><?php echo $lang['nc_admin_website_activity_valid'];?></th>
		  <th><?php echo $lang['nc_admin_website_activity_number'];?></th>
          <th class="w200 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $val){ ?>
        <tr class="hover edit">
		  <td></td>
          <td><?php echo $val['activity_name'];?></td>
		  <td><?php echo $val['store_name'];?></td>
		  <td><?php echo date("Y-m-d",$val['start_time']);?>~<?php echo date("Y-m-d",$val['end_time']);?></td>
		  <td><?php echo $val['apply_num'];?></td>
		  <td class='align-center'>
		  	<a href="javascript:if(confirm('<?php echo $lang['nc_admin_adv_operation'];?>'))window.location = 'index.php?act=activity&op=delactivity&activity_id=<?php echo $val['activity_id'];?>';"><?php echo $lang['nc_del'];?></a>
		  </td>
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
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
