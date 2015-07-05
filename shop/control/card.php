<?php
/**
 * 本地生活
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class cardControl extends BaseHomeControl{
	public function __construct() {
		parent::__construct();
        Language::read('card');
        Tpl::output('index_sign','card');
    }
	
	public function indexOp(){
		$this->listOp();
	}
	
	/*
	 * 商户会员卡
	 */
	public function listOp(){		
		$model = Model();
		$condition = array();
		$condition['is_card'] = 1;
		$condition['store_state'] = 2;
 		//城市分类
		$condition['city_id']	=	$this->city_info['area_id'];
		if(isset($_GET['area_id']) && !empty($_GET['area_id'])){
			//区域
			$condition['area_id'] = intval($_GET['area_id']);
			Tpl::output('area_id',intval($_GET['area_id']));
			if(isset($_GET['mall_id']) && !empty($_GET['mall_id'])){
				//商区
				$condition['mall_id'] = intval($_GET['mall_id']);
				Tpl::output('mall_id',intval($_GET['mall_id']));
			}
		}
		//商铺分类
		if(isset($_GET['class_id']) && !empty($_GET['class_id'])){
			$condition['class_id'] = intval($_GET['class_id']);
			Tpl::output('class_id',intval($_GET['class_id']));

			if(isset($_GET['class_id_1']) && !empty($_GET['class_id_1'])){
				$condition['s_class_id'] = intval($_GET['class_id_1']);
				Tpl::output('class_id_1',intval($_GET['class_id_1']));
			}
		}
		$list = $model->table('store')->field('store_id,store_name,card_discount,card_des,card_pic')->where($condition)->select();
		
		if(!empty($list)){
			foreach($list as $key=>$card){
				$list[$key]['member']	= $model->table('card_member')->where(array('store_id'=>$card['store_id']))->select();
			}
		}
		//分类
		$this->classlist();
		//区域
		$this->arealist();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('card.list');
	}
	
	/*
	 * 申请会员卡
	 */
	public function applycardOp(){
		if(isset($_GET['type']) && $_GET['type'] == 'card'){
			
			$member_id	=	$_SESSION['member_id'];
			$member_name=	$_SESSION['member_name'];
			$store_id	=	intval($_GET['store_id']);
			$store 		= $this->getStoreInfo($store_id);
			
			$param	=	array(
				'member_id'		=>	$member_id,
				'store_id'		=>	$store_id
			);
			
			$model = Model();
			$card_member = $model->table('card_member')->where($param)->find();

			if(!empty($card_member)){
				//会员卡已经存在
				echo json_encode(array('result'=>L('nc_card_apply_card_exists')));
				exit;
			}

			$params		=	array(
					'is_use'        =>  2,
					'card_number'   =>  $store['city_id'].$store_id.$member_id.rand(000,999),
					'member_id'		=>	$member_id,
					'member_name'	=>	$member_name,
					'store_id'		=>	$store_id,
					'store_name'	=>	$store['store_name']
			);
			
			
			$result = $model->table('card_member')->insert($params);//添加会员卡
			//计入分数
			member_point_add('member_card');
			echo json_encode(array('result'=>L('nc_member_apply_succ')));
			exit;
		}
		//申请会员卡页面
		$storeinfo = $this->getStoreInfo(intval($_GET['store_id']));
		Tpl::output('storeinfo',$storeinfo);
		
		Tpl::showpage('apply.card','null_layout');
	}
}
