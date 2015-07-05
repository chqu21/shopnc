<style>
.w90{ width:90px;}
</style>
<div class="mainbox setup_box setup-com">
<div class="hd"><h3><?php echo $lang['nc_member_appointment_more'];?></h3></div>
<div class="con">
<div class="form_table">
<table class="ui_table ui_table_inbox" width='100%'>
	<tr>
    	<td colspan='20' height="25" style="text-align:center; vertical-align:central;"><?php echo $lang['nc_member_appointment_more'];?></td>
    </tr>
    <tr>
    	<td class="w90"><?php echo $lang['nc_member_appointtime'] ;?></td>
        <td><?php echo date("Y-m-d",$output['appoint']['appointtime'])?></td>
    </tr>
    <tr>
    	<td><?php echo $lang['nc_member_appoint_person'] ;?></td>
        <td><?php echo $output['appoint']['contact']?></td>
    </tr>
    <tr>
    	<td><?php echo $lang['nc_member_appoint_phone'] ;?></td>
        <td><?php echo $output['appoint']['mobile'];?></td>
    </tr>
    <tr>
    	<td><?php echo $lang['nc_member_appoint_person_num'] ;?></td>
        <td><?php echo $output['appoint']['person_num']?>&nbsp;<?php echo $lang['person'];?></td>
    </tr>
    <tr>
    	<td colspan='20' height="25" style="text-align:center; vertical-align:central;"><?php echo $lang['nc_member_appointment_store_more'];?></td>
    </tr>
    <tr>
    	<td rowspan="3"><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['store_info']['store_id'];?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['store_info']['pic'];?>" ></a></td>
        <td><a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $output['store_info']['store_id'];?>"><?php echo $output['store_info']['store_name'];?></a></td>
    </tr>
    <tr>
        <td><?php echo $lang['nc_member_appointtime'];?>&nbsp;:&nbsp;<?php echo date('Y-m-d H:i:s',$output['appoint']['appointtime']);?></td>
    </tr>
    <tr>
        <td><?php echo $lang['nc_store_address'];?>&nbsp;:&nbsp;<?php echo $output['store_info']['address'];?><br/>
        	<?php echo $lang['nc_store_address_bus'];?>&nbsp;:&nbsp;<?php echo $output['store_info']['bus'];?>
        </td>
    </tr>	
	<tr>
		<td colspan='20' height="100" style="text-align:center; vertical-align:central;"><a href="javascript:void()" onClick="history.back()"><?php echo $lang['no_return'];?></a></td>
	</tr>
</table>
</div>
</div>
</div>