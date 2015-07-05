<?php
/**
 * 活动管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class activityControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('website');
	}
	
	/*
	 * 活动列表
	 */
	public function activityOp(){	
		
		$model = Model();
		$activity = $model->table('activity')->select();	
		Tpl::output('list',$activity);
		
		//分页
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('activity.list');
	}
	
	
	/*
	 * 添加活动
	 */
	public function delactivityOp(){
		$activity_id	= intval($_GET['activity_id']);
		$model = Model();
		$result = $model->table('activity')->where(array('activity_id'=>$activity_id))->delete();
		
		//删除操作
		if($result){
			$this->showTip(L('nc_admin_website_activity_delete_succ'),'','succ');
		}else{
			$this->showTip(L('nc_admin_website_activity_delete_fail'),'','error');
		}
	}

}