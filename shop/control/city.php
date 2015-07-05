<?php
/**
 * 本地生活首页
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class cityControl{

	public function __construct() {
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		Language::read('home');
        /**
         * 判断本地生活是否关闭
         */
		//if (C('offline_isuse') != '1'){
        //    header('location: '.SiteUrl);die;
		//}
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
		/**
		 * 获取导航
		 */
		//Tpl::output('nav_list',($nav = F('nav'))? $nav :H('nav',true,'file'));
		
		/**
		 * 本地生活Logo,标题
		 */
		Tpl::output('html_logo',C('offline_logo'));
        Tpl::output('html_title',C('offline_style'));

        /**
         * 页面导航列表
         */
        $nav_list = $this->nav_list();
        Tpl::output('nav_list',$nav_list);
        /**
         * seo
         */
        Tpl::output('seo_keywords',C('offlineshop_seo_keywords'));
        Tpl::output('seo_description',C('offlineshop_seo_description'));
        Tpl::output('index_sign','index');
    }

	/**
	 * 选择城市
	 */
	public function cityOp(){

		if(!$list = F('city')){
			$model_area = Model('area');
			$condition = array(
				'parent_area_id' => 0	
			);
			$list	= $model_area->getList($condition);
			F('city',$list,'cache/city');
		}
		Tpl::output('list',$list);
		
		//城市首字母
		$letterArr	=	array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','W','X','Y','Z');
		Tpl::output('letter',$letterArr);

		Tpl::showpage('area.select');
	}
   	/**
	 * 页面导航列表
	 */
   protected function nav_list(){
		$nav_list = Model()->table('navigation')->select();
        return $nav_list;
	}

	/**
	 * 选择城市
	 */
	public function select_cityOp(){
		$area_id = intval($_GET['area_id']);
		$model_area = Model('area');
		$area_info = $model_area->getOne(array('area_id'=>$area_id));
		
		if(empty($area_info)){
			showMessage('选择的城市不存在');
		}
		
		$area_str = serialize($area_info);

		setcookie('city',$area_str,time()+3600*24*30);
		header('Location:'.BASE_SITE_URL);
		exit;
	}
}
