<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="con">
      <p class="con_hints">您可以在这里对用户的评价进行解释说明</p>
      <div class="form_box">
        <form id="apply_form" enctype="multipart/form-data" method="post">
          <ul>
          	<li>
              <div class="tit">
                <label for="">用户昵称：</label>
              </div>
              <div class="pt">
                <span><?php echo $output['comment_info']['member_name']; ?></span>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">评论内容：</label>
              </div>
              <div class="pt">
                <span><?php echo $output['comment_info']['comment']; ?></span>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">解释说明：</label>
              </div>
              <div class="pt">
                <textarea id="comment_explain" name="comment_explain" style="width: 364px; height: 92px;" maxlength="200"><?php echo $output['comment_info']['comment_explain']; ?></textarea>
                <label for="comment_explain" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
            
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">解释说明最多为200个字符</label>
              </div>
            </li>
          </ul>
          <div class="btn_box">
            <input type='hidden' name='comment_id' value="<?php echo $output['comment_info']['comment_id'];?>">
            <span class="f_btn">
            <button class="btn_txt J_submit" type="submit"><?php echo $lang['nc_save'];?></button>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function(){
    $("#apply_form").validate({
        rules: {
        	comment_explain: {
				required:true
            }
        },
        messages: {
        	comment_explain: {
				required:'解释内容不能为空'
            }
        }
    });
});
//]]>
</script>