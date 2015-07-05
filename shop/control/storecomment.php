<?php
/**
 * 评论管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storecommentControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','comment_manage');
	}

	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 评论列表
	 */
	public function listOp(){
		$comment_model = Model('comment');
		$condition	=	array();
		$condition['store_id']	= $_SESSION['store_id'];
		//搜索
		if($_POST['comment'] != ''){
			$condition['comment'] = array('like','%'.$_POST['comment'].'%');
			Tpl::output('comment',$_POST['comment']);
		}
		$list = $comment_model->getList($condition);
		Tpl::output('list',$list);
		Tpl::output('show_page',$comment_model->showpage());
		Tpl::showpage('storecomment.list');
	}
	/*
	 * 解释说明
	 */
	public function explainOp(){
		$comid = intval($_GET['comment_id']);
		if($comid <= 0){
			$this->showTip('参数错误','','html','error');
		}
		$model = Model('comment');
		if(isset($_POST) && !empty($_POST)){
			if($_POST['comment_explain'] == ''){
				$this->showTip('解释内容不能为空','','html','error');
			}
			$rs = $model->table('comment')->where(array('comment_id'=>$comid))->update(array('comment_explain'=>$_POST['comment_explain']));
			if($rs){
				$this->showTip('解释说明添加成功！','index.php?act=storecomment','succ');
			}else{
				$this->showTip('解释说明添加失败','','html','error');
			}
		}
		$comment_info = $model->table('comment')->where(array('comment_id'=>$comid))->find();
		Tpl::output('comment_info',$comment_info);
		Tpl::showpage('comment.explain');
	}
	/*
	 * 删除评论
	 */
	public function del_commentOp(){
		//单条评论删除
		if(isset($_GET['comment_id']) && !empty($_GET['comment_id'])){
			$comment_id	= trim($_GET['comment_id']);
			$model	 = Model();
			$comment = $model->table('comment')->where(array('comment_id'=>$comment_id))->find();
			if($comment['store_id'] != $_SESSION['store_id']){
				$this->showTip(L('nc_member_store_comment_not_consistent'),'','succ');	
			}
			
			$result = $model->table('comment')->where(array('comment_id'=>$comment_id))->delete();
			if($result){
				$commentnum = $model->table('comment')->where(array('store_id'=>$_SESSION['store_id']))->count();
				$model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->update(array('comment_count'=>$commentnum));
				$this->showTip(L('nc_member_store_op_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_op_fail'),'','html','error');
			}
		}
		
		//批量删除评论
		if(isset($_POST['comment_id']) && !empty($_POST['comment_id'])){		
			$model	 = Model();
			$comment = $model->table('comment')->where(array('comment_id'=>array('in',$_POST['comment_id'])))->select();
			
			$ids = '';
			if(!empty($comment)){
				foreach($comment as $ck=>$cv){
					if($cv['store_id'] != $_SESSION['store_id']){
						continue;
					}
					$ids.=$cv['comment_id'].',';
				}
				$ids = trim($ids,',');
			}

			$result = $model->table('comment')->where(array('comment_id'=>array('in',$ids)))->delete();
			if($result){
				$commentnum = $model->table('comment')->where(array('store_id'=>$_SESSION['store_id']))->count();
				$model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->update(array('comment_count'=>$commentnum));
				$this->showTip(L('nc_member_store_op_succ'),'','succ');
			}else{
				$this->showTip(L('nc_member_store_op_fail'),'','html','error');
			}
		}
	}
}
?>