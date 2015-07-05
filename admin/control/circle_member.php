<?php
/**
 * 圈子话题管理
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
class circle_memberControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('circle');
	}
	/**
	 * 成员列表
	 */
	public function member_listOp(){
		$model = Model();
		if(chksubmit()){
			if (!empty($_POST['check_param']) && is_array($_POST['check_param'])){
				foreach ($_POST['check_param'] as $val){
					$param = explode('|', $val);
					list($member_id, $circle_id) = $param;
					$where['member_id'] = $member_id;
					$where['circle_id'] = $circle_id;
					Model()->table('circle_member')->where($where)->delete();
				}
			}
			showMessage(L('nc_common_op_succ'));
		}
		$where = array();
		if($_GET['searchname'] != ''){
			$where['member_name'] = array('like', '%'.$_GET['searchname'].'%');
		}
		if($_GET['circlename'] != ''){
			$where['circle_name'] = array('like', '%'.$_GET['circlename'].'%');
		}
		if($_GET['searchrecommend'] != '' && in_array(intval($_GET['searchrecommend']), array(0,1))){
			$where['is_recommend'] = intval($_GET['searchrecommend']);
		}
		
		$order = array();
		if(intval($_GET['searchsort']) > 0){
			switch (intval($_GET['searchsort'])){
				case 1:
					$order = 'cm_thcount desc';
					break;
				case 2:
					$order = 'cm_comcount desc';
					break;
				default:
					$order = 'cm_jointime desc';
					break;
			}
		}
		$member_list = $model->table('circle_member')->where($where)->page(10)->order($order)->select();
		Tpl::output('show_page', $model->showpage('2'));
		Tpl::output('member_list', $member_list);
		Tpl::showpage('circle_member.list');
	}
	/**
	 * 删除会员
	 */
	public function member_delOp(){
		$param = explode('|', $_GET['param']);
		list($member_id, $circle_id) = $param;
		$where['member_id'] = $member_id;
		$where['circle_id'] = $circle_id;
		Model()->table('circle_member')->where($where)->delete();
		showMessage(L('nc_common_op_succ'));
	}
	/**
	 * ajax操作
	 */
	public function ajaxOp(){
		switch ($_GET['branch']){
			case 'recommend':
				$array = explode('|', $_GET['id']);
				list($member_id, $circle_id) = $array;
				$where = array();
				$where['member_id']	= $member_id;
				$where['circle_id']	= $circle_id;
				$update = array(
					$_GET['column']=>$_GET['value']
				);
				Model()->table('circle_member')->where($where)->update($update);
				echo 'true';
				break;
		}
	}
}