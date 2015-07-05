<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storeactivityControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','activity_manage');
	}

	public function indexOp(){
		$this->activitylistOp();
	}
	/*
	 * 活动列表
	 */
	public function activitylistOp(){
		$activity_model	= Model('activity');
		$condition['store_id']	= $_SESSION['store_id'];
		//搜索
		if($_POST['activity_name'] != ''){
			$condition['activity_name'] = array('like','%'.$_POST['activity_name'].'%');
			Tpl::output('activity_name',$_POST['activity_name']);
		}
		$list = $activity_model->getList($condition,'','add_time desc');
		Tpl::output('list',$list);
		Tpl::showpage('storeactivity.list');
	}
	/*
	 * 活动添加
	 */
	public function addactivityOp(){
		if(isset($_POST) && !empty($_POST)){
			$params		=	array();
			if($_FILES['activity_pic']['name'] != ''){
				$uploadArr	=	$this->upload_pic('activity_pic');
				if($uploadArr['state'] == false){
					$this->showTip(L('nc_upload_fail'),'','html','error');
				}
				$params['pic'] = $uploadArr['name'];
			}
			$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
			if(strtotime(trim($_POST['start_time'])) < strtotime(date('Y-m-d',time()))){
				$this->showTip('起始时间不得早于当前日期','','html','error');
			}
			$params['activity_name']= trim($_POST['activity_name']);
			$params['store_id']		= $storeinfo['store_id'];
			$params['store_name']	= $storeinfo['store_name'];
			$params['start_time']	= strtotime(trim($_POST['start_time']));
			$params['end_time']		= strtotime(trim($_POST['end_time']));
			$params['add_time']		= time();
			$params['description']	= trim($_POST['description']);	
			$params['apply_time']	= strtotime(trim($_POST['apply_time']));
			if(!empty($_POST['apply_item'])){
				$apply_item = '';
				foreach($_POST['apply_item'] as $val){
					if(!empty($val)){
						$apply_item.=$val.',';
					}
				}
				
				if(!empty($apply_item)){
					$apply_item = trim($apply_item,',');
				}
				$params['apply_item'] = $apply_item;
			}

			$activity_model = Model('activity');
			$result = $activity_model->save($params);
			if($result){
				$this->showTip(L('nc_member_store_activity_save_succ'),'index.php?act=storeactivity','succ');
			}else{
				$this->showTip(L('nc_member_store_activity_save_fail'),'','html','error');
			}
		}
		
		Tpl::showpage('storeactivity.add');
	}
	
	/*
	 * 编辑活动
	 */
	public function editactivityOp(){
		if(isset($_POST) && !empty($_POST)){	
			$params 		= array();
			if(!empty($_FILES['activity_pic']['name'])){
				$uploadArr	=	$this->upload_pic('activity_pic');
				if($uploadArr['state'] == false){
					$this->showTip(L('nc_upload_fail'));
				}
				$params['pic']	= $uploadArr['name'];
			}
			
			$activity_mdoel = Model('activity');
			
			$params['activity_name'] = trim($_POST['activity_name']);
			$params['start_time']	= strtotime(trim($_POST['start_time']));
			$params['end_time']		= strtotime(trim($_POST['end_time']));
			$params['description']	= trim($_POST['description']);
			$params['apply_time']	= strtotime(trim($_POST['apply_time']));
			if(!empty($_POST['apply_item'])){
				$apply_item = '';
				foreach($_POST['apply_item'] as $val){
					if(!empty($val)){
						$apply_item.=$val.',';
					}
				}
				
				if(!empty($apply_item)){
					$apply_item = trim($apply_item,',');
				}
				$params['apply_item'] = $apply_item;
			}

			$condition					= array();
			$condition['activity_id']	= intval($_POST['activity_id']);
			$condition['store_id']		= $_SESSION['store_id'];
			$activity_model = Model('activity');
			$result = $activity_model->modify($params,$condition);
			if($result){
				$this->showTip(L('nc_member_store_activity_edit_succ'),'index.php?act=storeactivity','succ');
			}else{
				$this->showTip(L('nc_member_store_activity_edit_succ'),'','html','error');
			}
		}
		$activity_id = intval($_GET['activity_id']);
		$activity_mdoel = Model('activity');
		$activity = $activity_mdoel->getOne(array('activity_id'=>$activity_id,'store_id'=>$_SESSION['store_id']));
		
		if(empty($activity)){
			$this->showTip(L('nc_member_store_activity_is_not_exists'),'','html','error');
		}
		Tpl::output('activity',$activity);
		
		if(!empty($activity['apply_item'])){
			$signArr = explode(',',$activity['apply_item']);
			Tpl::output('signarr',$signArr);
		}
		Tpl::showpage('storeactivity.edit');
	}
	
	/*
	 * 删除活动
	 */
	public function delactivityOp(){
		$model	  = Model();
		$activity = $model->table('activity')->where(array('activity_id'=>intval($_GET['activity_id'])))->find();
		
		//活动不能为空
		if(empty($activity)){
			$this->showTip(L('nc_member_store_activity_is_not_exists'),'','index.php?act=storeactivity');
		}

		if($activity['store_id'] != $_SESSION['store_id']){
			$this->showTip(L('nc_member_store_activity_not_consistent'),'','index.php?act=storeactivity');
		}
		
		$result = $model->table('activity')->where(array('activity_id'=>intval($_GET['activity_id'])))->delete();
		if($result){
			$this->showTip(L('nc_member_store_activity_del_succ'),'','succ');
		}else{
			$this->showTip(L('nc_member_store_activity_del_fail'),'','html','error');
		}
	}
	
	/*
	 * 上传图片
	 */
	public function upload_pic(){
		$upload = new UploadFile();
		$uploaddir = ATTACH_ACTIVITY_PATH;
		$upload->set('default_dir',$uploaddir);
		$upload->set('thumb_width',	'218');
		$upload->set('thumb_height','200');
		$upload->set('thumb_ext',	'_small');
	
		if (!empty($_FILES['activity_pic']['name'])){
			$result = $upload->upfile('activity_pic');
			if($result){
				return array('state'=>'true','name'=>$upload->thumb_image);
			}else{
				return array('state'=>'false','name'=>$upload->error);
			}
		}else{
			return array('state'=>'false','name'=>L('nc_upload_fail'));
		}
	}
	
	/*
	 * 查看申请人
	 */
	public function viewapplyOp(){
		$activity_id = intval($_GET['activity_id']);
		$model = Model();
		$member = $model->table('activity_member')->where(array('activity_id'=>$activity_id))->select();
		Tpl::output('member',$member);
		Tpl::showpage('storeactivity.apply');
	}
}