<?php
/**
 * 运行框架
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net/
 * @link       http://www.shopnc.net/
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */

defined('InShopNC') or exit('Access Invalid!');
if (!@include(BASE_DATA_PATH.'/config/config.ini.php')) exit('config.ini.php isn\'t exists!');
global $config;
$sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
$tmp_array = explode('/',$sitepath);
$lastdir = end($tmp_array);
if (in_array($lastdir,array(DIR_CMS,DIR_SHOP,DIR_MICROSHOP,DIR_CIRCLE,DIR_ADMIN,DIR_API))){
	unset($tmp_array[count($tmp_array)-1]);
}
$auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].implode('/',$tmp_array));
define('BASE_SITE_URL', !empty($config['base_site_url']) ? rtrim($config['base_site_url'],'/') : $auto_site_url);
define('SHOP_SITE_URL', !empty($config['shop_site_url']) ? rtrim($config['shop_site_url'],'/') : $auto_site_url.'/'.DIR_SHOP);
define('CIRCLE_SITE_URL', !empty($config['circle_site_url']) ? rtrim($config['circle_site_url'],'/') : $auto_site_url.'/'.DIR_CIRCLE);
define('ADMIN_SITE_URL', !empty($config['admin_site_url']) ? rtrim($config['admin_site_url'],'/') : $auto_site_url.'/'.DIR_ADMIN);
define('API_SITE_URL', (!empty($config['base_site_url']) ? rtrim($config['base_site_url'],'/') : $auto_site_url).'/'.DIR_API);
define('UPLOAD_SITE_URL',!empty($config['upload_site_url']) ? rtrim($config['upload_site_url'],'/') : $auto_site_url.'/data/upload');
define('RESOURCE_SITE_URL',(!empty($config['base_site_url']) ? rtrim($config['base_site_url'],'/') : $auto_site_url).'/data/resource');
define('CACHE_SITE_URL',(!empty($config['base_site_url']) ? rtrim($config['base_site_url'],'/') : $auto_site_url).'/data/cache');
define('TEMPLATE_SITE_URL',SHOP_SITE_URL.DS.'templates'.DS.TPL_SHOP_NAME);

define('BASE_DATA_PATH',BASE_ROOT_PATH.'/data');
define('BASE_UPLOAD_PATH',BASE_DATA_PATH.'/upload');
define('BASE_RESOURCE_PATH',BASE_DATA_PATH.'/resource');
define('BASE_CACHE_PATH',BASE_DATA_PATH.'/cache');

define('CHARSET',$config['db'][1]['dbcharset']);
define('DBDRIVER',$config['dbdriver']);
define('SESSION_EXPIRE',$config['session_expire']);
define('LANG_TYPE',$config['lang_type']);
define('COOKIE_PRE',$config['cookie_pre']);
define('DBPRE',($config['db'][1]['dbname']).'`.`'.($config['tablepre']));

//统一ACTION
$_GET['act'] = $_GET['act'] ? strtolower($_GET['act']) : ($_POST['act'] ? strtolower($_POST['act']) : null);
$_GET['op'] = $_GET['op'] ? strtolower($_GET['op']) : ($_POST['op'] ? strtolower($_POST['op']) : null);
$_GET['act'] = preg_match('/^[\w]+$/i',$_GET['act']) ? $_GET['act'] : 'index';
$_GET['op'] = preg_match('/^[\w]+$/i',$_GET['op']) ? $_GET['op'] : 'index';

//对GET POST接收内容进行过滤,$ignore内的下标不被过滤
$ignore = array('article_content','pgoods_body','doc_content','content','sn_content','goods_body','store_description','input_group_intro','remind_content','note_content','ref_url','adv_pic_url','adv_word_url','adv_slide_url','appcode');
if (!class_exists('Security')) require(BASE_CORE_PATH.'/framework/libraries/security.php');
$_GET = !empty($_GET) ? Security::getAddslashesForInput($_GET,$ignore) : array();
$_POST = !empty($_POST) ? Security::getAddslashesForInput($_POST,$ignore) : array();
$_REQUEST = !empty($_REQUEST) ? Security::getAddslashesForInput($_REQUEST,$ignore) : array();


//启用ZIP压缩
if ($config['gzip'] == 1 && function_exists('ob_gzhandler') && $_GET['inajax'] != 1){
	ob_start('ob_gzhandler');
}else {
	ob_start();
}

require(BASE_CORE_PATH.'/framework/function/core.php');
require(BASE_CORE_PATH.'/framework/core/base.php');
require(BASE_CORE_PATH.'/framework/function/goods.php');
?>