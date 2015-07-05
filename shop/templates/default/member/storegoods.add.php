<div class="layout clearfix">
  <div class="mainbox setup_box">
    <div class="hd">
      <h3><?php echo $lang['nc_member_store_goods_add_goods'];?></h3>
    </div>
    <div class="con">
      <div class="form_box">
        <form method="post" enctype="multipart/form-data" id="apply_form">
          <ul>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_goods_name'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="w400 input_plain" type="text" name="goods_name" id="goods_name" maxlength="50" value=""/>
				<label for='goods_name' class='error msg_invalid' style='display:none;'></label>
              </div>
            </li>
            
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">商品名称最多为50个字符</label>
              </div>
            </li>
            
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_goods_price'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="w120 input_plain"  type="text" name="goods_price" id="goods_price" maxlength="7" />
				<label for="goods_price" class="error msg_invalid" style='display:none;'></label>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_goods_pic']	.$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <input class="" type="file" name="goods_pic" id="goods_pic"/>
				<label for="goods_pic" class="error msg_invalid" style='display:none;'></label>
			  </div>
            </li>
            <li>
              <div class="tit">
                <label for=""><?php echo $lang['nc_member_store_goods_content'].$lang['nc_colon'];?></label>
              </div>
              <div class="pt">
                <textarea name="goods_content" style="width:350px;height:180px" maxlength="200"></textarea>
              </div>
            </li>
            <li>
              <div class="tit">
                <label for="">&nbsp;</label>
              </div>
              <div class="pt">
				<label for="" class="ptinfo">商品描述最多为200个字符</label>
              </div>
            </li>
          </ul>
          <div class="btn_box"> 
          	<span class="f_btn">
            	<input type="submit" class="btn_txt J_submit" value="<?php echo $lang['nc_save'];?>" />
            </span> 
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">
$(function(){
    $("#apply_form").validate({
        rules: {
            goods_name: {
				required:true
            },
            goods_price:{
				required:true,
				number:true	
			},
			goods_pic:{
				required:true,
				accept:'jpg|png|gif'	
			}
        },
        messages: {
        	goods_name: {
				required:'<?php echo $lang['nc_member_store_goods_name_is_not_null'];?>'
            },
            goods_price:{
				required:'<?php echo $lang['nc_member_store_goods_price_is_not_null'];?>',
				number:'<?php echo $lang['nc_member_store_goods_price_is_not_null'];?>'
			},
			goods_pic:{
				required:'<?php echo $lang['nc_member_store_goods_pic_is_not_null'];?>',
				accept:'<?php echo $lang['nc_member_store_goods_pic_format_is_wrong'];?>'
			}
        }
    });
});
//]]>
</script>