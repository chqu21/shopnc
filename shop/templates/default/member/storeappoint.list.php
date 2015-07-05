<script type="text/javascript">
	function verify(){
		location.href='index.php?act=storeorder&op=verify'
	}
</script>
<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_appoint_list'];?></h3>
      </div>
    </div>
    <div class="con—box-search">
    <form method="post">
      <div style="width:500px; display:inline-block">&nbsp;</div>
      <span class="tit-hd" id=""><?php echo $lang['nc_time_from'];?></span>
      <input type='text' name='starttime' class="input_plain c2 focus" value="<?php echo isset($output['moreinfo']['starttime'])?$output['moreinfo']['starttime']:'';?>">
      <span class="tit-hd" id=""><?php echo $lang['nc_time_to'];?></span>
      <input type='text' name='endtime' class="input_plain c2 focus" value="<?php echo isset($output['moreinfo']['endtime'])?$output['moreinfo']['endtime']:'';?>">
      <input class="sh-btn" value="<?php echo $lang['nc_seach'];?>" type="submit">
    </form>
    </div>
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="w300" scope="col"><?php echo $lang['nc_member_comment_store_name'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_appointtime'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_appoint_person_num'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_appoint_person'];?></th>            
            <th class="w110" scope="col"><?php echo $lang['nc_member_appoint_phone'];?></th>
           <!-- <th scope="col"><?php echo $lang['nc_op'];?></th>-->
          </tr>
          <?php if(!empty($output['list'])){?>
          <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center">
            	<!--  
            	<input type="checkbox" value="">
            	-->
            </td>
            <td><?php echo $val['store_name'];?>&nbsp;<?php if($val['type'] == 2){ echo "<font color=\"#FF0000\">[".$lang['nc_member_order_type_group']."]</font>";}?></td>
			<td><?php echo date("Y-m-d",$val['appointtime']);?></td>
            <td><?php echo $val['person_num'];?></td>
			<td><?php echo $val['contact'];?></td>
			<td><?php echo $val['mobile'];?></td>
			<!--<td>				
				<a href="index.php?act=storesetting&op=appointdetail&appoint_id=<?php echo $val['id'];?>">详情</a>
			</td>-->
          </tr>
          <?php }?>
          <?php }else{?>
          <tr>
            <td colspan="20" class="norecord"><i>&nbsp;</i><?php echo $lang['nc_record'];?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <div class="cb_bg">
      <!--  
      <input id="CheckAllBox" class="checkbox" type="checkbox" onclick="CheckAll()">全选
      <input type="submit" style="padding-left:22px; margin-left:10px;" class="input_delete" onclick="return CheckDel();">
      -->
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script>
$(function(){
	$('input[name=starttime]').datepicker({dateFormat: 'yy-mm-dd',yearRange: "1950:2020"});	
	$('input[name=endtime]').datepicker({dateFormat: 'yy-mm-dd',yearRange: "1950:2020"});	
});
</script>