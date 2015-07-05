<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storesettingControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','store_setting');
	}

	public function indexOp(){
		$this->dashboardOp();
	}
	/**
	 * dashboard页面
	 */
	public function dashboardOp(){
		$model = Model();
		$store_info = $model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find();
		Tpl::output('store_info',$store_info);
		//统计店铺数据
		$order_num = $model->field('count(*) as num')->table('order')->where(array('store_id'=>$_SESSION['store_id']))->find();
		$group_num = $model->field('count(*) as num')->table('groupbuy')->where(array('store_id'=>$_SESSION['store_id']))->find();
		$coupon_num = $model->field('count(*) as num')->table('coupon')->where(array('store_id'=>$_SESSION['store_id']))->find();
		$activity_num = $model->field('count(*) as num')->table('activity')->where(array('store_id'=>$_SESSION['store_id']))->find();
		$member_num = $model->field('count(*) as num')->table('card_member')->where(array('store_id'=>$_SESSION['store_id']))->find();
		Tpl::output('order_num',$order_num['num']);
		Tpl::output('group_num',$group_num['num']);
		Tpl::output('coupon_num',$coupon_num['num']);
		Tpl::output('activity_num',$activity_num['num']);
		Tpl::output('member_num',$member_num['num']);
		Tpl::showpage('store.dashboard');
	}
	/*
	 * 账号设置
	 */
	public function settingOp(){
		if(isset($_POST) && !empty($_POST)){
			$params = array();
			if(!empty($_FILES['pic']['name'])){
				$uploadarr	=	$this->upload_pic('pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['pic']		= $uploadarr['name'];
			}
			
			if(!empty($_FILES['logo']['name'])){
				$uploadarr	=	$this->upload_pic('logo');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['logo']		= $uploadarr['name'];
			}
			
			if(!empty($_FILES['qr_code']['name'])){
				$uploadarr	=	$this->upload_pic('qr_code');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['qr_code']		= $uploadarr['name'];
				$params['is_qr_saft']	= 1;
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
			$params['side']				= trim($_POST['side']);
			$params['business_hour']	= trim($_POST['business_hour']);
			$params['bus']				= trim($_POST['bus']);
			$params['subway']			= trim($_POST['subway']);
			$params['description']		= $_POST['description'];
			$params['wx_account']		= trim($_POST['wx_account']);
			$params['email']			= trim($_POST['email']);
			$params['seo_title']		= trim($_POST['seo_title']);
			$params['seo_keyword']		= trim($_POST['seo_keyword']);
			$params['seo_description']	= trim($_POST['seo_description']);
			if($GLOBALS['setting_config']['enabled_subdomain'] == 1){
				$subdomain_refuse = explode(',', $GLOBALS['setting_config']['subdomain_refuse']);
				if(in_array(trim($_POST['store_subdomain']), $subdomain_refuse)){
					$this->showTip('该二级域名被禁止使用','','html','error');
				}
				$params['store_subdomain']	= trim($_POST['store_subdomain']);
			}
			
			//更新标签
			$model = Model();
			$params['label']			= serialize($model->table('store_label')->where(array('store_id'=>$_SESSION['store_id']))->select());
			
			$condition	=	array();
			$condition['store_id'] = intval($_POST['store_id']);

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
										$mall_num = $model->table('store')->where(array('mall_id'=>$mall['area_id'],'is_audit'=>2))->count();//1.待审核 2.审核通过 3.审核未通过
										$area_model->modify(array('number'=>$mall_num),array('area_id'=>$mall['area_id']));
									}
								}
								$area_num = $model->table('store')->where(array('area_id'=>$area['area_id'],'is_audit'=>2))->count();
								//1.待审核 2.审核通过 3.审核未通过 
								$area_model->modify(array('number'=>$area_num),array('area_id'=>$area['area_id']));
							}
						}
						$city_num = $model->table('store')->where(array('city_id'=>$area['city_id']))->count();
						$area_model->modify(array('number'=>$city_num),array('area_id'=>$city['area_id']));
					}
				}
				
				$city_path  = BASE_DATA_PATH.'/cache/city/area_'.$info['city_id'].'.php';
				if(is_file($city_path)){
					unlink($city_path);
				}
				
				$class_path = BASE_DATA_PATH.'/cache/class/class_'.$info['city_id'].'.php';
				if(is_file($class_path)){
					unlink($class_path);
				}	
				$this->showTip(L('nc_member_store_op_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_op_fail'),'','html','error');
			}
		}

		//商户信息
		$info = $this->getStoreInfo($_SESSION['store_id']);
		//if(isset($info['telephone'])){
		//	$teleArr = explode('-',$info['telephone']);
		//}
		//$tele_area = isset($teleArr[0])?$teleArr[0]:'';
		//$tele_phone= isset($teleArr[1])?$teleArr[1]:'';
		//Tpl::output('tele_area',$tele_area);
		//Tpl::output('tele_phone',$tele_phone);
		Tpl::output('info',$info);

		//城市
		$area_model = Model('area');
		$condition_city = array();
		$condition_city['parent_area_id'] = 0;
		$city_list = $area_model->getList($condition_city);
		Tpl::output('city_list',$city_list);

		//区域
		$condition_area	= array();
		$condition_area['parent_area_id'] = $info['city_id'];
		$area_list = $area_model->getList($condition_area);
		Tpl::output('area_list',$area_list);

		//商区
		$condition_mall = array();
		$condition_mall['parent_area_id'] = $info['area_id'];
		$mall_list = $area_model->getList($condition_mall);
		Tpl::output('mall_list',$mall_list);

		//分类
		$class_model = Model('store_class');
		$condition_class = array();
		$condition_class['parent_class_id'] = 0;
		$class_list = $class_model->getList($condition_class);
		Tpl::output('class_list',$class_list);	
		$class_info = $class_model->table('store_class')->where(array('class_id'=>$info['s_class_id']))->find();
		if($class_info['class_settle'] > 0){
			Tpl::output('settle_show',$class_info['class_settle']);
		}else{
			$pclass_info = $class_model->table('store_class')->where(array('class_id'=>$class_info['parent_class_id']))->find();
			if($pclass_info['class_settle'] > 0){
				Tpl::output('settle_show',$pclass_info['class_settle']);
			}
		}
		//标签
		$model	= Model();
		$labellist = $model->table('store_label')->where(array('store_id'=>$_SESSION['store_id']))->select();
		Tpl::output('labellist',$labellist);	
		Tpl::showpage('store.setting');
	}
	
	/*
	 * 预约列表
	 */	
	public function appointmentlistOp(){
		$where = " store_id='".$_SESSION['store_id']."'";
		
		if($_POST['starttime']){
		    $where .=" and appointtime>='".strtotime($_POST['starttime'])."'";
		}
		if($_POST['endtime']){
		    $endtime = strtotime($_POST['endtime'])+86399;
		    $where .=" and appointtime<='".$endtime."'";
		}
		$page   =   10;
        $order  =   '`appointtime` desc';
        
		$list = Model()->table('appointment')->where($where)->page($page)->order($order)->select();
		Tpl::output('list',$list);
		Tpl::output('moreinfo',$_POST);
		Tpl::output('show_page',Model()->showpage());
		Tpl::showpage('storeappoint.list');
	}
    /**
     * 预约详情
     * */
   /* public function appointdetailOp(){
        $id = $_GET['appoint_id'];
        $appoint = Model()->table('appointment')->where(array('id'=>$id))->find();
        Tpl::output('appoint',$appoint);
        Tpl::showpage('storeappointment.info');
    }*/
	
	/**
	 * 修改密码
	 * */
	public function setpasswordOp(){
	    if(isset($_POST) && !empty($_POST)){
	       if(empty($_POST['old_password'])){
                $this->showTip(L('nc_member_old_password_not_null'),'','html','error');
            }           
            $aa = Model()->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find();
            if(md5($_POST['old_password']) != $aa['password']){
              $this->showTip(L('nc_member_old_password_fail'),'','html','error');
            }           
            $data = array();
            if($_POST['new_password'] == $_POST['sure_password']){
                $data['password'] = md5(trim($_POST['new_password']));
                $model = Model();
                $res = $model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->update($data);
                if($res){
                    $this->showTip(L('nc_member_password_suss'),'','succ');
                }else{
                    $this->showTip(L('nc_member_password_fail'),'','html','error');
                }
            }else{
                $this->showTip(L('nc_member_password_comper_not'),'','html','error');
            }
	    }
	    Tpl::showpage('setpassword');	    
	}
	
	/**
	 * 验证密码
	 * */
	public function check_passwordOp(){
	   $member = Model()->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find();
        if($member['password'] == md5(trim($_GET['old_password']))){
            echo 'true';exit;
        }else{
            echo 'false';exit;
        }
	}
	
	/*
	 * 浏览消费记录
	 */
	public function viewconsumeOp(){
		$model  = Model();
		$record = $model->field('card_record.*,card_member.card_number,card_member.member_name')->table('card_record,card_member')->join('left join')->on('card_record.card_id=card_member.id')->where(array('card_record.id'=>intval($_GET['card_id'])))->select();
		Tpl::output('record',$record);
		Tpl::showpage('store.consume');
	}
	
	/*
	 * 会员卡
	 */
	public function cardOp(){	
		if(isset($_POST) && !empty($_POST)){
			//编辑会员卡信息
			$params		=	array();
			$params['is_card']	=	$_POST['is_card'];
			
			if($params['is_card'] == 1){
				$params['card_discount']	= $_POST['card_discount'];
				$params['card_des']			= $_POST['card_des'];
				//上传会员卡
				if(!empty($_FILES['card_pic']['name'])){
					$uploadarr	=	$this->upload_pic('card_pic');
					if($uploadarr['state'] == false){
						$this->showTip($uploadarr['name'],'','html','error');
					}
					$params['card_pic']		= $uploadarr['name'];
				}
			}

			$store_model = Model('store');
			$result = $store_model->modify($params,array('store_id'=>$_SESSION['store_id']));
			if($result){
				$this->showTip(L('nc_member_store_member_card_edit_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_member_card_edit_fail'),'','html','error');
			}
		}
		
		//显示会员卡
		$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
		Tpl::output('info',$storeinfo);
		
		Tpl::output('sign','member_card');
		Tpl::showpage('store.card');
	}
	
	/*
	 * 添加消费记录
	 */
	public function addconsumeOp(){
		if(isset($_POST) && !empty($_POST)){
			$model = Model();
			$card = $model->table('card_member')->where(array('is_use'=>2,'card_number'=>$_POST['card_number']))->find();
			if(empty($card)){
				$this->showTip('该会员卡不存在或未激活','','html','error');
			}
			$data = array(
				'card_id'		=>  $card['id'],
				'price'			=>	$_POST['price'],
				'add_time'		=>	time(),
				'person_number'	=>	intval($_POST['person_number'])		
			);
			
			$result = $model->table('card_record')->insert($data);
			
			if($result){
				//添加消费记录成功 修改消费总额
				$model->table('card_member')->where(array('is_use'=>2,'card_number'=>$_POST['card_number']))->update(array('total_price'=>'total_price'+$_POST['price']));
				$this->showTip(L('nc_member_card_consume_record_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_card_consume_record_fail'),'','html','error');
			}
		}
		Tpl::showpage('store.addconsume');
	}
	
	/*
	 * 商铺会员列表
	 */
	public function memberOp(){
		if($this->store['is_card'] == '0'){
			$this->showTip(L('nc_member_member_card_is_stop'),'','html','error');
		}
		
		$model = Model();		
		$list = $model->table('card_member')->where(array('store_id'=>$_SESSION['store_id']))->page(15)->order('id desc')->select();
		
		Tpl::output('list',$list);
		Tpl::output('sign','member_card');
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('store.member');
	}

	/*
	 * 开启会员卡
	 */
	public function card_stateOp(){
		$model = Model();
		$card  = $model->table('card_member')->where(array('member_id'=>intval($_GET['member_id']),'store_id'=>$_SESSION['store_id']))->find();
		if(empty($card)){
			$this->showTip('没有找到改会员卡信息','index.php?act=storesetting&op=member','html','error');
		}
		$data= array(
				'is_use' =>	intval($_GET['is_use'])
		);
		$result = $model->table('card_member')->where(array('member_id'=>intval($_GET['member_id']),'store_id'=>$_SESSION['store_id']))->update($data);
		if($result){
			$this->showTip(L('nc_member_store_op_succ'),'index.php?act=storesetting&op=member','succ');
		}else{
			$this->showTip(L('nc_member_store_op_fail'),'index.php?act=storesetting&op=member','html','error');
		}
	}
	
	/**
	 * 上传图片
	 */
	public function upload_pic($type = 'pic'){	
		$upload = new UploadFile();
		
		if($type == 'pic'){
			$uploaddir = ATTACH_STORE_PATH;	//商铺图片
			$upload->set('default_dir',$uploaddir);
			if (!empty($_FILES[$type]['name'])){
				$result = $upload->upfile($type);
				if($result){
					return array('state'=>'true','name'=>$upload->file_name);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}
			}else{
				return array('state'=>'false','name'=>L('nc_upload_fail'));
			}
		}elseif($type == 'logo'){
			$uploaddir = ATTACH_STORE_PATH;	//商铺图片
			$upload->set('default_dir',$uploaddir);
			if (!empty($_FILES[$type]['name'])){
				$result = $upload->upfile($type);
				if($result){
					return array('state'=>'true','name'=>$upload->file_name);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}
			}else{
				return array('state'=>'false','name'=>L('nc_upload_fail'));
			}
		}elseif($type == 'card_pic'){
			$uploaddir = ATTACH_CARD_PATH;	//会员卡图片
			$upload->set('default_dir',$uploaddir);
			if (!empty($_FILES[$type]['name'])){
				$result = $upload->upfile($type);
				if($result){
					return array('state'=>'true','name'=>$upload->file_name);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}
			}else{
				return array('state'=>'false','name'=>L('nc_upload_fail'));
			}
		}elseif($type == 'appointment_pic'){
			$uploaddir = ATTACH_APPOINT_PATH;	//预约图片
			$upload->set('default_dir',$uploaddir);
			if(!empty($_FILES[$type]['name'])){
				$result = $upload->upfile($type);
				if($result){
					return array('state'=>'true','name'=>$upload->file_name);
				}else{
					return array('state'=>'false','name'=>$upload->error);
				}	
			}
		}else{
			$uploaddir = ATTACH_QRCODE_PATH;	//二维码图片
			$upload->set('default_dir',$uploaddir);
			if (!empty($_FILES[$type]['name'])){
				$result = $upload->upfile($type);
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
		}elseif($type == 'label'){
			//新增标签
			$model = Model();
			$label = $model->table('store_label')->where(array('store_id'=>$_SESSION['store_id'],'label_name'=>trim($_GET['name'])))->find();
			if(!empty($label)){
				echo json_encode(array('result'=>'false','label'=>L('nc_store_label_is_exists')));
				exit;
			}
			$params	=	array(
				'store_id'		=>	$_SESSION['store_id'],
				'label_name'	=>	trim($_GET['name'])
			);
			$result = $model->table('store_label')->insert($params);
			if($result){
				echo json_encode(array('result'=>'true','label'=>$result));
			}else{
				echo json_encode(array('result'=>'false','label'=>L('nc_store_label_add_fail')));
			}
		}elseif($type == 'dellabel'){
			//删除标签
			$model = Model();
			$label_id = intval($_GET['lable_id']);
			$result = $model->table('store_label')->where(array('label_id'=>$label_id))->delete();
			if($result){
				echo json_encode(array('result'=>'true'));
			}else{
				echo json_encode(array('result'=>'false'));
			}
		}else{
			echo 'false';
		}
		exit;
	}
	
	/*
	 * 预约管理
	 */
	public function appointmentOp(){
		if(isset($_POST) && !empty($_POST)){
			$params						=	array();
			//上传会员卡
			if(!empty($_FILES['appointment_pic']['name'])){
				$uploadarr	=	$this->upload_pic('appointment_pic');
				if($uploadarr['state'] == false){
					$this->showTip($uploadarr['name'],'','html','error');
				}
				$params['appointment_pic']		= $uploadarr['name'];
			}
			$params['is_appointment']	=	intval($_POST['is_appointment']);
			
			$condition	=	array();
			$condition['store_id']	=	$_SESSION['store_id'];
				
			
			$model  = Model();
			$result = $model->table('store')->where($condition)->update($params);
			
			if($result){
				$this->showTip(L('nc_member_appointment_operation_succ'),'','succ');		
			}else{
				$this->showTip(L('nc_member_appointment_operation_fail'),'','html','error');
			}
		}	
		
		$model = Model();
		Tpl::output('store',$model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find());
		Tpl::showpage('store.appointment');
	}
	
	/*
	 * 	ajax获取分类团购分佣比例 
	 */
	public function ajax_get_sc_settleOp(){
		$s_class = intval($_GET['s_class']);
		if($s_class > 0){
			$model = Model();
			$class_info = $model->table('store_class')->where(array('class_id'=>$s_class))->find();
			if($class_info['class_settle'] > 0){
				echo json_encode(array('done'=>true,'msg'=>'分佣比例：'.$class_info['class_settle'].'%'));die;
			}else{
				$pclass_info = $model->table('store_class')->where(array('class_id'=>$class_info['parent_class_id']))->find();
				if($pclass_info['class_settle'] > 0){
					echo json_encode(array('done'=>true,'msg'=>'分佣比例：'.$pclass_info['class_settle'].'%'));die;
				}else{
					echo json_encode(array('done'=>false));die;
				}
			}
		}else{
			echo json_encode(array('done'=>false));die;
		}
	}
	/**
	 * 修改头像
	 */
	public function avatarOp(){
		$model = Model();
		$store_info = $model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->find();
		Tpl::output('store_info',$store_info);
		Tpl::showpage('store.avatar');
	}
	/**
	 * 上传头像
	 */
	public function uploadOp(){
		if(!chksubmit()){
			redirect('index.php?act=storesetting&op=avatar');
		}
		import('function.thumb');
		$store_id = $_SESSION['store_id'];
		//上传图片
		if(!empty($_FILES['uploadimg']['name'])){
			$upload = new UploadFile();
			$uploaddir = ATTACH_MEMBER_PATH;
			$upload->set('thumb_width',	500);
			$upload->set('thumb_height',499);
			$ext = strtolower(pathinfo($_FILES['uploadimg']['name'], PATHINFO_EXTENSION));
			$upload->set('file_name',"tmp_store_avatar_$store_id.$ext");
			$upload->set('thumb_ext','_new');
			$upload->set('ifremove',true);
			$upload->set('default_dir',$uploaddir);
			$result = $upload->upfile('uploadimg');
			if($result){
				Tpl::output('newfile',$upload->thumb_image);
				Tpl::output('height',get_height(BASE_UPLOAD_PATH.'/shop/member/'.$upload->thumb_image));
				Tpl::output('width',get_width(BASE_UPLOAD_PATH.'/shop/member/'.$upload->thumb_image));
				Tpl::showpage('store.avatar');
			}else{
				$this->showTip('图片文件上传失败','','html','error');
			}
		}else{
			$this->showTip('请选择要上传的头像图片文件','','html','error');
		}
	}
	
	/**
	 * 图片裁剪
	 */
	public function cutOp(){
		if(chksubmit()){
			$thumb_width = 120;
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			$scale = $thumb_width/$w;
			$_POST['newfile'] = str_replace('..', '', $_POST['newfile']);
			$src = BASE_UPLOAD_PATH.DS.'shop/member'.DS.$_POST['newfile'];
			$avatarfile = BASE_UPLOAD_PATH.DS.'shop/member'.DS."store_avatar_{$_SESSION['store_id']}.jpg";
			import('function.thumb');
			$cropped = resize_thumb($avatarfile, $src,$w,$h,$x1,$y1,$scale);
			@unlink($src);
			Model()->table('store')->where(array('store_id'=>$_SESSION['store_id']))->update(array('avatar'=>'store_avatar_'.$_SESSION['store_id'].'.jpg'));
			$_SESSION['store_avatar'] = 'store_avatar_'.$_SESSION['store_id'].'.jpg';
			redirect('index.php?act=storesetting&op=avatar');
		}
	}
}
?>