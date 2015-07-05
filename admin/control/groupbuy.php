<?php
/**
 * 团购管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class groupbuyControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('groupbuy');
	}
	public function indexOp(){
		$this->groupbuyOp();
	}
	/*
	 * 团购列表
	 */
	public function groupbuyOp(){	
		$condition = array();
		if(isset($_POST) && !empty($_POST)){	
			//团购状态
			if(intval($_POST['groupbuy_state']) == 1){
				$condition['start_time']	=	array('gt',time());
			}elseif(intval($_POST['groupbuy_state']) == 2){
				$condition['start_time']	=	array('lt',time());
				$condition['end_time']	=	array('gt',time());
			}elseif(intval($_POST['groupbuy_state']) == 3){
				$condition['end_time']	=	array('lt',time());
			}
			
			if(isset($_POST['group_name'])){
				$condition['group_name']	=	array('like',"%{$_POST['group_name']}%");
			}

			//审核状态
			if(isset($_POST['audit']) && !empty($_POST['audit'])){
				$condition['is_audit']	=	intval($_POST['audit']);
			}

			Tpl::output('groupbuy_state',intval($_POST['groupbuy_state']));
			Tpl::output('is_audit',intval($_POST['audit']));
			Tpl::output('group_name',$_POST['group_name']);
		}
		
		$groupbuy_model = Model('groupbuy');
		$list = $groupbuy_model->getList($condition,'','group_id desc');
		Tpl::output('list',$list);
		Tpl::output('show_page',$groupbuy_model->showpage());
		Tpl::showpage('groupbuy.list');
	}
	
	/*
	 * 团购订单
	 */
	public function groupbuyorderOp(){
		$order_model = Model('order');
		$condition	=	array();
		//搜索
		if($_POST['s_type'] != '' && $_POST['s_content'] != ''){
			$condition[$_POST['s_type']] = array('like','%'.$_POST['s_content'].'%');
			Tpl::output('s_type',$_POST['s_type']);
			Tpl::output('s_content',$_POST['s_content']);
		}
		$list = $order_model->getList($condition,'15','add_time desc');
		Tpl::output('list',$list);
		Tpl::output('show_page',$order_model->showpage());
		Tpl::showpage('order.list');
	}
	
	/*
	 * 团购操作
	 */
	public function recommendOp(){
		$condition	=	array();
		$condition	=	array(
				'group_id'	=>	array('in',$_POST['group_id'])
		);
		if(isset($_GET['type']) && $_GET['type'] == 1){
			//推荐评论
			$model = Model();
			$result = $model->table('groupbuy')->where($condition)->update(array('is_hot'=>'2'));
		}else{
			//取消推荐
			$model = Model();
			$result = $model->table('groupbuy')->where($condition)->update(array('is_hot'=>'1'));
		}
		
		if($result){
			$this->showTip(Language::get('nc_admin_comment_recommend_succ'),'','succ');
		}else{
			$this->showTip(Language::get('nc_admin_comment_recommend_fail'),'','error');
		}
	}
	
	/*
	 * 团购开启或者关闭
	 */
	public function stateOp(){
		$is_open = intval($_GET['is_open']);
		$group_id	=	intval($_GET['group_id']);
		
		//编辑状态
		$model = Model();
		$result = $model->table('groupbuy')->where(array('group_id'=>$group_id))->update(array('is_open'=>$is_open));
		
		if($result){
			$this->showTip(Language::get('nc_admin_groupbuy_op_succ'),'','succ');
		}else{
			$this->showTip(Language::get('nc_admin_groupbuy_op_fail'),'','error');
		}
	}
	
	/*
	 * 查看团购券
	 */
	public function groupbuyvoucherOp(){	
		$group_id	= intval($_GET['group_id']);
		$model 		= Model();
		
		//结束时间
		$group = $model->table('groupbuy')->where(array('group_id'=>$group_id))->find();		
		Tpl::output('endtime',$group['end_time']);
		
		$condition					=	array();
		$condition['order.item_id']	=	$group_id;
		
		//查询条件
		if(isset($_POST['state']) && !empty($_POST['state'])){
			$condition['order_pwd.state'] = intval($_POST['state']);
		}
		
		if(isset($_POST['groupname']) && !empty($_POST['groupname'])){
			$condition['order.item_name'] = trim($_POST['groupname']);
		}
		
		//获得数据		
		$field  = 'order.order_sn,order.store_name,order.item_name,order.member_name,order_pwd.state,order_pwd.use_time,order_pwd.order_pwd';
		$on		= 'order_pwd.order_id = order.order_id';	
		$model->table('order_pwd,order')->field($field);
		$list = $model->join('left')->on($on)->where($condition)->select();
		Tpl::output('list',$list);
		
		Tpl::showpage('voucher.list');
	}
	
	/*
	 *	删除订单 
	 */
	public function groupbuyorderdelOp(){
		if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$model = Model();
			$result = $model->table('order')->where(array('order_id'=>intval($_GET['order_id'])))->delete();
			
			if($result){
				$this->showTip(Language::get('nc_admin_groupbuyorder_del_succ'),'','succ');
			}else{
				$this->showTip(Language::get('nc_admin_groupbuyorder_del_fail'),'','error');
			}
		}
	}
	
	/*
	 * 删除团购
	 */
	public function dropOp(){
		$group_id	=	intval($_GET['group_id']);
		$model = Model();
		$result = $model->table('groupbuy')->where(array('group_id'=>$group_id))->delete();
		if($result){
			$this->showTip(Language::get('nc_admin_groupbuy_op_succ'),'','succ');
		}else{
			$this->showTip(Language::get('nc_admin_groupbuy_op_fail'),'','error');
		}
	}
	
	/*
	 * 审核
	 */
	public function auditOp(){
		if(isset($_POST['is_audit']) && !empty($_POST['is_audit'])){
			//团购审核
			$model = Model();
			if(intval($_POST['settle']) > 100){
				$this->showTip('分佣比例不能超过100%','','error');
			}
			if(intval($_POST['settle']) < 0){
				$this->showTip('分佣比例不能为负数','','error');
			}
			$result = $model->table('groupbuy')->where(array('group_id'=>intval($_POST['group_id'])))->update(array('is_audit'=>intval($_POST['is_audit']),'settle'=>intval($_POST['settle'])));	
			
			if($result){
				$groupbuy = $model->table('groupbuy')->where(array('group_id'=>intval($_POST['group_id'])))->find();
				$remind_member = $model->table('groupbuy_remind')->where(array('store_id'=>$groupbuy['store_id']))->select();
				
				if(!empty($remind_member)){
					foreach($remind_member as $val){
						$member = $model->table('member')->where(array('member_id'=>$val['member_id']))->find();
						$content = '商家'.$val['store_name'].'发布团购活动：'.$groupbuy['group_name'];
						$this->sendmessage($member['mobile'],$content);
					}
				}

				$this->showTip(L('nc_admin_groupbuy_audit_succ'),'index.php?act=groupbuy&op=groupbuy','succ');	
			}else{
				$this->showTip(L('nc_admin_groupbuy_audit_fail'),'','error');
			}		
		}

		//团购详情
		$group_id = intval($_GET['group_id']);
		$model = Model();
		$group = $model->table('groupbuy')->where(array('group_id'=>$group_id))->find();
		Tpl::output('group',$group);
		Tpl::showpage('groupbuy.audit');
	}


	/*
	 * 发送短信
	 */
	private function sendmessage($mobile,$content){
		//发送短信
		$post_data	=	array(
			'phone'	=>	$mobile,
			'text'	=>	$content
		);
		
		$ch	=	curl_init();
		curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
		curl_setopt($ch,CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
	}



	/*
	 * 批量审核
	 */
	public function batch_auditOp(){
		$condition	=	array();
		$condition	=	array(
			'group_id' => array('in',$_POST['group_id'])
		);
		$state = intval($_GET['state']);
		//取消推荐
		$model = Model();
		$result = $model->table('groupbuy')->where($condition)->update(array('is_audit'=>$state));
		if($result){
			$this->showTip('团购批量审核操作成功','','succ');
		}else{
			$this->showTip('团购批量审核操作失败','','error');
		}
	}

	/*
	 * 退款信息
	 */
	public function groupbuyrefundOp(){
		$model = Model();
		$list = $model->table('refund')->order('refund_id desc')->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('groupbuy.refund');
	}

	/*
	 * 退款审核
	 */
	public function refundauditOp(){
		if(isset($_POST)&&!empty($_POST)){
			$model	= Model();
			$refund = $model->table('refund')->where(array('refund_id'=>intval($_POST['refund_id'])))->find();		
			$order  = $model->table('order')->where(array('order_id'=>$refund['order_id']))->find();
			

			$params			 = array();
			$params['audit'] = intval($_POST['is_refund']);//审核通过
			$res = $model->table('refund')->where(array('refund_id'=>$refund['refund_id']))->update($params);

			if($res){
				
				if($params['audit']==2){
					//审核通过，退款金额返回预存款
					$update				  = array();
					$update['predeposit'] = array('exp','predeposit+'.$refund['refund_price']); 
					$res1 = $model->table('member')->where(array('member_id'=>$refund['member_id']))->update($update);

					$res2 = $model->table('order_pwd')->where(array('order_group_id'=>array('in',$refund['order_pwd'])))->delete();
					
					$number = count(explode(',',$refund['order_pwd']));
					$update = array();
					$update['buyer_count'] = array('exp','buyer_count+'.$number);
					$res3 = $model->table('groupbuy')->where(array('group_id'=>$order['item_id']))->update($update);

					$update				= array();
					$update['price']	= array('exp','price-'.$refund['refund_price']);
					$update['number']	= array('exp','number-'.$number);
					
					$order_pwd_count = $model->table('order_pwd')->where(array('order_id'=>$order['order_id']))->count();
					if($order_pwd_count==0){
						$update['state'] = 4;//退款
					}
					$res4 = $model->table('order')->where(array('order_id'=>$order['order_id']))->update($update);
					
					//预存款日志
					$predeposit_params	= array();
					$predeposit_params['member_id'] = $_SESSION['member_id'];
					$predeposit_params['member_name'] = $_SESSION['member_name'];
					$predeposit_params['type']	= 1;//1.添加
					$predeposit_params['content'] = 3;
					$predeposit_params['order_sn']= $order['order_sn'];
					$predeposit_params['price'] = $refund['refund_price'];

					$predeposit_model = Model('predeposit');
					$res5 = $predeposit_model->addlog($predeposit_params);

					if($res1 && $res2 && $res3 && $res4 && $res5){
						$this->showTip('操作成功','index.php?act=groupbuy&op=groupbuyrefund','succ');
					}else{
						$this->showTip('操作失败','index.php?act=groupbuy&op=groupbuyrefund','error');
					}
				}elseif($params['audit']==3){
					//审核不通过，取消团购券锁定
					$refundArr = array();
					$refundArr = explode(',',$refund['order_pwd']);
					
					if(!empty($refundArr)){
						foreach($refundArr as $val){
							$model->table('order_pwd')->where(array('order_group_id'=>$val))->update(array('state'=>1));
						}
					}

					$this->showTip('操作成功','index.php?act=groupbuy&op=groupbuyrefund','succ');
				}


			}else{
				$this->showTip('操作失败','','error');
			}
		}
		
		//退款信息
		$model = Model();
		$refund = $model->table('refund')->where(array('refund_id'=>intval($_GET['refund_id']),'audit'=>1))->find();
		if(empty($refund)){
			$this->showTip('','','error');
		}
		Tpl::output('refund',$refund);
		
		//团购券
		$order_pwd = $model->table('order_pwd')->where(array('order_group_id'=>array('in',$refund['order_pwd'])))->select();
		Tpl::output('order_pwd',$order_pwd);

		//订单信息
		$order = $model->table('order')->where(array('order_id'=>$refund['order_id']))->find();
		Tpl::output('order',$order);

		Tpl::showpage('refund.audit');
	}
}