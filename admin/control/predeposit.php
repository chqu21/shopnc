<?php
/**
 * 预存款管理
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

class predepositControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 充值列表
	 */
	public function listOp(){
		$model = Model();
		$condition = array();
		if(isset($_POST['member_name']) && !empty($_POST['member_name'])){
			$condition['member_name']	=	array('like',"%{$_POST['member_name']}%");	
			Tpl::output('member_name',trim($_POST['member_name']));
		}
		if(isset($_POST['state']) && !empty($_POST['state'])){
			$condition['state']	=	intval($_POST['state']);
			Tpl::output('state',intval($_POST['state']));
		}
		$list = $model->table('predeposit_charge')->where($condition)->page(10)->order('charge_time desc')->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('predeposit.list');
	}
	/**
	 * 删除充值记录
	 */
	public function delOp(){
		$pre_id = intval($_GET['pre_id']);
		if($pre_id <= 0){
			$this->showTip('参数错误');
		}
		$model = Model();
		$rs = $model->table('predeposit_charge')->where(array('pre_id'=>$pre_id))->delete();
		if($rs){
			$this->showTip('操作成功');
		}else{
			$this->showTip('操作失败');
		}
	}
	
}