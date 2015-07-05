<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_seo_set']?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=setting&op=seo_information&type=index" class="<?php if($output['seo']['type']=='index'){ echo 'current';}?>"><span><?php echo $lang['seo_set_index'];?></span></a></li>
        <li><a href="index.php?act=setting&op=seo_information&type=coupon" class="<?php if($output['seo']['type']=='coupon'){ echo 'current';}?>"><span><?php echo $lang['seo_set_coupon'];?></span></a></li>
		<li><a href="index.php?act=setting&op=seo_information&type=groupbuy" class="<?php if($output['seo']['type']=='groupbuy'){ echo 'current';}?>"><span><?php echo $lang['seo_set_groupbuy'];?></span></a></li>
		<li><a href="index.php?act=setting&op=seo_information&type=card" class="<?php if($output['seo']['type']=='card'){ echo 'current';}?>"><span><?php echo $lang['seo_set_card'];?></span></a></li>
		<li><a href="index.php?act=setting&op=seo_information&type=appointment" class="<?php if($output['seo']['type']=='appointment'){ echo 'current';}?>"><span>预约</span></a></li>
		<li><a href="index.php?act=setting&op=seo_information&type=gift" class="<?php if($output['seo']['type']=='gift'){ echo 'current';}?>"><span>积分商城</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
			<ul>
				<li><?php echo $lang['seo_set_write_information'];?></li>
			</ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form method="post" name="form_index">
    <input type="hidden" name="seo_type" value="<?php echo $output['seo']['type'];?>"/>
    <table class="table tb-type2">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label><?php echo $lang['seo_set_'.$output['seo']['type']];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="w96">title</td><td><input id="seo_title" name="title" value="<?php echo $output['seo']['title'];?>" class="w300" type="text"/></td>
        </tr>
        <tr class="noborder">
          <td class="w96">keywords</td><td><input id="seo_keywords" name="keywords" value="<?php echo $output['seo']['keywords'];?>" class="w300" type="text" maxlength="200" /></td>
        </tr>
        <tr class="noborder">
          <td class="w96">description</td><td><input id="seo_description" name="description" value="<?php echo $output['seo']['description'];?>" class="w300" type="text" maxlength="200"/></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form_index.submit()"><span><?php echo $lang['nc_save'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>