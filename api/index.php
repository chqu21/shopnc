<?php
/**
 * nc_server 入口文件
 * 
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net/
 * @link       http://www.shopnc.net/
 * @since      File available since Release v1.1
 */

define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/shopnc.php')) exit('shopnc.php isn\'t exists!');
if (!@include(BASE_PATH.'/apps.php')) exit('apps.php isn\'t exists!');
if (!$current_app = $nc_apps[$_POST['appid']]) exit('config content error!');

global $nc_apps;

define('APP_KEY',$current_app['app_key']);

@header("Content-type: text/html; charset=".CHARSET);

$array = array('member','apps');

$act = $_POST['act'];
$op	= $_POST['op'];
if (!in_array($act,$array)) exit('Input Invalid!');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
Base::run();
//
//$class = new $control_name();
//if (method_exists($class,$function)){
//	echo nc_callback($class->$function());exit;
//}else{
//	exit('Input Invalid!');
//}
//
//
?>