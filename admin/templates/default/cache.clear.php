<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>清理缓存</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="cache_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table nobdb">
      <tbody>
        <tr>
          <td colspan="2"><table class="table nomargin">
              <tbody>
                <tr>
                  <td class="required"><input id="cls_full" name="cls_full" value="1" type="checkbox">
                    &nbsp;
                    <label for="cls_full">全部</label></td>
                </tr>
                <tr class="noborder">
                  <td class="vatop rowform"><ul class="nofloat w830">
                  	  <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" id="groupbuy" value="setting" >
                          &nbsp;网站配置</label>
                      </li>
                      <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" value="adv" >
                          &nbsp;广告缓存</label>
                      </li>
                      <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" value="class" >
                          &nbsp;商户分类</label>
                      </li>
                      <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" value="area" >
                          &nbsp;地区缓存</label>
                      </li>
                      <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" value="member_degree" >
                          &nbsp;会员等级设置缓存</label>
                      </li>
					  <li class="left w18pre">
                        <label>
                          <input type="checkbox" name="cache[]" value="article" >
                          &nbsp;文章缓存</label>
                      </li>
                    </ul></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表
$(function(){
	$("#submitBtn").click(function(){
		if($('input[name="cache[]"]:checked').size()>0){
			$("#cache_form").submit();
		}
	});

	$('#cls_full').click(function(){
		$('input[name="cache[]"]').attr('checked',$(this).attr('checked') == 'checked');
	});
});
</script>