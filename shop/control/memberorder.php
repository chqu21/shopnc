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

class memberorderControl extends memberCenterControl{

	public function __construct(){
		parent::__construct();
		$this->menu('order');
		Tpl::output('menu_sign','order_manage');
	}
	
	public function indexOp(){
		$this->listOp();
	}

	/*
	 * 订单列表
	 */
	public function listOp(){
		$model	=	Model();
		$page	=	10;
		$order	=	'`add_time` desc';
		$where = array('member_id'=>$_SESSION['member_id']);
		//搜索
		if($_GET['s_type'] != '' && $_GET['s_content'] != ''){
			$where[$_GET['s_type']] = array('like','%'.$_GET['s_content'].'%');
		}
		if(intval($_GET['s_state']) > 0){
			$where['state'] = intval($_GET['s_state']);
		}
		$list	=	$model->table('order,groupbuy')->join('left')->on('order.item_id=groupbuy.group_id')->where($where)->page($page)->order($order)->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());

		Tpl::showpage('order.list');
	}
	
	/*
	 * 订单详情
	 */
	public function orderdetailOp(){
		$order_id	=	intval($_GET['order_id']);
		//团购券列表
		$model 		= 	Model();
		$field = "order_pwd.state,order_pwd.order_pwd,order.item_name,order.add_time,order_pwd.use_time";
		$on = "order_pwd.order_id = order.order_id";
		$model->table('order_pwd,order')->field($field);
		$order = $model->join('left')->on($on)->where(array('order_pwd.order_id'=>$order_id))->select();
		
		Tpl::output('order',$order);
		Tpl::showpage('memberorder.detail');
	}
	
	
	/*
	 * 订单退款
	 */
	public function refundOp(){
		$model = Model();
		$list = $model->table('refund')->where(array('member_id'=>$_SESSION['member_id']))->select();

		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		Tpl::output('menu','refund');
		Tpl::showpage('my.refund');
	}

	/*
	 * 订单退款
	 */
	public function orderrefundOp(){		
		if(isset($_POST)&&!empty($_POST)){
			$model = Model();
			$order = $model->table('order')->where(array('order_id'=>intval($_POST['order_id'])))->find();
			if(empty($order)){
				$this->showTip('订单不存在','index.php?act=memberorder','error');
			}

			$params	 = array();
			$params['order_id']		= intval($_POST['order_id']);
			$params['order_sn']		= $order['order_sn'];
			$params['order_pwd']	= trim($_POST['order_pwd'],',');
			$params['member_id']	= $order['member_id'];
			$params['member_name']	= $order['member_name'];
			$params['store_id']		= $order['store_id'];
			$params['store_name']	= $order['store_name'];
			$params['refund_price']	= $_POST['refund_price'];
			$params['audit']		= 1;//待审核

			$res = $model->table('refund')->insert($params);
			if($res){
				$res1 = $model->table('order_pwd')->where(array('order_group_id'=>array('in',$params['order_pwd'])))->update(array('state'=>3));
				
				if($res1){
					$this->showTip('操作成功','index.php?act=memberorder','succ');
				}else{
					$this->showTip('操作失败','index.php?act=memberorder','error');
				}
			}else{
				$this->showTip('操作失败','index.php?act=memberorder','error');
			}
		}

		$order_id	=	intval($_GET['order_id']);

		$model = Model();
		$order = $model->table('order')->where(array('order_id'=>$order_id,'member_id'=>$_SESSION['member_id']))->find();
		
		if(empty($order)){
			$this->showTip('订单不能为空');
		}
		$groupbuy = $model->table('groupbuy')->where(array('group_id'=>$order['item_id']))->find();

		if($groupbuy['end_time']>time() && $groupbuy['is_refund']==2){
			$this->showTip('该团购项不能申请退款','','error');
		}
		Tpl::output('groupbuy',$groupbuy);

		Tpl::output('order',$order);
		$order_pwd = $model->table('order_pwd')->where(array('order_id'=>$order_id))->select();
		Tpl::output('order_pwd',$order_pwd);
		Tpl::showpage('memberorder.refund');
	}


	/*
	 * 取消订单
	 */
	public function cancleorderOp(){
		$model = Model();
		
		$params		= array();
		$params['order_id'] = intval($_GET['order_id']);
		$params['member_id']= $_SESSION['member_id'];

		$order = $model->table('order')->where($params)->find();
		if(empty($order)){
			$this->showTip('订单不存在','','error');
		}

		$res = $model->table('order')->where($params)->delete();
		if($res){
			$this->showTip('取消成功','','succ');
		}else{
			$this->showTip('取消失败','','error');
		}
	}


	/*
	 * 发送短信
	 */
	public function sendmessageOp(){
		$order_id = intval($_GET['order_id']);
		
		//获得团购密码
		$model = Model();
		
		$order = $model->table('order')->where(array('order_id'=>$order_id))->find();//订单信息
		$order_pwd = $model->table('order_pwd')->where(array('order_id'=>$order_id,'state'=>1))->select();//团购密码
		
		if(empty($order_pwd))$this->showTip('验证密码为空','','error');
        if($order['member_name']!=$_SESSION['member_name']) $this->showtip('该订单和当前登陆用户不匹配！','','error');
		
		if(!empty($order_pwd)){
			foreach($order_pwd as $value){
				$order_password.= $value['order_pwd'].',';
			}
		}


		//发送短信
		$post_data	=	array(
				'phone'		=>	$order['mobile'],
				'text'		=>	'团购成功，您的团购密码：'.trim($order_password,',')
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
		$this->showTip('发送短信成功','index.php?act=memberorder&op=list','succ');
	}	
}
?>