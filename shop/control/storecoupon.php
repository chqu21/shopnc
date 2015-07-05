<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storecouponControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','coupon_manage');
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 优惠券列表
	 */
	public function listOp(){
		$coupon_model = Model('coupon');
		$condition	=	array();
		$condition['coupon.store_id']	= $_SESSION['store_id'];
		//搜索
		if($_POST['coupon_name'] != ''){
			$condition['coupon_name'] = array('like','%'.$_POST['coupon_name'].'%');
			Tpl::output('coupon_name',$_POST['coupon_name']);
		}
		$couponlist = $coupon_model->getList($condition,'','coupon_id desc');
		Tpl::output('list',$couponlist);
		Tpl::output('show_page',$coupon_model->showpage());
		Tpl::showpage('storecoupon.list');
	}
	
	/*
	 * 添加优惠券
	 */
	public function add_couponOp(){
		if(isset($_POST) && !empty($_POST)){
			$uploadArr	=	$this->upload_pic('coupon_pic');
			if($uploadArr['state'] == false){
				$this->showTip($uploadArr['name']);
			}
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['coupon_name']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_name_is_not_null')),
				array("input"=>trim($_POST['coupon_start_time']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_start_is_not_null')),
				array("input"=>trim($_POST['coupon_end_time']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_end_is_not_null'))
			);
			
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			
			$storeArr = $this->getStoreInfo($_SESSION['store_id']);
			$params			=	array();
			$params['coupon_name']		= trim($_POST['coupon_name']);
			$params['coupon_pic']		= $uploadArr['name'];
			$params['coupon_start_time']= strtotime(trim($_POST['coupon_start_time']));
			$params['coupon_end_time']	= strtotime(trim($_POST['coupon_end_time']));
			$params['coupon_des']		= trim($_POST['coupon_des']);
			$params['short_message']	= trim($_POST['short_message']);
			$params['store_id']			= $storeArr['store_id'];
			$params['store_name']		= $storeArr['store_name'];
			$params['city_id']			= $this->store['city_id'];
			//$params['download_type']	= intval($_POST['download_type']);
			
			$coupon_model	=	Model('coupon');
			$result	=	$coupon_model->save($params);

			if($result){
				$this->showTip(Language::get('nc_member_store_coupon_name_save_succ'),'index.php?act=storecoupon','succ');
			}else{
				$this->showTip(Language::get('nc_member_store_coupon_name_save_fail'),'','html','error');
			}
		}
		Tpl::showpage('storecoupon.add');
	}

	
	/*
	 * 编辑优惠券
	 */
	public function edit_couponOp(){
		if(isset($_POST) && !empty($_POST)){
			$params	=	array();
			if(!empty($_FILES['coupon_pic']['name'])){
				$uploadarr	=	$this->upload_pic('coupon_pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['coupon_pic']		= $uploadarr['name'];
			}
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['coupon_name']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_name_is_not_null')),
				array("input"=>trim($_POST['coupon_start_time']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_start_is_not_null')),
				array("input"=>trim($_POST['coupon_end_time']),"require"=>"true","message"=>Language::get('nc_member_store_coupon_end_is_not_null'))
			);
			
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}

			$storeArr = $this->getStoreInfo($_SESSION['store_id']);
			$params['coupon_name']		= trim($_POST['coupon_name']);
			$params['coupon_start_time']= strtotime(trim($_POST['coupon_start_time']));
			$params['coupon_end_time']	= strtotime(trim($_POST['coupon_end_time']));
			$params['coupon_des']		= trim($_POST['coupon_des']);
			$params['short_message']	= trim($_POST['short_message']);
			$params['store_id']			= $storeArr['store_id'];
			$params['store_name']		= $storeArr['store_name'];
			$params['city_id']			= $this->store['city_id'];
			//$params['download_type']	= intval($_POST['download_type']);
			$params['audit']			= 1;
	
			$condition	=	array();
			$condition['coupon_id']	= intval($_POST['coupon_id']);
			$coupon_model	=	Model('coupon');
			$result	=	$coupon_model->modify($params,$condition);

			if($result){
				$this->showTip(Language::get('nc_member_store_coupon_name_edit_succ'),'index.php?act=storecoupon','succ');
			}else{
				$this->showTip(Language::get('nc_member_store_coupon_name_edit_fail'),'','html','error');
			}
		}
		$coupon_id	= intval($_GET['coupon_id']);
		$model	= Model();
		$coupon = $model->table('coupon')->where(array('coupon_id'=>$coupon_id,'store_id'=>$_SESSION['store_id']))->find();
		
		if(empty($coupon)){
			$this->showTip(Language::get('nc_member_store_coupon_name_edit_fail'),'','html','error');
		}
		
		if($coupon['audit']==2){
			$this->showTip('该优惠券不能编辑','','html','error');
		}	

		Tpl::output('coupon',$coupon);
		Tpl::showpage('storecoupon.edit');
	}

	/**
	 * 删除优惠券
	 */
	public function del_couponOp(){
		$model  = Model();
		$coupon = $model->table('coupon')->where(array('coupon_id'=>intval($_GET['coupon_id'])))->find();
		
		//优惠券不存在
		if(empty($coupon)){
			$this->showTip(L('nc_member_store_coupon_is_not_exists'),'','html','error');
		}
		
		if($coupon['store_id'] != $_SESSION['store_id']){
			$this->showTip(L('nc_member_store_coupon_not_consistent'),'','html','error');	
		}
		
		if($coupon['audit']==2){
			$this->showTip('该团购不能删除','','html','error');
		}

		$result = $model->table('coupon')->where(array('coupon_id'=>intval($_GET['coupon_id'])))->delete();
		if($result){
			$this->showTip(L('nc_member_store_coupon_name_del_succ'),'index.php?act=storecoupon','succ');
		}else{
			$this->showTip(L('nc_member_store_coupon_name_del_fail'),'','html','error');
		}
	}

	/**
	 * 上传图片
	 */
	public function upload_pic(){	
		$upload = new UploadFile();
		$uploaddir = ATTACH_COUPON_PATH;
		$upload->set('default_dir',$uploaddir);
		$upload->set('thumb_width',	'218');
		$upload->set('thumb_height','200');
		$upload->set('thumb_ext',	'_small');

		if (!empty($_FILES['coupon_pic']['name'])){
			$result = $upload->upfile('coupon_pic');
			if($result){
				return array('state'=>'true','name'=>$upload->thumb_image);
			}else{
				return array('state'=>'false','name'=>$upload->error);
			}
		}else{
			return array('state'=>'false','name'=>L('nc_upload_fail'));
		}
	}
}
?>