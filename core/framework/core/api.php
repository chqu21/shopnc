<?php
/**
 * API核心文件
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
final class Base{

	public static function initialize(){

		if (!@include(BASE_DATA_PATH.'/config/config.ini.php')) exit('config.ini.php isn\'t exists!');
		if (!@include(BASE_CORE_PATH.'/framework/function/core.php')) exit('core.php isn\'t exists!');
		if (!@include(BASE_CORE_PATH.'/framework/core/model.php')) exit('model.php isn\'t exists!');
		if (!@include(BASE_CORE_PATH.'/framework/cache/cache.php')) exit('cache.php isn\'t exists!');
		if (!@include(BASE_CORE_PATH.'/framework/db/'.$config['dbdriver'].'.php')) exit($config['dbdriver'].'.php isn\'t exists!');
		if (!@include(BASE_CORE_PATH.'/framework/libraries/log.php')) exit('log.php isn\'t exists!');
		global $setting_config;
		unset($config['debug']);//关掉DEBUG，也没引log类

		if(!empty($config) && is_array($config)){
			$site_url = $config['site_url'];
			$version = $config['version'];
			$setup_date = $config['setup_date'];
			$gip = $config['gip'];
			$dbtype = $config['dbdriver'];
			$dbcharset = $config['db'][1]['dbcharset'];
			$dbserver = $config['db'][1]['dbhost'];
			$dbserver_port = $config['db'][1]['dbport'];
			$dbname = $config['db'][1]['dbname'];
			$db_pre = $config['tablepre'];
			$dbuser = $config['db'][1]['dbuser'];
			$dbpasswd = $config['db'][1]['dbpwd'];
			$session_expire = $config['session_expire'];
			$lang_type = $config['lang_type'];
			$cookie_pre = $config['cookie_pre'];
			$tpl_name = $config['tpl_name'];
		}

		define('SiteUrl',$site_url);
		define('GZIP',$gip);
		define('CHARSET',$dbcharset);
		define('DBTYPE',$dbtype);
		define('SESSION_EXPIRE',$session_expire);
		define('LANG_TYPE',$lang_type);
		define('DBPRE',$dbname.'`.`'.$db_pre);
		define('MYSQL_RESULT_TYPE',1);//数据库的查询结果使用键值对应(不包含数字对应的内容)
		define('ATTACH_PATH','upload');
		define('ATTACH_COMMON',ATTACH_PATH.'/common');
		define('RESOURCE_SITE_URL',SiteUrl.'/resource');//资源路径 resource
		define('CORE_PATH',BASE_PATH.'/framework');

		self::getSetting($config,$setting_config);

		if(function_exists('date_default_timezone_set')){
			if (is_numeric($setting_config['time_zone'])){
				@date_default_timezone_set('Asia/Shanghai');
			}else{
				@date_default_timezone_set($setting_config['time_zone']);
			}
		}

		self::paramFliter();

		if (defined('GZIP') && GZIP == 1 && function_exists('ob_gzhandler')){
			ob_start('ob_gzhandler');
		}else {
			ob_start();
		}

	}
	/**
	 * 返回配置信息
	 *
	 * @return array
	 */
	private static function getSetting($config, & $setting_config){
		$nc_config = $config;
		if(is_array($nc_config['db']['slave']) && !empty($nc_config['db']['slave'])){
			$dbslave = $nc_config['db']['slave'];
			$sid     = array_rand($dbslave);
			$nc_config['db']['slave'] = $dbslave[$sid];
		}else{
			$nc_config['db']['slave'] = $nc_config['db'][1];
		}		
		$nc_config['db']['master'] = $nc_config['db'][1];
		$setting_config = $nc_config;

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
		$setting_config = array_merge_recursive($setting,$nc_config);
	}

	/**
	 * 对GET POST接收内容进行过滤
	 *
	 * @return bool
	 */
	private static function paramFliter(){
		$magic_quotes = get_magic_quotes_gpc();
		$_GET = $magic_quotes ? $_GET : self::getFliter($_GET);
		$_POST = $magic_quotes ? $_POST : self::getFliter($_POST);
	}

	/**
	 * 对接收内容进行过滤
	 *
	 * @param array $var 待过滤的数组
	 * @return array
	 */
	private static function getFliter($var){
		if (is_array($var)){
			foreach($var as $key => $val) $var[$key] = self::getFliter($val);
		}else {
			$var = addslashes($var);
		}
		return $var;
	}
}