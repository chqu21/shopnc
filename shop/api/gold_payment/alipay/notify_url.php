<?php
/**
 * 支付宝通知地址
 *
 * 
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */

if (trim($_POST['extra_common_param']) == '2'){//积分兑换
	$_GET['act']	= 'payment';
}elseif (trim($_POST['extra_common_param']) == '3'){//预存款
	$_GET['act']	= 'memberpredeposit';
} else {
	exit;
}
$_GET['op']		= 'notify';
require_once(dirname(__FILE__).'/../../../index.php');
?>