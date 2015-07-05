<?php
/**
 * 文章管理
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

class predepositModel{
	

	public function addlog($params){
		$data = array();
		$data['member_id']	= $params['member_id'];
		$data['member_name']= $params['member_name'];
		$data['add_time']	= time();
		$data['type']		= $params['type'];
		switch($params['content']){
			case 1://支付
				$data['content'] = '订单号：'.$params['order_sn'].',使用预存款支付,支付金额:'.$params['price'];
				break;
			case 2://充值
				$data['content'] = '预存款充值订单号：'.$params['order_sn'].',充值金额：'.$params['price'];
				break;
			case 3://退款
				$data['content'] = '订单号：'.$params['order_sn'].',退款金额：'.$params['price'];
				break;
		}

		$model = Model();
		$res = $model->table('predeposit_log')->insert($data);
		return $res;
	}
}