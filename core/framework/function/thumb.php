<?php

defined('InShopNC') or exit('Access Invalid!');

function get_height($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}

function get_width($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

function resize_thumb($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	if (C('thumb.cut_type') == 'im'){
		$exec_str = rtrim(C('thumb.impath'),'/').'/convert -quality 90 -crop '.$width.'x'.$height.'+'.$start_width.'+'.$start_height.' -resize '.$newImageWidth.'x'.$newImageHeight.' '.$image.' '.$thumb_image_name;
		exec($exec_str);
	}else{
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$thumb_image_name); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
	    }		
	}
	return $thumb_image_name;
}
?>