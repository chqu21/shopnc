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

class storeControl extends basestoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('index_sign','index');
	}

	public function indexOp(){
		$this->detailOp();
	}
	/*
	 * 商铺首页
	 */
	public function detailOp(){
		Language::read('appointment');
		$store_id	=	intval($_GET['id']);
		$store_model = Model('store');
		$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
		if($_SESSION['admin_login'] != 1){
			if($storeinfo['is_audit'] != 2){
				$this->showTip('该店铺正在审核中，暂不开放',BASE_SITE_URL,'html','error');
			}
			if($storeinfo['store_state'] != 2){
				$this->showTip('该店铺暂未开启',BASE_SITE_URL,'html','error');
			}
		}
		Tpl::output('storeinfo',$storeinfo);
		$class = F('class_'.$storeinfo['city_id'],null,'cache/class');
		if(!empty($class['class_root'])){
			foreach ($class['class_root'] as $val){
				if($val['class_id'] == $storeinfo['class_id']){
					Tpl::output('class_name',$val['class_name']);
				}
			}
		}
		if(!empty($class['class_menu'][$storeinfo['class_id']])){
			foreach ($class['class_menu'][$storeinfo['class_id']] as $val){
				if($val['class_id'] == $storeinfo['s_class_id']){
					Tpl::output('sub_class_name',$val['class_name']);
				}
			}
		}
		$city = F('area_'.$storeinfo['city_id'],null,'cache/city');
		if(!empty($city)){
			foreach ($city as $val){
				if($val['area_id'] == $storeinfo['area_id']){
					Tpl::output('area_name',$val['area_name']);
				}
			}
		}
		//点评列表
		$model_comment = Model('comment');
		$condition	=	array(
			'comment.store_id'	=>	$store_id	
		);
		$c_sort = trim($_GET['c_sort']);
		switch ($c_sort){
			case '':
			case 'comment_time':
				$order_str = 'comment.add_time desc';
				break;
			case 'flower_num':
				$order_str = 'comment.flower_num desc';
				break;
			case 'fav_num':
				$order_str = 'comment.fav_num desc';
				break;
			case 'member_degree':
				$order_str = 'member.member_degree desc';
				break;
		}
		$comment_list =	$model_comment->field('comment.*,member.*,member_degree.md_name')->table('comment,member,member_degree')->join('left join')->on('comment.member_id=member.member_id,member.member_degree=member_degree.md_id')->where($condition)->page(10)->order($order_str)->select();
		
		Tpl::output('comment_list',$comment_list);
		Tpl::output('show_page',$model_comment->showpage(2));
		
		$model = Model();
		$member_info = $model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();
		Tpl::output('member_info',$member_info);
		//增加访问量
		$model->table('store')->where(array('store_id'=>$store_id))->setInc('store_click',1);
		//调取店铺团购信息
		
		$groupbuy_condition = array();
		$groupbuy_condition['store_id'] = $store_id;
		$groupbuy_condition['is_audit'] = 2;
		$groupbuy_condition['start_time']	=	array('elt',time());
		$groupbuy_condition['end_time']		=	array('egt',time());
		$groupbuy_list = $model->table('groupbuy')->where($groupbuy_condition)->select();
		Tpl::output('groupbuy_list',$groupbuy_list);
		//调取店铺优惠券信息
		$coupon_condition = array();
		$coupon_condition['store_id'] = $store_id;
		$coupon_condition['audit']	  = 2;
		$coupon_condition['coupon_start_time'] = array('elt',time());
		$coupon_condition['coupon_end_time'] = array('egt',time());
		$coupon_list = $model->table('coupon')->where($coupon_condition)->order('download_count desc')->select();
		Tpl::output('coupon_list',$coupon_list);
		//调取标签
		$label_list = $model->table('store_label')->where(array('store_id'=>$store_id))->order('label_num desc')->select();
		Tpl::output('label_list',$label_list);
		//计算评价分数
		$all_comment = $model->field('amount_score')->table('comment')->where(array('store_id'=>$store_id))->select();
		$final_score = 0;
		if(count($all_comment) > 0){
			if(!empty($all_comment)){
				foreach ($all_comment as $val){
					$final_score += $val['amount_score'];
				}
			}
			$final_score = round($final_score/count($all_comment));
		}
		Tpl::output('final_score',$final_score);
		Tpl::output('comment_num',count($all_comment));
		//调取店铺商品
		$goods_list = $model->table('goods')->where(array('store_id'=>$store_id))->order('add_time desc')->select();
		Tpl::output('goods_list',$goods_list);
		//附近的商铺
		$sidestore	 = $store_model->getList(array('mall_id'=>$storeinfo['mall_id'],'store_state'=>2,'store_id'=>array('neq',$store_id)));
		Tpl::output('sidestore',$sidestore);
		//收藏总数
		$count = $model->field('count(*) as sum')->table('favorites')->where(array('fav_id'=>$store_id,'fav_type'=>'store'))->find();
		Tpl::output('fav_num',$count['sum']);
		Tpl::showpage('store.detail');
	}
	
	/**
	 * 添加评论
	 */
	public function addcommentOp(){		
		$store_id	=	intval($_GET['id']);
		$storeinfo	=	$this->getStoreInfo($store_id);//店铺信息
		
		
		if(!empty($_POST['picname'])){
			//计入分数
			member_point_add('pic_upload');
			$pic =	trim($_POST['picname'],',');
		}
		//表单验证
		$obj_validate = new Validate();
		$obj_validate->validateparam	=	array(
			array("input"=>trim($_POST['person_cost']),"require"=>"true","message"=>Language::get('nc_store_detail_person_cost_is_not_null'))
		);

		$error = $obj_validate->validate();
		if ($error != ''){
			$this->showTip(Language::get('error').$error,'','html','error');
		}
		$content	=	trim($_POST['commentContent']);
		//点评内容不能超过200个字
		if(mb_strlen($content,'utf8') > 200){
			$this->showTip('点评内容不能超过200个字','','html','error');
		}
		$tags = trim($_POST['tags'],',');
		$params		=	array(	//评论数据
			'store_id'			=>	$storeinfo['store_id'],
			'store_name'		=>	$storeinfo['store_name'],
			'member_id'			=>	$_SESSION['member_id'],
			'member_name'		=>	$_SESSION['member_name'],
			'comment'			=>	$content,
			'photo'				=>	$pic,
			'add_time'			=>	time(),
			'person_cost'		=>	trim($_POST['person_cost']),
			'parking'			=>	trim($_POST['parking']),
			'tags'				=>	$tags,
			'city_id'			=>	$storeinfo['city_id'],
			'amount_score'      =>  intval($_POST['score'])
		);
		
		$model_comment = Model('comment');
		$result	=	$model_comment->save($params);
		if($result){
			//写入评论图片数据
			if($pic != ''){
				$photo_array = explode(',', $pic);
				$p_arr = array();
				foreach ($photo_array as $p){
					$p_arr[] = array(
						'pic_name'=>$p,
						'member_id'=>$_SESSION['member_id'],
						'member_name'=>$_SESSION['member_name'],
						'comment_id'=>$result,
						'store_id'=>$storeinfo['store_id'],
						'store_name'=>$storeinfo['store_name'],
						'add_time'=>time()
					);
				}
				$model_comment->table('comment_pic')->insertAll($p_arr);
			}
			//统计标签
			$tags = explode(',',$tags);
			if(!empty($tags)){
				$model = Model();
				foreach($tags as $t){
					$model->table('store_label')->where(array('label_id'=>$t))->setInc('label_num',1);
				}
				$label = $model->table('store_label')->where(array('store_id'=>$store_id))->select();
				$comment = $model->table('comment')->where(array('store_id'=>$store_id))->count();
				$model->table('store')->where(array('store_id'=>$store_id))->update(array('label'=>serialize($label),'comment_count'=>$comment));
			}
			//计算人均消费+店铺评价分数
			$num = $model->table('comment')->where(array('store_id'=>$store_id))->count();
			$sum = $model->table('comment')->where(array('store_id'=>$store_id))->sum('person_cost');
			$person_cost = ceil($sum/$num);
			$all_comment = $model->field('amount_score')->table('comment')->where(array('store_id'=>$store_id))->select();
			$final_score = 0;
			if(count($all_comment) > 0){
				if(!empty($all_comment)){
					foreach ($all_comment as $val){
						$final_score += $val['amount_score'];
					}
				}
				$final_score = round($final_score/count($all_comment));
			}
			$model->table('store')->where(array('store_id'=>$store_id))->update(array('person_consume'=>$person_cost,'store_score'=>$final_score));
			$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->setInc('comment_num',1);
			//计入分数
			member_point_add('add_comment');
			$this->showTip(L('nc_store_add_comment_succ'),'','succ');
		}else{
			$this->showTip(L('nc_store_add_comment_fail'),'','html','error');
		}
	}

	/**
	 * 上传头像
	 */
	public function uploadOp(){
		$upload = new UploadFile();
		$uploaddir = ATTACH_COMMENT_PATH;
		$upload->set('default_dir',$uploaddir);
		$upload->set('thumb_width',	'218');
		$upload->set('thumb_height','200');
		$upload->set('thumb_ext',	'_small');

		if (!empty($_FILES['uploadimg']['name'])){
			$result = $upload->upfile('uploadimg');
			if($result){
				$pic_name = $upload->thumb_image;
				echo "<script type='text/javascript'>parent.callback('".$pic_name."');</script>";
				exit;
			}else{
				echo "<script type='text/javascript'>alert('".Language::get('nc_store_upload_fail')."');</script>";
				exit;
			}
		}
	}

	/**
	 * 商铺详情
	 */
	public function infoOp(){
		//商铺详情
		$store_id	=	intval($_GET['id']);
		$storeinfo	=	$this->getStoreInfo($store_id);
		Tpl::output('storeinfo',$storeinfo);

		$cityname	=	$this->getAreaName($storeinfo['city_id']);
		$areaname	=	$this->getAreaName($storeinfo['area_id']);
		$mallname	=	$this->getAreaName($storeinfo['mall_id']);
		Tpl::output('cityname',$cityname);

		//附近的商铺
		$model_store = Model('store');
		$sidestore	 = $model_store->getList(array('mall_id'=>$storeinfo['mall_id'],'store_state'=>2));
		Tpl::output('sidestore',$sidestore);
		
		//商铺商品
		$model_goods = Model('goods');
		$goodslist = $model_goods->getList(array('store_id'=>$store_id));
		Tpl::output('goodslist',$goodslist);
		
		Tpl::showpage('store.intro');
	}

	/**
	 * 粉丝评价
	 */
	public function commentOp(){
		//商铺信息
		$store_id	=	intval($_GET['id']);
		
		//评价信息
		$model_comment		=	Model('comment');
		$condition		=	array(
				'comment.store_id'	=>	$store_id
		);

		$comment_list	=	$model_comment->getMemberList($condition,30,'comment_id desc');
		Tpl::output('list',$comment_list);
		Tpl::output('show_page',$model_comment->showpage(2));
		Tpl::showpage('store.comment');
	}

	/**
	 * 商铺活动
	 */
	public function activityOp(){
		$store_id =	intval($_GET['id']);
		$activity_model = Model('activity');
		$condition = array();
		$condition['store_id'] = $store_id;
		$list =	$activity_model->getList($condition);
		
		if(!empty($list)){
			$model	=	Model();
			foreach($list as $key=>$value){
				$list[$key]['member'] =	$model->table('activity_member')->where(array('activity_id'=>$value['activity_id']))->select();
			}	
		}
		Tpl::output('list',$list);
		Tpl::output('show_page',$activity_model->showpage());
		//计算评价分数
		$model_comment = Model('comment');
		$all_comment = $model_comment->field('amount_score')->table('comment')->where(array('store_id'=>$store_id))->select();
		$final_score = 0;
		if(count($all_comment) > 0){
			if(!empty($all_comment)){
				foreach ($all_comment as $val){
					$final_score += $val['amount_score'];
				}
			}
			$final_score = round($final_score/count($all_comment));
		}
		Tpl::output('final_score',$final_score);
		//点评列表
		$condition	=	array(
			'comment.store_id'	=>	$store_id	
		);
		$comment_list =	$model_comment->getMemberList($condition,5,'comment_id desc');
		Tpl::output('comment_list',$comment_list);
		//店铺分类信息
		$store_model = Model('store');
		$storeinfo = $store_model->getOne(array('store_id'=>$store_id));
		$class = F('class_'.$storeinfo['city_id'],null,'cache/class');
		if(!empty($class['class_root'])){
			foreach ($class['class_root'] as $val){
				if($val['class_id'] == $storeinfo['class_id']){
					Tpl::output('class_name',$val['class_name']);
				}
			}
		}
		if(!empty($class['class_menu'][$storeinfo['class_id']])){
			foreach ($class['class_menu'][$storeinfo['class_id']] as $val){
				if($val['class_id'] == $storeinfo['s_class_id']){
					Tpl::output('sub_class_name',$val['class_name']);
				}
			}
		}
		Tpl::showpage('store.activity');
	}
	
	/**
	 * 申请活动
	 */
	public function applyOp(){
		$activity_id	= intval($_GET['activity_id']);
		$activity_model = Model('activity');
		$activityArr	= $activity_model->getOne(array('activity_id'=>$activity_id));
	
		//检测活动是否存在
		if(empty($activityArr)){
			echo json_encode(array('result'=>'fail','msg'=>L('nc_store_activity_is_not_exists')));
			exit;
		}
		
		//会员是否登录
		if($_SESSION['is_login']!=1){
			echo json_encode(array('result'=>'fail','msg'=>'请您先登录'));
			exit;
		}
		
		//报名截止日期
		if($activityArr['apply_time'] < time()){
			echo json_encode(array('result'=>'fail','msg'=>'活动报名已截止'));
			exit;
		}
	
		//检查会员是否已经申请
		$model = Model();
		$memberArr = $model->table('activity_member')->where(array('member_id'=>$_SESSION['member_id'],'activity_id'=>$activity_id))->find();
		if(!empty($memberArr)){
			echo json_encode(array('result'=>'fail','msg'=>L('nc_store_activity_member_already_apply')));
			exit;
		}
		
		//申请活动
		$model	=	Model();
		$params				=	array();
		$params['member_id']			=	$_SESSION['member_id'];
		$params['member_name']			=	$_SESSION['member_name'];
		$params['activity_id']			=	$activity_id;
		$params['apply_time']			=	time();
		$params['member_avator']		= 	$_SESSION['avatar'];
		$params['activity_item']		=	trim($_GET['item'],',');
		$result	=	$model->table('activity_member')->insert($params,true);
		if($result){
			//计入分数
			member_point_add('activity');
			$model->table('activity')->where(array('activity_id'=>$activity_id))->setInc('apply_num',1);
			echo json_encode(array('result'=>'succ','msg'=>Language::get('nc_store_activity_apply_succ')));
			exit;
		}else{
			echo json_encode(array('result'=>'fail','msg'=>Language::get('nc_store_activity_apply_fail')));
			exit;
		}
	}
	
	public function preferentialOp(){
		Tpl::showpage('store.preferential');
	}
	
	/**
	 * ajax收藏功能
	 */
	public function ajax_collectOp(){
		if(!isset($_SESSION['member_id'])){
			echo json_encode(array('done'=>false,'msg'=>'请您先登录'));die;
		}
		$fav_type = trim($_GET['fav_type']);
		$fav_id = intval($_GET['fav_id']);
		if($fav_type != '' && $fav_id > 0){
			$model = Model();
			$fav_info = $model->table('favorites')->where(array('member_id'=>$_SESSION['member_id'],'fav_id'=>$fav_id,'fav_type'=>$fav_type))->find();
			if(!empty($fav_info)){
				echo json_encode(array('done'=>false,'msg'=>'您已收藏该'.($fav_type=='store'?'店铺':'点评')));die;
			}
			$insert_array = array();
			$insert_array['member_id'] = $_SESSION['member_id'];
			$insert_array['fav_id'] = $fav_id;
			$insert_array['fav_type'] = $fav_type;
			$insert_array['fav_time'] = time();
			$rs = $model->table('favorites')->insert($insert_array);
			if($rs){
				$count = $model->field('count(*) as sum')->table('favorites')->where(array('fav_id'=>$fav_id,'fav_type'=>$fav_type))->find();
    			echo json_encode(array('done'=>true,'num'=>$count['sum']));die;
    		}else{
    			echo json_encode(array('done'=>false,'msg'=>'收藏失败，请稍后再试'));die;
    		}
		}else{
			echo json_encode(array('done'=>false,'msg'=>'参数错误'));die;
		}
	}
	
	public function groupbuyremindOp(){
		if($_SESSION['is_login']!=1){
			$this->showTip('请先登录','','html','error');
		}	

		$model		= Model();
		$params		= array();
		$params['member_id'] = $_SESSION['member_id'];
		$params['store_id']	 = $_GET['id'];

		$groupbuy_remind = $model->table('groupbuy_remind')->where($params)->find();
		if(!empty($groupbuy_remind)){
			$this->showTip('您已经添加该商铺的团购提醒','','html','error');
		}
		
		$store = $model->table('store')->where(array('store_id'=>intval($_GET['id'])))->find();

		$params		= array();
		$params['member_id']	= $_SESSION['member_id'];
		$params['member_name']	= $_SESSION['member_name'];
		$params['store_id']		= $store['store_id'];
		$params['store_name']	= $store['store_name'];
		$params['add_time']		= time();

		$res = $model->table('groupbuy_remind')->insert($params);
		if($res){
			$this->showTip('添加成功','','html','succ');		
		}else{
			$this->showTip('添加失败','','html','error');
		}
	}


	/**
	 * ajax给评论送鲜花
	 */
	public function ajax_give_flowerOp(){
		if(!isset($_SESSION['member_id'])){
			echo json_encode(array('done'=>false,'msg'=>'请您先登录'));die;
		}
		$model = Model();
		$comment_id = intval($_GET['comment_id']);
		$c_info = $model->table('comment')->where(array('comment_id'=>$comment_id))->find();
		if($c_info['member_id'] == $_SESSION['member_id']){
			echo json_encode(array('done'=>false,'msg'=>'不能把鲜花送给自己的点评'));die;
		}
		if(cookie('o2ostoreflower-'.$_SESSION['member_id'].'-'.$comment_id) == 'yes'){
			echo json_encode(array('done'=>false,'msg'=>'请不要重复送鲜花'));die;
		}
		if($comment_id > 0){
			$rs = $model->table('comment')->where(array('comment_id'=>$comment_id))->update(array('flower_num'=>array('exp','flower_num+1')));
			if($rs){
				$comment_info = $model->field('flower_num')->where(array('comment_id'=>$comment_id))->find();
				//记录cookie
				setNcCookie('o2ostoreflower-'.$_SESSION['member_id'].'-'.$comment_id,'yes');
    			echo json_encode(array('done'=>true,'num'=>$comment_info['flower_num']));die;
    		}else{
    			echo json_encode(array('done'=>false,'msg'=>'鲜花赠送失败，请稍后再试'));die;
    		}
		}else{
			echo json_encode(array('done'=>false,'msg'=>'参数错误'));die;
		}
	}
}
?>