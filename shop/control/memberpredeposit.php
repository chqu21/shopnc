<?php
/**
 * 默认展示页面
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class memberpredepositControl extends memberCenterControl{

	public function __construct(){
		parent::__construct();
		Tpl::output('menu','predeposit');
		Tpl::output('menu_sign','predeposit_manage');
	}
	
	/*
	 * 充值列表
	 */
	public function listOp(){
		$model = Model();
		$list = $model->table('predeposit_charge')->where(array('member_id'=>$_SESSION['member_id']))->order('charge_time desc')->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());

		Tpl::showpage('predeposit.list');
	}

	/*
	 * 充值
	 */
	public function chargeOp(){
		if(isset($_POST) && !empty($_POST)){
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['payment'],'require'=>'true','message'=>'支付方式不能为空'),
				array('input'=>$_POST['charge_price'],'require'=>'true','message'=>'充值金额不能为空')
			);
			
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				showMessage(Language::get('error').$error,'','','error');
			}

			//获得支付信息
			$payment_id	=	intval($_POST['payment']);
			$payment_model = Model('payment');
			$payment = $payment_model->getOne(array('payment_id'=>$payment_id));
			if(empty($payment)){
				$this->showTip(L('nc_admin_payment_is_not_exists'),'','html','error');
			}
			
			$params	=	array(
					'pdr_sn'		=>	$this->recharge_snOrder(),
					'member_id'		=>	$_SESSION['member_id'],
					'member_name'	=>	$_SESSION['member_name'],
					'payment'		=>	$payment['payment_id'],
					'payment_name'	=>	$payment['payment_name'],
					'charge_price'	=>	$_POST['charge_price'],
					'charge_des'	=>	$_POST['charge_des'],
					'charge_time'	=>	time(),
					'state'			=>	1
			);
			
			$model = Model();
			$result = $model->table('predeposit_charge')->insert($params);
			
			if($result){
				//使用在线支付时跳转到对应的网站
				$payment_orderinfo = array();
				$payment_orderinfo['order_sn']      = $params['pdr_sn'];
				$payment_orderinfo['order_desc']    = '预存款充值';
				$payment_orderinfo['order_amount']  = $params['charge_price'];
				$payment_orderinfo['modeltype']		= '3';//表示是预存款功能调用支付接口
				
				//支付信息
				$payment_info	=	array();
				$payment_info['payment_config'] = unserialize($payment['payment_config']);
				$inc_file = BASE_ROOT_PATH.DS.ATTACH_PATH.DS.'api'.DS.'gold_payment'.DS.$payment['payment_code'].DS.$payment['payment_code'].'.php';
			

				//加载配置文件
				require_once($inc_file);
				$payment_api = new $payment['payment_code']($payment_info,$payment_orderinfo);
				@header("Location: ".$payment_api->get_payurl());
				exit;				
			}else{
				$this->showTip(L('nc_recharge_fail'),'','html','error');
			}
		}
		$payment_model = Model('payment');
		$paymentlist = $payment_model->getList(array('payment_state'=>1));
		Tpl::output('list',$paymentlist);
		
		Tpl::showpage('predeposit.charge');
	}

	/*
	 * 日志
	 */
	public function logOp(){
		$model = Model();
		$log   = $model->table('predeposit_log')->where(array('member_id'=>$_SESSION['member_id']))->order('add_time desc')->select();
		Tpl::output('list',$log);
		Tpl::output('show_page',$model->showpage());

		Tpl::output('menu','log');
		Tpl::showpage('predeposit.log');
	}
	
	/**
	 * 生成充值订单编号
	 * @return string
	 */
	private function recharge_snOrder() {
		$recharge_sn = 'pre'.date('Ymd').substr( implode(NULL,array_map('ord',str_split(substr(uniqid(),7,13),1))) , -8 , 8);
		return $recharge_sn;
	}
}
?>