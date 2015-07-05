<?php
/**
 * 前台登录 退出操作
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class loginControl extends BaseCircleControl {

	public function __construct(){
		parent::__construct();
		Language::read("login_index");
		require_once(BASE_PATH.'/framework/function/client.php');
	}

	/**
	 * 登录操作
	 *
	 */
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
				$this->showTip(Language::get('error').$error,'','error');
			}
	
			$params	=	array();
			$params['member_name']	=	trim($_POST['member_name']);
			$params['password']		=	md5($_POST['password']);
	
			$model	=	Model();
			$memberinfo	=	$model->table('member')->where($params)->find();
			if(empty($memberinfo)){
				$this->showTip(Language::get('login_index_login_again'),'','error');
			}
	
			$_SESSION['is_login']	= '1';
			$_SESSION['member_id']	= $memberinfo['member_id'];
			$_SESSION['member_name']= $memberinfo['member_name'];
			$_SESSION['avatar']		= $memberinfo['avatar'];
			$_SESSION['store_id']	= $memberinfo['store_id'];
	
			$model->table('member')->where(array('member_id'=>$memberinfo['member_id']))->setInc('login_num',1);
			//选择城市
			$area_id = $memberinfo['usercity'];
			$model_area = Model('area');
			$area_info = $model_area->getOne(array('area_id'=>$area_id));
	
			if(get_magic_quotes_gpc()){
				$area_str = serialize($area_info);
			}else{
				$area_str = serialize(@addslashes($area_info));
			}
	
			setCookie('city',$area_str);
	
			$_POST['ref_url']	=	strstr($_POST['ref_url'],'logout')=== false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : 'index.php?act=index';
	
			if ($_GET['inajax'] == 1){
				showDialog(Language::get('login_index_login_success'),'reload',succ);
			}
			
			if(!empty($_POST['ref_url'])){
				$this->showTip(Language::get('login_index_login_success'),$_POST['ref_url'],'succ');
			}else{
				$this->showTip(Language::get('login_index_login_again'),'index.php?act=login','error');
			}
		}
			
		if(empty($_GET['ref_url'])) $_GET['ref_url'] = getReferer();
		Tpl::output('banner',1);
		Tpl::showpage('login');
	}

	public function loginoutOp(){
		session_unset();
		session_destroy();
		showDialog(L('login_logout_success'),'','succ');
	}

}