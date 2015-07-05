<?php
/**
 * 商品图片统一调用函数
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
 * 取得商品缩略图的完整URL路径，接收商品信息数组，返回所需的商品缩略图的完整URL,该方法的返回地址受$config['thumb']['save_type']设置影响
 *
 * @param array $goods 商品信息数组
 * @param string $type 缩略图类型  值为tiny,small,mid,max
 * @return string
 */
function thumb($goods, $type = ''){
	if (!in_array($type,array('tiny','small','mid','max','240x240'))) $type = 'small';
	if (is_array($goods)){
		if (array_key_exists('goods_images',$goods)){
			$goods['goods_image'] = $goods['goods_images'];
		}elseif (array_key_exists('apic_cover',$goods)){
			$goods['goods_image'] = $goods['apic_cover'];
		}
		if (empty($goods['goods_image'])){
			return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
		}
		$a = explode('.',$goods['goods_image']);
		$ext = end($a);
		$file = str_ireplace(array('_tiny.'.$ext,'_small.'.$ext,'_mid.'.$ext,'_max.'.$ext,'_240x240.'.$ext),'',$goods['goods_image']);
		$fname = basename($file);
		
		//取店铺ID
		if (preg_match('/^(\d+_)/',$fname)){
			$store_id = substr($fname,0,strpos($fname,'_'));
		}else{
			$store_id = $goods['store_id'];
		}
		//取图片主机URL
		if (C('thumb.save_type')==1){
			//本地存储时，增加判断文件是否存在，用默认图代替
			if (!file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext))){
                if (file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.'_mid.'.$ext)){
                    $type = 'mid';
                } else {
                    return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
                }
            }
			$thumb_host = UPLOAD_SITE_URL.'/'.ATTACH_GOODS;
		}elseif (C('thumb.save_type')==2){
			//本地存储时，增加判断文件是否存在，用默认图代替，可跟据情况是否保留该判断
			if (!file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext))){
                if (file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.'_mid.'.$ext)){
                    $type = 'mid';
                } else {
                    return C('thumb_url').str_replace(ATTACH_PATH,'',defaultGoodsImage($type));
                }
            }
			$thumb_host = C('thumb_url').str_replace(ATTACH_PATH,'',ATTACH_GOODS);
		}else{
			$thumb_host =  C('thumb_url').'/'.ATTACH_GOODS;
		}
		return $thumb_host.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext);
	}
}
/**
 * 取得商品缩略图的完整URL路径，接收商品名称与店铺ID，返回所需的商品缩略图的完整URL,该方法的返回地址受$config['thumb']['save_type']设置影响
 *
 * @param string $file 商品名称
 * @param string $type 缩略图尺寸类型，值为tiny,small,mid,max
 * @param mixed $store_id 店铺ID 如果传入，则返回图片完整URL,如果为假，返回系统默认图
 * @return string
 */
function cthumb($file, $type = '',$store_id = false){
	if (!in_array($type,array('tiny','small','mid','max','240x240'))) $type = 'small';
	if (empty($file)){
		return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
	}
	$a = explode('.',$file);
	$ext = end($a);
	$file = str_ireplace(array('_tiny.'.$ext,'_small.'.$ext,'_mid.'.$ext,'_max.'.$ext,'_240x240.'.$ext),'',$file);
	$fname = basename($file);
	//取店铺ID
	if ($store_id === false){
		return $file.($type==''?'':'_'.$type.'.'.$ext);			
	}elseif (preg_match('/^(\d+_)/',$fname)){
		$store_id = substr($fname,0,strpos($fname,'_'));
	}
	//取图片主机URL
	if (C('thumb.save_type')==1){
		//本地存储时，增加判断文件是否存在，用默认图代替
        if (!is_numeric($store_id) || !file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext))){
            if (file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.'_mid.'.$ext)){
                $type = 'mid';
            } else {
                return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
            }
        }
		$thumb_host = UPLOAD_SITE_URL.'/'.ATTACH_GOODS;			
	}elseif (C('thumb.save_type')==2){
		//本地存储时，增加判断文件是否存在，用默认图代替，可跟据情况是否保留该判断
		if (!file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext))){
            if (file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file.'_mid.'.$ext)){
                $type = 'mid';
            } else {
                return C('thumb_url').str_replace(ATTACH_PATH,'',defaultGoodsImage($type));
            }
		}
		$thumb_host = C('thumb_url').str_replace(ATTACH_PATH,'',ATTACH_GOODS);
	}else{
		$thumb_host =  C('thumb_url').'/'.ATTACH_GOODS;
	}
	return $thumb_host.'/'.$store_id.'/'.$file.($type==''?'':'_'.$type.'.'.$ext);
}

/**
 * 取得团购缩略图的完整URL路径
 *
 * @param string $imgurl 商品名称
 * @param string $type 缩略图类型  值为small,mid,max
 * @return string
 */
function gthumb($imgurl = '', $type = ''){
	if (!in_array($type,array('small','mid','max'))) $type = 'small';
	if (empty($imgurl)){
		return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
	}
	$a = explode('.',$imgurl);
	$ext = end($a);
	$file = str_ireplace(array('_small.'.$ext,'_mid.'.$ext,'_max.'.$ext),'',$imgurl);
	$fname = basename($file);
	if (!file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GROUPBUY.'/'.$file.($type==''?'':'_'.$type.'.'.$ext))){
		if (BASE_UPLOAD_PATH.'/'.ATTACH_GROUPBUY.'/'.$file.'_small'.$ext){
			//向前兼容
			return UPLOAD_SITE_URL.'/'.ATTACH_GROUPBUY.'/'.$file.'_small.'.$ext;
		}else{
			//文件不存在用默认图代替
			return UPLOAD_SITE_URL.'/'.defaultGoodsImage($type);
		}
	}
	return UPLOAD_SITE_URL.'/'.ATTACH_GROUPBUY.'/'.$file.($type==''?'':'_'.$type.'.'.$ext);
}

/**
* 订单状态描述输出
*
* @param int	$state_code 状态标记
* @return string	$lang_string 描述输出
*/
function orderStateInfo($state_code,$refund_state=0) {
	$lang	= Language::getLangContent();	
	$lang_string	= '';
	$state_code		= intval($state_code);
	switch ($state_code) {
		case 0:
			$lang_string = $lang['has_been_canceled'];
			break;
		case 10:
			$lang_string = $lang['pending_payment'];
			break;
		case 11:
			$lang_string = $lang['pending_recive'];
			break;
		case 20:
			$lang_string = $lang['paid'];
			break;
		case 30:
			$lang_string = $lang['shipped'];
			break;
		case 40:
			$lang_string = $lang['completed'];
			if($refund_state == 2) $lang_string = $lang['refund_completed'];
			break;
    case 50:
      $lang_string = $lang['to_be_confirmed'];
      break;
    case 60:
      $lang_string = $lang['to_be_shipped'];
      break;
		default:
			$lang_string = $lang['completed'];
			break;
	}
	return $lang_string;
}

/**
 * 店铺信用等级
 * @param array $credit 信用信息
 * @return array
 */
function getCreditArr($credit){
	if ($GLOBALS['setting_config']['creditrule'] != ''){
		$credit_arr = unserialize($GLOBALS['setting_config']['creditrule']);
	}
	$max_credit = 0;
	if (!empty($credit_arr) && is_array($credit_arr)){
		foreach ($credit_arr as $k=>$v){
			if (!empty($v) && is_array($v)){
				foreach ($v as $son_k=>$son_v){
					if ($son_v[0]<=$credit && $son_v[1]>=$credit){
						return array('grade'=>$k,'songrade'=>$son_k);
					}
					//保存信用等级最大值
					$max_credit = $son_v[1];
				}
			}
		}
	}
	if ($credit > $max_credit){
		return array('grade'=>'crown','songrade'=>5);
	}
	return array();
}
?>
