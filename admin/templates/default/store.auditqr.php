<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>商铺管理</h3>
      <ul class="tab-base">
      	<li><a href="index.php?act=store"><span><?php echo $lang['nc_manage'];?></span></a></li>
      	<li><a href="javascript:void(0);" class="current"><span>审核</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name='form1'>
    <input type="hidden" name="store_id" value="<?php echo $output['store']['store_id'];?>" />
    <table class="table tb-type2">
      <tbody>     
        <tr>
          <td colspan="2">二维码:</td>
        </tr>
        <tr>
          <td colspan="2">
			<img src="<?php echo BASE_SITE_URL; ?>/data/upload/shop/qr_code/<?php echo $output['store']['qr_code']; ?>" width="153px" height="153px">
		  </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="site_status1" class="cb-enable selected" ><span><?php echo '通过';?></span></label>
            <label for="site_status0" class="cb-disable" ><span><?php echo '不通过';?></span></label>
            <input id="site_status1" name="is_qr_saft"  value="2" type="radio" checked>
            <input id="site_status0" name="is_qr_saft"  value="3" type="radio">
          </td>
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