<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 调用推荐位
 *
 * @param unknown_type $rec_id
 * @return string
 */
function rec_position($rec_id = null){
	if (!is_numeric($rec_id)) return null;
	$string = '';
	$file = BASE_DATA_PATH.'/cache/rec_position/'.$rec_id.'.php';
	if(file_exists($file)){
		$info = require($file);
	}else{
		$info = Model('adv_position')->where(array('ap_id'=>$rec_id,'is_use'=>1))->find();
		write_file($file,$info);
	}
	
	$string = '';
	if($info['ap_class'] == 1){
		//文字
		if(!empty($info['link'])){
			//链接
			$string = "<a href='{$info['link']}' target='_blank'>{$info['default_content']}</a>";	
		}else{
			$string = "{$info['default_content']}";
		}	
	}elseif($info['ap_class'] == 2){
		//图片
		if(!empty($info['link'])){
			$string = "<a href='{$info['link']}' target='_blank' style='cursor:pointer'><img src='".BASE_SITE_URL.'/data/upload/shop/adv/'.$info['default_content']."' width='".$info['ap_width']."' height='".$info['ap_height']."'></a>";
		}else{
			$string = "<img src='".BASE_SITE_URL.'/data/upload/shop/adv/'.$info['default_content']."' width='".$info['ap_width']."' height='".$info['ap_height']."'>";
		}
	}
	return $string;
}
?>