<?php
/**
 * 任务计划执行入口
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2014 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */


define('InShopNC',true);

if (empty($_SERVER['argv'][1]) || empty($_SERVER['argv'][2])) exit('parameter error');

require(dirname(__FILE__).'/../../global.php');
if (!@include(BASE_CORE_PATH.'/shopnc.php')) exit('shopnc.php isn\'t exists!');

Base::init();

$file_name = strtolower($_SERVER['argv'][1]);

$method = $_SERVER['argv'][2].'Op';

if (!@include(dirname(__FILE__).'/include/'.$file_name.'.php')) exit($file_name.'.php isn\'t exists!');

$class_name = $file_name.'Control';
$cron = new $class_name();

if (method_exists($cron,$method)){
    $cron->$method();
}else{
    exit('method '.$method.' isn\'t exists');
}