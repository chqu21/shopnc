<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storegoodsControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','goods_manage');
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 商品列表
	 */
	public function listOp(){
		$goods_model = Model('goods');
		$condition	=	array();
		$condition['store_id']	= $_SESSION['store_id'];
		//搜索
		if($_POST['goods_name'] != ''){
			$condition['goods_name'] = array('like','%'.$_POST['goods_name'].'%');
			Tpl::output('goods_name',$_POST['goods_name']);
		}
		$list = $goods_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::output('show_page',$goods_model->showpage());
		Tpl::showpage('storegoods.list');
	}
	
	/*
	 * 商品发布
	 */	
	public function addgoodsOp(){
		if(isset($_POST) && !empty($_POST)){
			$params = array();
			if(mb_strlen($_POST['goods_content'],'utf8') > 200){
				$this->showTip('商品描述请不要超过200个字','','html','error');
			}
			if(!empty($_FILES['goods_pic']['name'])){
				$uploadarr	=	$this->upload_pic('goods_pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['goods_pic']		= $uploadarr['name'];
			}
			
			$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
			$params['goods_name']	= trim($_POST['goods_name']);
			$params['goods_price']	= $_POST['goods_price'];
			$params['goods_content']	= $_POST['goods_content'];
			$params['add_time']		= time();
			$params['store_id']		= $_SESSION['store_id'];
			$params['store_name']	= $storeinfo['store_name'];

			$goods_model = Model('goods');
			$result = $goods_model->save($params);
			if($result){
				$this->showTip(L('nc_member_store_goods_add_succ'),'index.php?act=storegoods','succ');
			}else{
				$this->showTip(L('nc_member_store_goods_add_fail'),'','html','error');
			}
		}
		Tpl::showpage('storegoods.add');
	}
	
	/*
	 * 商品编辑
	 */
	public function edit_goodsOp(){	
		if(isset($_POST) && !empty($_POST)){
			//编辑商品
			$params = array();
			if(mb_strlen($_POST['goods_content'],'utf8') > 200){
				$this->showTip('商品描述请不要超过200个字','','html','error');
			}
			if(!empty($_FILES['goods_pic']['name'])){
				$uploadarr	=	$this->upload_pic('goods_pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['goods_pic']		= $uploadarr['name'];
			}
			$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
			
			$params['goods_name']	= trim($_POST['goods_name']);
			$params['goods_price']	= $_POST['goods_price'];
			$params['goods_content']= $_POST['goods_content'];
			$params['add_time']		= time();
			$params['store_id']		= $_SESSION['store_id'];
			$params['store_name']	= $storeinfo['store_name'];
			
			$goods_model = Model('goods');
			$result = $goods_model->modify($params,array('goods_id'=>intval($_POST['goods_id'])));//编辑商品
			if($result){
				$this->showTip(L('nc_member_store_goods_edit_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_goods_edit_fail'),'','html','error');
			}
		}

		//商品信息
		$goods_id	 = intval($_GET['goods_id']);
		$goods_model = Model('goods');
		$goods	=	$goods_model->getOne(array('goods_id'=>$goods_id,'store_id'=>$_SESSION['store_id']));
		
		if(empty($goods)){
			$this->showTip(L('nc_member_store_goods_edit_fail'),'','html','error');
		}

		Tpl::output('goods',$goods);
		Tpl::showpage('storegoods.edit');
	}
	
	/*
	 * 商品删除
	 */
	public function del_goodsOp(){
		//单个删除
		if(isset($_GET['goods_id']) && !empty($_GET['goods_id'])){
			$model = Model();
			$goods = $model->table('goods')->where(array('goods_id'=>intval($_GET['goods_id'])))->find();
			if($goods['store_id'] != $_SESSION['store_id']){
				$this->showTip(L('nc_member_store_goods_not_consistent'),'','html','error');
			}							
					
			$result = $model->table('goods')->where(array('goods_id'=>intval($_GET['goods_id'])))->delete();
			if($result){
				$this->showTip(L('nc_member_store_goods_del_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_goods_del_succ'),'','html','error');
			}
		}
		
		//批量删除
		if(isset($_POST['goods_id']) && !empty($_POST['goods_id'])){
			$model = Model();
			$goods = $model->table('goods')->where(array('goods_id'=>array('in',$_POST['goods_id'])))->select();
			
			$ids = '';
			if(!empty($goods)){
				foreach($goods as $gk=>$gv){
					if($gv['store_id'] != $_SESSION['store_id']){
						continue;
					}
					$ids.=$gv['goods_id'].',';
				}
				$ids = trim($ids,',');
			}

			$result = $model->table('goods')->where(array('goods_id'=>array('in',$ids)))->delete();
			if($result){
				$this->showTip(L('nc_member_store_goods_del_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_goods_del_fail'),'','html','error');
			}
		}
	}
	
	
	/**
	 * 上传商品图片
	 */
	public function upload_pic(){
		$upload = new UploadFile();
		$uploaddir = ATTACH_GOODS_PATH;
		$upload->set('default_dir',$uploaddir);
	
		if (!empty($_FILES['goods_pic']['name'])){
			$result = $upload->upfile('goods_pic');
			if($result){
				return array('state'=>'true','name'=>$upload->file_name);
			}else{
				return array('state'=>'false','name'=>$upload->error);
			}
		}else{
			return array('state'=>'false','name'=>L('nc_upload_fail'));
		}
	}
}
?>