<?php
/**
 * 管理员管理
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class paymentControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('setting');
	}

	public function indexOp(){
		$this->paymentOp();
	}
	
	/*
	 * 支付列表
	 */
	public function paymentOp(){
		$payment_model = Model('payment');
		//$condition	=	array(
		//		'payment_state'	=>	1		
		//);
		$list = $payment_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::showpage('payment.list');
	}
	
	/*
	 * 编辑支付方式
	 */
	public function editOp(){
		$payement_model = Model('payment');
		//编辑
		if(isset($_POST) && !empty($_POST)){
			$payment_id = intval($_POST['payment_id']);
			/*
			 * 验证
			 */
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
					array("input"=>$payment_id , "require"=>"true", "message"=>Language::get('wrong_argument')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error);
			}
			
			$params	=	array(
				'payment_state'	=>	$_POST['payment_state'],
				'payment_info'	=>	trim($_POST["payment_info"])							
			);	
			$payment_config	= '';
			$config_array =	explode(',',$_POST["config_name"]);//配置参数
			
			if(is_array($config_array) && !empty($config_array)){
				$config_info	=	array();
				foreach ($config_array as $k) {
					$config_info[$k] = trim($_POST[$k]);
				}
				$payment_config	= serialize($config_info);
			}
			$params['payment_config'] = $payment_config;//支付接口配置信息
			
			$condition	=	array(
				'payment_id'	=>	$payment_id			
			);

			$result = $payement_model->modify($params,$condition);
			if($result){
				$this->showTip('编辑成功','','succ');
			}else{
				$this->showTip('编辑失败','','fail');
			}
		}
		
		//支付方式
		$payment_id	=	intval($_GET['payment_id']);
		$payment = $payement_model->getOne(array('payment_id'=>$payment_id));	
		Tpl::output('payment',$payment);
		
		
		//配置信息
		$payment_config	=	$payment['payment_config'];
		$config_array	=	unserialize($payment_config);
		Tpl::output('config_array',$config_array);
		
		Tpl::showpage('payment.edit');
	}
}
