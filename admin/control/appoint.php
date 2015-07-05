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

class appointControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('store');
	}

	/**
	 * 评论列表
	 */
	public function appointlistOp(){
		$appoint_model = Model('appoint');
		$condition	 = array();
		$list = $appoint_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::output('show_page',$appoint_model->showpage(2));
		Tpl::showpage('appoint.list');
	}

	public function detailOp(){
		
	}
}
