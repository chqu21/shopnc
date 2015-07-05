<style>
.w90{ width:90px;}
.w50{ width:50px;}
.inline-block{ display:inline-block;}
</style>
<div class="con—wrap clearfix">
<div class="con—box">
<div class="con—box-title">
      <div class="con—box-title-border bg-line">
        <h3><?php echo $lang['nc_member_order_more'];?></h3>
      </div>
    </div>
<div class="table—box">
<?php $order = $output['order_info']; $goods = $output['goods'];?>
<table class="ui_table ui_table_inbox" width='90%'>
	<tr>
    	<td colspan='20' height="25" style="text-align:center; vertical-align:central;"><?php echo $order['order_sn'];?> <?php echo $lang['nc_member_order_more'];?></td>
    </tr>
    <tr>
    	<td class="w90"><?php echo $lang['nc_member_store_order_sn'] ;?></td>
        <td><?php echo $order['order_sn'];?></td>
        <td class="w90"><?php echo $lang['nc_member_store_add_time'] ;?></td>
        <td><?php echo  date("Y-m-d",$order['add_time']);?></td>
    </tr>
    <tr>
    	<td rowspan="2">
        	<?php if($output['flag'] == 'goods'){?>
        	<!--<a href=""><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GOODS_PATH.DS.str_replace('.jpg_small','',$goods['goods_pic']);?>" style="max-width:80px"></a>-->
            <?php }elseif($output['flag'] == 'group'){?>
            <a href="index.php?act=groupbuy&op=detail&group_id=<?php echo $order['item_id'];?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GROUPBUY_PATH.DS.str_replace('.jpg_small','',$goods['group_pic']);?>" style="max-width:80px"></a>
            <?php }?>
        </td>
    	<td colspan="3">
			<?php echo $order['item_name'];?>&nbsp;&nbsp;<font color="#FF0000">[<?php echo ($order['order_type']==1)?$lang['nc_member_order_type_group']:($order['order_type']==2)?$lang['nc_member_order_type_coupon']:'';?>]</font>
        </td>
    </tr>
     <tr>
    	<td colspan="3">
			<?php echo $lang['nc_member_store_order_goods_price'];?>：<?php echo $lang['nc_rmb'];?>&nbsp;<?php echo ($output['flag']=='goods')?$goods['goods_price']:$goods['group_price'];?><span class="inline-block w50"></span>
            <?php echo $lang['nc_member_store_item_number'];?>：<?php echo $order['number'];?><span class="inline-block w50"></span>
            <?php echo $lang['nc_member_store_order_price'];?>：<?php echo $lang['nc_rmb'];?>&nbsp;<?php echo $order['price'];?><span class="inline-block w50"></span>
            <?php echo $lang['nc_member_store_item_state'];?>：<?php switch(intval($order['state'])){
						case 1: echo $lang['nc_member_store_no_payment'];break;
						case 2: echo $lang['nc_member_store_payment'];break;
						case 3: echo $lang['nc_member_store_consume'];break;
						case 4: echo '已退款';break;	
						}
				?>
        </td>
    </tr>
    <?php if($order['order_type']==1){?>
    <tr>
    	<td><?php echo $lang['nc_member_group_order_pwd'];?></td>
        <td colspan="3">
        	<?php $ff=0; foreach((array)$output['opwd'] as $val){
				echo substr_replace($val['order_pwd'], '********', -10, 8)."&nbsp;&nbsp;&nbsp;";
				$ff++;
				switch(intval($val['state'])){
						case 1: echo "<font color=\"#FF0000\">[".$lang['nc_member_group_pwd_unused']."]</font>";break;
						case 2: echo "<font color=\"#FF0000\">[".$lang['nc_member_group_pwd_used']."]</font>";break;
						case 3: echo "<font color=\"#FF0000\">[".$lang['nc_member_group_pwd_lock']."]</font>";break;
				}
				if($goods['end_time']<time()) echo "&nbsp;&nbsp;&nbsp;<font color=\"#FF0000\">[".$lang['nc_member_group_time_out']."]</font>";
				if($ff<count($output['opwd'])) echo '<br>';
			}?>
        </td>
    </tr>  
    <?php }?>
    <tr>
    	<td><?php echo $lang['nc_member_store_member_name'] ;?></td>
        <td><?php echo $order['member_name'];?></td>
        <td><?php echo $lang['nc_member_order_member_phone'] ;?></td>
        <td><?php echo $order['mobile'];?></td>
    </tr>
    
	<tr>
		<td colspan='20' height="100" style="text-align:center; vertical-align:central;"><input type="submit" onClick="history.back();" class="btn_txt J_submit" value="<?php echo $lang['no_return'];?>" /></td>
	</tr>
</table>
</div>
</div>
</div>