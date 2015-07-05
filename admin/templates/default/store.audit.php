<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_store_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=store&op=storelist"><span><?php echo $lang['nc_manage'];?></span></a></li>
		<li><a href="javascript:void(0);" class="current"><span><?php echo $lang['nc_store_store_audit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name='form1'>
    <table class="table tb-type2">
      <tbody>     
        <tr>
          <td colspan="2" class="required"><?php echo $lang['nc_store_store_audit'];?>:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="is_audit1" class="cb-enable selected"><span><?php echo $lang['open'];?></span></label>
            <label for="is_audit2" class="cb-disable" ><span><?php echo $lang['close'];?></span></label>
            <input id="is_audit1" name="is_audit" checked  value="2" type="radio">
            <input id="is_audit2" name="is_audit" value="3" type="radio">
          </td>
          <td class="vatop tips">
          	<span class="vatop rowform"><?php echo $lang['nc_site_open_and_close'];?></span>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2">
          	<input type="hidden" name="store_id" value="<?php echo $output['store_id'];?>">
          	<a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo $lang['nc_save'];?></span></a>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>