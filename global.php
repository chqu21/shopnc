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

error_reporting(E_ALL & ~E_NOTICE);
define('BASE_ROOT_PATH',str_replace('\\','/',dirname(__FILE__)));
define('BASE_CORE_PATH',BASE_ROOT_PATH.'/core');
define('BASE_DATA_PATH',BASE_ROOT_PATH.'/data');

define('DS','/');
define('InShopNC',true);
define('StartTime',microtime(true));
define('TIMESTAMP',time());
define('DIR_SHOP','shop');
define('DIR_CIRCLE','circle');
define('DIR_ADMIN','admin');
define('DIR_API','api');

define('ATTACH_PATH','shop');
define('ATTACH_COMMON_PATH',ATTACH_PATH.'/common');
define('ATTACH_MEMBER_PATH',ATTACH_PATH.'/member');
define('ATTACH_COMMENT_PATH',ATTACH_PATH.'/comment');
define('ATTACH_STORE_PATH',ATTACH_PATH.'/store');
define('ATTACH_COUPON_PATH',ATTACH_PATH.'/coupon');
define('ATTACH_EVOUCHER_PATH',ATTACH_PATH.'/evoucher');
define('ATTACH_CLASS_PATH',ATTACH_PATH.'/class');
define('ATTACH_GROUPBUY_PATH',ATTACH_PATH.'/groupbuy');
define('ATTACH_ACTIVITY_PATH',ATTACH_PATH.'/activity');
define('ATTACH_QRCODE_PATH',ATTACH_PATH.'/qr_code');
define('ATTACH_CARD_PATH',ATTACH_PATH.'/card');
define('ATTACH_APPOINT_PATH',ATTACH_PATH.'/appointment');
define('ATTACH_GOODS_PATH',ATTACH_PATH.'/goods');
define('ATTACH_ADV_PATH',ATTACH_PATH.'/adv');
define('ATTACH_BRAND_PATH',ATTACH_PATH.'/brand');
define('ATTACH_ARTICLE_PATH',ATTACH_PATH.'/article');
define('ATTACH_GIFT_PATH',ATTACH_PATH.'/gift');
define('ATTACH_CIRCLE','circle');

define('TPL_SHOP_NAME','default');
define('TPL_CIRCLE_NAME', 'default');
define('TPL_ADMIN_NAME', 'default');


if(!file_exists(BASE_ROOT_PATH.'/install/lock')){
	@header("Location:install/index.php");
	exit;
}