<?php
defined('InShopNC') or exit('Access Invalid!');
class couponControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('coupon');
	}
	
	public function indexOp(){
		$this->couponOp();
	}
	
	/*
	 *	优惠券列表
	 */
	public function couponOp(){
		
		$coupon_model = Model('coupon');
		$condition = array();
		//搜索
		if($_POST['s_type'] != '' && $_POST['s_content'] != ''){
			$condition[$_POST['s_type']] = array('like','%'.$_POST['s_content'].'%');
			Tpl::output('s_type',$_POST['s_type']);
			Tpl::output('s_content',$_POST['s_content']);
		}
		if(intval($_POST['s_audit']) > 0){
			$condition['audit'] = intval($_POST['s_audit']);
			Tpl::output('s_audit',intval($_POST['s_audit']));
		}
		$list = $coupon_model->getList($condition);
		
		Tpl::output('list',$list);
		Tpl::output('show_page',$coupon_model->showpage(2));
		Tpl::showpage('coupon.list');
		
	}
	
	/*
	 * 审核
	 */
	public function auditOp(){
		if(isset($_POST) && !empty($_POST)){
			//审核状态
			$params	=	array(
					'audit'			=>	trim($_POST['audit']),
					'audit_reason'	=>	trim($_POST['audit_reason'])
			);
			
			//条件
			$condition	=	array(
					'coupon_id'	=>	intval($_POST['coupon_id'])
			);
			
			$model  = Model();
			$result = $model->table('coupon')->where($condition)->update($params);
			if($result){
				$this->showTip(L('nc_admin_coupon_audit_succ'),'index.php?act=coupon&op=coupon','succ');
			}else{
				$this->showTip(L('nc_admin_coupon_audit_fail'),'','error');
			}	
		}
		
		//优惠券编号
		$coupon_id = intval($_GET['coupon_id']);
		$model  = Model();
		$coupon = $model->table('coupon')->where(array('coupon_id'=>$coupon_id))->find();
		Tpl::output('coupon',$coupon);
		
		Tpl::showpage('coupon.audit');
	}
	/*
	 * 批量审核
	 */
	public function batch_auditOp(){
		$condition	=	array();
		$condition	=	array(
			'coupon_id' => array('in',$_POST['coupon_id'])
		);
		$state = intval($_GET['state']);
		//取消推荐
		$model = Model();
		$result = $model->table('coupon')->where($condition)->update(array('audit'=>$state));
		if($result){
			$this->showTip('优惠券批量审核操作成功！','','succ');
		}else{
			$this->showTip('优惠券批量审核操作失败','','error');
		}
	}
	/*
	 * 优惠券删除
	 */
	public function delOp(){
		
		//单个删除
		if(isset($_GET['coupon_id']) && !empty($_GET['coupon_id'])){
			$model = Model();
			//删除
			$result = $model->table('coupon')->where(array('coupon_id'=>intval($_GET['coupon_id'])))->delete();
			if($result){
				$this->showTip(L('nc_admin_download_delete_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_download_delete_fail'),'','error');
			}
		}
		
		//批量删除
		if(isset($_POST['coupon_id']) && !empty($_POST['coupon_id'])){
			$model = Model();
			$result = $model->table('coupon')->where(array('coupon_id'=>array('in',$_POST['coupon_id'])))->delete();
			
			if($result){
				$this->showTip(L('nc_admin_download_delete_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_download_delete_fail'),'','error');
			}
		}
	}
	
	/*
	 * 优惠券下载
	 */
	public function coupon_downloadOp(){
		$model = Model();
		//搜索
		$where = true;
		if($_POST['coupon_name'] != ''){
			$where = array();
			$where['coupon_name'] = array('like','%'.$_POST['coupon_name'].'%');
			Tpl::output('coupon_name',$_POST['coupon_name']);
		}
		$list = $model->table('coupon_download')->where($where)->order('download_time desc')->page(20)->select();			
		
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('coupondownload.list');
	}
	
	/*
	 * 下载优惠券删除
	 */
	public function downloaddelOp(){	
		
		//单个删除
		if(isset($_GET['coupon_id']) && !empty($_GET['coupon_id'])){
			$model = Model();
			$result = $model->table('coupon_download')->where(array('coupon_id'=>intval($_GET['coupon_id'])))->delete();
				
			if($result){
				$this->showTip(L('nc_admin_download_delete_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_download_delete_fail'),'','error');
			}
		}	
		
		//批量删除
		if(isset($_POST['coupon_id']) && !empty($_POST['coupon_id'])){
			$model 	= Model();
			$result = $model->table('coupon_download')->where(array('coupon_id'=>array('in',$_POST['coupon_id'])))->delete();
			
			if($result){
				$this->showTip(L('nc_admin_download_delete_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_download_delete_fail'),'','error');
			}
		}
		
	}
	/**
     * ajax修改优惠券推荐状态
     */
    public function ajax_recommendOp(){
    	$coupon_id = intval($_GET['coupon_id']);
    	$stat = intval($_GET['stat']);
    	if($coupon_id > 0 && ($stat==0 || $stat==1)){
    		$model = Model();
    		$rs = $model->table('coupon')->where(array('coupon_id'=>$coupon_id))->update(array('is_recommend'=>$stat));
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false));die;
    	}
    }
}