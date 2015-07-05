<?php
/**
 * 积分商城
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

class giftControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 礼品管理
	 */
	public function gift_manageOp(){
		$model = Model();
		$sg_name = $_POST['sg_name'];
		if($sg_name != ''){
			$condition['sg_name'] = array('like','%'.$sg_name.'%');
			Tpl::output('sg_name',$sg_name);
		}
		$gift_list = $model->table('gift')->where($condition)->order('sg_add_time desc')->select();
		Tpl::output('gift_list',$gift_list);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('gift.manage');
	}
	/**
	 * 添加礼品
	 */
	public function gift_addOp(){
		$model = Model();
		if(chksubmit()){
			//数据验证
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['sg_name'],'require'=>'true','message'=>'请填写礼品名称'),
				array('input'=>$_POST['sg_point'],'require'=>'true','message'=>'请填写兑换所需积分'),
				array('input'=>$_POST['sg_num'],'require'=>'true','message'=>'请填写礼品库存数量'),
				array('input'=>$_POST['sg_price'],'require'=>'true','message'=>'请填写礼品市场价格')
			);
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if($error != ''){
				$this->showTip(Language::get('error').$error,'','','error');
			}
			if(intval($_POST['sg_point']) <= 0){
				$this->showTip('兑换积分不能为0或负数','','','error');
			}
			if(floatval($_POST['sg_price']) <= 0){
				$this->showTip('市场价格不能为0或负数','','','error');
			}
			if(intval($_POST['sg_limit_num']) > intval($_POST['sg_num'])){
				$this->showTip('购买上限数量不得大于库存数量','','','error');
			}
			$insert_array = array();
			$insert_array['sg_name'] = $_POST['sg_name'];
			$insert_array['sg_code'] = $_POST['sg_code'];
			$insert_array['sg_intro'] = $_POST['sg_intro'];
			$insert_array['sg_point'] = intval($_POST['sg_point']);
			$insert_array['sg_price'] = number_format($_POST['sg_price'],2);
			$insert_array['sg_num'] = intval($_POST['sg_num']);
			$insert_array['sg_limit_num'] = intval($_POST['sg_limit_num']);
			$insert_array['sg_member_degree'] = intval($_POST['sg_member_degree']);
			$insert_array['sg_recommend'] = $_POST['sg_recommend'];
			$insert_array['sg_sale'] = $_POST['sg_sale'];
			if(!empty($_FILES['sg_pic']['name'])) {
				$upload	= new UploadFile();
				$uploaddir = ATTACH_GIFT_PATH;
				$upload->set('default_dir',$uploaddir);
				$result = $upload->upfile('sg_pic');
				if(!$result) {
					$this->showTip($upload->error);
				}
				$insert_array['sg_pic'] = $upload->file_name;
			}
			$insert_array['sg_add_time'] = time();
			$insert_array['sg_last_change_time'] = time();
			$result	= $model->table('gift')->insert($insert_array);
			if($result){
				$this->showTip('积分商城礼品添加成功！','index.php?act=gift&op=gift_manage');
			}else{
				$this->showTip('积分商城礼品添加失败');
			}
		}
		//调取会员等级信息
		$member_degree = $model->table('member_degree')->where(true)->order('md_id asc')->select();
		Tpl::output('member_degree',$member_degree);
		Tpl::showpage('gift.add');
	}
	/**
	 * 编辑礼品
	 */
	public function gift_editOp(){
		$model = Model();
		if(chksubmit()){
			$sg_id = intval($_POST['sg_id']);
			if($sg_id <= 0){
				$this->showTip('参数错误');
			}
			//数据验证
			$obj_validate = new Validate();
			$validate_array = array( 
				array('input'=>$_POST['sg_name'],'require'=>'true','message'=>'请填写礼品名称'),
				array('input'=>$_POST['sg_point'],'require'=>'true','message'=>'请填写兑换所需积分'),
				array('input'=>$_POST['sg_num'],'require'=>'true','message'=>'请填写礼品库存数量'),
				array('input'=>$_POST['sg_price'],'require'=>'true','message'=>'请填写礼品市场价格')
			);
			$obj_validate->validateparam = $validate_array;
			$error = $obj_validate->validate();			
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','','error');
			}
			if(intval($_POST['sg_point']) <= 0){
				$this->showTip('兑换积分不能为0或负数','','','error');
			}
			if(floatval($_POST['sg_price']) <= 0){
				$this->showTip('市场价格不能为0或负数','','','error');
			}
			if(intval($_POST['sg_limit_num']) > intval($_POST['sg_num'])){
				$this->showTip('购买上限数量不得大于库存数量','','','error');
			}
			$update_array = array();
			$update_array['sg_name'] = $_POST['sg_name'];
			$update_array['sg_code'] = $_POST['sg_code'];
			$update_array['sg_intro'] = $_POST['sg_intro'];
			$update_array['sg_point'] = intval($_POST['sg_point']);
			$update_array['sg_price'] = $_POST['sg_price']!=''?number_format($_POST['sg_price'],2):0.00;
			$update_array['sg_num'] = intval($_POST['sg_num']);
			$update_array['sg_limit_num'] = intval($_POST['sg_limit_num']);
			$update_array['sg_member_degree'] = intval($_POST['sg_member_degree']);
			$update_array['sg_recommend'] = $_POST['sg_recommend'];
			$update_array['sg_sale'] = $_POST['sg_sale'];
			if(!empty($_FILES['sg_pic']['name'])) {
				$upload	= new UploadFile();
				$uploaddir = ATTACH_GIFT_PATH;
				$upload->set('default_dir',$uploaddir);
				$result = $upload->upfile('sg_pic');
				if(!$result) {
					$this->showTip($upload->error);
				}
				$update_array['sg_pic'] = $upload->file_name;
			}
			$update_array['sg_last_change_time'] = time();
			$result	= $model->table('gift')->where(array('sg_id'=>$sg_id))->update($update_array);
			if($result){
				$this->showTip('积分商城礼品编辑成功！','index.php?act=gift&op=gift_manage');
			}else{
				$this->showTip('积分商城礼品编辑失败');
			}
		}
		$sg_id = intval($_GET['sg_id']);
		if($sg_id <= 0){
			$this->showTip('参数错误');
		}
		//调取会员等级信息
		$member_degree = $model->table('member_degree')->where(true)->order('md_id asc')->select();
		Tpl::output('member_degree',$member_degree);
		//调取礼品信息
		$gift_info = $model->table('gift')->where(array('sg_id'=>$sg_id))->find();
		Tpl::output('gift_info',$gift_info);
		Tpl::showpage('gift.edit');
	}
	/**
	 * 删除礼品
	 */
	public function gift_delOp(){
		$model = Model();
		if($_GET['type'] == 'batch'){
			$result = $model->table('gift')->where(array('sg_id'=>array('in',$_POST['sg_id'])))->delete();
		}else{
			$sg_id = intval($_GET['sg_id']);
			if($sg_id <= 0){
				$this->showTip('参数错误');
			}
			$result = $model->table('gift')->where(array('sg_id'=>$sg_id))->delete();
		}
		if($result){
			$this->showTip('积分商城礼品删除成功！','index.php?act=gift&op=gift_manage');
		}else{
			$this->showTip('积分商城礼品删除失败');
		}
	}
	/**
	 * 礼品兑换订单
	 */
	public function gift_logOp(){
		$model = Model();
		$member_name = $_POST['member_name'];
		$condition = array();
		if($member_name != ''){
			$condition['member_name'] = array('like','%'.$member_name.'%');
			Tpl::output('member_name',$member_name);
		}
		if(intval($_POST['go_state']) > 0){
			$condition['go_state'] = intval($_POST['go_state']);
			Tpl::output('go_state',intval($_POST['go_state']));
		}
		$gift_order = $model->table('gift_order')->where($condition)->order('go_add_time desc')->select();
		Tpl::output('gift_order',$gift_order);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('gift.log');
	}
	/**
	 * 订单详情
	 */
	public function order_detailOp(){
		$model = Model();
		$go_id = intval($_GET['go_id']);
		if($go_id <= 0){
			$this->showTip('参数错误');
		}
		//调取礼品信息
		$order_info = $model->table('gift_order')->where(array('go_id'=>$go_id))->find();
		Tpl::output('order_info',$order_info);
		Tpl::showpage('gift.order');
	}
	/**
	 * 礼品确认发货
	 */
	public function order_shipOp(){
		$model = Model();
		$go_id = intval($_GET['go_id']);
		if($go_id <= 0){
			$this->showTip('参数错误');
		}
		$rs = $model->table('gift_order')->where(array('go_id'=>$go_id))->update(array('go_state'=>2,'go_change_time'=>time()));
		if($rs){
			$this->showTip('礼品订单发货成功','index.php?act=gift&op=gift_log');
		}else{
			$this->showTip('礼品订单发货失败');
		}
	}
}