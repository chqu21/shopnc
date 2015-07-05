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
error_reporting(E_ALL & ~E_NOTICE);

if(!function_exists('fsockopen') && !function_exists('pfsockopen')) {
	exit(' function fsockopen isn\'t exists');
}

define('BASE_PATH',dirname(dirname(__FILE__)));

define('DS','/');

define('InShopNC',true);

if (!@include(dirname(__FILE__).'/apps.php')) exit('apps.php isn\'t exists!');
if (empty($nc_apps)) exit('apps.php error!');

@require(BASE_PATH.'/framework/function/core.php');
$synstr = "";
foreach ((array)$nc_apps as $name=>$app) {
	$synstr .= '<script type="text/javascript" src="'.$app['app_url'].'/nc_client/nc.php?time='.time().'&code='.urlencode(encrypt('action=test&name='.$name.'&time='.time(),$app['app_key'])).'"></script>';
}
echo $synstr;
?>