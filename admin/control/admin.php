<?php
/**
 * 管理员管理
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

class adminControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('setting');
	}
	/**
	 * 管理员列表
	 */
	public function admin_listOp(){
		$model		= Model();
		$adminlist	=	$model->table('admin')->select();
		Tpl::output('list',$adminlist);
		Tpl::output('page',$model->showpage());
		Tpl::showpage('admin.index');
	}
	
	/**
	 * 管理员添加
	 */
	public function admin_addOp(){
		/**
		 * 保存
		 */
		if (isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['admin_name']),"require"=>"true","message"=>Language::get('nc_admin_admin_name_is_not_null')),
				array("input"=>trim($_POST['admin_password']),"require"=>"true","message"=>Language::get('nc_admin_admin_password_is_not_null'))
			);
				
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','error');
			}
			$params			=	array();
			$params['admin_name']		= trim($_POST['admin_name']);
			$params['admin_password']	= md5(trim($_POST['admin_password']));	
			$model	= Model();
			$result	= $model->table('admin')->insert($params);
			if($result){
				$this->showTip(Language::get('nc_admin_add_account_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_add_account_fail'));
			}
		}
		Tpl::showpage('admin.add');
	}

	/**
	 * 管理员编辑
	 */
	public function admin_editOp(){
		/**
		 * 保存
		 */
		if (isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['admin_password']),"require"=>"true","message"=>Language::get('nc_admin_admin_password_is_not_null')),
				array("input"=>trim($_POST['admin_confirm_password']),"require"=>"true","message"=>Language::get('nc_admin_password_confirm_is_not_null'))
			);
				
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','error');
			}

			$condition		= array();
			$condition['admin_id']	= intval($_POST['admin_id']);

			$params			= array();
			$params['admin_password']	= md5(trim($_POST['admin_password']));

			$model	= Model();
			$result	= $model->table('admin')->where($condition)->update($params);
			if($result){
				$this->showTip(Language::get('nc_admin_edit_account_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_edit_account_fail'));
			}
		}
		$admin_id	= intval($_GET['admin_id']);
		$model		= Model();
		$admininfo	= $model->table('admin')->where(array('admin_id'=>$admin_id))->find();
		if(empty($admininfo)){
			$this->showTip(Language::get('nc_admin_add_account_succ'));
		}
		Tpl::output('admininfo',$admininfo);
		Tpl::showpage('admin.edit');
	}


	/**
	 * 管理员删除
	 */
	public function admin_delOp(){
		if(isset($_GET['admin_id']) && !empty($_GET['admin_id'])){
			$admin_id	=	intval($_GET['admin_id']);
			$model = Model();
			$result = $model->table('admin')->where(array('admin_id'=>$admin_id))->delete();

			if($result){
				$this->showTip(Language::get('nc_admin_del_account_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_del_account_fail'));
			}
		}

		if(isset($_POST['del_id']) && !empty($_POST['del_id'])){
			$condition				= array();
			$condition['admin_id']	= array('in',implode(',',$_POST['del_id']));

			$model	= Model();
			$result	= $model->table('admin')->where($condition)->delete();
			
			if($result){
				$this->showTip(Language::get('nc_admin_del_account_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_del_account_fail'));
			}
		}else{
			$this->showTip(Language::get('nc_admin_del_selected'));
		}
		
	}


	/**
	 * 检测管理账号是否存在
	 */
	public function check_admin_nameOp(){
		$admin_name	=	trim($_POST['admin_name']);
		$model	=	Model();
		$admininfo = $model->table('admin')->where(array('admin_name'=>$admin_name))->find();
		
		if(!empty($admininfo)){
			echo 'false';
		}else{
			echo 'true';
		}
		exit;
	}
}
