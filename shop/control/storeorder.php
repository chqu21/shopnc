<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storeorderControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','order_manage');
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 订单列表
	 */
	public function listOp(){
		$order_model = Model('order');
		$condition	 = array();
		
		//查询订单
		if(isset($_POST['order_sn']) && !empty($_POST['order_sn'])){
			$condition['order_sn']	= trim($_POST['order_sn']);
			Tpl::output('order_sn',$condition['order_sn']);
		}
		
		//状态查询
		if(isset($_POST['state']) && !empty($_POST['state'])){
			$condition['state']	= intval($_POST['state']);
			Tpl::output('state',$condition['state']);
		}
		
		$condition['store_id']	= $_SESSION['store_id'];
		$orderlist = $order_model->getList($condition,'15','add_time desc');
		Tpl::output('list',$orderlist);
		Tpl::output('show_page',$order_model->showpage());
		Tpl::showpage('storeorder.list');
	}
	
	/*
	 * 团购券验证
	 */
	public function verifyOp(){
		if(isset($_POST) && !empty($_POST)){
			$model = Model();
			$order_pwd = $model->table('order_pwd')->where(array('order_pwd'=>$_POST['order_passwd']))->find();
			
			$order = $model->table('order')->where(array('order_id'=>$order_pwd['order_id']))->find();
			$groupbuy = $model->table('groupbuy')->where(array('group_id'=>$order['item_id']))->find();
			
			if($order['store_id']!=$_SESSION['store_id']){
				$this->showTip(L('nc_member_store_verify_password_is_wrong'),'','html','error');
			}

			//密码错误
			if(empty($order_pwd)){
				$this->showTip(L('nc_member_store_verify_password_is_wrong'),'','html','error');
			}
			


			//状态无效
			if($order_pwd['state'] == 2){
				$this->showTip(L('nc_member_store_verify_password_is_use'),'','html','error');
			}
			
			if($order_pwd['state'] == 3){
				$this->showTip('团购券已锁定','','html','error');
			}

			$use_time = time(); 		
			$result_a = $model->table('order_pwd')->where(array('order_group_id'=>$order_pwd['order_group_id']))->update(array('state'=>2,'use_time'=>$use_time));
			$result_b = $model->table('order')->where(array('order_id'=>$order_pwd['order_id']))->update(array('use_time'=>$use_time));
			if($result_a && $result_b){
				$orderinfo = $model->table('order')->where(array('order_id'=>$order_pwd['order_id']))->find();
				//消费成功 发送短信
				$post_data	=	array(
					'phone'		=>	$orderinfo['mobile'],
					'text'		=>	'您的团购密码：'.$order_pwd['order_pwd'].'已经使用'
				);
					
				$ch	=	curl_init();
				curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
				curl_setopt($ch,CURLOPT_HEADER, 0);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch,CURLOPT_POST, 1);
				curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
				$output = curl_exec($ch);
				curl_close($ch);
				
				//修改状态
				$count = $model->table('order_pwd')->where(array('order_id'=>$orderinfo['order_id'],'state'=>2))->count();
				if($count == $orderinfo['number']){
					$model->table('order')->where(array('order_id'=>$orderinfo['order_id']))->update(array('state'=>3));
				}
				//验证成功
				//$this->showTip(L('nc_member_store_verify_succ').'<br>团购名称：'.$orderinfo['item_name'].'<br>价格：'.intval($orderinfo['price']).'元','index.php?act=storeorder','succ',1,6000);
				$r_url = '<a href="index.php?act=storeorder&op=verify" style="color:red">点击返回</a>';
				Tpl::output('msg',L('nc_member_store_verify_succ').'<br>团购名称：'.$orderinfo['item_name'].'<br>价格：'.$groupbuy['group_price'].'元<br>'.$r_url);
				Tpl::output('msg_type','succ');
				Tpl::showpage('msg','null_layout');die;
			}else{
				//验证失败
				$this->showTip(L('nc_member_store_verify_fail'),'index.php?act=storeorder','html','error');
			}
		}
		
		Tpl::showpage('storeorder.verify');
	}
	
	/**
	 * 订单详情页面
	 * */
	public function order_detailOp(){
	    $order_id = $_GET['order_id'];
	    if(!isset($order_id) || $order_id == '' || $order_id <= 0){
	        $this->showTip(L('nc_member_order_no_exite'),'index.php?act=storeorder','html','error');	        
	    }
	    $order = Model()->table('order')->where(array('order_id'=>$order_id))->find();
	    $table = 'goods';
	    if(empty($order) || !is_array($order)){
	        $this->showTip(L('nc_member_order_no_exite'),'index.php?act=storeorder','html','error');	        
	    }
	    $condition = array();
	    $flag = 'goods';
	    if($order['order_type']==1){
	        $table = 'groupbuy';
	        $condition['group_id'] = $order['item_id'];
	        $flag = 'group';
	    }else{
	        $condition['goods_id'] = $order['item_id'];
	    }
	    $goods = Model()->table($table)->where($condition)->find();
	    $opwd = Model()->table('order_pwd')->where(array('order_id'=>$order['order_id']))->select();
	    Tpl::output('opwd',$opwd);
	    Tpl::output('flag',$flag);
	    Tpl::output('goods',$goods);
	    Tpl::output('order_info',$order);
	    Tpl::showpage('storeorder.info');
	}
}
?>