<?php
/**
 * 结算管理
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

class settleControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('setting');
	}
	public function settle_manageOp(){
		$model = Model();
		$condition = array();
		//搜索
		if(isset($_POST['store_name']) && !empty($_POST['store_name'])){
			$condition['store_name'] = array('like',"%{$_POST['store_name']}%");	
			Tpl::output('store_name',trim($_POST['store_name']));
		}
		if(isset($_POST['state']) && intval($_POST['state']) > 0){
			$condition['state'] = intval($_POST['state']);	
			Tpl::output('state',intval($_POST['state']));
		}
		//调取结算清单
		$settle_list = $model->table('settle')->where($condition)->order('settle_time desc')->page(15)->select();
		Tpl::output('settle_list',$settle_list);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('settle.list');
	}
	public function ajax_settleOp(){
		$model = Model();
		$data_array = array();
		$setting_info = $model->table('setting')->where(array('name'=>'last_settle'))->find();
		$today_date = strtotime(date('Y-m-d',time()));
		if(intval($setting_info['value']) > 0){
			$condition = 'order.state=3 and order.use_time>='.$setting_info['value'].' and order.use_time < '.$today_date;
		}else{
			$condition = 'order.state=3 and order.use_time < '.$today_date;
		}
		$order = $model->field('order.store_id,order.store_name,order.price,order.use_time,groupbuy.settle')->table('order,groupbuy')->join('left join')->on('order.item_id=groupbuy.group_id')->where($condition)->limit('')->select();
		if(!empty($order)){
			foreach ($order as $val){
				$data_array[$val['store_id']] = array(
					'store_id'=>$val['store_id'],
					'store_name'=>$val['store_name'],
					'all_price'=>$data_array[$val['store_id']]['all_price']+$val['price'],
					'date_start'=>$data_array[$val['store_id']]['date_start']==''?$val['use_time']:($val['use_time']<$data_array[$val['store_id']]['date_start']?$val['use_time']:$data_array[$val['store_id']]['date_start']),
					'date_end'=>$data_array[$val['store_id']]['date_end']==''?$val['use_time']:($val['use_time']>$data_array[$val['store_id']]['date_start']?$val['use_time']:$data_array[$val['store_id']]['date_start']),
					'pay'=>$data_array[$val['store_id']]['pay']+$val['settle']>0?($val['all_price']*($val['settle']/100)):$val['all_price']
				);
			}
			$insert_array = array();
			foreach ($data_array as $da){
				$insert_array[] = array(
					'settle_sn'=>date('YmdHis'.$da['store_id'],time()),
					'store_id'=>$da['store_id'],
					'store_name'=>$da['store_name'],
					'date_start'=>$da['date_start'],
					'date_end'=>$da['date_end'],
					'amount'=>$da['all_price'],
					'final_pay'=>$da['pay'],
					'state'=>1,
					'settle_time'=>time()
				);
				$rs = $model->table('settle')->insertAll($insert_array);
				if($rs){
					//更新最后结算日期
					$model->table('setting')->where(array('name'=>'last_settle'))->update(array('value'=>$today_date));
					echo json_encode(array('done'=>true));die;
				}else{
					echo json_encode(array('done'=>false,'msg'=>'订单结算失败'));die;
				}
			}
		}else{
			echo json_encode(array('done'=>false,'msg'=>'当前没有要结算的订单'));die;
		}
	}
	public function settle_state_changeOp(){
		$model = Model();
		$new_state = intval($_GET['new_state']);
		$settle_id = intval($_GET['settle_id']);
		if(($new_state != 2 && $new_state != 4) || $settle_id == 0){
			$this->showTip('参数错误','index.php?act=settle&op=settle_manage','succ');
		}
		$rs = $model->table('settle')->where(array('settle_id'=>$settle_id))->update(array('state'=>$new_state));
		if($rs){
			$this->showTip('操作成功！','index.php?act=settle&op=settle_manage','succ');
		}else{
			$this->showTip('操作失败','','error');
		}
	}
	public function settle_detailOp(){
		$settle_id = intval($_GET['settle_id']);
		if($settle_id <= 0){
			$this->showTip('参数错误','','error');
		}
		$model = Model();
		$settle_info = $model->table('settle')->where(array('settle_id'=>$settle_id))->find();
		if(empty($settle_info)){
			$this->showTip('未找到该结算单信息','','error');
		}
		$condition = 'state = 3 and store_id = '.$settle_info['store_id'].' and use_time >= '.$settle_info['date_start'].' and use_time <= '.$settle_info['date_end'];
		$order_list = $model->table('order')->where($condition)->page(15)->order('use_time desc')->select();
		Tpl::output('settle_info',$settle_info);
		Tpl::output('order_list',$order_list);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('settle.detail');
	}
}

