<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_groupbuy_item_audit'];?></h3>
      <ul class="tab-base">
      	<li><a href="index.php?act=groupbuy&op=groupbuy"><span><?php echo $lang['nc_manage'];?></span></a></li>
      	<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_admin_groupbuy_audit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name='form1'>
    <input type="hidden" name="group_id" value="<?php echo $output['group']['group_id'];?>" />
    <table class="table tb-type2">
      <tbody>     
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_groupbuy_is_not_audit'];?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="is_audit2" class="cb-enable selected" ><span><?php echo $lang['open'];?></span></label>
            <label for="is_audit3" class="cb-disable" ><span><?php echo $lang['close'];?></span></label>
            <input id="is_audit2" name="is_audit"  value="2" type="radio" checked>
            <input id="is_audit3" name="is_audit"  value="3" type="radio">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="settle">分佣比例:</label></td>
        </tr>    
        <tr class="noborder">
          <td class="vatop rowform"><input name="settle" type="text" id="settle" value="<?php echo $output['group']['settle']; ?>" style="width:50px"> %</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="audit_reason"><?php echo $lang['nc_admin_groupbuy_audit_reason'];?>:</label></td>
        </tr>    
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="audit_reason" rows="6" id="audit_reason" ></textarea></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo $lang['nc_save'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>