<?php
/**
 * 品牌管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class brandControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('store');
	}
	
	/*
	 * 品牌列表
	 */
	public function brandlistOp(){	
		$model = Model();
		$brand = $model->table('brand')->select();
		Tpl::output('list',$brand);
		
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('brand.list');
	}
	
	/*
	 * 新增品牌
	 */
	public function addbrandOp(){
		if(isset($_POST) && !empty($_POST)){
			$params	=	array();
			if(!empty($_FILES['brand_pic']['name'])){
				$uploadArr = $this->upload_pic();
				if($uploadArr['state'] === false){
					$this->showTip($uploadArr['name'],'','error');
				}
				$params['brand_pic']	= $uploadArr['name'];
			}
			
			$params['brand_name']	=	trim($_POST['brand_name']);
			$params['brand_des']	=	$_POST['brand_des'];
			$params['brand_sort']	=	intval($_POST['brand_sort']);	
				
			$model = Model();
			$result = $model->table('brand')->insert($params);
			if($result){
				$this->showTip(L('nc_admin_brand_add_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_brand_add_fail'),'','error');
			}
		}
		Tpl::showpage('brand.add');
	}
	
	/*
	 * 编辑品牌
	 */
	public function brandeditOp(){
		//修改品牌信息
		if(isset($_POST) && !empty($_POST)){
			$params	=	array();
			
			if(!empty($_FILES['brand_pic']['name'])){
				$uploadArr = $this->upload_pic();
				if($uploadArr['state'] === false){
					$this->showTip($uploadArr['name'],'','error');
				}
				$params['brand_pic']	= $uploadArr['name'];
			}
			
			$params['brand_name']	=	trim($_POST['brand_name']);
			$params['brand_des']	=	$_POST['brand_des'];
			$params['brand_sort']	=	intval($_POST['brand_sort']);
			
			$condition	=	array();
			$condition['brand_id']	= (int)$_POST['brand_id']; 
			$model = Model();
			$result = $model->table('brand')->where($condition)->update($params);
			
			if($result){
				$this->showTip(L('nc_admin_brand_edit_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_brand_edit_fail'),'','error');
			}
		}
		
		$brand_id	=	intval($_GET['brand_id']);
		$model = Model();
		$brand = $model->table('brand')->where(array('brand_id'=>$brand_id))->find();
		Tpl::output('brand',$brand);
		Tpl::showpage('brand.edit');
	}
	
	/**
	 * 上传图片
	 */
	private function upload_pic(){
		$upload = new UploadFile();
		$uploaddir = ATTACH_BRAND_PATH;
		$upload->set('default_dir',$uploaddir);
		
		if (!empty($_FILES['brand_pic']['name'])){
			$result = $upload->upfile('brand_pic');
			if($result){
				return array('state'=>'true','name'=>$upload->file_name);
			}else{
				return array('state'=>'false','name'=>$upload->error);
			}
		}else{
			return array('state'=>'false','name'=>L('nc_upload_fail'));
		}
	}
	
	/*
	 * 删除品牌
	 */
	public function branddelOp(){
		$brand_id	=	intval($_GET['brand_id']);
		$model = Model();
		$result = $model->table('brand')->where(array('brand_id'=>$brand_id))->delete();
		if($result){
			$this->showTip(L('nc_admin_brand_del_succ'),'','succ');
		}else{
			$this->showTip(L('nc_admin_brand_del_fail'),'','error');
		}
	}
}