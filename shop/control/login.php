<?php
	class loginControl extends BaseHomeControl{
		public function __construct(){
			parent::__construct();
		}
		
		public function indexOp(){
			$this->loginOp();
		}

		public function loginOp(){
			//检测登陆
			$this->checklogin();

			if(isset($_POST) && !empty($_POST)){
				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST["member_name"],		"require"=>"true", "message"=>$lang['nc_login_username_is_not_null']),
					array("input"=>$_POST["password"],		"require"=>"true", "message"=>$lang['nc_login_password_is_not_null'])
				);
				$error = $obj_validate->validate();
				if ($error != ''){
					$this->showTip(Language::get('error').$error,'','html','error','','2000');
				}

				$params	=	array();
				$params['member_name']	=	trim($_POST['member_name']);
				$params['password']		=	md5($_POST['password']);

				$model	=	Model();
				$memberinfo	=	$model->table('member')->where($params)->find();
				if(empty($memberinfo)){
					$this->showTip(Language::get('nc_username_and_password_is_wrong'),'','html','error','','2000');
				}

				$_SESSION['is_login']	= '1';
				$_SESSION['member_id']	= $memberinfo['member_id'];
				$_SESSION['member_name']= $memberinfo['member_name'];
				$_SESSION['avatar']		= $memberinfo['avatar'];
				$_SESSION['store_id']	= $memberinfo['store_id'];
				$_SESSION['member_degree'] = $memberinfo['member_degree'];
				
				$model->table('member')->where(array('member_id'=>$memberinfo['member_id']))->update(array('login_time'=>time(),'login_num'=>$memberinfo['login_num']+1));
				//选择城市
				$area_id = $memberinfo['usercity'];
				$model_area = Model('area');
				$area_info = $model_area->getOne(array('area_id'=>$area_id));
				
				if(get_magic_quotes_gpc()){
					$area_str = serialize($area_info);
				}else{
					$area_str = addslashes(serialize($area_info));
				}
				
				setcookie('city',$area_str,time()+3600*24*30);
				
				$_POST['ref_url']	=	strstr($_POST['ref_url'],'logout')=== false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : 'index.php?act=index';

				if(!empty($_POST['ref_url'])){
					header('Location: '.$_POST['ref_url']);
					//$this->showTip(Language::get('nc_member_login_succ'),$_POST['ref_url'],'succ');
				}else{
					$this->showTip(Language::get('nc_member_login_fail'),'index.php?act=login','html','error');
				}		
			}
			Tpl::output('nchash',substr(md5(BASE_SITE_URL.$_GET['act'].$_GET['op']),0,8));
			if(empty($_GET['ref_url'])) $_GET['ref_url'] = getReferer();
			Tpl::output('banner',1);
			Tpl::showpage('login');
		}
		
		/*
		 * 注销
		 */
		public function logoutOp(){
			session_unset();
			session_destroy();
			setcookie("city", "", time()-3600);
			header('Location: index.php');
		}
		
		/*
		 * 注册
		 */
		public function registerOp(){
			//检测登陆
			$this->checklogin();

			if(isset($_POST) && !empty($_POST)){
				/**
				 * 注册验证
				 */	
				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST["member_name"],		"require"=>"true",	"message"=>$lang['nc_username_is_not_null']),
					array("input"=>$_POST["password"],			"require"=>"true",		"message"=>$lang['nc_password_is_not_null']),
					array("input"=>$_POST["password_confirm"],	"require"=>"true",	"validator"=>"Compare","operator"=>"==","to"=>$_POST["password"],"message"=>$lang['nc_password_not_same']),
					array("input"=>$_POST["email"],				"require"=>"true",		"validator"=>"email", "message"=>$lang['nc_email_invalid']),
					array("input"=>strtoupper($_POST["captcha"]),"require"=>"true","message"=>$lang['nc_captcha_is_not_null']),
					array("input"=>$_POST["agree"],			"require"=>"true", 		"message"=>$lang['nc_must_agree'])
				);
				$error = $obj_validate->validate();
				if ($error != ''){
					$this->showTip(Language::get('error').$error,'','html','error');
				}
				$model = Model();
				//检测用户名是否存在
				$memberinfo	= $model->table('member')->where(array('member_name'=>trim($_POST['member_name'])))->find();
				if(is_array($memberinfo) && !empty($memberinfo)){
					$this->showTip('该用户名已经存在','','html','error');
				}
				/**
				 * 会员添加
				 */
				$member_array	=	array();
				$member_array['member_name']	=	trim($_POST['member_name']);
				$member_array['password']		=	md5(trim($_POST['password']));
				$member_array['email']			=	trim($_POST['email']);
				$member_array['mobile']			=	trim($_POST['mobile']);
				$member_array['usercity']		= 	intval($_POST['city_id']);
				$member_array['register_time']  =   time();
				$member_array['member_degree']  =   1;
				$member_array['login_time']     =   time();
				$member_array['login_num']      =   1;				
				$member_id	=	$model->table('member')->insert($member_array,true);

				if($member_id){
					$member_more	=	array();
					$member_more['member_id']	=	$member_id;
					$state	=	$model->table('member_more')->insert($member_more,true);

					//会员信息
					$memberinfo	=	$model->table('member')->where(array('member_id'=>$member_id))->find();
					$_SESSION['is_login']	= '1';
					$_SESSION['member_id']	= $memberinfo['member_id'];
					$_SESSION['member_name']= $memberinfo['member_name'];
					$_SESSION['avatar']		= $memberinfo['avatar'];
					
					if($state){
						$this->showTip(Language::get('nc_register_succ'),'index.php?act=memberaccount','html','succ');
					}else{
						$this->showTip(Language::get('nc_register_fail'),'','html','error');
					}
				}else{
					$this->showTip(Language::get('nc_register_fail'),'','html','error');
				}
			}
			
			//城市列表
			$area_model = Model('area');
			$area = $area_model->getList(array('parent_area_id'=>'0','first_letter'=>'A'));
			Tpl::output('area',$area);
			
			Tpl::output('nchash',substr(md5(BASE_SITE_URL.$_GET['act'].$_GET['op']),0,8));
			Tpl::output('banner',1);
			Tpl::showpage('register');
		}


		public function check_memberOp(){
			$model	=	Model();
			$memberinfo	=	$model->table('member')->where(array('member_name'=>trim($_GET['member_name'])))->find();
			if(is_array($memberinfo) and count($memberinfo)>0) {
				if($_GET['option'] == 'forget'){
				    echo 'true';
				}else{
			         echo 'false';
				}
			} else {
			    if($_GET['option'] == 'forget'){
                     echo 'false';
                }else{
                     echo 'true';
                }				
			}
		}

		/**
		 * 电子邮箱检测
		 */
		public function check_emailOp() {
			$model	=	Model();
			if($_GET['option'] == 'forget'){
			     $memberinfo = $model->table('member')->where(array('member_name'=>trim($_GET['member_name']),'email'=>trim($_GET['email'])))->find();
			     if(is_array($memberinfo) && count($memberinfo)>0){
			         echo 'true';
			     }else{
			         echo 'false';
			     }
			}else{
    			$memberinfo   =   $model->table('member')->where(array('email'=>trim($_GET['email'])))->find();
                if(is_array($memberinfo) and count($memberinfo)>0) {
                    echo 'false';
                } else {
                    echo 'true';
                } 
			}
		}
		
		/**
		 * 忘记密码
		 * */
		public function forget_passwordOp(){
		    //检测登陆
            $this->checklogin();
		    if(isset($_POST) && !empty($_POST)){
		        $model = Model();
		        $code = md5(trim($_POST['member_name']).time());
		        $flag = $model->table('member')->where(array('member_name'=>trim($_POST['member_name'])))->update(array('email_code'=>$code));
		        $result = false;
                if($flag && $GLOBALS['setting_config']['email_enabled'] == '1'){
                    $email    = new Email();
                    $subject = $GLOBALS['setting_config']['site_name'].Language::get('nc_forget');
                    $rurl = BASE_SITE_URL.'/index.php?act=login&op=resetpassword&code='.$code;
                    $message = Language::get('nc_password_message_1').'<a href="'.$rurl.'" target="_blank">'.$rurl.'</a><br>'.Language::get('nc_password_message_2');
                    $message.= Language::get('nc_password_message_3').'【<a href="'.BASE_SITE_URL.'" target="_blank">'.$GLOBALS['setting_config']['site_name'].'</a>】';
                    $result = $email->send_sys_email(trim($_POST['email']),$subject,$message);
                }
                if($result){
                    $this->showTip(Language::get('nc_forget_up_submit'),'index.php?act=login','succ');
                }else{
                    $this->showTip(Language::get('nc_forget_up_fail'),'index.php?act=login&op=forget_password','html','error');
                }               	        
		    }
		    Tpl::output('banner',1);
            Tpl::showpage('forget_password');
		}
		
		/**
		 * 密码重置
		 * */
		public function resetpasswordOp(){
		    //检测登陆
            $this->checklogin();
            $model = Model();
            if(isset($_POST) && !empty($_POST)){
                if(isset($_POST['new_password']) && $_POST['new_password'] == $_POST['sure_password']){
                    if(isset($_SESSION['code']) && !empty($_SESSION['code'])){
                        $update = array();
                        $update['password'] = md5(trim($_POST['new_password']));
                        $update['email_code'] = md5($_SESSION['code']['member_name'].time());
                        $res = $model->table('member')->where(array('member_id'=>$_SESSION['code']['member_id']))->update($update);
                        if($res){
                            $this->showTip(Language::get('nc_url_had_succ'),'index.php?act=login','succ');
                        }else{
                            $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=login&op=forget_password','html','error');
                        }
                    }else{
                        $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=login&op=forget_password','html','error');
                    }
                }else{
                    $this->showTip(Language::get('nc_password_error'),'','html','error');
                }
            }
            $code = $_GET['code'];
            if($code == ''){
                $this->showTip(Language::get('nc_url_not_have_code'),'index.php?act=login&op=forget_password','html','error');
            }
            $member = $model->field('member_id,member_name,email_code')->table('member')->where(array('email_code'=>$code))->find();
            if(empty($member)){
                $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=login&op=forget_password','html','error');
            }
            $_SESSION['code'] = $member;
            Tpl::showpage('resetpassword');
		}
		
		/**
		 * ajax获取城市列表
		 */
		public function ajax_getcityOp(){
			//城市列表
			$area_model = Model('area');
			$area = $area_model->getList(array('parent_area_id'=>'0','first_letter'=>trim($_GET['letter'])));
			if(is_array($area) && !empty($area)){
				echo json_encode(array('done'=>true,'data'=>$area));
			}else{
				echo json_encode(array('done'=>false));
			}
		}
	}
?>