<?php
/**
 * 区域管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class areaControl extends SystemControl{
	public function __construct(){
		parent::__construct();		
		Language::read('store');
	}
	
	/*
	 * 区域列表
	 */
	public function arealistOp(){

		$area_model = Model("area");
		$condition	=	array();
		$condition['parent_area_id'] = $_GET['area_parent_id']?intval($_GET['area_parent_id']):0;
		if(isset($_POST)&&!empty($_POST)){
			if(isset($_POST['area_name'])&&!empty($_POST['area_name'])){
				$condition['area_name']			=	array(array('like','%'.trim($_POST['area_name']).'%'));
				Tpl::output('area_name',trim($_POST['area_name']));
			}

			if(isset($_POST['first_letter'])&&!empty($_POST['first_letter'])){
				$condition['first_letter']		=	$_POST['first_letter'];
				Tpl::output('first_letter',$_POST['first_letter']);
			}		
		}
		
        $list = $area_model->getList($condition,15);
        if(!empty($list)){
        	foreach ($list as $key=>$val){
        		$child_area = $area_model->table('area')->where(array('parent_area_id'=>$val['area_id']))->select();
        		if(!empty($child_area)){
        			$list[$key]['have_child'] = 1;
        		}
        		unset($child_area);
        	}
        }
		Tpl::output('show_page',$area_model->showpage(2));	
        Tpl::output('list',$list);

		//城市首字母
		$letterArr	=	array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		Tpl::output('letter',$letterArr);
		if($_GET['ajax'] == '1'){
			//转码
			if (strtoupper(CHARSET) == 'GBK'){
				$list = Language::getUTF8($list);
			}
			$output = json_encode($list);
			print_r($output);
			exit;
		}else {
        	Tpl::showpage("area.list");
		}
	}

	/**
	 *  添加区域
	 */
	public function area_addOp(){		
		//添加区域
		if(isset($_POST)&&!empty($_POST)){
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['area_name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('nc_admin_area_name_error'))
			);
			
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				showMessage(Language::get('error').$error,'','','error');
			}
			
			$params	=	array(
				'area_name'			=>		$_POST['area_name'],
				'parent_area_id'	=>		isset($_POST['parent_area_id'])&&!empty($_POST['parent_area_id'])?$_POST['parent_area_id']:0,
				'add_time'			=>		time(),
				'first_letter'		=>		$_POST['first_letter'],
				'area_number'		=>		trim($_POST['area_number']),
				'post'				=>		trim($_POST['post']),
				'hot_city'			=>		intval($_POST['is_hot']),
				'area_sort'			=>		intval($_POST['area_sort'])
			);

			$area_model = Model("area");
			$result	=	$area_model->save($params);
			if($result){
				delCacheFile('city');
				showMessage(Language::get('nc_admin_area_add_success'),"index.php?act=area&op=arealist");
			}else{
				showMessage(Language::get('nc_admin_area_add_fail'),"index.php?act=area&op=arealist",'','error');
			}
		}
		
		

		//城市首字母
		$letterArr	=	array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		Tpl::output('letter',$letterArr);

		//获得分类
		if(isset($_GET['area_id'])){
			$area_model = Model("area");
			$condition	=	array();
			$condition	=	array(
				'area_id'	=>	intval($_GET['area_id'])
			);
			$area_list = $area_model->getList($condition);
			Tpl::output('area_name',$area_list[0]['area_name']);
			Tpl::output('area_id',$area_list[0]['area_id']);
		}else{
			Tpl::output('area_name',Language::get('nc_admin_first_area'));
			Tpl::output('area_id',0);
		}

		Tpl::showpage("area.add");
	}

	/**
	 *  编辑区域
	 */
	public function area_editOp(){
		//编辑区域
		if(isset($_POST)&&!empty($_POST)){
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['area_name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('nc_admin_area_name_error'))
			);

			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				showMessage(Language::get('error').$error,'','','error');
			}
			
			$udpate	=	array(
				'area_name'			=>		$_POST['area_name'],
				//'parent_area_id'	=>		isset($_POST['parent_area_id'])&&!empty($_POST['parent_area_id'])?$_POST['parent_area_id']:0,
				'add_time'			=>		time(),
				'first_letter'		=>		$_POST['first_letter'],
				'area_number'		=>		trim($_POST['area_number']),
				'post'				=>		trim($_POST['post']),
				'hot_city'			=>		intval($_POST['is_hot']),
				'area_sort'			=>		intval($_POST['area_sort'])
			);
			
			$condition	=	array(
				'area_id'	=>	intval($_POST['area_id'])	
			);
			$area_model = Model("area");
			$result	=	$area_model->modify($udpate,$condition);
			if($result){
				delCacheFile('city');
				showMessage(Language::get('nc_admin_area_edit_success'),"index.php?act=area&op=arealist");
			}else{
				showMessage(Language::get('nc_admin_area_edit_fail'),"index.php?act=area&op=arealist",'','error');
			}
		}

		//城市首字母
		$letterArr	=	array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','W','X','Y','Z');
		Tpl::output('letter',$letterArr);

		//获取区域信息
		$area_model = Model("area");
		$condition	=	array(
			'area_id'	=>	intval($_GET['area_id'])
		);
		$area_list = $area_model->getList($condition);
		$area_info = $area_list[0];
		Tpl::output('area_info',$area_info);

		$parent_area_id	=	$area_info['parent_area_id'];
		$parent_condition	=	array(
			'area_id'	=>		$parent_area_id
		);
		$parent_area	=	$area_model->getList($parent_condition);
		if(!empty($parent_area)){
			Tpl::output('parent_area_name',$parent_area[0]['area_name']);
		}else{
			Tpl::output('parent_area_name',Language::get('nc_admin_first_area'));
		}

		Tpl::showpage("area.edit");
	}

	/**
	 *  查看区域
	 */
	public function view_areaOp(){
		//获取区域信息
		$area_model  =	Model("area");
		$parent_area_id	=	intval($_GET['parent_area_id']);
		$condition	=	array(
				'parent_area_id'	=>	$parent_area_id
		);
		$area_list	=	$area_model->getList($condition,10);
		Tpl::output('show_page',$area_model->showpage(2));	
		Tpl::output('list',$area_list);

		$area	=	$area_model->getOne(array('area_id'=>$parent_area_id));
		Tpl::output('parent_area',$area);
		Tpl::showpage("city_area.list");
	}


	/**
	 *  查看商区
	 */
	public function view_mall_streetOp(){
		//获取区域信息
		$area_model = Model("area");
		$parent_area_id	=	intval($_GET['parent_area_id']);
		$condition	=	array(
				'parent_area_id'	=>	$parent_area_id
		);
		$mall_list	=	$area_model->getList($condition,10);
		Tpl::output('show_page',$area_model->showpage(2));	
		Tpl::output('list',$mall_list);
		
		$mall = $area_model->getOne(array('area_id'=>$parent_area_id));
		Tpl::output('parent_area',$mall);

		Tpl::showpage("mall.list");
	}

	public function ajaxOp(){
		$cityid = intval($_GET['id']);
		$offline_model = Model("offline_area");
		$params		=	array(
				'hot_city'	=>	intval($_GET['value'])
		);
		$result = $offline_model->modify($params,array('area_id'=>$cityid));
		if($result){
			echo 'true';
		}else{
			echo 'false';
		}
		exit;
	}

	/**
	 *  区域删除
	 */
	public function area_dropOp(){
		$model = Model();
		$result = $model->table('area')->where(array('area_id'=>array('in',$_POST['area_id'])))->delete();

		if($result){
			delCacheFile('city');
			showMessage(Language::get('nc_admin_area_delete_success'));
		}else{
			showMessage(Language::get('nc_admin_area_delete_fail'));
		}
	}
}
?>