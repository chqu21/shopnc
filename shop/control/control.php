<?php
/**
 * 前台control父类,店铺control父类,会员control父类
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class Control{
	public function __construct(){
		//检测网站是否关闭
		if($GLOBALS['setting_config']['site_status'] != 1){
			echo $GLOBALS['setting_config']['closed_reason'];
			exit;
		}
        //页面导航列表
        $nav_list = $this->nav_list();
        Tpl::output('nav_list',$nav_list);
	}
	protected $layout	=	null;
	protected function showTip($msg,$url='',$show_type='html',$msg_type='succ',$is_show=1,$time=2000){
		/**
		 * 如果默认为空，则跳转至上一步链接
		 */
		$url = ($url!='' ? $url : getReferer());
		$msg_type = in_array($msg_type,array('succ','error')) ? $msg_type : 'error';
		if (is_array($url)){
			foreach ($url as $k => $v){
				$url[$k]['url'] = $v['url']?$v['url']:getReferer();
			}
		}
		/**
		 * 读取信息布局的语言包
		 */
		Language::read("msg");
		/**
		 * html输出形式
		 * 指定为指定项目目录下的error模板文件
		 */
		Tpl::setDir('');
		Tpl::output('html_title',Language::get('nc_html_title'));
		Tpl::output('msg',$msg);
		Tpl::output('url',$url);
		Tpl::output('msg_type',$msg_type);
		Tpl::output('is_show',$is_show);
		Tpl::showpage('msg',$this->layout,$time);
		exit;
	}
    
   	/**
	 * 页面导航列表
	 */
   protected function nav_list(){
		$nav_list = Model()->table('navigation')->order('nav_sort asc')->select();
        return $nav_list;
	}
}

class BaseHomeControl extends Control{
	protected $city_info = array();
	protected $order_sn	= null;
	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		Language::read('home');

		/**
         * 是否选择城市
         */
		if(empty($_COOKIE['city'])){		
			$cityinfo = unserialize($GLOBALS['setting_config']['default_city']);
			$this->city_info = $cityinfo;
		}else{
			$cityinfo = unserialize(stripslashes($_COOKIE['city']));
			$this->city_info = $cityinfo;
		}
		Tpl::output('city_id',$cityinfo['area_id']);
		Tpl::output('city',$cityinfo['area_name']);		
		
		/**
		 * 设置模板文件夹路径
		 */
		Tpl::setDir('home');
		
		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('home_layout');
		
		/**
		 * 转码
		 */
		if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
			$_GET = Language::getGBK($_GET);
		}
		
		$model = Model();
		$seo = $model->table('seo')->where(array('type'=>trim($_GET['act'])))->find();
		
		/**
		 * 本地生活Logo,标题
		 */
        Tpl::output('html_title',$seo['title']);
        
        /**
         * seo
         */
        Tpl::output('seo_keywords',$seo['keywords']);
        Tpl::output('seo_description',$seo['description']);
		
		$this->layout	=	'home_msg';
	}

	/**
	 * 商区列表
	 */
	protected function arealist(){
		$cityinfo = $this->city_info;

		$parent_area_id = $cityinfo['area_id'];
		if(!$area_list = F('area_'.$parent_area_id,null,'cache/city')){
			$area_model  = Model('area');
			$area_list = $area_model->getList(array('parent_area_id'=>$parent_area_id),'','area_sort asc');
			
			if(!empty($area_list)){
				foreach($area_list as $key=>$val){
					$area_list[$key][] = $area_model->getList(array('parent_area_id'=>$val['area_id']),'','area_sort asc');		
				}
			}
			F('area_'.$parent_area_id,$area_list,'cache/city');
		}

		Tpl::output('area_list',$area_list);
	}

	/**
	 * 分类列表
	 */
	protected function classlist(){
		$cityinfo = $this->city_info;
		$parent_area_id = $cityinfo['area_id'];
		if(!$class = F('class_'.$parent_area_id,null,'cache/class')){
			$model_class = Model('store_class');
			$class_list = $model_class->getList(TRUE,NULL,'class_sort asc');
			$class_root = array();
			$class_menu = array();
			
			if(!empty($class_list)){
				foreach($class_list as $key=>$val){
					if($val['parent_class_id'] == 0){
						$class_root[] = $class_list[$key];
					}else{
						$class_menu[$val['parent_class_id']][] = $class_list[$key];
					}
				}
			}
			$class = array('class_root'=>$class_root,'class_menu'=>$class_menu);
			F('class_'.$parent_area_id,$class,'cache/class');
		}
		Tpl::output('class_root',$class['class_root']);
		Tpl::output('class_menu',$class['class_menu']);
	}


	/**
	 * 人均消费
	 */
	protected function pconsume(){
		return	array(
			1	=>	Language::get('offline_20_below'),
			2	=>	Language::get('offline_21_50'),
			3	=>	Language::get('offline_51_80'),
			4	=>	Language::get('offline_81_120'),
			5	=>	Language::get('offline_121_200'),
			6	=>	Language::get('offline_201_500'),
			7	=>	Language::get('offline_500')
		);
	}

	/**
	 * 检测登陆
	 */
	protected function checklogin(){
		if($_SESSION['is_login']==1){
			@header("Location:index.php");
		}
	}
	
	/*
	 * 商铺信息
	 */
	protected function getStoreInfo($store_id){
		$store_model = Model('store');
		$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
		return $storeinfo;
	}
	
	/*
	 * 订单号
	 */
	public function snOrder() {
		$this->order_sn = date('Ymd').substr( implode(NULL,array_map('ord',str_split(substr(uniqid(),7,13),1))) , -8 , 8);
		return $this->order_sn;
	}
}


class basestoreControl extends Control{
	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		Language::read('store');
		Language::read('home');
		$this->layout	=	'store_msg';
		
		/*
		 * 检测商铺是否存在
		 */
		if($_GET['op'] != 'ajax_collect' && $_GET['op'] != 'ajax_give_flower'){
			$store_id  = intval($_GET['id']);
			$storeinfo = $this->getStoreInfo($store_id); 
			if(empty($storeinfo)){
				$this->showTip(L('nc_view_store_is_not_exists'),'index.php','html','error');
			}
			Tpl::output('storeinfo',$storeinfo);		
		}
		/**
         * 是否选择城市
         */
		if(empty($_COOKIE['city'])){		
			$cityinfo = unserialize($GLOBALS['setting_config']['default_city']);
			$this->city_info = $cityinfo;
		}else{
			if(get_magic_quotes_gpc()){
				$cityinfo = unserialize(stripslashes($_COOKIE['city']));
			}else{
				$cityinfo = unserialize($_COOKIE['city']);
			}
			$this->city_info	=	$cityinfo;
		}

		Tpl::output('city_id',$cityinfo['area_id']);
		Tpl::output('city',$cityinfo['area_name']);	
		/**
		 * 设置模板文件夹路径
		 */
		Tpl::setDir('store');

		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('store_layout');
		Tpl::output('site_name',$GLOBALS['setting_config']['site_name']);
	}

	/**
	 * 商铺信息
	 */
	protected function getStoreInfo($store_id){
		$store_model = Model('store');
		$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
		return $storeinfo;
	}
	
	/*
	 * 商户名称
	 */
	protected function getAreaName($area_id){
		$model_area		=	Model('area');
		$area	=	$model_area->getOne(array('area_id'=>$area_id));
		return $area['area_name'];
	}
}
class memberstoreControl extends Control{
	protected $store = array();
	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		Language::read('member_store');

		if(!isset($_SESSION['store_id']) || $_SESSION['store_id']<1){
			header("Location:index.php?act=slogin");
			exit;
		}	
		
		/**
		 * 设置模板文件夹路径
		 */
		Tpl::setDir('member');
		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('member_store_layout');
		$this->layout	=	'member_store_msg';

		$storeinfo = $this->getStoreInfo($_SESSION['store_id']);
		$this->store = $storeinfo;
		if($storeinfo['store_state'] == 1){			
			$this->showTip(L('nc_member_store_now_apply'),'index.php?act=storedetail');
		}elseif($storeinfo['store_state'] == 3){
			$this->showTip(L('nc_member_store_already_close'));
		}
	}

	/**
	 * 商铺信息
	 */
	protected function getStoreInfo($store_id){
		$store_model = Model('store');
		$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
		return $storeinfo;
	}

	protected function getAreaName($area_id){
		$model_area		=	Model('area');
		$area	=	$model_area->getOne(array('area_id'=>$area_id));
		return $area['area_name'];
	}
	
	/*
	 * 上传图片
	 */
	protected function upload($path,$type){
		$upload = new UploadFile();
		$upload->set('default_dir',$path);
		
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
class memberCenterControl extends control{
	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		Language::read('member');
		
		if(!isset($_SESSION['is_login']) || $_SESSION['is_login']!=1){
			$ref_url = request_uri();
			header("Location:index.php?act=login&ref_url=".urlencode($ref_url));
			exit;
		}

		/**
		 * 设置模板文件夹路径
		 */
		Tpl::setDir('member');
		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('member_layout');
		//tip layout
		$this->layout	=	'member_msg';
	}

	/**
	 * 设置左侧列表
	 */
	protected function menu($menu){
		Tpl::output('menu',$menu);
	}

}