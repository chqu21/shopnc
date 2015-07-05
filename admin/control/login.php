<?php
/**
 * 登录
 *
 * 包括 登录 验证 退出 操作
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class LoginControl extends SystemControl {

	/**
	 * 不进行父类的登录验证，所以增加构造方法重写了父类的构造方法
	 */
	public function __construct(){
		import('function.seccode');
		Language::read('common,layout,login');
		if (isset($_POST) && !empty($_POST)){
			//登录验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
			array("input"=>$_POST["user_name"],		"require"=>"true", "message"=>L('login_index_username_null')),
			array("input"=>$_POST["password"],		"require"=>"true", "message"=>L('login_index_password_null')),
			array("input"=>$_POST["captcha"],		"require"=>"true", "message"=>L('login_index_checkcode_null')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage(L('error').$error,'','error');
			}else {
				if (!checkSeccode($_POST['nchash'],$_POST['captcha'])){
					showMessage(L('login_index_checkcode_wrong').$error);
				}
				$model = Model();
				$array	= array();
				$array['admin_name']	= trim($_POST['user_name']);
				$array['admin_password']= md5(trim($_POST['password']));
				$admin_info = $model->table('admin')->where($array)->find();

				if(is_array($admin_info) and !empty($admin_info)) {

					$this->systemSetKey(array('name'=>$admin_info['admin_name'], 'id'=>$admin_info['admin_id']));
					$update_info	= array(
						'admin_login_num'=>($admin_info['admin_login_num']+1),
						'admin_login_time'=>TIMESTAMP
					);
					$model->table('admin')->where(array('admin_id'=>$admin_info['admin_id']))->update($update_info);
					$_SESSION['admin_login'] = 1;
					@header('Location: index.php');exit;
				}else {
					showMessage(L('login_index_username_password_wrong'),'index.php?act=login&op=login','error');
				}
			}
		}

		Tpl::output('nchash',substr(md5(ADMIN_SITE_URL.$_GET['act'].$_GET['op']),0,8));
		Tpl::output('html_title',$lang['login_index_manage_login']);
		Tpl::showpage('login','login_layout');
	}
	public function loginOp(){}
	public function indexOp(){}
}