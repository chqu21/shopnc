<?php
/**
 * API核心文件
 *
 * API核心初始化类允许继承
 *
 * @package    core
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class ShopNCBase{
	/**
	 * 站点配置信息
	 */
	public $setting_config = array();
	
	public function __construct(){
		if (!defined('SiteUrl')){//当没有定义过时执行(避免重复)
			try {
				if (file_exists(BASE_PATH.DS.'config.ini.php')){
					/**
					 * 包含配置信息
					 */
					require_once(BASE_PATH.DS.'config.ini.php');
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
//					define('DBSERVER',$dbserver);
//					define('DBSERVER_PORT',$dbserver_port);
//					define('DBNAME',$dbname);
//					define('DBUSER',$dbuser);
//					define('DBPASSWD',$dbpasswd);
					define('SESSION_EXPIRE',$session_expire);
					define('LANG_TYPE',$lang_type);
					define('DBPRE',$dbname.'`.`'.$db_pre);
					define('MYSQL_RESULT_TYPE',1);//数据库的查询结果使用键值对应(不包含数字对应的内容)
					/**
					 * 设置allow_url_open 允许使用
					 */
					ini_set("allow_url_fopen","1");
					/**
					 * 设置附件文件目录
					 */
					define('ATTACH_PATH','upload');
					define('ATTACH_COMMON',ATTACH_PATH.'/common');
					define('RESOURCE_SITE_URL',SiteUrl.'/resource');//资源路径 resource
					define('CORE_PATH',BASE_PATH.'/framework');
					$this->setting_config = $this->getSetting($config);
					/**
					 * 设置时区
					 */
					$this->setTimeZone($this->setting_config['time_zone']);
					/**
					 * 过滤
					 */
					$this->paramFliter();
					/**
					 * 启动gzip
					 */
					if (defined('GZIP') && GZIP == 1 && function_exists('ob_gzhandler')){
						ob_start('ob_gzhandler');
					}else {
						ob_start();
					}
				}else {
					$error = "config.ini.php isn't exists!";
					throw new Exception($error);
				}
			}catch (Exception $e){
				showMessage($e->getMessage(),'','exception');
			}
		}
		
	}
	/**
	 * 初始化数据库
	 * 
	 * @return bool 布尔类型的返回结果
	 */
	private function database(){
		try {
			if (file_exists(BASE_PATH.DS.'framework'.DS.'db'.DS.DBTYPE.'.php')){
				require_once(BASE_PATH.DS.'framework'.DS.'core'.DS.'db.php');
				require_once(BASE_PATH.DS.'framework'.DS.'core'.DS.'model.php');
				require_once(BASE_PATH.DS.'framework'.DS.'cache'.DS.'cache.php');
				require_once(BASE_PATH.DS.'framework'.DS.'db'.DS.DBTYPE.'.php');
				require_once(BASE_PATH.DS.'framework'.DS.'libraries'.DS.'log.php');
			}else {
				$error = "Base Error: db file isn't exists!";
				throw new Exception($error);
			}
		}catch (Exception $e){
			showMessage($e->getMessage(),'','exception');
		}
		return true;
	}
	/**
	 * 返回配置信息
	 *
	 * @return array
	 */
	public function getSetting($config){
		global $setting_config;
		$nc_config = $config;
		$nc_config['db']['read'] = $nc_config['db'][1];
		$nc_config['db']['write'] = $nc_config['db'][1];
		$setting_config = $nc_config;
		$this->database();
		if (empty($this->setting_config)){
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
			$this->setting_config = array_merge_recursive($setting,$nc_config);
		}
		$setting_config = $this->setting_config;
		return $this->setting_config;
	}
	/**
	 * 模型实例化入口
	 *
	 * @param string $model_name 模型名称
	 * @return obj 对象形式的返回结果
	 */
	public function getModel($model_name){
		return Model($model_name);
	}
	/**
	 * 对GET POST接收内容进行过滤
	 *
	 * @return bool
	 */
	public function paramFliter(){
		$magic_quotes = get_magic_quotes_gpc();
		$_GET = $magic_quotes ? $_GET : $this->getFliter($_GET);
		$_POST = $magic_quotes ? $_POST : $this->getFliter($_POST);
		return true;
	}

	/**
	 * 对接收内容进行过滤
	 *
	 * @param array $var 待过滤的数组
	 * @return array
	 */
	public function getFliter($var){
		if (is_array($var)){
			foreach($var as $key => $val) $var[$key] = $this->getFliter($val);
		}else {
			$var = addslashes($var);
		}
		return $var;
	}

	/**
	 * 设置时区
	 *
	 * @param int $time_zone 时区键值
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function setTimeZone($time_zone){
		$zonelist =	array(
		'-12' => 'Pacific/Kwajalein',
		'-11' => 'Pacific/Samoa',
		'-10' => 'US/Hawaii',
		'-9' => 'US/Alaska',
		'-8' => 'America/Tijuana',
		'-7' => 'US/Arizona',
		'-6' => 'America/Mexico_City',
		'-5' => 'America/Bogota',
		'-4' => 'America/Caracas',
		'-3.5' => 'Canada/Newfoundland',
		'-3' => 'America/Buenos_Aires',
		'-2' => 'Atlantic/St_Helena',
		'-1' => 'Atlantic/Azores',
		'0' => 'Europe/Dublin',
		'1' => 'Europe/Amsterdam',
		'2' => 'Africa/Cairo',
		'3' => 'Asia/Baghdad',
		'3.5' => 'Asia/Tehran',
		'4' => 'Asia/Baku',
		'4.5' => 'Asia/Kabul',
		'5' => 'Asia/Karachi',
		'5.5' => 'Asia/Calcutta',
		'5.75' => 'Asia/Katmandu',
		'6' => 'Asia/Almaty',
		'6.5' => 'Asia/Rangoon',
		'7' => 'Asia/Bangkok',
		'8' => 'Asia/Shanghai',
		'9' => 'Asia/Tokyo',
		'9.5' => 'Australia/Adelaide',
		'10' => 'Australia/Canberra',
		'11' => 'Asia/Magadan',
		'12' => 'Pacific/Auckland',
		);
		if(function_exists('date_default_timezone_set')){
			if (!empty($zonelist[$time_zone])){
				date_default_timezone_set($zonelist[$time_zone]);
			}else {
				date_default_timezone_set('Asia/Shanghai');
			}
		}
		return true;
	}
	
}