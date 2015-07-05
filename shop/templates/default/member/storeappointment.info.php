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
		<td colspan='20' height="100" style="text-align:center; vertical-align:central;"><a href="javascript:void()" onClick="history.back()"><?php echo $lang['no_return'];?></a></td>
	</tr>
</table>
</div>
</div>
</div>