<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="mdbox person-info">
        <div class="user-time" style="border-top:none; margin-top:0; padding-top:0;">
          <p><span class="col-exp">积分：</span><span id="J_col_exp"><?php echo $output['minfo']['member_point']; ?></span></p>
          <p><span class="col-exp">贡献值：</span><span id="J_col_exp"><?php echo $output['minfo']['member_contribution']; ?></span></p>
          <p><span class="col-exp">会员等级：</span><?php echo $output['minfo']['md_name']; ?></p>
          <p><span class="col-exp">注册时间：</span><?php echo $output['minfo']['register_time']>0?date('Y-m-d',$output['minfo']['register_time']):'未知'; ?></p>
          <p><span class="col-exp">最后登录：</span><?php echo $output['minfo']['login_time']>0?date('Y-m-d',$output['minfo']['login_time']):'未知'; ?></p>
        </div>
        <div class="user-about"> <em class="col-exp">简介：</em><?php echo $output['minfo']['introduce']; ?></div>
        <div class="user-message">
          <ul>
            <li><em class="col-exp">体型：</em>
			<?php switch ($output['minfo']['weight']){ 
				case 1:
					echo '保密';
					break;
				case 2:
					echo '小巧玲珑型';
					break;
				case 3:
					echo '魅力可乐型';
					break;
				case 4:
					echo '高挑优雅型';
					break;
				case 5:
					echo '可爱球型';
					break;
			}?>
			</li>
            <li><em class="col-exp">恋爱状况：</em>
			<?php switch ($output['minfo']['member_state']){ 
				case 1:
					echo '单身';
					break;
				case 2:
					echo '热恋';
					break;
				case 3:
					echo '已婚';
					break;
				case 4:
					echo '保密';
					break;
			}?>
			</li>
            <li><em class="col-exp">生日：</em><?php echo $output['minfo']['birthday']>0?date('Y-m-d',$output['minfo']['birthday']):'未知'; ?></li>
            <li><em class="col-exp">星座：</em>
            <?php switch ($output['minfo']['constellation']){ 
				case 1:
					echo '白羊座';
					break;
				case 2:
					echo '金牛座';
					break;
				case 3:
					echo '双子座';
					break;
				case 4:
					echo '巨蟹座';
					break;
				case 5:
					echo '狮子座';
					break;
				case 6:
					echo '处女座';
					break;
				case 7:
					echo '天秤座';
					break;
				case 8:
					echo '天蝎座';
					break;
				case 9:
					echo '射手座';
					break;
				case 10:
					echo '摩羯座';
					break;
				case 11:
					echo '水瓶座';
					break;
				case 12:
					echo '双鱼座';
					break;	
			}?></li>
          </ul>
          <ul class="message-list">
            <li><em class="col-exp">爱好：</em><?php echo $output['minfo']['hobby']; ?></li>
            <li><em class="col-exp">行业：</em><?php echo $output['minfo']['industry']; ?></li>
            <li><em class="col-exp">大学：</em><?php echo $output['minfo']['college']; ?></li>
            <li><em class="col-exp">QQ：</em><?php echo $output['minfo']['member_qq']; ?></li>
          </ul>
        </div>
      </div>