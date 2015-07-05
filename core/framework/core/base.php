<?php
/**
 * 核心文件
 *
 * 核心初始化类，不允许继承
 *
 * @package    core
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
final class Base{

	const CPURL = '';

	/**
	 * 运行
	 */
	public static function run(){
			self::cp();
			spl_autoload_register(array('Base','autoload'));
			//配置信息	
			global $setting_config;
			self::parse_conf($setting_config);
			define('MD5_KEY',md5($setting_config['md5_key']));

			if(function_exists('date_default_timezone_set')){
				if (is_numeric($setting_config['time_zone'])){
					@date_default_timezone_set('Asia/Shanghai');
				}else{
					@date_default_timezone_set($setting_config['time_zone']);
				}				
			}

			//开始会话
			self::start_session();

			//输出到模板
			Tpl::output('setting_config',$setting_config);

			//执行 control
			self::control();
	}

	/**
	 * 取得配置信息
	 */
	private static function parse_conf(&$setting_config){
		$nc_config = $GLOBALS['config'];
		//处理从数据库配置
		if(is_array($nc_config['db']['slave']) && !empty($nc_config['db']['slave'])){
			//如果为读写分离模式则随机选择一台从数据库服务器
			$dbslave = $nc_config['db']['slave'];
			$sid     = array_rand($dbslave);
			$nc_config['db']['slave'] = $dbslave[$sid];
		}else{
			//否则从主数据库读
			$nc_config['db']['slave'] = $nc_config['db'][1];
		}

		//处理主数据库配置
		$nc_config['db']['master'] = $nc_config['db'][1];
		//该行必须在H函数使用之前
		$setting_config = $nc_config;
		//取得基本配置,此处只支持文件缓存
		$setting = ($setting = H('setting')) ? $setting : H('setting',true);
		if($nc_config['thumb']['save_type'] == 1){
			$nc_config['thumb_url'] = SiteUrl;	//使用Site_Url为兼容2.2
		}elseif ($nc_config['thumb']['save_type'] == 2 && preg_match("/^http:\/\/[\.\-\w]+/",$nc_config['thumb']['url'])){
			$nc_config['thumb_url'] = $nc_config['thumb']['url'];
		}elseif ($nc_config['thumb']['save_type'] == 3 && $setting['ftp_open']){
			$nc_config['thumb_url'] = $setting['ftp_access_url'];
		}else{
			$nc_config['thumb_url'] = SiteUrl;
		}
		if($nc_config['payment'] != 1) $setting['predeposit_isuse'] = 1;//支付到平台时强制开启预存款功能
		$setting['shopnc_version'] = '<span class="vol"><font class="b">Shop</font><font class="o">NC</font><em>2013</em></span>';

		$setting_config = array_merge_recursive($setting,$nc_config);
	}

	/**
	 * 控制器调度
	 *
	 */
	private static function control(){
		//二级域名
		if ($GLOBALS['setting_config']['enabled_subdomain'] == '1' && $_GET['act'] == 'index' && $_GET['op'] == 'index'){
			$store_id = subdomain();
			if ($store_id > 0) $_GET['act'] = 'store';
		}
		$act_file = realpath(BASE_PATH.'/control/'.$_GET['act'].'.php');

		if (is_file($act_file)){
			require($act_file);
			$class_name = $_GET['act'].'Control';
			if (class_exists($class_name)){
				$main = new $class_name();
				$function = $_GET['op'].'Op';

				if (method_exists($main,$function)){
					$main->$function();
				}elseif (method_exists($main,'indexOp')){
					$main->indexOp();
				}else {
					$error = "Base Error: function $function not in $class_name!";
					throw_exception($error);
				}
			}else {
				$error = "Base Error: class $class_name isn't exists!";
				throw_exception($error);
			}
		}else {
			$error = "Base Error: access file isn't exists!";
			throw_exception($error);
		}
	}

	/**
	 * 开启session
	 *
	 */
	private static function start_session(){
		if ($GLOBALS['setting_config']['subdomain_suffix']){
			$subdomain_suffix = $GLOBALS['setting_config']['subdomain_suffix'];
		}else{
			if (preg_match("/^[0-9.]+$/",$_SERVER['HTTP_HOST'])){
				$subdomain_suffix = $_SERVER['HTTP_HOST'];
			}else{
				$split_url = explode('.',$_SERVER['HTTP_HOST']);
				if($split_url[2] != '') unset($split_url[0]);
				$subdomain_suffix = implode('.',$split_url);
			}
		}

		//@ini_set('session.cookie_domain', $subdomain_suffix);

		//开启以下配置支持session信息存信memcache
		/*@ini_set("session.save_handler", "memcache");
		@ini_set("session.save_path", C('memcache.1.host').':'.C('memcache.1.port'));*/

		//默认以文件形式存储session信息
		session_save_path(BASE_DATA_PATH.'/session');
		session_start();
	}
	
	private static function autoload($class){
		$class = strtolower($class);
		if (ucwords(substr($class,-5)) == 'Class' ){
			if (!@include_once(BASE_PATH.'/class/'.substr($class,0,-5).'.class.php')){
				exit("Class Error: {$class}.isn't exists!");
			}
		}elseif (ucwords(substr($class,0,5)) == 'Cache' && $class != 'cache'){
			if (!@include_once(BASE_CORE_PATH.'/framework/cache/'.substr($class,0,5).'.'.substr($class,5).'.php')){
				exit("Class Error: {$class}.isn't exists!");
			}
		}elseif ($class == 'db'){
			if (!@include_once(BASE_CORE_PATH.'/framework/db/'.strtolower(DBDRIVER).'.php')){
				exit("Class Error: {$class}.isn't exists!");
			}
		}else{
			if (!@include_once(BASE_CORE_PATH.'/framework/libraries/'.$class.'.php')){
				exit("Class Error: {$class}.isn't exists!");
			}
		}
	}

	/**
	 * 合法性验证
	 *
	 */
	private static function cp(){
		if (self::CPURL == '') return;
		if (strpos(self::CPURL,'||') !== false){
			$a = explode('||',self::CPURL);
			foreach ($a as $v) {
				$d = strtolower(stristr($_SERVER['HTTP_HOST'],$v));
				if ($d == strtolower($v)){
					return;
				}else{
					continue;
				}
			}
			header('location: http://www.shopnc.net');exit();			
		}else{
			$d = strtolower(stristr($_SERVER['HTTP_HOST'],self::CPURL));
			if ($d != strtolower(self::CPURL)){
				header('location: http://www.shopnc.net');exit();
			}
		}
	}
}