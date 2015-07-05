<?php
/**
 * 站点设置
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class storeControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('store');
	}
	
	public function indexOp(){
		$this->storelistOp();
	}
	
	/*
	 * 开通商铺列表
	 */
	public function storelistOp(){
		$store_model = Model('store');
		if(isset($_POST['store_name']) && !empty($_POST['store_name'])){
			$condition['store_name']	=	array('like',"%{$_POST['store_name']}%");	
			Tpl::output('store_name',trim($_POST['store_name']));
		}
		
		$condition['store_state']	 = isset($_GET['state'])?$_GET['state']:2;
		if(isset($_POST['audit']) && !empty($_POST['audit'])){
			$condition['is_audit']	=	intval($_POST['audit']);
			Tpl::output('audit',intval($_POST['audit']));
		}
		
		$list = $store_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::output('show_page',$store_model->showpage(2));	
		
		if($condition['store_state'] == 1){
			Tpl::showpage('store.create');
		}elseif($condition['store_state'] == 2){
			Tpl::showpage('store.list');
		}elseif($condition['store_state'] == 3){
			Tpl::showpage('store.close');
		}
	}

	
	public function audit_qrOp(){
		
		if(isset($_POST)&&!empty($_POST)){

			$params		= array();
			$params['is_qr_saft'] = intval($_POST['is_qr_saft']);

			$model = Model();
			$res = $model->table('store')->where(array('store_id'=>intval($_POST['store_id'])))->update($params);

			if($res){
				$this->showTip('审核成功','index.php?act=store&op=storelist','succ');
			}else{
				$this->showTip('审核失败','index.php?act=store&op=storelist','error');
			}
		}

		$model = Model();
		$store = $model->table('store')->where(array('store_id'=>intval($_GET['store_id'])))->find();
		Tpl::output('store',$store);
		Tpl::showpage('store.auditqr');
	}

	/*
	 * 检测商铺账号
	 */
	public function checkaccountOp(){
		$account = trim($_GET['account']);
		$model = Model();
		$account = $model->table('store')->where(array('account'=>$account))->find();
		
		if(!empty($account)){
			echo 'false';
		}else{
			echo 'true';
		}
		exit;
	}
	
	/*
	 * 店铺状态
	 */
	public function storestateOp(){
		$store_id	=	intval($_GET['store_id']);
		$model = Model();
		$result = $model->table('store')->where(array('store_id'=>$store_id))->update(array('store_state'=>isset($_GET['state'])?$_GET['state']:3));
		if($result){
			$this->showTip(L('nc_store_close_succ'),'index.php?act=store','succ');
		}else{
			$this->showTip(L('nc_store_close_fail'),'index.php?act=store','error');
		}
	}
	
	/*
	 * 创建商铺
	 */
	public function applycheckOp(){
		
		//表单验证
		$obj_validate = new Validate();
		$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['account']),"require"=>"true","message"=>Language::get('nc_admin_admin_name_is_not_null')),
				array("input"=>trim($_POST['password']),"require"=>"true","message"=>Language::get('nc_admin_admin_password_is_not_null'))
		);
		
		$error = $obj_validate->validate();
		if ($error != ''){
			$this->showTip(Language::get('error').$error,'','error');
		}
		
		$params					=	array();
		$params['account']		=	trim($_POST['account']);
		$params['password']		=	md5(trim($_POST['password']));
		$params['store_state']	= 	1;
		
		$model = Model();
		$result = $model->table('store')->insert($params);
		
		if($result){
			$this->showTip(L('nc_store_create_store_succ'),'','succ');
		}else{
			$this->showTip(L('nc_store_create_store_fail'),'','error');
		}
	}
	
	/*
	 * 商家审核
	 */
	public function auditOp(){
		if(isset($_POST) && !empty($_POST)){
			
			$params				=	array();
			$params['is_audit']	=	intval($_POST['is_audit']);
			
			$condition			= array();
			$condition['store_id'] = intval($_POST['store_id']);
			
			$model = Model();
			$result = $model->table('store')->where($condition)->update($params);
			
			if($result){
				$this->showTip(L('nc_store_store_audit_succ'),'','succ');	
			}else{
				$this->showTip(L('nc_store_store_audit_fail'),'','error');	
			}
		}
		
		Tpl::output('store_id',intval($_GET['store_id']));
		Tpl::showpage('store.audit');
	}
	
	private function getName($type,$id){
		//分类名称
		if($type == 1){
			$model = Model();
			$info = $model->table('store_class')->where(array('class_id'=>$id))->find();
			return $info['class_name'];
		}elseif($type == 2){
			//区域名称
			$model = Model();
			$info = $model->table('area')->where(array('area_id'=>$id))->find();
			return $info['area_name'];
		}else{
			return false;
		}
	}

	public function storeclassOp(){
		$offline_model = Model("store_class");
		$condition	=	array();
        $list = $offline_model->getList($condition);

        Tpl::output('list',$list);
		Tpl::showpage('storeclass.list');
	}

	public function addOp(){
		$store_model = Model('store_class');
        $condition = array();
        $condition['parent_class_id'] = 0;
        $class_list = $store_model->getList($condition);
		
		//新增分类
		if(isset($_POST)&&!empty($_POST)){
			//数据验证
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['class_name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('nc_store_class_name_error')),
				array('input'=>$_POST['class_sort'],'require'=>'true','validator'=>'Range','min'=>0,'max'=>255,'message'=>Language::get('nc_store_class_sort_error')),
			);
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','','error');
			}
			

			$param = array();
			$param['class_name'] = trim($_POST['class_name']);
			if(isset($_POST['parent_class_id']) && intval($_POST['parent_class_id']) > 0){
				$param['parent_class_id'] = $_POST['parent_class_id'];
			}else{
				$param['parent_class_id'] = 0;
			}

			$param['class_sort'] = intval($_POST['class_sort']);
			$param['class_recommend'] = intval($_POST['is_recommend']);
			if(!empty($_FILES['class_image']['name'])) {
				$upload	= new UploadFile();
				$uploaddir = ATTACH_CLASS_PATH;
				$upload->set('default_dir',$uploaddir);
				$result = $upload->upfile('class_image');
				if(!$result) {
					$this->showTip($upload->error);
				}
				$param['class_image'] = $upload->file_name;
			}
			$result	=	$store_model->save($param);
			if($result){
				$this->showTip(Language::get('nc_store_class_add_succ'),'index.php?act=store&op=storeclass');
			}else{
				$this->showTip(Language::get('nc_store_class_add_fail'));
			}
		}
		
		$parent_class_id = intval($_GET['parent_class_id']);
        if(!empty($parent_class_id)) {
            Tpl::output('parent_class_id',$parent_class_id);
        }
		Tpl::output('op','add');
		Tpl::output('list',$class_list);
		Tpl::showpage('storeclass.add');
	}

	/**
	 *  编辑分类
	 */
	public function editOp(){
		$class_id	=	intval($_GET['class_id']);

		//取得一级分类列表
        $store_model = Model('store_class');
        $condition = array();
        $condition['class_id'] = $class_id;
        $class_info = $store_model->getList($condition);
        Tpl::output('class_info',$class_info[0]);		
		
		if(isset($_POST)&&!empty($_POST)){
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['class_name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('nc_store_class_name_error')),
				array('input'=>$_POST['class_sort'],'require'=>'true','validator'=>'Range','min'=>0,'max'=>255,'message'=>Language::get('nc_store_class_sort_error')),
			);

			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','','error');
			}

			$param = array();
			$param['class_name'] = trim($_POST['class_name']);
			$param['class_sort'] = intval($_POST['class_sort']);
			$param['class_recommend'] = intval($_POST['is_recommend']);
			$param['parent_class_id'] = intval($_POST['parent_class_id']);
			if(!empty($_FILES['class_image']['name'])) {
				$upload	= new UploadFile();
				$uploaddir = ATTACH_CLASS_PATH;
				$upload->set('default_dir',$uploaddir);
				$result = $upload->upfile('class_image');
				if(!$result) {
					$this->showTip($upload->error);
				}
				$param['class_image'] = $upload->file_name;
				//删除老图片
				//if(!empty($_POST['old_class_image'])) {
				//	$old_image = BasePath.DS.ATTACH_OFFLINE.DS.$_POST['old_class_image'];
				//	if(is_file($old_image)) {
				//		unlink($old_image);
				//	}
				//}
			}

			if(isset($_POST['class_id']) && intval($_POST['class_id']) > 0) {
				$result = $store_model->modify($param,array('class_id'=>$_POST['class_id']));
			} else {
				$result = $store_model->save($param);
			}
			if($result){
				delCacheFile('class');
				$this->showTip(Language::get('nc_store_class_edit_succ'),'index.php?act=store&op=storeclass');
			}else{
				$this->showTip(Language::get('nc_store_class_edit_fail'));
			}
		}
		$condition = array();
        $condition['parent_class_id'] = 0;
        $class_list = $store_model->getList($condition);
		//操作
		Tpl::output('op','edit');
		Tpl::output('list',$class_list);
		Tpl::showpage('storeclass.add');
	}

	/**
     * 分类删除
     **/
     public function dropOp() {
        $class_id = trim($_POST['class_id']);
        $store_model = Model('store_class');
        $condition = array();
        $condition['parent_class_id'] = array('in',$class_id);
        $class_list = $store_model->getList($condition,'','','class_id');

        if(!empty($class_list) && is_array($class_list)) {
            foreach($class_list as $val) {
                $class_id .= ','.$val['class_id']; 
            }
        }
        $class_id = rtrim($class_id,',');
        $condition = array();
        $condition['class_id'] = array('in',$class_id);
        //删除分类图片
        //$list = $offline_model->getList($condition);
        //if(!empty($list)) {
        //    foreach ($list as $value) {
        //        if(!empty($value['class_image'])) {
                    //删除老图片
          //          $old_image = BasePath.DS.ATTACH_OFFLINE.DS.$value['class_image'];
         //           if(is_file($old_image)) {
         //               unlink($old_image);
        //            }
        //        }
       //     }
       // }

        //删除分类
        $result = $store_model->drop($condition);
        if($result) {
            $this->showTip(Language::get('nc_store_class_detele_succ'),'');
        } else {
            $this->showTip(Language::get('nc_store_class_detele_fail'),'','','error');
        }

     }

	public function store_applyOp(){
		$model = Model();
		$model = $model->table('store')->where(array('state'=>1))->select();

	}
	/** 
     * ajax修改分类信息
     */
    public function ajax_update_classOp(){
    	$type = trim($_GET['type']);
    	$class_id = intval($_GET['class_id']);
    	$value = trim($_GET['value']);
    	//分佣比例不能超过100
    	if($type == 'class_settle' && intval($value) > 100){
    		echo json_encode(array('done'=>false,'msg'=>'分佣比例不能超过100%'));die;
    	}
    	if($class_id > 0 && $type != ''){
    		$model = Model();
    		$rs = $model->table('store_class')->where(array('class_id'=>$class_id))->update(array($type=>$value));
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false,'msg'=>'修改失败'));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false,'msg'=>'参数错误'));die;
    	}
    }
    /**
     * ajax修改分类推荐状态
     */
    public function ajax_recommendOp(){
    	$class_id = intval($_GET['class_id']);
    	$stat = intval($_GET['stat']);
    	if($class_id > 0 && ($stat==0 || $stat==1)){
    		$model = Model();
    		$rs = $model->table('store_class')->where(array('class_id'=>$class_id))->update(array('class_recommend'=>$stat));
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false));die;
    	}
    }
    /**
     * 修改商户密码
     */
    public function change_pwdOp(){
    	$model = Model();
    	if(isset($_POST) && !empty($_POST)){
    		$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['password'],'require'=>'true','message'=>'新密码必须填写'),
				array('input'=>$_POST['re_password'],'require'=>'true','message'=>'确认密码必须填写'),
			);
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','','error');
			}
			if($_POST['password'] != $_POST['re_password']){
				$this->showTip('两次密码输入不一致','','','error');
			}
			$rs_a = $model->table('member')->where(array('member_name'=>$_POST['member_name']))->update(array('password'=>md5($_POST['password'])));
			$rs_b = $model->table('store')->where(array('account'=>$_POST['member_name']))->update(array('password'=>md5($_POST['password'])));
    		if($rs_a && $rs_b){
    			$this->showTip('商户密码修改成功！','index.php?act=store&op=storelist&state=2','','succ');
    		}else{
    			$this->showTip('商户密码修改失败','','','error');
    		}
    	}
    	$store_id = intval($_GET['store_id']);
    	if($store_id <= 0){
    		$this->showTip('参数错误','','error');
    	}
    	$storeinfo = $model->table('store')->where(array('store_id'=>$store_id))->find();
    	Tpl::output('member_name',$storeinfo['account']);
    	Tpl::showpage('change_pwd');
    }
    
	/**
     * ajax修改优惠券推荐状态
     */
    public function ajax_store_recommendOp(){
    	$store_id = intval($_GET['store_id']);
    	$stat = intval($_GET['stat']);
    	if($store_id > 0 && ($stat==0 || $stat==1)){
    		$model = Model();
    		$rs = $model->table('store')->where(array('store_id'=>$store_id))->update(array('store_recommend'=>$stat));
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false));die;
    	}
    }
}
