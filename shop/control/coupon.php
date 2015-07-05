<?php
/**
 * 本地生活
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class couponControl extends BaseHomeControl{
	public function __construct() {
		parent::__construct();
        Language::read('coupon');
        Tpl::output('index_sign','coupon');
    }
	
	public function indexOp(){
		$this->listOp();
	}
	/*
	 * 优惠券列表
	 */
	public function listOp(){
		//优惠券列表
		$model_coupon = Model('coupon');
		$coupon_condition	=	array();
		$coupon_condition['coupon.audit']		=	2;//2.审核通过
		$coupon_condition['coupon.city_id']		=	$this->city_info['area_id'];
		$coupon_condition['store.store_state']=	2;
		if(isset($_GET['area_id']) && !empty($_GET['area_id'])){
			//区域
			$coupon_condition['store.area_id'] = intval($_GET['area_id']);
			Tpl::output('area_id',intval($_GET['area_id']));
			if(isset($_GET['mall_id']) && !empty($_GET['mall_id'])){
				//商区
				$coupon_condition['store.mall_id'] = intval($_GET['mall_id']);
				Tpl::output('mall_id',intval($_GET['mall_id']));
			}
		}
		//商铺分类
		if(isset($_GET['class_id']) && !empty($_GET['class_id'])){
			$coupon_condition['store.class_id'] = intval($_GET['class_id']);
			Tpl::output('class_id',intval($_GET['class_id']));

			if(isset($_GET['class_id_1']) && !empty($_GET['class_id_1'])){
				$coupon_condition['store.s_class_id'] = intval($_GET['class_id_1']);
				Tpl::output('class_id_1',intval($_GET['class_id_1']));
			}
		}
		$coupon_condition['coupon.coupon_start_time']	=	array('lt',time());
		$coupon_condition['coupon.coupon_end_time']	=	array('gt',time());
		//排序
		$order = '';
		if($_GET['orderby'] != '' && $_GET['sort'] != ''){
			$order = $_GET['orderby'].' '.($_GET['sort']=='desc'?'desc':'asc');
		}
		$list =	$model_coupon->getList($coupon_condition,10,$order);
		Tpl::output('list',$list);
		Tpl::output('show_page',$model_coupon->showpage(2));
		
		//优惠券领取
		$model = Model();
		$model->table('coupon_download,coupon')->field('coupon.coupon_id,coupon_download.member_name,coupon_download.coupon_name,coupon.coupon_pic');
		$download = $model->join('left')->on('coupon_download.coupon_id = coupon.coupon_id')->where(array('coupon.city_id'=>$this->city_info['area_id']))->order('coupon_download.download_time desc')->limit(8)->select();
		Tpl::output('download',$download);
		//分类
		$this->classlist();
		//区域
		$this->arealist();
		Tpl::showpage('coupon.list');
	}
	/**
	 * 优惠券详细
	 */
	public function detailOp(){
		$coupon_id	=	intval($_GET['coupon_id']);
		
		//优惠券详情
		$coupon_info	=	$this->couponinfo($coupon_id);
		$store_info = $this->getStoreInfo($coupon_info['store_id']);
		if($store_info['store_state']==3){
			$this->showTip('该店铺已经关闭','','html','error');
		}

		//优惠券有效期结束
		if($coupon_info['coupon_end_time']<time()){
			$this->showTip('该优惠券已经过期','','html','error');
		}
		Tpl::output('coupon_info',$coupon_info);
		
		$model	=	Model();
		$model->table('coupon')->where(array('coupon_id'=>$coupon_id))->setInc('view_count',1);
		
		//相关优惠券
		$couponlist = $model->table('coupon')->where(array('city_id'=>$this->city_info['area_id']))->order('coupon_id desc')->limit(3)->select();
		Tpl::output('couponlist',$couponlist);


		//优惠券所属店铺信息
		$field	=	"store.store_id,store.store_name,store.pic,store.address,store.telephone,store.bus,store.logo,store.person_consume,store.description";
		$on		=	"coupon.store_id=store.store_id";
		$model->table('coupon,store')->field($field);
		$store_info	=	$model->join('left')->on($on)->where(array('coupon_id'=>$coupon_id))->find();
		Tpl::output('store_info',$store_info);
		//计算评价分数
		$all_comment = $model->field('amount_score')->table('comment')->where(array('store_id'=>$coupon_info['store_id']))->select();
		$final_score = 0;
		if(count($all_comment) > 0){
			if(!empty($all_comment)){
				foreach ($all_comment as $val){
					$final_score += $val['amount_score'];
				}
			}
			$final_score = round($final_score/count($all_comment));
		}
		Tpl::output('final_score',$final_score);	
		Tpl::showpage('coupon.detail');
	}


	/**
	 * 打印优惠券
	 */	
	public function printOp(){
		$coupon_id	=	intval($_GET['coupon_id']);
		
		//优惠券详情
		$coupon_info	=	$this->couponinfo($coupon_id);
		$store_info = $this->getStoreInfo($coupon_info['store_id']);
		if($store_info['store_state']==3){
			$this->showTip('该店铺已经关闭','','html','error');
		}
		
		if(empty($coupon_info)){
			$this->showTip(L('nc_coupon_is_not_exists'),'','html','error');
		}
		
		if($coupon_info['download_type']==2){
			$this->showTip('该优惠券不支持打印下载','','html','error');
		}

		Tpl::output('coupon_info',$coupon_info);
		
		$model = Model();
		$params	=	array(
			'member_id'		=>	isset($_SESSION['member_id'])?$_SESSION['member_id']:'',
			'member_name'	=>	isset($_SESSION['member_name'])?$_SESSION['member_name']:'',
			'coupon_id'		=>	$coupon_id,
			'coupon_name'	=>	$coupon_info['coupon_name'],
			'download_time'	=>	time(),
			'download_type'	=>	1
		);
		$model->table('coupon_download')->insert($params,true);
		$model->table('coupon')->where(array('coupon_id'=>$coupon_id))->setInc('download_count',1);
		//计入分数
		member_point_add('coupon');
		Tpl::showpage('coupon.print','null_layout');
	}

	function checkSeccode($nchash,$value){
		list($checkvalue, $checktime, $checkidhash) = explode("\t", decrypt(cookie('seccode'.$nchash),MD5_KEY));
		return $checkvalue == strtoupper($value) && $checkidhash == $nchash;
	}
	/**
	 * 短信发送优惠券
	 */	
	 public function sendmsgOp(){
		//验证手机号
		if(!$this->checkphone($_GET['phone'])){
			$arr	=	array(
				'result'	=>	'fail',
				'msg'		=>	Language::get('offline_phone_format_error')
			);
			echo json_encode($arr);
			exit;
		}

		//验证码
		if (!$this->checkSeccode($_GET['nchash'],$_GET['captcha'])){
			$arr	=	array(
				'result'	=>	'fail',
				'msg'		=>	Language::get('offline_captcha_format_error')
			);
			echo json_encode($arr);
			exit;
		}

		//优惠券详情
		$coupon_id	=	intval($_GET['coupon_id']);
		$coupon_info	=	$this->couponinfo($coupon_id);
		$store_info = $this->getStoreInfo($coupon_info['store_id']);
		if($store_info['store_state']==3){
			$arr = array(
				'result'	=>  'fail',
				'msg'		=>	'店铺已关闭'	
			);
			echo json_encode($arr);
			exit;
		}
		
		
		$post_data	=	array(
			'phone'		=>	trim($_GET['phone']),
			'text'		=>	$coupon_info['short_message']
		);

		$ch	=	curl_init();
		curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
		curl_setopt($ch,CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
		$model	= Model();
		$params	=	array(
				'member_id'		=>	isset($_SESSION['member_id'])?$_SESSION['member_id']:'',
				'member_name'	=>	isset($_SESSION['member_name'])?$_SESSION['member_name']:'',
				'coupon_id'		=>	$coupon_id,
				'coupon_name'	=>	$coupon_info['coupon_name'],
				'download_time'	=>	time(),
				'download_type'	=>	2
		);
		$model->table('coupon_download')->insert($params);
		$model->table('coupon')->where(array('coupon_id'=>$coupon_id))->setInc('download_count',1);
		
		$arr	=	array(
			'result'	=>	'succ',
			'msg'		=>	Language::get('offline_message_send_succ')
		);
		echo json_encode($arr);
		exit;
	 }
	
	public function messageinfoOp(){
		//优惠券详情
		$coupon_id	=	intval($_GET['coupon_id']);
		$coupon_info	=	$this->couponinfo($coupon_id);
		Tpl::output('coupon_info',$coupon_info);

		//验证码
		if (C('captcha_status_login')){
			Tpl::output('nchash',substr(md5(SiteUrl.$_GET['act'].$_GET['op']),0,8));
		}
		Tpl::showpage('ajax_coupon', 'null_layout');
	}
	/**
	 * 优惠券详情
	 */
	private function couponinfo($coupon_id){
		//优惠券详情
		$condition	=	array(
			'coupon_id'	=>	$coupon_id	
		);
		$coupon_model	=	Model('coupon');
		$coupon_info	=	$coupon_model->getOne($condition);
		return $coupon_info;
	}

	/**
	 * 验证手机号码
	 */
	private function checkphone($phone){
		if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$phone)){ 
		    return true;
		}else{
            return false;
		}
	}

}
