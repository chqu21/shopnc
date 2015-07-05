<?php
/**
 * 默认展示页面
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
define('MYSQL_RESULT_TYPE',1);
class memberaccountControl extends memberCenterControl{

	public function __construct(){
		parent::__construct();
	}

	
	public function indexOp(){
		$this->accountOp();
	}

	/**
	 * 基本资料
	 */
	public function accountOp(){
		$member_id	=	$_SESSION['member_id'];
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['nickname']),"require"=>"true","message"=>Language::get('nc_nickname_is_not_null')),
				array("input"=>trim($_POST['usercity']),"require"=>"true","message"=>Language::get('nc_usercity_is_not_null'))
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			if(mb_strlen(trim($_POST['nickname']),'utf8') > 24){
				$this->showTip('昵称请不要超过24个字','','html','error');
			}
			if(mb_strlen(trim($_POST['introduce']),'utf8') > 200){
				$this->showTip('自我介绍请不要超过200个字','','html','error');
			}
			$model	=	Model();
			$memberinfo	= $model->table('member')->where(array('member_id'=>$member_id))->find();
			$old_nickname = $memberinfo['nickname'];
			$params				=	array();
			$params['nickname']	=	trim($_POST['nickname']);
			$params['gender']	=	$_POST['gender'];
			$params['usercity']	=	trim($_POST['usercity']);
			$params['introduce']=	trim($_POST['introduce']);

			
			$result	=	$model->table('member')->where(array('member_id'=>$member_id))->update($params);
			
			if($result){
				if($old_nickname == ''){
					//计入分数
					member_point_add('member_info');
				}
				$this->showTip(Language::get('nc_save_account_is_succ'),'index.php?act=memberaccount&op=account','succ');
			}else{
				$this->showTip(Language::get('nc_save_account_is_fail'),'','html','error');
			}
		}

		$model	=	Model();
		$memberinfo	=	$model->field('member.*,area.area_name,area.first_letter')->table('member,area')->join('left join')->on('member.usercity=area.area_id')->where(array('member.member_id'=>$member_id))->find();
		Tpl::output('member',$memberinfo);

		$this->menu('account');
		Tpl::output('menu_sign','base_information');
		
		//城市
		$area = $model->table('area')->where(array('parent_area_id'=>'0','first_letter'=>$memberinfo['first_letter']))->select();
		Tpl::output('area',$area);
		Tpl::output('letter_array',array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'));
		Tpl::showpage('member.index');
	}


	/**
	 * 详细信息
	 */
	public function detailOp(){
		$member_id	=	$_SESSION['member_id'];
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['member_state']),"validator"=>"number","message"=>Language::get('nc_member_state_is_not_number'))
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			if(trim($_POST['birthday'])!='' && strtotime(trim($_POST['birthday'])) > time()){
				$this->showTip('不能选择未来时间作为您的生日','','html','error');
			}
			if(mb_strlen(trim($_POST['hobby']),'utf8') > 200){
				$this->showTip('爱好请不要超过200个字','','html','error');
			}
			$params				=	array();
			$params['weight']	=	intval($_POST['weight']);
			$params['member_state']	=	intval($_POST['member_state']);
			$params['birthday']		=	trim($_POST['birthday'])!=''?strtotime(trim($_POST['birthday'])):0;
			$params['constellation']=	intval($_POST['constellation']);
			$params['member_qq']	=	trim($_POST['member_qq']);
			$params['industry']		=	trim($_POST['industry']);
			$params['college']		=	trim($_POST['college']);
			$params['hobby']		=	trim($_POST['hobby']);
			
			$model	=	Model();
			$result	=	$model->table('member_more')->where(array('member_id'=>$member_id))->update($params);
			if($result){
				$this->showTip(Language::get('nc_save_detail_is_succ'),'index.php?act=memberaccount&op=detail','succ');
			}else{
				$this->showTip(Language::get('nc_save_detail_is_fail'),'','html','error');
			}
		}
		
		$model		=	Model();		
		$membermore	=	$model->table('member_more')->where(array('member_id'=>$member_id))->find();
		Tpl::output('member',$membermore);

		$this->menu('detail');

		Tpl::output('constellation',$this->constellation());
		Tpl::output('weight',$this->weight());
		Tpl::output('menu_sign','title_detail');
		Tpl::showpage('member.detail');
	}

	private function constellation(){
		return array(
			1	=>	Language::get('nc_member_Aries'),
			2	=>	Language::get('nc_member_Taurus'),
			3	=>	Language::get('nc_member_Gemini'),
			4	=>	Language::get('nc_member_Cancer'),
			5	=>	Language::get('nc_member_Leo'),
			6	=>	Language::get('nc_member_Virgo'),
			7	=>	Language::get('nc_member_Libra'),
			8	=>	Language::get('nc_member_Scorpio'),
			9	=>	Language::get('nc_member_Sagittarius'),
			10	=>	Language::get('nc_member_Capricornus'),
			11	=>	Language::get('nc_member_Aquarius'),
			12	=>	Language::get('nc_member_Pisces')
		);
	}

	private function weight(){
		return array(
			1	=>	Language::get('nc_member_secret'),	
			2	=>	Language::get('nc_member_small_and_exquisite_type'),
			3	=>	Language::get('nc_member_charm_cola'),
			4	=>	Language::get('nc_member_tall_graceful_form'),
			5	=>	Language::get('nc_member_lovely_ball')
		);
	}

	/**
	 * 个人头像
	 */
	public function avatarOp(){
		/**
		 * 头像文件
		 */
		$model  = Model();
		$member = $model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();
		Tpl::output('member',$member); 
		$this->menu('avatar');
		Tpl::output('menu_sign','title_avatar');
		Tpl::showpage('member.avatar');
	}
	
	/**
	 * 上传头像
	 */
	public function uploadOp(){
		if(!chksubmit()){
			redirect('index.php?act=memberaccount&op=avatar');
		}
		import('function.thumb');
		$member_id = $_SESSION['member_id'];
		//上传图片
		if(!empty($_FILES['uploadimg']['name'])){
			$upload = new UploadFile();
			$uploaddir = ATTACH_MEMBER_PATH;
			$upload->set('thumb_width',	500);
			$upload->set('thumb_height',499);
			$ext = strtolower(pathinfo($_FILES['uploadimg']['name'], PATHINFO_EXTENSION));
			$upload->set('file_name',"tmp_avatar_$member_id.$ext");
			$upload->set('thumb_ext','_new');
			$upload->set('ifremove',true);
			$upload->set('default_dir',$uploaddir);
			$result = $upload->upfile('uploadimg');
			if($result){
				$this->menu('avatar');
				Tpl::output('newfile',$upload->thumb_image);
				Tpl::output('height',get_height(BASE_UPLOAD_PATH.'/shop/member/'.$upload->thumb_image));
				Tpl::output('width',get_width(BASE_UPLOAD_PATH.'/shop/member/'.$upload->thumb_image));
				Tpl::showpage('member.avatar');
			}else{
				$this->showTip('图片文件上传失败','','html','error');
			}
		}else{
			$this->showTip('请选择要上传的头像图片文件','','html','error');
		}
	}
	
	/**
	 * 图片裁剪
	 */
	public function cutOp(){
		if(chksubmit()){
			$thumb_width = 120;
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			$scale = $thumb_width/$w;
			$_POST['newfile'] = str_replace('..', '', $_POST['newfile']);
			$src = BASE_UPLOAD_PATH.DS.'shop/member'.DS.$_POST['newfile'];
			$avatarfile = BASE_UPLOAD_PATH.DS.'shop/member'.DS."avatar_{$_SESSION['member_id']}.jpg";
			import('function.thumb');
			$cropped = resize_thumb($avatarfile, $src,$w,$h,$x1,$y1,$scale);
			@unlink($src);
			Model()->table('member')->where(array('member_id'=>$_SESSION['member_id']))->update(array('avatar'=>'avatar_'.$_SESSION['member_id'].'.jpg'));
			if($_SESSION['avatar'] == ''){
				//计入分数
				member_point_add('avatar_upload');
			}
			$_SESSION['avatar'] = 'avatar_'.$_SESSION['member_id'].'.jpg';
			redirect('index.php?act=memberaccount&op=avatar');
		}
	}
	
	/**
	 * 收获地址
	 */
	public function addressOp(){
		$member_id	=	$_SESSION['member_id'];
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam	=	array(
				array("input"=>trim($_POST['shipped_to_name']),"require"=>"true","message"=>'收货人不能为空'),
				array("input"=>trim($_POST['address']),"require"=>"true","message"=>'收货地址不能为空'),
				array("input"=>trim($_POST['zipcode']),"require"=>"true","message"=>'邮政编码不能为空'),
				array("input"=>trim($_POST['telephone']),"require"=>"true","message"=>'联系电话不能为空')
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			$params						=	array();
			$params['shipped_to_name']	=	trim($_POST['shipped_to_name']);
			$params['address']			=	trim($_POST['address']);
			$params['zipcode']			=	trim($_POST['zipcode']);
			$params['telephone']		=	trim($_POST['telephone']);
			$params['province']		    =	trim($_POST['p_val']);
			$params['city']		        =	trim($_POST['c_val']);
			$params['district']		    =	trim($_POST['d_val']);
			
			$model	=	Model();
			$result	=	$model->table('member')->where(array('member_id'=>$member_id))->update($params);

			if($result){
				$this->showTip(Language::get('nc_save_shipping_is_succ'),'index.php?act=memberaccount&op=address','succ');
			}else{
				$this->showTip(Language::get('nc_save_shipping_is_fail'),'','html','error');
			}
		}
		
		$model		=	Model();		
		$member	=	$model->table('member')->where(array('member_id'=>$member_id))->find();
		Tpl::output('member',$member);
		//调取一级地区信息
		$area_model = Model('area');
		$condition_city = array();
		$condition_city['parent_area_id'] = 0;
		$city_list = $area_model->getList($condition_city);
		Tpl::output('area_array',$city_list);
		$this->menu('address');
		Tpl::output('menu_sign','title_address');
		Tpl::showpage('member.address');
	}
	
	/**
	 * 账号信息
	 */
	public function accountinfoOp(){
		$member_id	=	$_SESSION['member_id'];
		$model	=	Model();
		$memberinfo	=	$model->table('member')->where(array('member_id'=>$member_id))->find();
		Tpl::output('member',$memberinfo);
		$this->menu('accountinfo');

		Tpl::output('menu_sign','account_info');
		Tpl::showpage('member.accountinfo');
	}

	public function modifypwdOp(){
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
			array("input"=>$_POST["current_password"],		"require"=>"true",		"message"=>Language::get('nc_member_current_password_is_not_null')),
			array("input"=>$_POST["new_password"],		"require"=>"true",		"message"=>Language::get('nc_member_new_password_is_not_null')),
			array("input"=>$_POST["confirm_password"],	"require"=>"true",		"validator"=>"Compare","operator"=>"==","to"=>$_POST["new_password"],"message"=>Language::get('nc_member_password_not_same')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			if($_POST['new_password'] == ''){
				$this->showTip('所设置的支付密码不能为空','','html','error');
			}
			if($_POST['new_password'] != $_POST['confirm_password']){
				$this->showTip('两次密码输入不一致','','html','error');
			}
			$model	=	Model();
			$member_info = $model->table('member')->where(array('member_id'=>$_SESSION['member_id'],'password'=>trim(md5($_POST['current_password']))))->find();

			if(empty($member_info)){
				$this->showTip(Language::get('nc_member_password_is_wrong'),'','html','error');
			}

			$result	=	$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->update(array('password'=>trim(md5($_POST['new_password']))));
			if($result){
				$this->showTip(Language::get('nc_member_modify_password_succ'),'index.php?act=memberaccount&op=accountinfo','succ');
			}else{
				$this->showTip(Language::get('nc_member_modify_password_fail'),'','html','error');
			}
		}
		Tpl::output('menu_sign','account_info');
		Tpl::showpage('member.modifypwd');
	}
	
	public function modifypaypwdOp(){
		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
			array("input"=>$_POST["new_password"],		"require"=>"true",		"message"=>Language::get('nc_member_new_password_is_not_null')),
			array("input"=>$_POST["confirm_password"],	"require"=>"true",		"validator"=>"Compare","operator"=>"==","to"=>$_POST["new_password"],"message"=>Language::get('nc_member_password_not_same')),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error').$error,'','html','error');
			}
			if($_POST['new_password'] == ''){
				$this->showTip('所设置的支付密码不能为空','','html','error');
			}
			if($_POST['new_password'] != $_POST['confirm_password']){
				$this->showTip('两次密码输入不一致','','html','error');
			}
			$model	=	Model();
			$member_info = $model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();

			if($member_info['pay_password'] != '' && $member_info['pay_password'] != md5($_POST["current_password"])){
				$this->showTip(Language::get('nc_member_password_is_wrong'),'','html','error');
			}

			$result	=	$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->update(array('pay_password'=>trim(md5($_POST['new_password']))));
			if($result){
				$this->showTip(Language::get('nc_member_modify_password_succ'),intval($_GET['from_orderpay_id'])>0?'index.php?act=groupbuy&op=grouppayment&order_id='.intval($_GET['from_orderpay_id']):'index.php?act=memberaccount&op=accountinfo','succ');
			}else{
				$this->showTip(Language::get('nc_member_modify_password_fail'),'','html','error');
			}
		}
		Tpl::output('menu_sign','account_info');
		Tpl::showpage('member.modifypaypwd');
	}

	public function modifyemailOp(){

		if(isset($_POST) && !empty($_POST)){
			//表单验证
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["email"],		"require"=>"true",		"message"=>$lang['nc_member_current_password_is_not_null']),
				array("input"=>$_POST["telephone"],		"require"=>"true",		"message"=>$lang['nc_member_new_password_is_not_null'])
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$this->showTip(Language::get('error'),'','html','error');
			}

			//编辑邮件移动电话
			$model	=	Model();
			$result	=	$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->update(array('email'=>trim($_POST['email']),'mobile'=>trim($_POST['mobile'])));
			
			if($result){
				$this->showTip(Language::get('nc_member_modify_email_tele_succ'),'index.php?act=memberaccount&op=accountinfo','succ');
			}else{
				$this->showTip(Language::get('nc_member_modify_email_tele_fail'),'','html','error');
			}
		}

		$model	=	Model();
		$memberinfo	=	$model->table('member')->where(array('member_id'=>$_SESSION['member_id']))->find();
		Tpl::output('memberinfo',$memberinfo);
		Tpl::output('menu_sign','account_info');
		Tpl::showpage('member.modifyemail');
	}

	/**
	 * 账号信息
	 */
	public function commentOp(){
		$member_id	=	$_SESSION['member_id'];
		$model	=	Model();
		$page	=	10;
		$where = array('member_id'=>$member_id);
		//搜索
		if($_GET['s_type'] != '' && $_GET['s_content'] != ''){
			$where[$_GET['s_type']] = array('like','%'.$_GET['s_content'].'%');
		}
		$commentlist	=	$model->table('comment')->where($where)->page($page)->order('`add_time` desc')->select();
		Tpl::output('list',$commentlist);
		Tpl::output('show_page',$model->showpage());

		$this->menu('comment');
		Tpl::output('menu_sign','comment_manage');
		Tpl::showpage('member.comment');
	}


	/**
	 * 删除评论
	 */
	public function dropcommentOp(){
		$comment_id	=	intval($_GET['comment_id']);
		$model	 =	Model();
		$comment = $model->table('comment')->where(array('comment_id'=>$comment_id,'member_id'=>$_SESSION['member_id']))->find();
		
		if(empty($comment)){//检查该评论是否存在
			$this->showTip(Language::get('nc_member_drop_is_not_exists'),'','html','error');
		}
			
		$result	 =	$model->table('comment')->where(array('comment_id'=>$comment_id))->delete();//删除评论
		
		if($result){//更新评论数
			$commentnum = $model->table('comment')->where(array('store_id'=>$comment['store_id']))->count();
			$model->table('store')->where(array('store_id'=>$_SESSION['store_id']))->update(array('comment_count'=>$commentnum));
			
			$this->showTip(Language::get('nc_member_drop_comment_succ'),'index.php?act=memberaccount&op=comment','succ');
		}else{
			$this->showTip(Language::get('nc_member_drop_comment_fail'),'','html','error');
		}
	}
	
	/**
	 * 我的收藏
	 */
	public function fav_listOp(){
		$fav_type = trim($_GET['s_type']);
		$model = Model();
		if($fav_type == 'comment'){
			$list = $model->field('favorites.fav_id,comment.store_id,comment.member_name,comment.store_name,comment.comment,comment.add_time,comment.person_cost,comment.parking')->table('favorites,comment')->join('left join')->on('favorites.fav_id=comment.comment_id')->where(array('favorites.member_id'=>$_SESSION['member_id'],'favorites.fav_type'=>'comment'))->order('favorites.fav_time desc')->page(10)->select();
		}else{
			$list = $model->field('favorites.fav_id,store.store_id,store.store_name,store.logo,store.person_consume,store.comment_count,store.city_id,store.class_id')->table('favorites,store')->join('left join')->on('favorites.fav_id=store.store_id')->where(array('favorites.member_id'=>$_SESSION['member_id'],'favorites.fav_type'=>'store'))->order('favorites.fav_time desc')->page(10)->select();
			$class = F('class_',null,'cache/class');
			$city = F('city',null,'cache/city');
			if(!empty($list)){
				foreach ($list as $k=>$v){
					if(!empty($class['class_root'])){
						foreach ($class['class_root'] as $ck=>$cv){
							if($cv['class_id'] == $v['class_id']){
								$list[$k]['class_name'] = $cv['class_name'];
								break; 
							}
						}
					}
					if(!empty($city)){
						foreach ($city as $ctk=>$ctv){
							if($ctv['area_id'] == $v['city_id']){
								$list[$k]['city_name'] = $ctv['area_name'];
								break; 
							}
						}
					}
				}
			}
		}
		$this->menu('favorite');
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('member.favlist');
	}
	/**
	 * 取消收藏
	 */
	public function fav_delOp(){
		$model = Model();
		$fav_id = intval($_GET['fav_id']);
		if($fav_id <= 0){
			$this->showTip('参数错误','','html','error');
		}
		$params = array();
		$params['member_id'] = $_SESSION['member_id'];
		$params['fav_id'] 	 = $fav_id;
		
		if($model->table('favorites')->where($params)->delete()){
			$this->showTip('取消收藏成功！','index.php?act=memberaccount&op=fav_list','succ');
		}else{
			$this->showTip('取消收藏失败','','html','error');
		}
	}	
	/**
	 * 我的会员卡
	 */
	public function card_listOp(){
		$model = Model();
		$list = $model->table('card_member')->where(array('member_id'=>$_SESSION['member_id']))->page(10)->order('id desc')->select();
		$this->menu('card');
		Tpl::output('list',$list);
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('member.card');
	}
	
	/**
	 * ajax获取地区信息
	 */
	public function address_getOp(){
		$p_id = intval($_GET['p_id']);
		//调取地区信息缓存
		$area_list = F('area');
		$result_array = array();
		if(!empty($area_list)){
			foreach ($area_list as $key=>$val){
				if($val['area_parent_id'] == $p_id){
					$val['area_id'] = $key;
					$result_array[] = $val;
				}
			}
		}
		echo json_encode($result_array);
	}

	
	/**
	 * 团购提醒
	 */
	public function groupbuyremindOp(){
		$model = Model();
		$remind = $model->table('groupbuy_remind')->where(array('member_id'=>$_SESSION['member_id']))->select();

		Tpl::output('list',$remind);
		Tpl::output('menu','groupbuyremind');
		Tpl::showpage('groupbuy.remind');
	}


	/**
	 * 团购提醒删除
	 */
	public function delremindOp(){
		$model		= Model();
		$params		= array();
		$params['member_id'] = $_SESSION['member_id'];
		$params['remind_id'] = intval($_GET['remind_id']);

		$res = $model->table('groupbuy_remind')->where($params)->delete();
		if($res){
			$this->showTip('操作成功','','html','succ');
		}else{
			$this->showTip('操作失败','','html','error');
		}
	}
	
	/**
	 * 积分兑换
	 */
	public function giftorderOp(){
		$model = Model();
		$condition = array('member_id'=>$_SESSION['member_id']);
		$s_type = trim($_GET['s_type']);
		$s_content = trim($_GET['s_content']);
		$s_state = intval($_GET['s_state']);
		if($s_content != ''){
			$condition[$s_type] = array('like','%'.$s_content.'%');
		}
		if($s_state > 0){
			$condition['go_state'] = $s_state;
		}
		//调取礼品订单列表信息
		$gift_order_list = $model->table('gift_order')->where($condition)->page(10)->select();
		Tpl::output('gift_order_list',$gift_order_list);
		Tpl::output('menu','giftorder');
		Tpl::output('show_page',$model->showpage());
		Tpl::showpage('gift_order.list');
	}
	
	/**
	 * 礼品确认收货
	 */
	public function gift_receiveOp(){
		$model = Model();
		$go_id = intval($_GET['go_id']);
		if($go_id <= 0){
			$this->showTip('参数错误');
		}
		$rs = $model->table('gift_order')->where(array('go_id'=>$go_id))->update(array('go_state'=>3,'go_change_time'=>time()));
		if($rs){
			$this->showTip('确认收货成功！','index.php?act=memberaccount&op=giftorder','html','succ');
		}else{
			$this->showTip('确认收货失败','','html','error');
		}
	}
	
	/**
	 * 我的积分
	 */
	public function scorelogOp(){
		$model = Model();
		$condition = array('member_id'=>$_SESSION['member_id']);
		if(intval($_GET['s_state']) > 0){
			$condition['pl_type'] = intval($_GET['s_state']);
		}
		$score_log = $model->table('point_log')->where($condition)->order('pl_time desc')->page(10)->select();
		Tpl::output('score_log',$score_log);
		Tpl::output('show_page',$model->showpage());
		Tpl::output('menu','scorelog');
		Tpl::showpage('score.log');
	}
}