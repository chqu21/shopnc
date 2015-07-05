<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storegroupbuyControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','group_manage');
	}

	public function indexOp(){
		$this->listOp();
	}

	public function listOp(){
		$group_model = Model('groupbuy');
		$condition	=	array();
		$condition['store_id']	= $_SESSION['store_id'];
		//搜索
		if($_POST['groupbuy_name'] != ''){
			$condition['group_name'] = array('like','%'.$_POST['groupbuy_name'].'%');
			Tpl::output('groupbuy_name',$_POST['groupbuy_name']);
		}
		if($_POST['state'] != ''){
			$state = intval($_POST['state']);
			switch ($state){
				case 1://待审核
					$condition['is_audit'] = 1;
					break;
				case 2://审核未通过
					$condition['is_audit'] = 3;
					break;
				case 3://还未开始
					$condition['is_audit'] = 2;
					$condition['start_time'] = array('gt',time());
					break;
				case 4://正在进行
					$condition['is_audit'] = 2;
					$condition['start_time'] = array('elt',time());
					$condition['end_time'] = array('gt',time());
					break;
				case 5://已过期
					$condition['is_audit'] = 2;
					$condition['end_time'] = array('elt',time());
					break;
			}
			Tpl::output('state',intval($_POST['state']));
		}
		$list = $group_model->getList($condition,10,'publish_time desc');
		Tpl::output('list',$list);
		Tpl::output('show_page',$group_model->showpage());
		Tpl::showpage('groupbuy.list');
	}

	public function addOp(){
		if(isset($_POST) && !empty($_POST)){
			$group_model = Model('groupbuy');
			$uploadArr	=	$this->upload_pic('groupbuy_pic');
			if($uploadArr['state'] == false){
				$this->showTip($uploadArr['name']);
			}
			$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
			$params			=	array();
			$params['group_name']		= trim($_POST['group_name']);
			$params['group_help']		= trim($_POST['group_help']);
			$params['start_time']		= strtotime(trim($_POST['start_time']));
			$params['end_time']			= strtotime(trim($_POST['end_time']));
			$params['store_id']			= $storeinfo['store_id'];
			$params['store_name']		= $storeinfo['store_name'];
			$params['original_price']	= trim($_POST['original_price']);
			$params['group_price']		= trim($_POST['group_price']);
			$params['buyer_count']		= trim($_POST['buyer_count']);
			$params['buyer_limit']		= trim($_POST['buyer_limit']);
			$params['group_intro']		= trim($_POST['group_intro']);
			$params['group_pic']		= $uploadArr['name'];
			$params['publish_time']		= time();
			$params['city_id']			= $this->store['city_id'];
			$params['area_id']			= $this->store['area_id'];
			$params['mall_id']			= $this->store['mall_id'];
			$params['class_id']			= $this->store['class_id'];
			$params['s_class_id']		= $this->store['s_class_id'];
			$params['is_refund']		= intval($_POST['is_refund']);
			$params['settle']           = 0;
			//调取分类分佣比例
			$class_info = $group_model->table('store_class')->where(array('class_id'=>$this->store['s_class_id']))->find();
			if($class_info['class_settle'] > 0){
				$params['settle'] = $class_info['class_settle'];
			}else{
				$pclass_info = $group_model->table('store_class')->where(array('class_id'=>$class_info['parent_class_id']))->find();
				$params['settle'] = $pclass_info['class_settle'];
			}
			$result = $group_model->table('groupbuy')->save($params);
			if($result){
				$model = Model();
				$model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->setInc('groupbuy_num',1);
				$this->showTip(L('nc_member_store_add_groupbuy_succ'),'index.php?act=storegroupbuy&op=list','succ');
			}else{
				$this->showTip(L('nc_member_store_add_groupbuy_fail'),'','html','error');
			}
		}
		Tpl::showpage('groupbuy.add');
	}

	public function editOp(){
		if(isset($_POST) && !empty($_POST)){
			$params			=	array();
			if(!empty($_FILES['groupbuy_pic']['name'])){
				$uploadarr	=	$this->upload_pic('groupbuy_pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['group_pic']		= $uploadarr['name'];
			}

			$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
			$params['group_name']		= trim($_POST['group_name']);
			$params['group_help']		= trim($_POST['group_help']);
			$params['start_time']		= strtotime(trim($_POST['start_time']));
			$params['end_time']			= strtotime(trim($_POST['end_time']));
			$params['store_id']			= $storeinfo['store_id'];
			$params['store_name']		= $storeinfo['store_name'];
			$params['original_price']	= trim($_POST['original_price']);
			$params['group_price']		= trim($_POST['group_price']);
			$params['buyer_count']		= trim($_POST['buyer_count']);
			$params['buyer_limit']		= trim($_POST['buyer_limit']);
			$params['group_intro']		= trim($_POST['group_intro']);
			$params['city_id']			= $this->store['city_id'];
			$params['area_id']			= $this->store['area_id'];
			$params['mall_id']			= $this->store['mall_id'];
			$params['class_id']			= $this->store['class_id'];
			$params['s_class_id']		= $this->store['s_class_id'];
			$params['is_refund']		= intval($_POST['is_refund']);

			$group_model = Model('groupbuy');
			$condition		=	array();
			$condition['group_id']	= trim($_POST['group_id']);
			//判断是否为“审核不通过”团购
			if(intval($_POST['audit_state']) == 3){
				$params['is_audit'] = 1;
			}
			$result = $group_model->modify($params,$condition);
			if($result){
				$this->showTip(L('nc_member_store_edit_groupbuy_succ'),'index.php?act=storegroupbuy&op=list','succ');
			}else{
				$this->showTip(L('nc_member_store_edit_groupbuy_fail'),'index.php?act=storegroupbuy&op=list','html','error');
			}
		}
		$group_id = intval($_GET['group_id']);
		$group_model = Model('groupbuy');

		$condition = array();
		$condition['group_id'] = $group_id;
		$condition['store_id'] = $_SESSION['store_id'];
		$group	= $group_model->getOne($condition);
		if(empty($group)){//检测该团购不存在
			$this->showTip(L('nc_member_store_edit_groupbuy_fail'),'index.php?act=storegroupbuy&op=list','html','error');
		}
		
		if($group['is_audit']==2){//2 审核通过
			$this->showTip('不能对该团购编辑','index.php?act=storegroupbuy&op=list','html','error');			
		}

		Tpl::output('group',$group);
		Tpl::showpage('groupbuy.edit');
	}

	public function deleteOp(){
		$model = Model();
		$group = $model->table('groupbuy')->where(array('group_id'=>intval($_GET['group_id'])))->find();
		
		if(empty($group)){//团购不存在
			$this->showTip(L('nc_member_store_groupbuy_is_exists'),'index.php?act=storegroupbuy','html','error');
		}

		if($group['store_id'] != $_SESSION['store_id']){
			$this->showTip(L('nc_member_store_groupbuy_not_consistent'),'index.php?act=storegroupbuy','html','error');
		}	
			
		if($group['is_audit']==2){//2 审核通过
			$this->showTip('不能对该团购编辑','index.php?act=storegroupbuy&op=list','html','error');			
		}

		$result = $model->table('groupbuy')->where(array('group_id'=>intval($_GET['group_id'])))->delete();//删除该团购
		if($result){
			$this->showTip(L('nc_member_store_groupbuy_delete_succ'),'index.php?act=storegroupbuy','succ');		
		}else{
			$this->showTip(L('nc_member_store_groupbuy_delete_fail'),'index.php?act=storegroupbuy','html','error');	
		}
	}

	/**
	 * 上传图片
	 */
	public function upload_pic(){	
		$upload = new UploadFile();
		$uploaddir = ATTACH_GROUPBUY_PATH;
		$upload->set('default_dir',$uploaddir);
		$upload->set('thumb_width',	'300');
		$upload->set('thumb_height','300');
		$upload->set('thumb_ext',	'_small');

		if (!empty($_FILES['groupbuy_pic']['name'])){
			$result = $upload->upfile('groupbuy_pic');
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