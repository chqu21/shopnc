<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class membercouponControl extends memberCenterControl{

	public function __construct(){
		parent::__construct();
	}
	
	/*
	 * 优惠券列表
	 */
	public function listOp(){
		$model	=	Model();
		$page	=	10;
		$order	=	'`download_time` desc';
		//搜索
		$where = array('member_id'=>$_SESSION['member_id']);
		if($_GET['s_content'] != ''){
			$where['coupon_name'] = array('like','%'.$_GET['s_content'].'%');
		}
		$list	=	$model->table('coupon_download')->where($where)->page($page)->order($order)->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		
		$this->menu('coupon');
		Tpl::output('menu_sign','coupon_manage');
		Tpl::showpage('coupon.list');
	}
}
?>