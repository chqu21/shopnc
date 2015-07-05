<?php
defined('InShopNC') or exit('Access Invalid!');
class advControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('website');
	}
	
	public function indexOp(){
		$this->adv_positionOp();
	}
	
	/*
	 *	广告位列表
	 */
	public function adv_positionOp(){
		$condition	=	array();
		
		//查询
		if(isset($_POST['ap_class']) && !empty($_POST['ap_class'])){
			$condition['ap_class']	= intval($_POST['ap_class']);
			Tpl::output('ap_class',$condition['ap_class']);
		}
		
		if(isset($_POST['ap_name']) && !empty($_POST['ap_name'])){
			$condition['ap_name']	= trim($_POST['ap_name']);
			Tpl::output('ap_name',$condition['ap_name']);
		}
		
		$model = Model();
		$list = $model->table('adv_position')->where($condition)->select();
		Tpl::output('list',$list);
		
		Tpl::output('show_page',$model->showpage());		
		Tpl::showpage('adv_position.list');		
	}
	
	/*
	 * 新增广告位
	 */
	public function adv_addOp(){
		if(isset($_POST) && !empty($_POST)){
						
			//新增广告位
			$params				=	array();
			$params['ap_name']	=	trim($_POST['ap_name']);
			$params['ap_intro']	=	trim($_POST['ap_intro']);
			$params['ap_class']	=	trim($_POST['ap_class']);
			$params['ap_display']	=	trim($_POST['ap_display']);
			$params['is_use']	=	trim($_POST['is_use']);
			
			if($_POST['ap_width_media'] != ''){
				$params['ap_width']  = intval(trim($_POST['ap_width_media']));
			}
			
			if($_POST['ap_height'] != ''){
				$params['ap_height'] = intval(trim($_POST['ap_height']));
			}
			
			if($_POST['ap_width_word'] != ''){
				$params['ap_word']  = intval(trim($_POST['ap_width_word']));
			}
			
			if(!empty($_POST['ap_link'])){
				$params['link']	= trim($_POST['ap_link']);
			}
			
			//上传广告位图片
			if($_FILES['default_pic']['name'] != ''){
				$upload = new UploadFile();
				$upload->set('default_dir',ATTACH_ADV_PATH);
				
				$result = $upload->upfile('default_pic');
				if (!$result){
					showMessage($upload->error,'','','error');
				}
				$params['default_content'] = $upload->file_name;
			}
			
			$model = Model();
			$result = $model->table('adv_position')->insert($params);
			if($result){
				delCacheFile('rec_position');	
				showMessage(L('nc_admin_website_adv_add_succ'),'index.php?act=adv','succ');								
			}else{
				showMessage(L('nc_admin_website_adv_add_fail'),'index.php?act=adv','error');
			}
		}
		
		//添加广告位页面
		Tpl::showpage('adv_position.add');
	}
	
	/*
	 *	编辑广告位 
	 */
	public function edit_advOp(){
		if(isset($_POST) && !empty($_POST)){			
			//编辑广告位
			$params				=	array();
			$params['ap_name']	=	trim($_POST['ap_name']);
			$params['ap_intro']	=	trim($_POST['ap_intro']);
			$params['ap_class']	=	trim($_POST['ap_class']);
			$params['ap_display']	=	trim($_POST['ap_display']);
			$params['is_use']	=	trim($_POST['is_use']);
			
			if($_POST['ap_width_media'] != ''){
				$params['ap_width']  = intval(trim($_POST['ap_width_media']));
			}
			
			if($_POST['ap_height'] != ''){
				$params['ap_height'] = intval(trim($_POST['ap_height']));
			}
			
			if($_POST['ap_width_word'] != ''){
				$params['ap_word']  = intval(trim($_POST['ap_width_word']));
			}
			
			if(!empty($_POST['ap_link'])){
				$params['link']		= trim($_POST['ap_link']);	
			}
			
			//上传广告位图片
			if($_FILES['default_pic']['name'] != ''){
				$upload = new UploadFile();
				$upload->set('default_dir',ATTACH_ADV_PATH);
				
				$result = $upload->upfile('default_pic');
				if (!$result){
					showMessage($upload->error,'','','error');
				}
				$params['default_content'] = $upload->file_name;
			}
			
			$condition	=	array(
				'ap_id'		=>	intval($_POST['ap_id'])				
			);
						
			$model  = Model();
			$result = $model->table('adv_position')->where($condition)->update($params);

			if($result){
				delCacheFile('rec_position');	
				showMessage(L('nc_admin_website_adv_edit_succ'),'index.php?act=adv','succ');										
			}else{
				showMessage(L('nc_admin_website_adv_edit_fail'),'index.php?act=adv','error');
			}
		}
		
		//获得广告位
		$ap_id = intval($_GET['ap_id']);
		$model = Model();
		$adv   = $model->table('adv_position')->where(array('ap_id'=>$ap_id))->find();
		Tpl::output('adv',$adv);
		
		Tpl::showpage('adv_position.edit');
	}
	
	public function rec_codeOp(){
		Tpl::showpage('rec_position.code','null_layout');
	}
	
	/*
	 * 删除广告位
	 */
	public function	delOp(){				
		//单个删除
		if(isset($_GET['ap_id']) && !empty($_GET['ap_id'])){
			$model = Model();
			$result = $model->table('adv_position')->where(array('ap_id'=>intval($_GET['ap_id'])))->delete();
			if($result){
				showMessage(L('nc_admin_website_adv_del_succ'),'index.php?act=adv','succ');
			}else{
				showMessage(L('nc_admin_website_adv_del_fail'),'index.php?act=adv','error');
			}
		}
		
		//批量删除
		if(isset($_POST['ap_id']) && !empty($_POST['ap_id'])){
			$model = Model();
			$result = $model->table('adv_position')->where(array('ap_id'=>$_POST['ap_id']))->delete();
			if($result){
				showMessage(L('nc_admin_website_adv_del_succ'),'','succ');
			}else{
				showMessage(L('nc_admin_website_adv_del_fail'),'','error');
			}
		}		
	}
}