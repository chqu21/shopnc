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

class commentControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('store');
	}

	/**
	 * 评论列表
	 */
	public function commentlistOp(){
		$comment_model = Model('comment');
		$condition	 = array();
		//搜索
		if($_POST['s_type'] != '' && $_POST['s_content'] != ''){
			$condition[$_POST['s_type']] = array('like','%'.$_POST['s_content'].'%');
			Tpl::output('s_type',$_POST['s_type']);
			Tpl::output('s_content',$_POST['s_content']);
		}
		$list = $comment_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::output('show_page',$comment_model->showpage(2));
		Tpl::showpage('comment.list');
	}

	/**
	 * 删除评论
	 */
	public function delOp(){
		if(isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
			$model = Model();
			$result = $model->table('comment')->where(array('in',$_POST['comment_id']))->delete();
			if($result){
				$this->showTip(Language::get('nc_admin_comment_delete_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_comment_delete_fail'));
			}
		}
		
		if(isset($_GET['comment_id']) && !empty($_GET['comment_id'])){
			$comment_id	= intval($_GET['comment_id']);
			$model	 =	Model();
			$comment = $model->table('comment')->where(array('comment_id'=>$comment_id))->find();
			$result  = $model->table('comment')->where(array('comment_id'=>$comment_id))->delete();
			if($result){
				$commentnum = $model->table('comment')->where(array('store_id'=>$comment['store_id']))->count();
				$model->table('store')->where(array('store_id'=>$comment['store_id']))->update(array('comment_count'=>$commentnum));
				$this->showTip(Language::get('nc_admin_comment_delete_succ'));
			}else{
				$this->showTip(Language::get('nc_admin_comment_delete_fail'));
			}
		}
	}
	
	/*
	 * 推荐评论
	 */
	public function recommendOp(){	
		$condition	=	array();
		$condition	=	array(
				'comment_id'	=>	array('in',$_POST['comment_id'])
		);
		if(isset($_GET['type']) && $_GET['type'] == 1){
			//推荐评论
			$model = Model();
			$result = $model->table('comment')->where($condition)->update(array('is_recommend'=>'1'));
		}else{
			//取消推荐
			$model = Model();
			$result = $model->table('comment')->where($condition)->update(array('is_recommend'=>'0'));
		}
		
		if($result){
			$this->showTip(Language::get('nc_admin_comment_recommend_succ'));
		}else{
			$this->showTip(Language::get('nc_admin_comment_recommend_fail'));
		}
	}
	
	
}
