<?php
/**
 * 默认展示页面
 *
 * 默认展示页面
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class indexControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('indexs');
	}
	public function indexOp(){
		//输出管理员信息
		Tpl::output('admin_info',$this->getAdminInfo());
		Tpl::showpage('index','index_layout');
	}

	/**
	 * 退出
	 */
	public function logoutOp(){
		session_unset();
		session_destroy();
		setNcCookie('sys_key','',-1,'',null);
		@header("Location: index.php");
		exit;
	}

	

}
