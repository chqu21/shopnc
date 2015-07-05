<?php
defined('InShopNC') or exit('Access Invalid!');
class giftControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
        Tpl::output('index_sign','gift');
	}
	public function indexOp(){
		$this->listOp();
	}
	/**
	 * 积分商城
	 */
	public function listOp(){
		$model = Model();
		//调取礼品列表
		$gift_list = $model->table('gift')->where(array('sg_sale'=>1))->order('sg_add_time desc')->page(10)->select();
		Tpl::output('show_page',$model->showpage());
		Tpl::output('gift_list',$gift_list);
		//调取推荐礼品列表
		$model_r = Model();
		$gift_recommend = $model_r->table('gift')->where(array('sg_sale'=>1,'sg_recommend'=>1))->order('sg_add_time desc')->limit(5)->select();
		Tpl::output('gift_recommend',$gift_recommend);
		Tpl::showpage('gift.index');
	}
	/**
	 * 礼品详情
	 */
	public function detailOp(){
		$model = Model();
		$sg_id = intval($_GET['sg_id']);
		if($sg_id <= 0){
			$this->showTip('参数错误','','html','error');
		}
		//调取礼品信息
		$sg_info = $model->table('gift')->where(array('sg_id'=>$sg_id))->find();
		Tpl::output('sg_info',$sg_info);
		//调取推荐礼品列表
		$model_r = Model();
		$gift_recommend = $model->table('gift')->where(array('sg_sale'=>1,'sg_recommend'=>1))->order('sg_add_time desc')->limit(5)->select();
		Tpl::output('gift_recommend',$gift_recommend);
		//调取会员等级信息
		if($sg_info['sg_member_degree'] != 0){
			$md_info = $model->table('member_degree')->where(array('md_id'=>$sg_info['sg_member_degree']))->find();
			Tpl::output('limit_member',$md_info['md_name']);
		}
		Tpl::showpage('gift.detail');
	}
	/**
	 * 订单确认
	 */
	public function order_confirmOp(){
		$model = Model();
		//调取用户会员信息
		$minfo = $model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();
		Tpl::output('minfo',$minfo);
		//调取礼品信息
		$sg_id = intval($_GET['sg_id']);
		$sg_info = $model->table('gift')->where(array('sg_id'=>$sg_id))->find();
		Tpl::output('sg_info',$sg_info);
		Tpl::showpage('gift.order_confirm','null_layout');
	}
	/**
	 * 下礼品订单
	 */
	public function orderOp(){
		$model = Model();
		$sg_id = intval($_POST['sg_id']);
		if($sg_id <= 0){
			$this->showTip('参数错误','','html','error');
		}
		//验证兑换条件
		$sg_info = $model->table('gift')->where(array('sg_id'=>$sg_id))->find();
		$minfo = $model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();
		if($sg_info['sg_member_degree'] != 0 && $_SESSION['member_id'] < $sg_info['sg_member_degree']){
			$this->showTip('您当前的会员等级无法兑换该礼品','','html','error');
		}
		if($sg_info['sg_limit_num'] != 0 && intval($_POST['go_num']) > $sg_info['sg_limit_num']){
			$this->showTip('不能超过礼品兑换数量上限','','html','error');
		}
		if(($sg_info['sg_sale_num']+intval($_POST['go_num'])) > $sg_info['sg_num']){
			$this->showTip('礼品库存数量不足','','html','error');
		}
		if(intval($_POST['go_num']) <= 0){
			$this->showTip('礼品兑换数量不能为0或负数','','html','error');
		}
		//判断会员积分是否够用
		if($minfo['member_point'] < $sg_info['sg_point']*intval($_POST['go_num'])){
			$this->showTip('您的积分不足以兑换','','html','error');
		}
		//写入订单信息
		$order_array = array();
		$order_array['go_sn'] = 'G'.date('Ymd').substr( implode(NULL,array_map('ord',str_split(substr(uniqid(),7,13),1))) , -8 , 8); 
		$order_array['member_id'] = $_SESSION['member_id'];
		$order_array['member_name'] = $_SESSION['member_name'];
		$order_array['sg_id'] = $sg_id;
		$order_array['sg_name'] = $sg_info['sg_name'];
		$order_array['go_num'] = intval($_POST['go_num']);
		$order_array['go_unit_point'] = $sg_info['sg_point'];
		$order_array['go_total_point'] = $sg_info['sg_point']*intval($_POST['go_num']);
		$order_array['go_address'] = $_POST['go_address'];
		$order_array['go_contact'] = $_POST['go_contact'];
		$order_array['go_phone'] = $_POST['go_phone'];
		$order_array['go_zipcode'] = $_POST['go_zipcode'];
		$order_array['go_state'] = 1;
		$order_array['go_add_time'] = time();
		$order_array['go_change_time'] = time();
		$rs = $model->table('gift_order')->insert($order_array);
		if($rs){
			//更新礼品兑换数量
			$model->table('gift')->where(array('sg_id'=>$sg_id))->setInc('sg_sale_num',intval($_POST['go_num']));
			//写入分数变更日志
			$log_array = array();
			$log_array['member_id'] = $_SESSION['member_id'];
			$log_array['pl_type'] = 2;
			$log_array['pl_change_score'] = -$sg_info['sg_point']*intval($_POST['go_num']);
			$log_array['pl_total_score'] = $minfo['member_point']-$sg_info['sg_point']*intval($_POST['go_num']);
			$log_array['pl_time'] = time();
			$log_array['pl_note'] = '使用积分兑换礼品"'.$sg_info['sg_name'].'"';
			$model->table('point_log')->insert($log_array);
			//变更会员积分
			$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->update(array('member_point'=>$log_array['pl_total_score']));
			$this->showTip('礼品兑换订单保存成功！','','html','succ');
		}else{
			$this->showTip('礼品兑换订单保存失败','','html','error');
		}
	}
}