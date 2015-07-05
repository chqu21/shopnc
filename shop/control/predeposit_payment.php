<?php
defined('InShopNC') or exit('Access Invalid!');
class predeposit_paymentControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('index_sign','groupbuy');
	}
	
	/*
	 * 通知地址
	 */
	public function notifyOp(){
		//外部订单号
		$pdr_sn = $_POST['out_trade_no'];
		
		//获取订单
		$model = Model();
		$order = $model->table('predeposit_charge')->where(array('pdr_sn'=>$pdr_sn))->find();
		
		if(empty($order)){
			exit(L('nc_groupbuy_order_is_not_exist'));
		}
		
		if($order['state'] == 2){
			exit(L('nc_groupbuy_order_is_payment'));
		}
		
		//支付方式
		$payment_id = 1;
		$payment = $model->table('payment')->where(array('payment_id'=>$payment_id))->find();
		
		//支付信息
		$payment_info	=	array();
		$payment_info['payment_config'] = unserialize($payment['payment_config']);

		$inc_file = BASE_ROOT_PATH.DS.ATTACH_PATH.DS.'api'.DS.'gold_payment'.DS.$payment['payment_code'].DS.$payment['payment_code'].'.php';
		
		//加载配置文件
		require_once($inc_file);
		$payment_api = new $payment['payment_code']($payment_info,$order);
		if($payment_api->notify_verify()){
			$result = $model->table('predeposit_charge')->where(array('pdr_sn'=>$pdr_sn))->update(array('state'=>2));

			$predeposit_params	= array();
			$predeposit_params['member_id'] = $_SESSION['member_id'];
			$predeposit_params['member_name'] = $_SESSION['member_name'];
			$predeposit_params['type'] = 1;
			$predeposit_params['content'] = 2;
			$predeposit_params['order_sn']= $order['pdr_sn'];
			$predeposit_params['price'] = $order['charge_price'];

			$predeposit_model = Model('predeposit');
			$predeposit_model->addlog($predeposit_params);
			if($result){
				exit(L('nc_groupbuy_is_succ'));
			}else{
				exit(L('nc_groupbuy_is_fail'));
			}
		}else{
			exit(L('nc_groupbuy_is_fail'));
		}
	}
	
	/*
	 * 返回地址
	 */
	public function returnOp(){
		//外部订单号
		$pdr_sn = $_GET['out_trade_no'];
		
		//获取订单
		$model = Model();
		$predeposit_charge = $model->table('predeposit_charge')->where(array('pdr_sn'=>$pdr_sn))->find();
							
		if(empty($predeposit_charge)){
			$this->showTip('记录不存在',BASE_SITE_URL.'/index.php?act=memberpredeposit&op=list','html','error');
		}
		
		if($predeposit_charge['state'] == 2){
			$this->showTip('该订单支付过',BASE_SITE_URL.'/index.php?act=memberpredeposit&op=list','html','error');
		}
		
		//支付方式
		$payment = $model->table('payment')->where(array('payment_id'=>1))->find();
		$inc_file= BASE_ROOT_PATH.DS.ATTACH_PATH.DS.'api'.DS.'gold_payment'.DS.$payment['payment_code'].DS.$payment['payment_code'].'.php';
		
		//支付信息
		$payment_info	=	array();
		$payment_info['payment_config'] = unserialize($payment['payment_config']);
		
		//加载配置文件
		require_once($inc_file);
		$payment_api = new $payment['payment_code']($payment_info,$predeposit_charge);
		if($payment_api->return_verify()){
			$result = $model->table('predeposit_charge')->where(array('pdr_sn'=>$pdr_sn))->update(array('state'=>2));
			if($result){				
				$params	 = array();
				$params['predeposit']	= array('exp','predeposit+'.$predeposit_charge['charge_price']);

				$model = Model();
				$model->table('member')->where(array('member_id'=>$predeposit_charge['member_id']))->update($params);
				
				$predeposit_params	= array();
				$predeposit_params['member_id'] = $_SESSION['member_id'];
				$predeposit_params['member_name'] = $_SESSION['member_name'];
				$predeposit_params['type'] = 1;
				$predeposit_params['content'] = 2;
				$predeposit_params['order_sn']= $predeposit_charge['pdr_sn'];
				$predeposit_params['price'] = $predeposit_charge['charge_price'];

				$predeposit_model = Model('predeposit');
				$predeposit_model->addlog($predeposit_params);

				$this->showTip('支付成功',BASE_SITE_URL.'/index.php?act=memberpredeposit&op=list','succ');
			}else{
				$this->showTip('支付失败',BASE_SITE_URL.'/index.php?act=memberpredeposit&op=list','html','error');
			}
		}else{
			$this->showTip('支付失败',BASE_SITE_URL.'/index.php?act=memberpredeposit&op=list','html','error');
		}
	}
	
	/*
	 * 生成密码
	 */
	protected function orderpwdOp($order_id){
		$order_pwd	=	rand(1000,9999).rand(1000,9999).rand(1000,9999);
		$params	=	array(
				'order_id'		=>	$order_id,
				'state'			=>	1,
				'order_pwd'		=>	$order_pwd
		);
		
		$model = Model();
		$model->table('order_pwd')->insert($params);
		return $order_pwd;
	}
	
}