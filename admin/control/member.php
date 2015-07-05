<?php
/**
 * 会员管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class memberControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('member');
	}
	
	/*
	 * 会员列表
	 */
	public function memberOp(){
		$model = Model();
		//搜索
		$where = true;
		if($_POST['member_name'] != ''){
			$where = array();
			$where['member_name'] = array('like','%'.$_POST['member_name'].'%');
			Tpl::output('member_name',$_POST['member_name']);
		}
		$memberlist = $model->table('member')->where($where)->order('member_id desc')->page(10)->select();
		Tpl::output('list',$memberlist);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('member.list');
	}

	/*
	 * 会员删除
	 */
	public function dropOp(){
		$model = Model();
		if(isset($_POST['member_id']) && !empty($_POST['member_id'])){
			$member_id	= trim($_POST['member_id']);
			$result = $model->table('member')->where(array('member_id'=>array('in',$member_id)))->delete();
			if($result){
				showMessage(L('nc_admin_member_drop_is_succ'));
			}else{
				showMessage(L('nc_admin_member_drop_is_fail'));
			}
		}

		if(isset($_GET['member_id']) && !empty($_GET['member_id'])){
			$member_id	=	intval($_GET['member_id']);
			$result = $model->table('member')->where(array('member_id'=>$member_id))->delete();
			if($result){
				showMessage(L('nc_admin_member_drop_is_succ'));
			}else{
				showMessage(L('nc_admin_member_drop_is_fail'));
			}
		}
	}
	
	/**
	 * 分数设置
	 */
	public function score_settingOp(){
		$model = Model();
		if($_GET['ajax_submit'] == 'ok'){
			$value = intval($_GET['value']);
			$rs = $model->table('score_setting')->where(array('ss_id'=>$_GET['ss_id']))->update(array($_GET['ss_type']=>$value));
			if($rs){
				//更新分数设置缓存
				$tmp_list = $model->table('score_setting')->order('ss_id asc')->select();
				$score_setting = array();
				if(!empty($tmp_list)){
					foreach ($tmp_list as $val){
						$score_setting[$val['ss_code']] = $val;
					}
				}
				write_file(BASE_DATA_PATH.'/cache/score_setting.php',$score_setting);
				echo json_encode(array('done'=>true));die;
			}else{
				echo json_encode(array('done'=>false));die;
			}
		}
		$list = $model->table('score_setting')->order('ss_id asc')->select();
		Tpl::output('list',$list);
		Tpl::showpage('score.setting');
	}
	
	/**
	 * 会员等级设置
	 */
	public function member_degreeOp(){
		$model = Model();
		if($_GET['ajax_submit'] == 'ok'){
			$type = trim($_GET['type']);
			if($type == 'name'){
				$rs = $model->table('member_degree')->where(array('md_id'=>$_GET['md_id']))->update(array('md_name'=>$_GET['md_name']));
			}else{
				$rs_a = $model->table('member_degree')->where(array('md_id'=>$_GET['md_id']))->update(array('md_to'=>$_GET['md_to']));
				$rs_b = $model->table('member_degree')->where(array('md_id'=>$_GET['md_id']+1))->update(array('md_from'=>$_GET['md_to']+1));
				$rs = $rs_a && $rs_b;
			}
			if($rs){
				//更新分数设置缓存
				$tmp_list = $model->table('member_degree')->order('md_id asc')->select();
				$member_degree = array();
				if(!empty($tmp_list)){
					foreach ($tmp_list as $val){
						$member_degree[$val['md_from'].'-'.$val['md_to']] = $val;
					}
				}
				write_file(BASE_DATA_PATH.'/cache/member_degree.php',$member_degree);
				echo json_encode(array('done'=>true));die;
			}else{
				echo json_encode(array('done'=>false));die;
			}
		}
		$list = $model->table('member_degree')->order('md_id asc')->select();
		Tpl::output('list',$list);
		Tpl::showpage('member.degree');
	}

	/**
	 * 重置密码
	 */
	public function resetpasswdOp(){
		
		if(isset($_POST) && !empty($_POST)){
			$params		= array();
			$params['password'] = md5($_POST['passwd']);

			$model = Model();
			$res = $model->table('member')->where(array('member_id'=>intval($_POST['member_id'])))->update($params);
			if($res){
				showMessage('操作成功','index.php?act=member&op=member','succ');
			}else{
				showMessage('操作失败','index.php?act=member&op=member','error');
			}
		}
		
		Tpl::output('member_id',intval($_GET['member_id']));
		Tpl::showpage('member.resetpasswd');
	}
}