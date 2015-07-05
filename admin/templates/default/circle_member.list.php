<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_circle_membermanage'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="act" value="circle_member">
    <input type="hidden" name="op" value="member_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="searchtitle"><?php echo $lang['circle_member_name'];?></label></th>
          <td><input type="text" name="searchname" id="searchname" class="txt" value='<?php echo $_GET['searchname'];?>'></td>
          <th><label for="circlename"><?php echo $lang['circle_name'];?></label></th>
          <td><input type="text" name="circlename" id="circlename" class="txt" value="<?php echo $_GET['circlename'];?>" /></td>
          <th><label><?php echo $lang['nc_sort'];?></label></th>
          <td>
            <select name="searchsort">
              <option value=""><?php echo $lang['nc_common_pselect'];?></option>
              <option value="1"><?php echo $lang['circle_member_sort_theme_desc'];?></option>
              <option value="2"><?php echo $lang['circle_member_sort_reply_desc'];?></option>
            </select>
          </td>
          <th><label><?php echo $lang['nc_recommend'];?></label></th>
          <td><select name="searchrecommend">
              <option value=""><?php echo $lang['nc_common_pselect'];?></option>
              <option value="1" <?php if ($_GET['searchrecommend'] == '1'){echo 'selected=selected';}?>><?php echo $lang['nc_yes'];?></option>
              <option value="0" <?php if ($_GET['searchrecommend'] == '0'){echo 'selected=selected';}?>><?php echo $lang['nc_no'];?></option>
            </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5><?php echo $lang['nc_prompts'];?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
          <ul>
            <li><?php echo $lang['circle_member_prompts_one'];?></li>
            <li><?php echo $lang['circle_member_prompts_two'];?></li>
            <li><?php echo $lang['circle_member_prompts_three'];?></li>
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="member_form" name="member_form">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="submit_type" id="submit_type" value="" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th><th></th>
          <th><?php echo $lang['circle_member_name'];?></th>
          <th><?php echo $lang['circle_belong_to_circle'];?></th>
          <th class="align-center"><?php echo $lang['circle_member_theme_count'];?></th>
          <th class="align-center"><?php echo $lang['circle_member_reply_count'];?></th>
          <th class="align-center"></th>
          <th class="align-center"><?php echo $lang['circle_member_lastspeak_time'];?></th>
          <th class="align-center"><?php echo $lang['circle_no_speak'];?></th>
          <th class="align-center"><?php echo $lang['nc_recommend'];?></th>
          <th class="align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['member_list'])){ ?>
        <?php foreach($output['member_list'] as $val){ ?>
        <tr class="hover edit member">
          <td class="w24"><input type="checkbox" name="check_param[]" value="<?php echo $val['member_id'];?>|<?php echo $val['circle_id'];?>" class="checkitem"></td>
          <td class="w48 picture"><div class="size-44x44"><img src="<?php echo getMemberAvatarForCircle($val['member_avatar']);?>" class="size-44x44"/></div></td>
          <td><p><strong><?php echo $val['member_name'];?></strong></p></td>
          <td><p class="name"><strong><?php echo $val['circle_name'];?></strong>(<?php switch (intval($val['is_identity'])){
          	case 1:
          		echo L('circle_member_identity_master');
          		break;
          	case 2:
          		echo L('circle_member_identity_manager');
          		break;
          	case 3:
          		echo L('circle_member_identity_member');
          		break;
          }?>)<p class="smallfont"><?php echo $lang['circle_member_join_time'];?><?php echo @date('Y-m-d H:i', $val['cm_applytime']);?><p></p></td>
          <td class="align-center"><?php echo $val['cm_thcount'];?></td>
          <td class="align-center"><?php echo $val['cm_comcount'];?></td>
          <td class="align-center"></td>
          <td class="w150 align-center"><?php echo @date('Y-m-d H:i', $val['cm_lastspeaktime']);?></td>
          <td class="align-center"><?php if($val['is_allowspeak'] == '1'){echo L('circle_allow');}else{echo L('circle_prohibit');}?></td>
          <td class="align-center yes-onoff">
            <a href="JavaScript:void(0);" class="tooltip <?php echo $val['is_recommend']? 'enabled':'disabled'?>" ajax_branch='recommend' nc_type="inline_edit" fieldname="is_recommend" fieldid="<?php echo $val['member_id'].'|'.$val['circle_id'];?>" fieldvalue="<?php echo $val['is_recommend'];?>" title="<?php echo $val['is_recommend'] ? L('nc_yes') : L('nc_no');?>"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif"></a>
          </td>
          <td class="w72"><a href="javascript:void(0);" onclick="if(confirm('<?php echo L('circle_member_del_confirm');?>')){location.href='index.php?act=circle_member&op=member_del&param=<?php echo $val['member_id']?>|<?php echo $val['circle_id'];?>';}else{return false;}"><?php echo $lang['nc_del'];?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="20"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['member_list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall_2"><?php echo $lang['nc_select_all'];?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['circle_member_del_confirm'];?>')){$('#submit_type').val('batchdel');$('#member_form').submit();}"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"><?php echo $output['show_page'];?></div>
            </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>  
