<div class="mainbox setup_box">
  <div class="hd">
    <h3><?php echo $lang['nc_member_title_detail'];?></h3>
    <span>(<i class="c1">*</i><?php echo $lang['nc_member_required_item'];?>)</span></div>
  <div class="con">
    <p class="con_hints"><?php echo $lang['nc_member_detail_help'];?></p>
    <div class="form_box">
      <form method="post" action="<?php echo BASE_SITE_URL;?>/index.php?act=memberaccount&op=detail" id="detail_form">
        <ul>
          <li class="current">
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_weight'];?>：</label>
            </div>
            <div class="pt">
              <div id="J_weight" class="op_txt"><span>
                <?php if(!empty($output['member']['weight'])){ echo $output['weight'][$output['member']['weight']];}else{ echo $lang['nc_member_secret'];}?>
                </span><i class="i_down"></i></div>
              <input type="hidden" value="<?php echo $output['member']['weight'];?>" name="weight">
            </div>
            <div class="slt_wrap slt_box slt_body" style="top:36px;display:none;" id="C_weight">
              <div class="slt_list">
                <ul class='u_weight'>
                  <?php if(!empty($output['weight'])){?>
                  <?php foreach($output['weight'] as $wk=>$wv){?>
                  <li data-id="<?php echo $wk;?>"><?php echo $wv;?></li>
                  <?php }?>
                  <?php }?>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_state'];?>：</label>
            </div>
            <div class="pt fi">
              <input type="radio" id="love1" value="1" class="rp" name="member_state" <?php if($output['member']['member_state']==1){ echo 'checked';}?>>
              <label for="love1"><?php echo $lang['nc_member_simple'];?></label>
              <input type="radio" id="love2" value="2" class="rp" name="member_state" <?php if($output['member']['member_state']==2){ echo 'checked';}?>>
              <label for="love2"><?php echo $lang['nc_member_madly_in_love'];?></label>
              <input type="radio" id="love5" value="3" class="rp" name="member_state" <?php if($output['member']['member_state']==3){ echo 'checked';}?>>
              <label for="love3"><?php echo $lang['nc_member_married'];?></label>
              <input type="radio" id="love4" value="4" class="rp" name="member_state" <?php if($output['member']['member_state']==4){ echo 'checked';}?> checked>
              <label for="love4"><?php echo $lang['nc_member_secret'];?></label>
            </div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_birthday'];?>：</label>
            </div>
            <div class="pt sb">
              <input type='text' name='birthday' class="input_plain c2 focus" value="<?php if(!empty($output['member']['birthday'])){ echo date('Y-m-d',$output['member']['birthday']);}?>">
            </div>
          </li>
          <li class="current" style="z-index:1;">
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_constellation'];?>：</label>
            </div>
            <div class="pt">
              <div id="J_constellation" class="op_txt"><span>
                <?php if(!empty($output['member']['constellation'])){ echo $output['constellation'][$output['member']['constellation']];}?>
                </span><i class="i_down"></i></div>
              <input type="hidden" value="<?php echo $output['member']['constellation'];?>" name="constellation">
            </div>
            <div class="slt_wrap slt_box slt_star" style="top:36px;display:none;" id='C_constellation'>
              <div class="slt_list">
                <ul class='u_constellation'>
                  <?php if(!empty($output['constellation'])){?>
                  <?php foreach($output['constellation'] as $ck=>$cv){?>
                  <li data-id="<?php echo $ck;?>"><?php echo $cv;?></li>
                  <?php }?>
                  <?php }?>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_qq'];?>：</label>
            </div>
            <div class="pt fi">
              <input type="text" value="<?php echo $output['member']['member_qq'];?>" class="input_plain c2 focus" name="member_qq" maxlength="10">
              <label for='member_qq' class='error msg_invalid' style='display:none;'></label>
            </div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_industry'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" value="<?php echo $output['member']['industry'];?>" class="input_plain c2 focus" name="industry" maxlength="50">&nbsp;&nbsp;(行业不要超过50个字符)
            </div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_college'];?>：</label>
            </div>
            <div class="pt">
              <input type="text" value="<?php echo $output['member']['college'];?>" class="input_plain c2 focus" name="college" maxlength="50">&nbsp;&nbsp;(大学不要超过50个字符)
            </div>
            <div class="f-msg"></div>
          </li>
          <li>
            <div class="tit">
              <label for=""><?php echo $lang['nc_member_hobby'];?>：</label>
            </div>
            <div class="pt">
              <textarea class="tp c2" rows="2" cols="" name="hobby" maxlength="200"><?php echo $output['member']['hobby'];?></textarea>&nbsp;&nbsp;(爱好不能超过200个字符)
            </div>
          </li>
        </ul>
        <div class="btn_box">
        <span class="f_btn">
          <button type="submit" class="btn_txt J_submit"><?php echo $lang['nc_save'];?></button>
          </span> </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">
	$(function(){
		$('input[name=birthday]').datepicker({dateFormat: 'yy-mm-dd',yearRange: "1950:2020"});

		$("#J_constellation").toggle(function(){
			$("#C_constellation").show();
		},function(){
			$("#C_constellation").hide();
		});

		$("#J_weight").toggle(function(){
			$("#C_weight").show();
		},function(){
			$("#C_weight").hide();
		});

		$(".u_constellation li").click(function(){
			var data_id = $(this).attr('data-id');
			var nc_html = $(this).html();
			$("#C_constellation").hide();
			$("#J_constellation").children('span').html(nc_html);
			$("input[name=constellation]").val(data_id);
		});

		$(".u_weight li").click(function(){
			var data_id = $(this).attr('data-id');
			var nc_html = $(this).html();
			$("#C_weight").hide();
			$("#J_weight").children('span').html(nc_html);
			$("input[name=weight]").val(data_id);
		});
		$('#detail_form').validate({
			rules:{
				member_qq:{
					number:true
				}
			},
			messages:{
				member_qq:{
					number:'QQ号码请填写数字'
				}
			}
		});
	});
</script>