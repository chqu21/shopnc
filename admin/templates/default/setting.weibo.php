<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_admin_setting_login'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=setting&op=qqlogin"><span><?php echo $lang['nc_admin_setting_qq'];?></span></a></li>
        <li><a href="index.php?act=setting&op=weibologin" class="current"><span><?php echo $lang['nc_admin_setting_sina'];?></span></a></li>
        <li><a href="index.php?act=setting&op=renrenlogin"><span><?php echo $lang['nc_admin_setting_renren'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" name="settingForm">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label><?php echo $lang['nc_admin_setting_weibo_isuse'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
          	<label for="sina_isuse1" class="cb-enable <?php if($output['setting']['sina_isuse'] == '1'){ ?>selected<?php } ?>" ><span><?php echo $lang['open'];?></span></label>
            <label for="sina_isuse2" class="cb-disable <?php if($output['setting']['sina_isuse'] == '0'){ ?>selected<?php } ?>" ><span><?php echo $lang['close'];?></span></label>
            <input id="sina_isuse1" name="sina_isuse" <?php if($output['setting']['sina_isuse'] == '1'){ ?>checked="checked"<?php } ?>  value="1" type="radio">
            <input id="sina_isuse2" name="sina_isuse" <?php if($output['setting']['sina_isuse'] == '0'){ ?>checked="checked"<?php } ?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="qq_appcode"><?php echo $lang['qq_appcode'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="sina_appcode" rows="6" class="tarea" id="sina_appcode"><?php echo $output['setting']['sina_appcode'];?></textarea></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="qq_appid"><?php echo $lang['qq_appid'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="sina_wb_akey" name="sina_wb_akey" value="<?php echo $output['setting']['sina_wb_akey'];?>" class="txt" type="text">
            </td>
          <td class="vatop tips"><a style="color:#ffffff; font-weight:bold;" target="_blank" href="http://connect.qq.com"><?php echo $lang['qq_apply_link']; ?></a></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="qq_appkey"><?php echo $lang['qq_appkey'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="sina_wb_skey" name="sina_wb_skey" value="<?php echo $output['setting']['sina_wb_skey'];?>" class="txt" type="text"></td>
          <td class="vatop tips">&nbsp;</td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.settingForm.submit()"><span><?php echo $lang['nc_save'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
