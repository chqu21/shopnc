<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_store_activity_manage'];?></h3>
      </div>
    </div>
	<div class="con—box-search">
    <form method="post">
      <span class="tit-hd" id="">活动名称：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="activity_name" value="<?php echo $output['activity_name'];?>">
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="" scope="col"><?php echo $lang['nc_member_store_activity_name'];?></th>
            <th class="w150" scope="col"><?php echo $lang['nc_member_store_activity_time'];?></th>
            <th class="w80" scope="col"><?php echo $lang['nc_member_store_activity_apply_num'];?></th>
            <!--  <th class="w340" scope="col"><?php echo $lang['nc_member_store_activity_description'];?></th> -->
			<th scope="col" class="w150"><?php echo $lang['nc_op'];?></th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center"></td>
            <td><?php echo $val['activity_name'];?></td>
            <td><?php echo date("Y-m-d",$val['start_time']);?>~<?php echo date("Y-m-d",$val['end_time']);?></td>
            <td><?php echo $val['apply_num'];?></td>
            <!--<td><?php echo htmlspecialchars_decode($val['description']);?></td>-->
			<td>
				<a href="index.php?act=storeactivity&op=editactivity&activity_id=<?php echo $val['activity_id'];?>"><?php echo $lang['nc_edit'];?></a>&nbsp;|&nbsp;
				<a href="javascript:if(confirm('确认删除吗？'))window.location.href='index.php?act=storeactivity&op=delactivity&activity_id=<?php echo $val['activity_id'];?>';"><?php echo $lang['nc_del'];?></a>&nbsp;|&nbsp;
				<a href="index.php?act=storeactivity&op=viewapply&activity_id=<?php echo $val['activity_id'];?>"><?php echo $lang['nc_member_store_activity_view_apply'];?></a>
			</td>
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
      <input id="CheckAllBox" class="checkbox" type="checkbox" onclick="CheckAll()"><?php echo $lang['nc_select_all'];?>
      <input type="submit" style="padding-left:22px; margin-left:10px;" class="input_delete" id="ctl00_ContentPlaceHolder1_BtnDelete" onclick="return CheckDel();" value="<?php echo $lang['nc_del'];?>>" name="">
    -->
      <input type="button" style="padding-left:25px; margin-left:10px; margin-top:5px;" class="coupon-add" onclick="javascript:location.href='index.php?act=storeactivity&op=addactivity'" value="<?php echo $lang['nc_member_store_activity_add'];?>">      
      <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
