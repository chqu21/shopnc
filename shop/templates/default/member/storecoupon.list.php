<div class="con—wrap clearfix">
  <div class="con—box">
    <div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_store_coupon_manage'];?></h3>
      </div>
    </div>
	<div class="con—box-search">
    <form method="post">
      <span class="tit-hd" id="">优惠券名称：</span>
      <input type="text" class="tit-input w150" style="margin-right:10px;" name="coupon_name" value="<?php echo $output['coupon_name'];?>">
      <input class="sh-btn" value="查询" type="submit">
    </form>
    </div>
    <div class="table—box">	  
      <table cellspacing="0" border="0">
        <tbody>
          <tr class="category-hd">
            <th class="w20" scope="col">&nbsp;</th>
            <th class="w140" scope="col"><?php echo $lang['nc_member_store_coupon_name'];?></th>
            <th class="w65" scope="col"><?php echo $lang['nc_member_store_store_name'];?></th>
            <th class="w110" scope="col"><?php echo $lang['nc_member_store_the_period_validity'];?></th>
            <th class="w70" scope="col"><?php echo $lang['nc_member_store_downloadcount'];?></th>
            <th class="w50" scope="col"><?php echo $lang['nc_member_store_viewcount'];?></th>
			<th class="w50" scope="col"><?php echo $lang['nc_op'];?></th>
          </tr>
		  <?php if(!empty($output['list'])){?>
		  <?php foreach($output['list'] as $key=>$val){?>
          <tr>
            <td align="center">
            <!--  
            <input type="checkbox" value="">--></td>
            <td><a href="index.php?act=coupon&op=detail&coupon_id=<?php echo $val['coupon_id'];?>" target="_blank" style="color:#3399CC"><?php echo $val['coupon_name'];?></a></td>
            <td><?php echo $val['store_name']?></td>
            <td><?php echo date('Y-m-d',$val['coupon_start_time']);?>&nbsp;~&nbsp;<?php echo date('Y-m-d',$val['coupon_end_time']);?></td>
            <td><span style="color:#E64D5E;font-weight:bold;font-size:14px"><?php echo $val['download_count'];?></span></td>
            <td><?php echo $val['view_count'];?></td>
			<td>
			<?php if($val['audit']!=2){?>
			<a href="index.php?act=storecoupon&op=edit_coupon&coupon_id=<?php echo $val['coupon_id'];?>"><?php echo $lang['nc_edit'];?></a>&nbsp;|&nbsp;<a href="javascript:if(confirm('确认删除吗？'))window.location.href='index.php?act=storecoupon&op=del_coupon&coupon_id=<?php echo $val['coupon_id'];?>';"><?php echo $lang['nc_delete'];?></a>
			<?php }?>
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
        <div class="cb_bg_l">
        	<!--  
        	<input class="checkbox checkall"  type="checkbox">全选
      		<input type="button" style="padding-left:22px; margin-left:10px;" class="input_delete"  onclick="javascript:submit_delete_batch();" value="删除" name="">
        	-->
        	<input type="button" style="padding-left:25px; margin-left:10px; margin-top:5px;" class="coupon-add" onclick="javascript:location.href='index.php?act=storecoupon&op=add_coupon'" value="<?php echo $lang['nc_member_store_add_coupon'];?>">
        </div>
        <div class="page_box"><?php echo $output['show_page']; ?></div>
    </div>
  </div>
</div>
