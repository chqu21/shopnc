<?php
	class sloginControl extends Control{
		public function __construct(){
			if(isset($_SESSION['store_id']) && $_SESSION['store_id']>0){
				header("Location:index.php?act=storesetting&op=dashboard");
				exit;
			}
			
			Language::read('common');
            language::read('home');
			Language::read('storelogin');
			
			/**
			 * 设置模板文件夹路径
			 */
			Tpl::setDir('member');
			/**
			 * 设置布局文件内容
			 */
			Tpl::setLayout('member_store_layout');
            //页面导航列表
            $nav_list = $this->nav_list();
            Tpl::output('nav_list',$nav_list);
			$this->layout	=	'member_store_msg';
			Tpl::output('sign','create_store');
		}

		public function indexOp(){
			$this->sloginOp();
		}
		
        /**
    	 * 页面导航列表
    	 */
       protected function nav_list(){
    		$nav_list = Model()->table('navigation')->select();
            return $nav_list;
    	}
		/*
		 * 商户登陆
		 */
		public function sloginOp(){
			if(isset($_POST) && !empty($_POST)){
				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
						array("input"=>$_POST["account"],"require"=>"true", "message"=>$lang['nc_store_login_account_is_not_null']),
						array("input"=>$_POST["password"],"require"=>"true", "message"=>$lang['nc_store_login_password_is_not_null'])
				);
					
				$error = $obj_validate->validate();
				if ($error != ''){
					$this->showTip(Language::get('error').$error,'','html','error');
				}
					
				$params	=	array();
				$params['account']	=	trim($_POST['account']);
				$params['password']	=	md5($_POST['password']);
				
				$model = Model();
				$store = $model->table('store')->where($params)->find();
				if(!empty($store)){			
					//待审核
					//if($store['is_audit'] == 1){
					//	$this->showTip(L('nc_store_login_store_audit_wait'),'','html','error');
					//	exit;
					//}
					
					//审核未通过
					if($store['is_audit'] == 3){
						$this->showTip(L('nc_store_login_store_audit_no'),'','html','error');
						exit;
					}
					
					if($store['store_state'] == 3){
						$this->showTip(L('nc_store_login_store_is_close'),'','html','error');
					}

					$_SESSION['store_id']	= $store['store_id'];
					$_SESSION['account']	= $store['account'];
					$_SESSION['store_avatar']     = $store['avatar'];
					$_SESSION['seller_login'] = 1;
					
					header("Location:index.php?act=storesetting&op=dashboard");
					exit;
					//$this->showTip(L('nc_store_login_login_succ'),'index.php?act=storesetting','succ');
				}else{
					$this->showTip(L('nc_store_login_login_fail'),'','html','error','','2000');
				}	
			}						
			Tpl::showpage('slogin','null_layout');
		}
		/*
		 * 注销
		 */
		public function logoutOp(){
			session_unset();
			session_destroy();
			header('Location: index.php?act=slogin');
		}

		/**
		 * 忘记密码
		 */
		public function forget_passwordOp(){
			if(isset($_POST) && !empty($_POST)){
				$model = Model();
				$store = $model->table('store')->where(array('account'=>trim($_POST['account']),'email'=>trim($_POST['email'])))->find();
				
				if(empty($store)){//验证是否存在
					$this->showTip(L('nc_member_store_account_email_is_wrong'),'index.php?act=slogin','succ');
				}

		        $code = md5(trim($_POST['account']).time());
		        $flag = $model->table('store')->where(array('account'=>trim($_POST['account'])))->update(array('email_code'=>$code));
		        $result = false;
                if($flag && $GLOBALS['setting_config']['email_enabled'] == '1'){
                    $email    = new Email();
                    $subject = $GLOBALS['setting_config']['site_name'].Language::get('nc_forget');
                    $rurl = BASE_SITE_URL.'/index.php?act=slogin&op=resetpassword&code='.$code;
                    $message = Language::get('nc_password_message_1').'<a href="'.$rurl.'" target="_blank">'.$rurl.'</a><br>'.Language::get('nc_password_message_2');
                    $message.= Language::get('nc_password_message_3').'【<a href="'.BASE_SITE_URL.'" target="_blank">'.$GLOBALS['setting_config']['site_name'].'</a>】';
                    $result = $email->send_sys_email(trim($_POST['email']),$subject,$message);
                }
                if($result){
                    $this->showTip(Language::get('nc_forget_up_submit'),'index.php?act=slogin','succ');
                }else{
                    $this->showTip(Language::get('nc_forget_up_fail'),'index.php?act=slogin&op=forget_password','html','error');
                }  
			}
			
			Tpl::output('sign','forget_password');
			Tpl::showpage('sforget_password');
		}


		/**
		 * 上传图片
		 */
		public function upload_pic(){	
			$upload = new UploadFile();
			$uploaddir = ATTACH_STORE_PATH;
			$upload->set('default_dir',$uploaddir);
			$upload->set('thumb_width',	'218');
			$upload->set('thumb_height','200');
			$upload->set('thumb_ext',	'_small');

			if (!empty($_FILES['pic']['name'])){
				$result = $upload->upfile('pic');
				if($result){
					return array('state'=>'true','name'=>$upload->thumb_image);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}
			}else{
				return array('state'=>'false','name'=>L('nc_upload_fail'));
			}
		}

		/**
		 * ajax获取城市
		 *
		 */
		public function ajaxOp(){
			//获得请求类型
			$type	=	trim($_GET['type']);
			if(empty($type)){
				echo 'false';exit;
			}
			
			if($type == 'area'){
				//区域ajax请求
				$area_id = intval($_GET['area_id']);
				if(empty($area_id)){
					echo 'false';exit;
				}
				$condition		= array();
				$condition['parent_area_id']	= $area_id;
				$area_model = Model('area');
				$area_list	= $area_model->getList($condition);
				if(!empty($area_list)){
					echo json_encode($area_list);
				}else{
					echo 'false';
				}
			}elseif($type == 'class'){
				//分类ajax请求
				$class_id = intval($_GET['class_id']);
				if(empty($class_id)){
					echo 'false';exit;
				}
				$condition		= array();
				$condition['parent_class_id']	= $class_id;
				$store_class_model = Model('store_class');
				$class_list  = $store_class_model->getList($condition);
				if(!empty($class_list)){
					echo json_encode($class_list);
				}else{
					echo 'false';
				}
			}else{
				echo 'false';
			}
			exit;
		}


		/**
		 * 密码重置
		 * */
		public function resetpasswordOp(){
		    //检测登陆
            //$this->checklogin();
            $model = Model();
            if(isset($_POST) && !empty($_POST)){
                if(isset($_POST['new_password']) && $_POST['new_password'] == $_POST['sure_password']){
                    if(isset($_SESSION['code']) && !empty($_SESSION['code'])){
                        $update = array();
                        $update['password'] = md5(trim($_POST['new_password']));
                        $update['email_code'] = md5($_SESSION['code']['store_name'].time());
                        $res = $model->table('store')->where(array('store_id'=>$_SESSION['code']['store_id']))->update($update);
                        if($res){
                            $this->showTip(Language::get('nc_url_had_succ'),'index.php?act=slogin','succ');
                        }else{
                            $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=slogin&op=forget_password','html','error');
                        }
                    }else{
                        $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=slogin&op=forget_password','html','error');
                    }
                }else{
                    $this->showTip(Language::get('nc_password_error'),'','html','error');
                }
            }
            $code = $_GET['code'];
            if($code == ''){
                $this->showTip(Language::get('nc_url_not_have_code'),'index.php?act=slogin&op=forget_password','html','error');
            }
            $store = $model->table('store')->where(array('email_code'=>$code))->find();

            if(empty($store)){
                $this->showTip(Language::get('nc_url_had_fail'),'index.php?act=slogin&op=forget_password','html','error');
            }
            $_SESSION['code'] = $store;
			Tpl::output('sign','confirm_password');
            Tpl::showpage('sresetpassword');
		}
	}
?>