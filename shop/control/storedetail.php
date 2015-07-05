<?php
	class storedetailControl extends Control{
		public function __construct(){
			if(!isset($_SESSION['store_id']) || $_SESSION['store_id']<1){
				header("Location:index.php?act=slogin");
				exit;
			}
			
			$model = Model();
			$store = $model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find();
			if($store['store_state'] != 1){
				header("Locationi:index.php?act=storesetting");
				exit;
			}

			Language::read('common');
			Language::read('storelogin');

			/**
			 * 设置模板文件夹路径
			 */
			Tpl::setDir('member');

			/**
			 * 设置布局文件内容
			 */
			Tpl::setLayout('member_store_layout');
			$this->layout	=	'create_store_msg';
			Tpl::output('sign','create_store');

		}

		public function indexOp(){
			$this->storedetailOp();
		}
		
		
		/*
		 * 完善商户信息
		 */		
		public function storedetailOp(){
			if(isset($_POST)&&!empty($_POST)){
				$uploadarr	=	$this->upload_pic('pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				//验证规则
				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST['store_name'],"require"=>"true","message"=>Language::get('nc_store_name_not_null')),
					array("input"=>$_POST['alisa'],"require"=>"true","message"=>Language::get('nc_alisa_name_not_null')),
					array("input"=>$_POST['city'],"require"=>"true","validator"=>"Number","message"=>Language::get('nc_address_is_error')),
					array("input"=>$_POST['area'],"require"=>"ture","validator"=>"Number","message"=>Language::get('nc_address_is_error')),
					array("input"=>$_POST['mall'],"require"=>"ture","validator"=>"Number","message"=>Language::get('nc_address_is_error')),
					array("input"=>$_POST['class'],"require"=>"true","message"=>Language::get('nc_class_name_not_null')),
					array("input"=>$_POST['s_class'],"require"=>"true","message"=>Language::get('nc_class_name_not_null'))
				);
				
				$error = $obj_validate->validate();
				if ($error != ''){
					$this->showTip(Language::get('error').$error,'','html','error');
				}

				//创建商铺
				$params = array();
				$params['class_id']			= $_POST['class'];
				$params['s_class_id']		= $_POST['s_class'];
				$params['store_name']		= trim($_POST['store_name']);
				$params['alisa']			= trim($_POST['alisa']);
				//$params['telephone']		= $_POST['area_number'].'-'.$_POST['telephone'];
				$params['telephone']		= $_POST['telephone'];
				$params['city_id']			= intval($_POST['city']);
				$params['area_id']			= intval($_POST['area']);	
				$params['mall_id']			= intval($_POST['mall']);
				$params['address']			= trim($_POST['address']);
				$params['pic']				= $uploadarr['name'];
				$params['side']				= trim($_POST['side']);
				$params['business_hour']	= trim($_POST['business_hour']);
				$params['bus']				= trim($_POST['bus']);
				$params['subway']			= trim($_POST['subway']);
				$params['description']		= $_POST['description'];
				$params['add_time']			= time();
				$params['store_state']		= 2;
				//$params['is_brand']		= intval($_POST['brand_store']);
				$params['email']		= trim($_POST['email']);
				
				if($params['is_brand'] == 1){
					$params['brand_id']	=	intval($_POST['brand_id']);
				}
				$params['is_audit']		= 1;
				
				$condition	=	array(
					'store_id'	=>	intval($_POST['store_id'])	
				);

				$store_model	= Model('store');
				$result = $store_model->modify($params,$condition);
				if($result){
					//更新地区，分类商铺数
					$info = $this->getStoreInfo($_POST['store_id']);
					$model	=	Model();
					
					$area_model = Model('area');
					$city = $area_model->getList(array('parent_area_id'=>'0'));
					if(!empty($city)){
						foreach($city as $city){
							$area = $area_model->getList(array('parent_area_id'=>$city['area_id']));
							if(!empty($area)){
								foreach($area as $area){
									$mall = $area_model->getList(array('parent_area_id'=>$area['area_id']));
									if(!empty($mall)){
										foreach($mall as $mall){
											$mall_num = $model->table('store')->where(array('mall_id'=>$mall['area_id']))->count();
											$area_model->modify(array('number'=>$mall_num),array('area_id'=>$mall['area_id']));
										}
									}
									$area_num = $model->table('store')->where(array('area_id'=>$area['area_id']))->count();
									$area_model->modify(array('number'=>$area_num),array('area_id'=>$area['area_id']));
								}
							}
							$city_num = $model->table('store')->where(array('city_id'=>$area['city_id']))->count();
							$area_model->modify(array('number'=>$city_num),array('area_id'=>$city['area_id']));
						}
					}					
					
					$city_path  = BASE_DATA_PATH.'/cache/city/area_'.intval($_POST['city']).'.php';
					if(is_file($city_path)){
						unlink($city_path);
					}
					
					$class_path = BASE_DATA_PATH.'/cache/class/class_'.intval($_POST['city']).'.php';
					if(is_file($class_path)){
						unlink($class_path);
					}
					unset($_SESSION['store_id']);
					$this->showTip(L('nc_area_save_succ'),'index.php?act=slogin','succ');
				}else{
					$this->showTip(L('nc_area_save_fail'),'','html','error');
				}
			}

			//城市
			$area_model = Model('area');
			$condition_area = array();
			$condition_area['parent_area_id'] = 0;
			$area_list = $area_model->getList($condition_area);
			Tpl::output('area_list',$area_list);

			//分类
			$store_class_model = Model('store_class');
			$condition_class = array();
			$condition_class['parent_class_id'] = 0;
			$class_list = $store_class_model->getList($condition_class);
			Tpl::output('class_list',$class_list);
			
			//品牌
			$model = Model();
			$brand = $model->table('brand')->order('brand_sort asc')->select();
			Tpl::output('brand',$brand);

			Tpl::showpage('store.info');
		}


		/**
		 * 上传图片
		 */
		public function upload_pic(){	
			$upload = new UploadFile();
			$uploaddir = ATTACH_STORE_PATH;
			$upload->set('default_dir',$uploaddir);
			$upload->set('thumb_width',	'218');
			$upload->set('thumb_height','200');
			$upload->set('thumb_ext',	'_small');

			if (!empty($_FILES['pic']['name'])){
				$result = $upload->upfile('pic');
				if($result){
					return array('state'=>'true','name'=>$upload->thumb_image);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}
			}else{
				return array('state'=>'false','name'=>L('nc_upload_fail'));
			}
		}

		/**
		 * ajax获取城市
		 *
		 */
		public function ajaxOp(){
			//获得请求类型
			$type	=	trim($_GET['type']);
			if(empty($type)){
				echo 'false';exit;
			}
			
			if($type == 'area'){
				//区域ajax请求
				$area_id = intval($_GET['area_id']);
				if(empty($area_id)){
					echo 'false';exit;
				}
				$condition		= array();
				$condition['parent_area_id']	= $area_id;
				$area_model = Model('area');
				$area_list	= $area_model->getList($condition);
				if(!empty($area_list)){
					echo json_encode($area_list);
				}else{
					echo 'false';
				}
			}elseif($type == 'class'){
				//分类ajax请求
				$class_id = intval($_GET['class_id']);
				if(empty($class_id)){
					echo 'false';exit;
				}
				$condition		= array();
				$condition['parent_class_id']	= $class_id;
				$store_class_model = Model('store_class');
				$class_list  = $store_class_model->getList($condition);
				if(!empty($class_list)){
					echo json_encode($class_list);
				}else{
					echo 'false';
				}
			}else{
				echo 'false';
			}
			exit;
		}

		/**
		 * 商铺信息
		 */
		protected function getStoreInfo($store_id){
			$store_model = Model('store');
			$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
			return $storeinfo;
		}

	}
?>