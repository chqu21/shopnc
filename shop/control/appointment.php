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
class appointmentControl extends BaseHomeControl{
	public function __construct() {
		parent::__construct();
        Language::read('appointment');
        Tpl::output('index_sign','appointment');
    }
	
	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 预约列表
	 */
	public function listOp(){
		
		$condition				=	array();
		$condition['city_id']	=	$this->city_info['area_id'];	//城市ID
		$condition['store_state']	=	2;	//商铺开启
		$condition['is_audit']	=	2;	//审核通过
		$condition['is_appointment']	=	2;	//开启预约功能
		//城市分类
		$condition['city_id']	=	$this->city_info['area_id'];
		if(isset($_GET['area_id']) && !empty($_GET['area_id'])){
			//区域
			$condition['area_id'] = intval($_GET['area_id']);
			Tpl::output('area_id',intval($_GET['area_id']));
			if(isset($_GET['mall_id']) && !empty($_GET['mall_id'])){
				//商区
				$condition['mall_id'] = intval($_GET['mall_id']);
				Tpl::output('mall_id',intval($_GET['mall_id']));
			}
		}
		//商铺分类
		if(isset($_GET['class_id']) && !empty($_GET['class_id'])){
			$condition['class_id'] = intval($_GET['class_id']);
			Tpl::output('class_id',intval($_GET['class_id']));

			if(isset($_GET['class_id_1']) && !empty($_GET['class_id_1'])){
				$condition['s_class_id'] = intval($_GET['class_id_1']);
				Tpl::output('class_id_1',intval($_GET['class_id_1']));
			}
		}
		$model = Model();
		$appoint = $model->table('store')->where($condition)->select();
		
		if(!empty($appoint)){
			foreach($appoint as $key=>$val){
				$appoint[$key]['number'] = $model->table('appointment')->where(array('store_id'=>$val['store_id']))->count();
			}
		}
		//分类
		$this->classlist();
		//区域
		$this->arealist();
		//获取预约人数
		Tpl::output('appoint',$appoint);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('appointment.list');
	}
    
	/**
	 * 添加预约
	 * */
	public function orderOp(){		
		if(isset($_POST) && !empty($_POST)){
			$model = Model();
			$store = $model->table('store')->where(array('store_id'=>intval($_POST['store_id'])))->find();
			if(empty($store)){//验证店铺是否存在
				$this->showTip(L('nc_appointment_op_fail'),'','html','error');
			}
			if($store['store_id'] == $_SESSION['store_id']){
				$this->showTip('无法预约自己的店铺','','html','error');
			}
			$time = $_POST['appointtime'].' '.$_POST['hour'].':00:00';
			$appoint_time = strtotime($time);
			if($appoint_time <= time()){
				$this->showTip('请不要预约过去的时间','','html','error');
			}
			$appointment = $model->table('appointment')->where(array('member_id'=>$_SESSION['member_id'],'appointtime'=>$appoint_time))->find();
			
			if(!empty($appointment)){//检测是否重复预约
				$this->showTip(L('nc_appointment_already_appointment'),'','html','error');
			}

			$data = array(
				'store_id'		=>	$store['store_id'],
				'store_name'	=>	$store['store_name'],
				'person_num'	=>	intval($_POST['person_num']),
				'appointtime'	=>	$appoint_time,
				'mobile'		=>	trim($_POST['mobile']),
				'member_id'		=>	$_SESSION['member_id'],
				'contact'		=>	$_POST['contact']
			);
			
			$result = $model->table('appointment')->insert($data);
			
			if($result){
				//计入分数
				member_point_add('appointment');
				$this->showTip(L('nc_appointment_op_succ'),'','succ');	
			}else{
				$this->showTip(L('nc_appointment_op_fail'),'','html','error');	
			}			
		}
		
		$model = Model();
		$store = $model->table('store')->where(array('store_id'=>intval($_GET['store_id']),'is_audit'=>2))->find();//审核通过的店铺
		Tpl::output('store',$store);
		Tpl::showpage('appointment.order','null_layout');
	}
	
	
}
