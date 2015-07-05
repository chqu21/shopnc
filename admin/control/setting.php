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

class settingControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('setting');
	}

	/**
	 * 站点设置
	 */
	public function base_informationOp(){
		if(isset($_POST) && !empty($_POST)){	
			$params	= array();
			if(!empty($_FILES['site_logo']['name'])){
				$uploadArr = $this->upload_pic('site_logo');
				if($uploadArr['state'] === false){
					$this->showTip($uploadArr['name'],'','error');
				}
				$params['site_logo']	= $uploadArr['name'];
			}
			
		    if(!empty($_FILES['member_logo']['name'])){
                $uploadArr = $this->upload_pic('member_logo');
                if($uploadArr['state'] === false){
                    $this->showTip($uploadArr['name'],'','error');
                }
                $params['member_logo']    = $uploadArr['name'];
            }
            
		    if(!empty($_FILES['seller_logo']['name'])){
                $uploadArr = $this->upload_pic('seller_logo');
                if($uploadArr['state'] === false){
                    $this->showTip($uploadArr['name'],'','error');
                }
                $params['seller_logo']    = $uploadArr['name'];
            }
            
			if(!empty($_FILES['weixin_qrcode']['name'])){
                $uploadArr = $this->upload_pic('weixin_qrcode');
                if($uploadArr['state'] === false){
                    $this->showTip($uploadArr['name'],'','error');
                }
                $params['weixin_qrcode'] = $uploadArr['name'];
            }
            
			if(!empty($_FILES['qrcode_app_url']['name'])){
                $uploadArr = $this->upload_pic('qrcode_app_url');
                if($uploadArr['state'] === false){
                    $this->showTip($uploadArr['name'],'','error');
                }
                $params['qrcode_app_url'] = $uploadArr['name'];
            }
            
			$params['site_name']	= trim($_POST['site_name']);
			$params['icp_number']	= trim($_POST['icp_number']);
			$params['statistics_code']	= htmlspecialchars(trim($_POST['statistics_code']));
			$params['time_zone']	= $_POST['time_zone'];
			$params['site_status']	= $_POST['site_status'];
			$params['closed_reason']	= $_POST['closed_reason'];
			$params['ios_app_url']	    = $_POST['ios_app_url'];
			$params['android_app_url']	= $_POST['android_app_url'];
			$params['weixin_account']	= $_POST['weixin_account'];
			$params['remind_groupbuy']	= intval($_POST['remind_groupbuy']);
			$params['enabled_subdomain'] = $_POST['enabled_subdomain'];
			$params['subdomain_refuse']  = trim($_POST['subdomain_refuse'],',');
			
			$model	=	Model();
			//默认城市信息
			$area_id	=	intval($_POST['default_city']);
			$area_arr = $model->table('area')->where(array('area_id'=>$area_id))->find();
			$params['default_city']	= serialize($area_arr);
			
			
			foreach($params as $k=>$v){
				$model->table('setting')->where(array('name'=>$k))->update(array('value'=>$v));
			}
			
			$list = $model->table('setting')->select();

			$arr  = array();
			foreach($list as $v){
				$arr[$v['name']]	=	$v['value'];
			}
			F('setting',$arr,'cache');
			
			$this->showTip(Language::get('nc_admin_site_succ'),'','succ');
		}
		
		//配置
		$model		= Model();
		$setting	= $model->table('setting')->select();
		$list_setting	=	array();
		foreach($setting as $v){
			$list_setting[$v['name']] = $v['value'];
		}
		Tpl::output('list_setting',$list_setting);
		
		//城市
		$city	= $model->table('area')->where(array('parent_area_id'=>'0'))->select();
		Tpl::output('city',$city);
		
		Tpl::showpage('setting.base_information');
	}
	
	/*
	 * qq互联
	 */
	public function qqloginOp(){
		
		//编辑qq互联信息
		if(isset($_POST) && !empty($_POST)){
			$params					=	array();
			$params['qq_isuse']		=	intval($_POST['qq_isuse']);
			$params['qq_appid']		=	trim($_POST['qq_appid']);
			$params['qq_appkey']	=	trim($_POST['qq_appkey']);
			$params['qq_appcode']	=	trim($_POST['qq_appcode']);
			
			$model = Model();
			foreach($params as $key=>$value){
				$model->table('setting')->where(array('name'=>$key))->update(array('value'=>$value));
			}
			
			$list = $model->table('setting')->select();
			$arr  = array();
			foreach($list as $v){
				$arr[$v['name']]	=	$v['value'];
			}
			F('setting',$arr,'cache');
			
			$this->showTip(L('nc_admin_setting_qq_login'),'','succ');
		}
		
		//qq互联配置信息
		$model = Model();
		$setting = $model->table('setting')->select();
		$list = array();
		if(!empty($setting)){
			foreach($setting as $value){
				$list[$value['name']]	=	$value['value'];	
			}
		}

		Tpl::output('setting',$list);	
		Tpl::showpage('setting.qq');
	}
	
	/*
	 * 微博登陆
	 */
	public function weibologinOp(){
		if(isset($_POST) && !empty($_POST)){
			$params					=	array();
			$params['sina_isuse']	=	intval($_POST['sina_isuse']);	
			$params['sina_wb_akey']	=	trim($_POST['sina_wb_akey']);
			$params['sina_wb_skey']	=	trim($_POST['sina_wb_skey']);
			$params['sina_appcode']	=	trim($_POST['sina_appcode']);
			
			//weibo配置信息
			$model = Model();
			foreach($params as $key=>$value){
				$model->table('setting')->where(array('name'=>$key))->update(array('value'=>$value));
			}
			
			$list = $model->table('setting')->select();
			$arr  = array();
			foreach($list as $v){
				$arr[$v['name']]	=	$v['value'];
			}
			F('setting',$arr,'cache');
			
			$this->showTip(L('nc_admin_setting_weibo_login'),'','succ');
		}
		
		//新浪微博配置
		$model = Model();
		$setting = $model->table('setting')->select();
		$list = array();
		if(!empty($setting)){
			foreach($setting as $value){
				$list[$value['name']]	=	$value['value'];	
			}
		}
		
		Tpl::output('setting',$list);
		Tpl::showpage('setting.weibo');
	}

	
	/*
	 * 人人登陆
	 */
	public function renrenloginOp(){
		
		if(isset($_POST) && !empty($_POST)){
			$params	=	array();
			//$params
		}
		
		//人人配置
		$model 	 = Model();
		$setting = $model->table('setting')->select();
		$list = array();
		if(!empty($setting)){
			foreach($setting as $value){
				$list[$value['name']]	=	$value['value'];
			}
		}
		Tpl::output('setting',$list);
		Tpl::output('renren',$renren);
		Tpl::showpage('setting.renren');
	}
	
	/**
	 * 上传图片
	 */
	private function upload_pic($type){	
		if ($type == 'site_logo'){
		    $upload = new UploadFile();
            $uploaddir = ATTACH_COMMON_PATH;
            $upload->set('default_dir',$uploaddir);
			$result = $upload->upfile($type);
			if($result){
			    return array('state'=>'true','name'=>$upload->file_name);
			}else{
				return array('state'=>'false','name'=>$upload->error);
			}
			
		}elseif($type == 'member_logo'){
		    $upload = new UploadFile();
            $uploaddir = ATTACH_COMMON_PATH;
            $upload->set('default_dir',$uploaddir);
		    $result = $upload->upfile('member_logo');
			if($result){
                return array('state'=>'true','name'=>$upload->file_name);
            }else{
                return array('state'=>'false','name'=>$upload->error);
            }
		}elseif($type == 'seller_logo'){
			$upload = new UploadFile();
            $uploaddir = ATTACH_COMMON_PATH;
            $upload->set('default_dir',$uploaddir);
		    $result = $upload->upfile('seller_logo');
			if($result){
                return array('state'=>'true','name'=>$upload->file_name);
            }else{
                return array('state'=>'false','name'=>$upload->error);
            }
		}elseif($type == 'qrcode_app_url'){
			$upload = new UploadFile();
            $uploaddir = ATTACH_COMMON_PATH;
            $upload->set('default_dir',$uploaddir);
		    $result = $upload->upfile('qrcode_app_url');
			if($result){
                return array('state'=>'true','name'=>$upload->file_name);
            }else{
                return array('state'=>'false','name'=>$upload->error);
            }
		}elseif($type == 'weixin_qrcode'){
			$upload = new UploadFile();
            $uploaddir = ATTACH_COMMON_PATH;
            $upload->set('default_dir',$uploaddir);
		    $result = $upload->upfile('weixin_qrcode');
			if($result){
                return array('state'=>'true','name'=>$upload->file_name);
            }else{
                return array('state'=>'false','name'=>$upload->error);
            }
		}else{
			return array('state'=>'false','name'=>L('nc_upload_fail'));
		}
	}

	/**
	 * Email设置
	 */
	public function email_informationOp(){
		if(isset($_POST) && !empty($_POST)){
			$update_array = array();
			$update_array['email_enabled']	= trim($_POST['email_enabled']);
			$update_array['email_type'] = trim($_POST['email_type']);
			$update_array['email_host'] = trim($_POST['email_host']);
			$update_array['email_port'] = trim($_POST['email_port']);
			$update_array['email_addr'] = trim($_POST['email_addr']);
			$update_array['email_id'] = trim($_POST['email_id']);
			$update_array['email_pass'] = trim($_POST['email_pass']);
			
			$model	= Model();
			foreach($update_array as $k=>$v){
				$model->table('setting')->where(array('name'=>$k))->update(array('value'=>$v));
			}
			$list = $model->table('setting')->select();
			$arr  = array();
			foreach($list as $v){
				$arr[$v['name']]	=	$v['value'];
			}
			F('setting',$arr,'cache');
			$this->showTip(Language::get('nc_admin_save_succ'),'','succ');
		}

		$model		= Model();
		$setting	= $model->table('setting')->select();
		$list_setting	=	array();
		foreach($setting as $v){
			$list_setting[$v['name']] = $v['value'];
		}
		Tpl::output('list_setting',$list_setting);
		Tpl::showpage('setting.email_setting');
	}
	

	/**
	 * 测试邮件发送
	 *
	 * @param
	 * @return
	 */
	public function email_testingOp(){
		/**
		 * 读取语言包
		 */
		$lang	= Language::getLangContent();
		$email_type = trim($_POST['email_type']);
		$email_host = trim($_POST['email_host']);
		$email_port = trim($_POST['email_port']);
		$email_addr = trim($_POST['email_addr']);
		$email_id = trim($_POST['email_id']);
		$email_pass = trim($_POST['email_pass']);

		$email_test = trim($_POST['email_test']);
		$subject	= $lang['test_email'];
		$site_url	= BASE_SITE_URL;

        $site_title = $GLOBALS['setting_config']['site_name'];
        $message = '<p>'.$lang['this_is_to']."<a href='".$site_url."' target='_blank'>".$site_title.'</a>'.$lang['test_email_send_ok'].'</p>';
		if ($email_type == '1'){
			require_once(BASE_CORE_PATH.DS.'framework'.DS.'libraries'.DS.'email.php');
			$obj_email = new Email();
			$obj_email->set('email_server',$email_host);
			$obj_email->set('email_port',$email_port);
			$obj_email->set('email_user',$email_id);
			$obj_email->set('email_password',$email_pass);
			$obj_email->set('email_from',$email_addr);
            $obj_email->set('site_name',$site_title);
			$result = $obj_email->send($email_test,$subject,$message);
		}else {
			$result = @mail($email_test,$subject,$message);
		}
       if ($result === false){
            $message = $lang['test_email_send_fail'];
            if (strtoupper(CHARSET) == 'GBK'){
                $message = Language::getUTF8($message);
            }
            showMessage($message,'','json');
        }else {
            $message = $lang['test_email_send_ok'];
            if (strtoupper(CHARSET) == 'GBK'){
                $message = Language::getUTF8($message);
            }
            showMessage($message,'','json');
        }
    }


	/**
	 * SEO设置
	 */
	public function seo_informationOp(){
		if(isset($_POST) && !empty($_POST)){
			$model	= Model();
			$params	=	array(
				'title'		=>	trim($_POST['title']),
				'keywords'	=>	trim($_POST['keywords']),
				'description'=>	trim($_POST['description'])
			);	
			$result = $model->table('seo')->where(array('type'=>trim($_POST['seo_type'])))->update($params);
			if($result){
				$this->showTip(Language::get('nc_admin_seo_edit_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_seo_edit_fail'));
			}
		}
		$seo_type	= isset($_GET['type'])?trim($_GET['type']):'index';
		$model		= Model();
		$seo	= $model->table('seo')->where(array('type'=>$seo_type))->find();
		if(empty($seo)){
			$this->showTip(Language::get('nc_admin_item_is_not_exists'));
		}
		Tpl::output('seo',$seo);
		Tpl::showpage('setting.seo_setting');
	}
	
	/*
	 * 关于我们
	 */
	public function aboutusOp(){
		Tpl::showpage('setting.about');
	}
}
