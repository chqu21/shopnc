<?php
/**
 * 商品管理
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class goodsControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Language::read('goods');
	}
	
	/*
	 * 商品列表
	 */
	public function goodsOp(){
		$condition = array();
		//搜索
		if($_POST['store_name'] != ''){
			$condition['store_name'] = array('like','%'.$_POST['store_name'].'%');
			Tpl::output('store_name',$_POST['store_name']);
		}
		if($_POST['goods_name'] != ''){
			$condition['goods_name'] = array('like','%'.$_POST['goods_name'].'%');
			Tpl::output('goods_name',$_POST['goods_name']);
		}
		//商品列表
		$model = Model();
		$goods = $model->table('goods')->where($condition)->page(10)->order('add_time desc')->select();
		Tpl::output('list',$goods);
		
		//分页
		Tpl::output('show_page',$model->showpage());	
		Tpl::showpage('goods.list');
	}
	
	
	/*
	 * 删除商品
	 */
	public function delgoodsOp(){	
		if(isset($_GET['goods_id']) && !empty($_GET['goods_id'])){
			//删除商品
			$goods_id	= intval($_GET['goods_id']);
			$model = Model();
			$result = $model->table('goods')->where(array('goods_id'=>$goods_id))->delete();
			
			//删除操作
			if($result){
				$this->showTip(L('nc_admin_goods_del_goods_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_goods_del_goods_fail'),'','error');
			}	
		}
		
		if(isset($_POST['goods_id']) && !empty($_POST['goods_id'])){
			//删除商品
			$model = Model();
			$model->table('goods')->where(array('goods_id'=>array('in',$_POST['goods_id'])))->delete();
			
			
			//删除操作
			if($result){
				$this->showTip(L('nc_admin_goods_del_goods_succ'),'','succ');
			}else{
				$this->showTip(L('nc_admin_goods_del_goods_fail'),'','error');
			}
		}

	}

}