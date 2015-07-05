<?php
/**
 * 系统后台公共方法
 *
 * 包括系统后台父类
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class SystemControl{

	/**
	 * 管理员资料
	 */
	private $admin_info;
	protected $layout	=	null;
	protected function __construct(){
		Language::read('common,layout');
		$this->layout	= 'msg_layout';
		/**
		 * 验证用户是否登录
		 * $admin_info 管理员资料 name id
		 */

		$this->admin_info = $this->systemLogin();
	}

	/**
	 * 取得当前管理员信息
	 *
	 * @param
	 * @return 数组类型的返回结果
	 */
	protected final function getAdminInfo(){
		return $this->admin_info;
	}

	protected function showTip($msg,$url='',$show_type='html',$msg_type='succ',$is_show=1,$time=2000){
		/**
		 * 如果默认为空，则跳转至上一步链接
		 */
		$url = ($url!='' ? $url : getReferer());

		$msg_type = in_array($msg_type,array('succ','error')) ? $msg_type : 'error';
		if (is_array($url)){
			foreach ($url as $k => $v){
				$url[$k]['url'] = $v['url']?$v['url']:getReferer();
			}
		}
		/**
		 * 读取信息布局的语言包
		 */
		Language::read("msg");
		/**
		 * html输出形式
		 * 指定为指定项目目录下的error模板文件
		 */
		Tpl::setDir('');
		Tpl::output('html_title',Language::get('nc_html_title'));
		Tpl::output('msg',$msg);
		Tpl::output('url',$url);
		Tpl::output('msg_type',$msg_type);
		Tpl::output('is_show',$is_show);
		Tpl::showpage('msg',$this->layout,$time);
		exit;
	}
	/**
	 * 系统后台登录验证
	 *
	 * @param
	 * @return array 数组类型的返回结果
	 */
	protected final function systemLogin(){
		//取得cookie内容，解密，和系统匹配
		$user = unserialize(decrypt(cookie('sys_key'),MD5_KEY));
		if(empty($user)){
			@header('Location: index.php?act=login&op=login');exit;
		}else{
			$this->systemSetKey($user);
		}
		return $user;
	}

	/**
	 * 系统后台 会员登录后 将会员验证内容写入对应cookie中
	 *
	 * @param string $name 用户名
	 * @param int $id 用户ID
	 * @return bool 布尔类型的返回结果
	 */
	protected final function systemSetKey($user){
		setNcCookie('sys_key',encrypt(serialize($user),MD5_KEY),3600,'',null);
	}
}
