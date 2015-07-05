<?php
defined('InShopNC') or exit('Access Invalid!');
class groupbuyControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
        Language::read('groupbuy');
        Tpl::output('index_sign','groupbuy');
	}

	public function indexOp(){
		$this->listOp();
	}

	/*
	 * 团购列表
	 */
	public function listOp(){
		$groupbuy_model = Model('groupbuy');
		$condition		=	array();
		$condition['groupbuy.start_time']	=	array('elt',time());
		$condition['groupbuy.end_time']		=	array('egt',time());
		$condition['groupbuy.is_open']		= 	1;//1.开启 2.关闭
		$condition['groupbuy.is_audit']		=	2;//1.待审核 2.审核通过 3.审核未通过
		$condition['store.store_state']		=	2;
		//城市分类
		$condition['groupbuy.city_id']	=	$this->city_info['area_id'];
		if(isset($_GET['area_id']) && !empty($_GET['area_id'])){
			//区域
			$condition['groupbuy.area_id'] = intval($_GET['area_id']);
			Tpl::output('area_id',intval($_GET['area_id']));
			if(isset($_GET['mall_id']) && !empty($_GET['mall_id'])){
				//商区
				$condition['groupbuy.mall_id'] = intval($_GET['mall_id']);
				Tpl::output('mall_id',intval($_GET['mall_id']));
			}
		}
		
		//商铺分类
		if(isset($_GET['class_id']) && !empty($_GET['class_id'])){
			$condition['groupbuy.class_id'] = intval($_GET['class_id']);
			Tpl::output('class_id',intval($_GET['class_id']));

			if(isset($_GET['class_id_1']) && !empty($_GET['class_id_1'])){
				$condition['groupbuy.s_class_id'] = intval($_GET['class_id_1']);
				Tpl::output('class_id_1',intval($_GET['class_id_1']));
			}
		}
		//排序
		$order = 'buyer_count desc';
		if($_GET['orderby'] != '' && $_GET['sort'] != ''){
			$order = $_GET['orderby'].' '.($_GET['sort']=='desc'?'desc':'asc');
		}
		
		$model = Model();
		$list = $model->table('groupbuy,store')->join('left')->on('groupbuy.store_id=store.store_id')->where($condition)->select();
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		
		//分类
		$this->classlist();

		//区域
		$this->arealist();

		//热门团购
		$this->hotgroupbuy();

		Tpl::showpage('groupbuy');
	}

	/*
	 * 团购详情
	 */
	public function detailOp(){
		//团购详细
		$group_id	= intval($_GET['group_id']);
		$group_model= Model('groupbuy');
		$group = $group_model->getOne(array('group_id'=>$group_id));
		
		$storeinfo = $this->getStoreInfo($group['store_id']);
		if($storeinfo['store_state']==3){
			$this->showTip('店铺已关闭','','html','error');
		}
		
		//验证团购是否存在
		if(empty($group)){
			$this->showTip(L('nc_groupbuy_is_not_exists'),'','html','error');
		}
		
		//团购待审核
		if($group['is_audit']==1){
			$this->showTip('团购待审核','','html','error');
		}
		
		//团购审核未通过
		if($group['is_audit']==3){
			$this->showTip('团购审核未通过','','html','error');
		}
		
				
		//团购已关闭
		if($group['is_open']==2){
			$this->showTip('团购已关闭','','html','error');
		}

		//验证团购是否开始
		if($group['start_time']>time()){
			$this->showTip(L('nc_groupbuy_is_not_start'),'','html','error');
		}
		
		//验证团购是否结束
//		if($group['end_time']<time()){
//			$this->showTip(L('nc_groupbuy_is_already_end'),'','html','error');
//		}
		Tpl::output('group',$group);
		
		$storeinfo = $this->getStoreInfo($group['store_id']);
		Tpl::output('storeinfo',$storeinfo);
		
		//热门团购
		$this->hotgroupbuy();
		Tpl::showpage('groupbuy.detail');
	}
	
	/*
	 * 团购订单
	 */
	public function groupbuyorderOp(){
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>intval($_POST['q_number']),"require"=>"true","validator"=>"number","message"=>L('nc_groupbuy_is_not_null_and_number'))
			);
			
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			
			$group_id		= intval($_POST['group_id']);
			$group_model	= Model('groupbuy');
			$group = $group_model->getOne(array('group_id'=>$group_id));
			
			$storeinfo = $this->getStoreInfo($group['store_id']);
			if($storeinfo['store_state']==3){
				$this->showTip('店铺已关闭','','html','error');
			}
			
			//检测是否登录
			if(!isset($_SESSION['member_id'])){
				$this->showTip(L('nc_groupbuy_is_not_login'),'index.php?act=login','html','error');
			}
			
			//验证团购是否存在
			if(empty($group)){
				$this->showTip(L('nc_groupbuy_is_not_exists'),'','html','error');
			}
			
			//验证团购是否开始
			if($group['start_time']>time()){
				$this->showTip(L('nc_groupbuy_is_not_start'),'','html','error');
			}
			
			//验证团购是否结束
			if($group['end_time']<time()){
				$this->showTip(L('nc_groupbuy_is_already_end'),'','html','error');
			}
			
			//验证团购数量
			if(intval($_POST['q_number'])>$group['buyer_limit']){
				$this->showTip(L('nc_groupbuy_quantity_is_not_limit'),'','html','error');
			}
			if((intval($_POST['q_number'])+$group['buyer_num']) > $group['buyer_count']){
				$this->showTip('团购券库存不足','','html','error');
			}
			$store_id	=	$group['store_id'];
			$storeinfo	=	$this->getStoreInfo($store_id);
			
			$member_model = Model('member');
			$member = $member_model->getOne(array('member_id'=>$_SESSION['member_id']));

			//生成团购订单
			$params					= array();
			$params['order_sn']		= $this->snOrder();
			$params['member_id']	= $member['member_id'];
			$params['member_name']	= $member['member_name'];
			$params['mobile']		= $member['mobile'];
			$params['store_id']		= $storeinfo['store_id'];
			$params['store_name']	= $storeinfo['store_name'];
			$params['add_time']		= time();
			$params['order_type']	= 1;//未支付状态
			$params['item_id']		= intval($_POST['group_id']);
			$params['item_name']	= $group['group_name'];
			$params['number']		= intval($_POST['q_number']);
			$params['price']		= intval($_POST['q_number'])*$group['group_price'];
			$params['state']		= 1;
			$params['order_out']	= $this->order_sn;


			$order_model = Model('order');
			$result = $order_model->save($params);

			if($result){
				//计入分数
				member_point_add('groupbuy');
				//修改团购购买数量
				$model = Model();
				$model->table('groupbuy')->where(array('group_id'=>$group_id))->setInc('buyer_num',intval($_POST['q_number']));
				
				header("Location:index.php?act=groupbuy&op=grouppayment&order_id=".$result);
				exit;
			}else{
				$this->showTip(L('nc_groupbuy_operation_is_wrong'),'','html','error');
			}
		}
		
		//团购信息
		$group_id	= intval($_GET['group_id']);
		$group_model= Model('groupbuy');
		$group = $group_model->getOne(array('group_id'=>$group_id));
		if(empty($group)){
			$this->showTip(L('nc_home_groupbuy_is_not_exists'),'index.php','html','error');
		}
		
		$storeinfo = $this->getStoreInfo($group['store_id']);
		if($storeinfo['store_state']==3){
			$this->showTip('店铺已关闭','','html','error');
		}
		
		Tpl::output('group',$group);
		Tpl::showpage('groupbuy.order');
	}
	
	/*
	 * 支付
	*/
	public function grouppaymentOp(){
		$order_id	=	intval($_GET['order_id']);
		$order_model = Model('order');
		$order = $order_model->getOne(array('order_id'=>$order_id));
		if(empty($order)){
			$this->showTip(L('nc_group_order_is_not_exists'),'','html','error');	
		}
		
		//会员登陆
		if($_SESSION['is_login'] != 1){
			$this->showTip(L('nc_group_member_is_not_login'),'','html','error');
		}
		
		if($order['member_id']!=$_SESSION['member_id']){
			$this->showTip('您无权操作此订单','','html','error');
		}
		
		if($order['state'] == 2){
			$this->showTip('该订单已被支付','index.php?act=groupbuy','html','error');
		}
		
		//会员信息
		$member_id	=	$_SESSION['member_id'];
		$member_model = Model('member');
		$member = $member_model->getOne(array('member_id'=>$member_id));
		Tpl::output('member',$member);
		
		
		//支付方式
		$model = Model();
		$payment = $model->table('payment')->where(array('payment_state'=>1))->select();
		Tpl::output('payment',$payment);
		
		Tpl::output('order',$order);
		Tpl::showpage('groupbuy.payment');
	}
	
	/*
	 * 热门团购
	 */
	private function hotgroupbuy(){
		$hot_condition = array();
		$hot_condition['is_hot'] = 2;
		$hot_condition['city_id']= $this->city_info['area_id'];
		$hot_condition['is_open']= 1;
		$hot_condition['is_audit']=2;
		$hot_condition['start_time'] = array('elt',time());
		$hot_condition['end_time']= array('egt',time());
		
		$model = Model();
		$list = $model->table('groupbuy')->where($hot_condition)->order('publish_time desc')->limit(4)->select();//is_hot:1.否 2.是 (热门团购)   is_audit:1.待审核 2.审核通过 3.审核未通过
		Tpl::output('hotgroupbuy',$list);
	}
}
?>