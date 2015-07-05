<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_coupon_manage'];?></h3>
      <ul class="tab-base">
      	<li><a href="index.php?act=coupon"><span><?php echo $lang['nc_manage'];?></span></a></li>
      	<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_admin_coupon_audit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name='form1'>
    <input type="hidden" name="coupon_id" value="<?php echo $output['coupon']['coupon_id'];?>" />
    <table class="table tb-type2">
      <tbody>     
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_admin_coupon_audit_state'];?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="site_status1" class="cb-enable selected" ><span><?php echo $lang['open'];?></span></label>
            <label for="site_status0" class="cb-disable" ><span><?php echo $lang['close'];?></span></label>
            <input id="site_status1" name="audit"  value="2" type="radio" checked>
            <input id="site_status0" name="audit"  value="3" type="radio">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="closed_reason"><?php echo $lang['nc_admin_coupon_audit_reason'];?>:</label></td>
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