<?php
/**
 * 文件上传
 *
 * 
 *
 * @package    function
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @author	   ShopNC Team
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
/**
 * 产生验证码
 *
 * @param string $nchash 哈希数
 * @return string
 */
function makeSeccode($nchash){
	$seccode = random(6, 1);
	$seccodeunits = '';

	$s = sprintf('%04s', base_convert($seccode, 10, 23));
	$seccodeunits = 'ABCEFGHJKMPRTVXY2346789';
	if($seccodeunits) {
		$seccode = '';
		for($i = 0; $i < 4; $i++) {
			$unit = ord($s{$i});
			$seccode .= ($unit >= 0x30 && $unit <= 0x39) ? $seccodeunits[$unit - 0x30] : $seccodeunits[$unit - 0x57];
		}
	}
	setNcCookie('seccode'.$nchash, encrypt(strtoupper($seccode)."\t".(time())."\t".$nchash,MD5_KEY),31536000);
	return $seccode;
}

/**
 * 验证验证码
 *
 * @param string $nchash 哈希数
 * @param string $value 待验证值
 * @return boolean
 */
function checkSeccode($nchash,$value){
	list($checkvalue, $checktime, $checkidhash) = explode("\t", decrypt(cookie('seccode'.$nchash),MD5_KEY));
	return $checkvalue == strtoupper($value) && $checkidhash == $nchash;
}
?>