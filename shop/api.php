<?php
/**
 * 入口文件
 *
 * 统一入口，进行初始化信息
 * 
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net/
 * @link       http://www.shopnc.net/
 * @since      File available since Release v1.1
 */
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
require_once(dirname(dirname(__FILE__)).'/global.php');
session_save_path(BASE_DATA_PATH.DS.'session');
require_once(BASE_DATA_PATH.DS.'config/config.ini.php');
if(!empty($config) && is_array($config)){
	$site_url = $config['shop_site_url'];
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
	$lang_type = $config['lang_type'];
	$cookie_pre = $config['cookie_pre'];
}
if($_GET['act'] == 'adv'){

	define('ATTACH_ADV','shop/adv');
	define('SHOP_SITE_URL',$site_url);
	$advshow_classfile = BASE_PATH.DS.'control/adv.php';
	if(is_file($advshow_classfile)){
		include_once ($advshow_classfile);
		$advshow = new advControl();
		$advshow->advshowOp();
	}else{
		echo "Adv System Inner Error!";
	}

}elseif ($_GET['act'] == 'toqq'){
	define('SHOP_SITE_URL',$site_url);
	if ($_GET['op'] == 'g'){
		include 'api/qq/oauth/qq_callback.php';
	}else{
		include 'api/qq/oauth/qq_login.php';
	}
}elseif ($_GET['act'] == 'tosina'){
	define('SHOP_SITE_URL',$site_url);
	if ($_GET['op'] == 'g'){
		include 'api/sina/callback.php';
	}else{
		include 'api/sina/index.php';
	}	
}elseif ($_GET['act'] == 'get_session'){
	session_start();
	$key = $_GET['key'];
	$val = '';
	if (!empty($_SESSION[$key])) $val = $_SESSION[$key];
	echo $val;
	exit;
}elseif ($_GET['act'] == 'sharebind'){
	define('SHOP_SITE_URL',$site_url);
	if($_GET['type'] == 'qqzone'){
		include 'api/snsapi/qqzone/oauth/qq_login.php';
	}elseif ($_GET['type'] == 'sinaweibo'){
		include 'api/snsapi/sinaweibo/index.php';
	}elseif ($_GET['type'] == 'qqweibo'){
		include 'api/snsapi/qqweibo/index.php';
	}elseif ($_GET['type'] == 'renren'){
		include 'api/snsapi/renren/index.php';
	}
}