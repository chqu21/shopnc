<?php
defined('InShopNC') or exit('Access Invalid!');

/**
 * member login
 * @return	-1 用户名/密码 错误 -2 账号被停用 >0 用户ID
 */
function nc_member_login($user_name, $password) {
	$result =  nc_api_post('api_member', 'login', array('user_name'=>$user_name, 'password'=>$password));
	return nc_callback($result);
}

/**
 * get member info
 * @param $type uid/username
 * @return	array
 */
function nc_member_info($value, $type = 'uid'){
	$result = nc_api_post('api_member', 'info', array($type=>$value));
	return json_decode(nc_callback($result),true);
}

function nc_member_synlogin($member_id) {
	$return = nc_api_post('api_member', 'synlogin', array('uid'=>intval($member_id)));
	return $return;
}

function nc_member_synloginout($member_id) {
	$return = nc_api_post('api_member', 'synloginout', array('uid'=>intval($member_id)));
	return $return;
}

function nc_callback($data){
	return decrypt($data,APP_KEY);
}

function nc_api_post($act, $op, $arg = array()) {
	$s = $sep = '';
	foreach($arg as $k => $v) {
		$k = urlencode($k);
		if(is_array($v)) {
			$s2 = $sep2 = '';
			foreach($v as $k2 => $v2) {
				$k2 = urlencode($k2);
				$s2 .= "$sep2{$k}[$k2]=".urlencode($v2);
				$sep2 = '&';
			}
			$s .= $sep.$s2;
		} else {
			$s .= "$sep$k=".urlencode($v);
		}
		$sep = '&';
	}
	$postdata = nc_api_request_data($act, $op, $s);
	return nc_fopen(ltrim(API_SITE_URL,'/').'/', 500000, $postdata, '', TRUE, '', 20);
}

function nc_api_request_data($act, $op, $arg='') {
	$input = nc_api_input($arg);
	$post = "act=$act&op=$op&input=$input&appid=".APP_ID;
	return $post;
}
function nc_api_input($data) {
	$s = urlencode(encrypt($data.'&agent='.md5($_SERVER['HTTP_USER_AGENT'])."&time=".time(), APP_KEY));
	return $s;
}

function nc_fopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE) {
	$return = '';
	$matches = parse_url($url);
	!isset($matches['host']) && $matches['host'] = '';
	!isset($matches['path']) && $matches['path'] = '';
	!isset($matches['query']) && $matches['query'] = '';
	!isset($matches['port']) && $matches['port'] = '';
	$host = $matches['host'];
	$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
	$port = !empty($matches['port']) ? $matches['port'] : 80;
	if($post) {
		$out = "POST $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= 'Content-Length: '.strlen($post)."\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cache-Control: no-cache\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
		$out .= $post;
	} else {
		$out = "GET $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
	}

	if(function_exists('fsockopen')) {
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	} elseif (function_exists('pfsockopen')) {
		$fp = @pfsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	} else {
		$fp = false;
	}

	if(!$fp) {
		return '';
	} else {
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
		if(!$status['timed_out']) {
			while (!feof($fp)) {
				if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
					break;
				}
			}

			$stop = false;
			while(!feof($fp) && !$stop) {
				$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
				$return .= $data;
				if($limit) {
					$limit -= strlen($data);
					$stop = $limit <= 0;
				}
			}
		}
		@fclose($fp);
		return $return;
	}
}
?>