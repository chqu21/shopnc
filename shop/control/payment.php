<?php
defined('InShopNC') or exit('Access Invalid!');
class paymentControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('index_sign','groupbuy');
	}
	
	public function indexOp(){
		$this->paymentOp();
	}
	
	/*
	 * 订单支付
	 */
	public function paymentOp(){
		//判断是否登陆
		if($_SESSION['is_login'] != 1){
			$this->showTip(L('nc_order_member_is_not_login'),'','html','error');
		}
		
		$payment 	= trim($_POST['payment']);
		$order_sn	= trim($_POST['order_sn']);
		
		$order_model = Model('order');
		$order = $order_model->getOne(array('order_sn'=>$order_sn));
		
		if(empty($order)){
			$this->showTip(L('nc_order_is_not_exists'),'','html','error');
		}
		
		if($order['state']==2){
			$this->showTip('订单已支付','','html','error');
		}
		
		$member_model = Model('member');
		$member = $member_model->getOne(array('member_id'=>$_SESSION['member_id']));

		if($payment == 'predeposit'){
			//检验预存款支付密码是否正确
			if($member['pay_password'] != md5(trim($_POST['pay_password']))){
				$this->showTip('预存款支付密码输入不正确','','html','error');
			}
			
			$predeposit_price	=	$member['predeposit'];
			$order_price 		= 	$order['price'];
			$member_predeposit	=	$predeposit_price-$order_price;
			
			if($member_predeposit<0){
				$this->showTip(L('nc_order_reminding_money_is_not_enough'),'index.php?act=memberpredeposit&op=charge','html','error');
			}
			
			$update	=	array(
					'predeposit'	=>	$member_predeposit
			);
			$condition	=	array(
					'member_id'		=>	$member['member_id']
			);
			$result = $member_model->modify($update,$condition);
			if($result){
				$order_update	=	array(
						'state'			=>	2
				);
				$order_condition = array(
						'order_sn'	=>	$order_sn		
				);
				$result1 = $order_model->modify($order_update,$order_condition);
				
				//预存款记录
				$predeposit_params	 = array();
				$predeposit_params['member_id'] = $_SESSION['member_id'];
				$predeposit_params['member_name'] = $_SESSION['member_name'];
				$predeposit_params['type']		= 2;//2.减少
				$predeposit_params['content']	= 1;
				$predeposit_params['order_sn']	= $order_sn;
				$predeposit_params['price']		= $order_price;


				$predeposit_model = Model('predeposit');
				$result2 = $predeposit_model->addlog($predeposit_params);

				if($result1 && $result2){
					//生成密码券
					$orderpwd	= '';
					for($i=0;$i<$order['number'];$i++){
						$orderpwd = $this->orderpwdOp($order['order_id']).',';
					}
					
					//发送短信
					$post_data	=	array(
							'phone'		=>	$order['mobile'],
							'text'		=>	'团购成功，您的团购密码：'.trim($orderpwd,',')
					);
					
					$ch	=	curl_init();
					curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
					curl_setopt($ch,CURLOPT_HEADER, 0);
					curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch,CURLOPT_POST, 1);
					curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
					$output = curl_exec($ch);
					curl_close($ch);
					
					//团购成功
					$this->showTip('团购成功','index.php?act=memberorder&op=list','succ');
				}else{
					$this->showTip(L('nc_order_payment_fail'),'','html','error');
				}
			}else{
				$this->showTip(L('nc_order_payment_fail'),'','html','error');
			}
		}elseif($payment == 'otherpayment'){
			if($_POST['otherpayment'] == 'alipay'){
				//使用在线支付时跳转到对应的网站
				$payment_orderinfo = array();
				$payment_orderinfo['order_sn']      = $order['order_sn'];
				$payment_orderinfo['order_desc']    = '团购订单';
				$payment_orderinfo['order_amount']  = $order['price'];
				$payment_orderinfo['modeltype']		= '2';

				$model 	 = Model();
				$payment = $model->table('payment')->where(array('payment_code'=>'alipay'))->find();
				
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
				exit;
			}	
		}
	}
	
	/*
	 * 通知地址
	 */
	public function notifyOp(){
		//外部订单号
		$order_sn = $_POST['out_trade_no'];
		
		//获取订单
		$model = Model();
		$order = $model->table('order')->where(array('order_sn'=>$order_sn))->find();
		
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
			$result = $model->table('order')->where(array('order_sn'=>$order_sn))->update(array('state'=>2));
			
			//生成密码券
			$orderpwd	= '';
			for($i=0;$i<$order['number'];$i++){
				$orderpwd = $this->orderpwdOp($order['order_id']).',';
			}
			
			//发送短信
			$post_data	=	array(
					'phone'		=>	$order['mobile'],
					'text'		=>	'团购成功，您的团购密码：'.trim($orderpwd,',')
			);
			
			$ch	=	curl_init();
			curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
			curl_setopt($ch,CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch,CURLOPT_POST, 1);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
			$output = curl_exec($ch);
			curl_close($ch);
			
			
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
		$order_sn = $_GET['out_trade_no'];
		
		
		//获取订单
		$model = Model();
		$order = $model->table('order')->where(array('order_sn'=>$order_sn))->find();
		
					

		if(empty($order)){
			$this->showTip(L('nc_groupbuy_order_is_not_exist'),BASE_SITE_URL.'/index.php?act=memberorder&op=list','html','error');
		}
		
		if($order['state'] == 2){
			$this->showTip(L('nc_groupbuy_order_is_payment'),BASE_SITE_URL.'/index.php?act=memberorder&op=list','html','error');
		}
		
		//支付方式
		$payment_id = $order['payment'];
		$payment = $model->table('payment')->where(array('payment_id'=>1))->find();
		
		//支付信息
		$payment_info	=	array();
		$payment_info['payment_config'] = unserialize($payment['payment_config']);
		
		$inc_file = BASE_ROOT_PATH.DS.ATTACH_PATH.DS.'api'.DS.'gold_payment'.DS.$payment['payment_code'].DS.$payment['payment_code'].'.php';
		
		//加载配置文件
		require_once($inc_file);
		$payment_api = new $payment['payment_code']($payment_info,$order);
		if($payment_api->return_verify()){
			$result = $model->table('order')->where(array('order_sn'=>$order_sn))->update(array('state'=>2));
			if($result){
				//生成密码券
				$orderpwd	= '';
				for($i=0;$i<$order['number'];$i++){
					$orderpwd = $this->orderpwdOp($order['order_id']).',';
				}

				//发送短信
				$post_data	=	array(
						'phone'		=>	$order['mobile'],
						'text'		=>	'团购成功，您的团购密码：'.trim($orderpwd,',')
				);
				
				$ch	=	curl_init();
				curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
				curl_setopt($ch,CURLOPT_HEADER, 0);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch,CURLOPT_POST, 1);
				curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
				$output = curl_exec($ch);
				curl_close($ch);


				$this->showTip(L('nc_groupbuy_is_succ'),BASE_SITE_URL.'/index.php?act=memberorder&op=list','succ');
			}else{
				$this->showTip(L('nc_groupbuy_is_fail'),BASE_SITE_URL.'/index.php?act=memberorder&op=list','html','error');
			}
		}else{
			$this->showTip(L('nc_groupbuy_is_fail'),BASE_SITE_URL.'/index.php?act=memberorder&op=list','html','error');
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