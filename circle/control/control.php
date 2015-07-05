<?php
/**
 * 圈子父类
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

/********************************** 前台control父类 **********************************************/

class BaseCircleControl{
	protected $identity = 0;	// 身份	0游客 1圈主 2管理 3成员 4申请中 5申请失败 6禁言
	protected $c_id = 0;		// 圈子id
	protected $cm_info = array();	// Members of the information
	protected $m_readperm = 0;	// Members read permissions
	/**
	 * 构造函数
	 */
	public function __construct(){
		/**
		 * 验证圈子是否开启
		 */
		if (C('circle_isuse') != '1'){
			@header('location: '.SiteUrl);die;
		}
		/**
		 * 短消息检查
		 */		
		$this->checkMessage();
		/**
		 * 读取通用、布局的语言包
		 */
		Language::read('common');
		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('circle_layout');
        /**
         * 获取导航
         */
        Tpl::output('nav_list',($nav = F('nav')) ? $nav : H('nav',true,'file'));
	}

	/**
	 * 检测登陆
	 */
	protected function checklogin(){
		if($_SESSION['is_login']==1){
			@header("Location:index.php");
		}
	}
	protected function showTip($msg,$url='',$show_type='html',$msg_type='succ',$is_show=1,$time=2000){
		/**
		 * 如果默认为空，则跳转至上一步链接
		 */
		$url = ($url!='' ? $url : getReferer());
	
		$msg_type = in_array($msg_type,array('succ','error')) ? $msg_type : 'error';
		if (is_array($url)){
			foreach ($url as $k => $v){
				$url[$k]['url'] = $v['url']?$v['url']:getReferer();
			}
		}
		/**
		 * 读取信息布局的语言包
		 */
		Language::read("msg");
		/**
		 * html输出形式
		 * 指定为指定项目目录下的error模板文件
		*/
		Tpl::setDir('');
		Tpl::output('html_title',Language::get('nc_html_title'));
		Tpl::output('msg',$msg);
		Tpl::output('url',$url);
		Tpl::output('msg_type',$msg_type);
		Tpl::output('is_show',$is_show);
		Tpl::showpage('msg',$this->layout,$time);
		exit;
	}
	/**
	 * 检查短消息数量
	 *
	 * @param 
	 * @return 
	 */
	private function checkMessage() {
		if($_SESSION['member_id'] == '') return ;
		//判断cookie是否存在
		$cookie_name = 'msgnewnum'.$_SESSION['member_id'];
		if (cookie($cookie_name) != null && intval(cookie($cookie_name)) >=0){
			$countnum = intval(cookie($cookie_name));
		}else {
			$message_model = Model('message');
			$countnum = $message_model->countNewMessage($_SESSION['member_id']);
			setNcCookie($cookie_name,"$countnum",2*3600);//保存1天
		}
		Tpl::output('message_num',$countnum);
	}
	/**
	 * 圈子信息
	 */
	protected function circleInfo(){
        $this->circle_info = Model()->table('circle')->find($this->c_id);
		if(empty($this->circle_info)){
			showMessage(L('circle_group_not_exists'), '', '', 'error');
		}
		Tpl::output('circle_info', $this->circle_info);
	}
	/**
	 * 圈主和管理信息
	 */
	protected function manageList(){
		$manager_list = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'is_identity'=>array('in', array(1,2))))->select();
		$manager_list = array_under_reset($manager_list, 'is_identity', 2);
		Tpl::output('creator', $manager_list[1][0]);
		$manager_list = array_under_reset($manager_list[2], 'member_id', 1);
		Tpl::output('manager_list', $manager_list);
	}
	/**
	 * 会员信息
	 */
	protected function memberInfo(){
		if($_SESSION['is_login']){
			$this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
			if(!empty($this->cm_info)){
				switch (intval($this->cm_info['cm_state'])){
					case 1:
						$this->identity = intval($this->cm_info['is_identity']);
						break;
					case 0:
						$this->identity = 4;
						break;
					case 2:
						$this->identity = 5;
						break;
				}
				// 禁言
				if($this->cm_info['is_allowspeak'] == 0){
					$this->identity = 6;
				}
			}
			Tpl::output('cm_info', $this->cm_info);
		}
		Tpl::output('identity', $this->identity);
	}
	/**
	 * sidebar相关信息
	 */
	protected function sidebar(){
		// Classification of the circle
		$class_info = Model()->table('circle_class')->find($this->circle_info['class_id']);
		Tpl::output('class_info', $class_info);
		
		// 明星圈友
		$star_member = Model()->table('circle_member')->where(array('cm_state'=>1, 'circle_id'=>$this->c_id, 'is_star'=>1))->order('rand()')->limit(5)->select();
		Tpl::output('star_member', $star_member);
		
		// 最新加入
		$newest_member = Model()->table('circle_member')->where(array('cm_state'=>1, 'circle_id'=>$this->c_id))->order('cm_jointime desc')->limit(5)->select();
		Tpl::output('newest_member', $newest_member);
		
		// 热销商品（直通车）
		if (C('gold_isuse') && C('ztc_isuse')){
			//商品参加直通车金币是否足够
			$ztc_dayprod = intval($GLOBALS['setting_config']['ztc_dayprod']);
			$datetime = date('Y-m-d',time());
			$datetime = strtotime($datetime);
			$condition	= "ztc_startdate <= $datetime and (($datetime - ztc_lastdate)/(3600*24))*$ztc_dayprod <= ztc_goods_goldnum";
			$goods_ids = Model()->table('ztc_goods')->field('ztc_goodsid,ztc_storeid,ztc_id')->where($condition)->order(rand(1,3))->limit(6)->getfield(1);
			$field = "goods_id,goods_name,store_id,goods_image,goods_store_price,goods_click,salenum";
			if ($goods_ids){
				$ztc_list = Model()->table('goods')->field($field)->where(array('goods_show'=>1,'goods_id'=>array('in',$goods_ids)))->select();
			}else{
				$ztc_list = array();
			}
			Tpl::output('ztc_list',$ztc_list);
		}
		
		// 有情圈子
		$friendship_list = Model()->table('circle_fs')->where(array('circle_id'=>$this->c_id, 'friendship_status'=>1))->order('friendship_sort asc')->select();
		Tpl::output('friendship_list', $friendship_list);
	}
	/**
	 * 最新话题/热门话题/人气回复
	 */
	protected function themeTop(){
		$model = Model();
		// 最新话题
		$new_themelist = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_id desc')->limit(10)->select();
		Tpl::output('new_themelist', $new_themelist);
		// 热门话题
		$hot_themelist = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_browsecount desc')->limit(10)->select();
		Tpl::output('hot_themelist', $hot_themelist);
		// 人气回复
		$reply_themelist = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_commentcount desc')->limit(10)->select();
		Tpl::output('reply_themelist', $reply_themelist);
	}
	/**
	 * SEO
	 */
	protected function circleSEO($title= '') {
        Tpl::output('html_title',$title.' '.C('circle_seotitle').' - Powered by ShopNC');
        Tpl::output('seo_keywords',C('circle_seokeywords'));
        Tpl::output('seo_description',C('circle_seodescription'));
	}
	
	/**
	 * Read permissions
	 */
	protected function readPermissions($cm_info){
		$data = H('circle_level');
		$rs = array();
		$rs[0] = 0;
		$rs[0] = L('circle_no_limit');
		foreach ($data as $v){
			$rs[$v['mld_id']]	= $v['mld_name'];
		}
		switch ($cm_info['is_identity']){
			case 1:
			case 2:
				$rs['255'] = L('circle_administrator');
				$this->m_readperm = 255;
				return $rs;
				break;
			case 3:
				$rs = array_slice($rs, 0, intval($cm_info['cm_level'])+1, true);
				$this->m_readperm = $cm_info['cm_level'];
				return $rs;
				break;
		}
	}
	/**
	 * breadcrumb navigation
	 */
	protected function breadcrumd($param = ''){
		$crumd = array(
			0=>array(
				'link'=>CIRCLE_SITE_URL,
				'title'=>L('nc_index')
			),
			1=>array(
				'link'=>CIRCLE_SITE_URL.'/index.php?act=group&c_id='.$this->c_id,
				'title'=>$this->circle_info['circle_name']
			),
		);
		if(!empty($this->theme_info)){
			$crumd[2] = array(
				'link'=>CIRCLE_SITE_URL.'/index.php?act=theme&op=theme_detail&c_id='.$this->c_id.'&t_id='.$this->t_id,
				'title'=>$this->theme_info['theme_name']
			);
		}
		if(empty($param)){
			unset($crumd[(count($crumd)-1)]['link']);
		}else{
			$crumd[]['title'] = $param;
		}
		Tpl::output('breadcrumd', $crumd);
	}
}
class BaseCircleThemeControl extends BaseCircleControl{
	protected $circle_info = array();	// 圈子详细信息
	protected $t_id = 0;		// 话题id
	protected $theme_info = array();	// 话题详细信息
	protected $r_id = 0;		// 回复id
	protected $reply_info = array();	// reply info
	protected $cm_info = array();		// Members of the information
	public function __construct(){
		parent::__construct();
		Language::read('circle');
		
		$this->c_id = intval($_GET['c_id']);
		if($this->c_id <= 0){
			@header("location: ".CIRCLE_SITE_URL);
		}
		Tpl::output('c_id', $this->c_id);
	}
	/**
	 * 话题信息
	 */
	protected function themeInfo(){
		$this->t_id = intval($_GET['t_id']);
		if($this->t_id <= 0){
			@header("location: ".CIRCLE_SITE_URL);
		}
		Tpl::output('t_id', $this->t_id);
	
		$this->theme_info = Model()->table('circle_theme')->where(array('circle_id'=>$this->c_id, 'theme_id'=>$this->t_id))->find();
		if(empty($this->theme_info)){
			showMessage(L('circle_theme_not_exists'), '', '', 'error');
		}
		Tpl::output('theme_info', $this->theme_info);
	}
	/**
	 * 验证回复
	 */
	protected function checkReplySelf(){
		$this->t_id = intval($_GET['t_id']);
		if($this->t_id <= 0){
			showDialog(L('wrong_argument'));
		}
		Tpl::output('t_id', $this->t_id);
		
		$this->r_id = intval($_GET['r_id']);
		if($this->r_id <= 0){
			showDialog(L('wrong_argument'));
		}
		Tpl::output('r_id', $this->r_id);
		
		$this->reply_info = Model()->table('circle_threply')->where(array('theme_id'=>$this->t_id, 'reply_id'=>$this->r_id, 'member_id'=>$_SESSION['member_id']))->find();
		if(empty($this->reply_info)){
			showDialog(L('wrong_argument'));
		}
		Tpl::output('reply_info', $this->reply_info);
	}
	/**
	 * 验证话题
	 */
	protected function checkThemeSelf(){
		$this->t_id = intval($_GET['t_id']);
		if($this->t_id <= 0){
			showDialog(L('wrong_argument'));
		}
		Tpl::output('t_id', $this->t_id);
		
		$this->theme_info = Model()->table('circle_theme')->where(array('theme_id'=>$this->t_id, 'member_id'=>$_SESSION['member_id']))->find();
		if(empty($this->theme_info)){
			showDialog(L('wrong_argument'));
		}
		Tpl::output('theme_info', $this->theme_info);
	}
}
class BaseCircleManageControl extends BaseCircleControl{
	protected $circle_info = array();	// 圈子详细信息
	protected $t_id = 0;		// 话题id
	protected $theme_info = array();	// 话题详细信息
	protected $identity = 0;	// 身份	0游客 1圈主 2管理 3成员
	protected $cm_info = array();	// 会员信息
	public function __construct(){
		parent::__construct();
		$this->c_id = intval($_GET['c_id']);
		if($this->c_id <= 0){
			@header("location: ".CIRCLE_SITE_URL);
		}
		Tpl::output('c_id', $this->c_id);
	}
	/**
	 * 圈子信息
	 */
	protected function circleInfo(){
		// 圈子信息
		$this->circle_info = Model()->table('circle')->find($this->c_id);
		if(empty($this->circle_info)) @header("location: ".CIRCLE_SITE_URL);
		Tpl::output('circle_info', $this->circle_info);
	}
	/**
	 * 会员信息
	 */
	protected function circleMemberInfo(){
		// 会员信息
		$this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
		if(!empty($this->cm_info)){
			$this->identity = $this->cm_info['is_identity'];
			Tpl::output('cm_info', $this->cm_info);
		}
		if(in_array($this->identity, array(0,3))){
			@header("location: ".CIRCLE_SITE_URL);
		}
		Tpl::output('identity', $this->identity);
	}
	/**
	 * 去除圈主
	 */
	protected function removeCreator($array){
		return array_diff($array, array($this->cm_info['member_id']));
	}
	/**
	 * 去除圈主和管理
	 */
	protected function removeManager($array){
		$where = array();
		$where['is_identity']	= array('in', array(1,2));
		$where['circle_id']		= $this->c_id;
		$cm_info = Model()->table('circle_member')->where($where)->select();
		if(empty($cm_info)){
			return $array;
		}
		foreach ($cm_info as $val){
			$array = array_diff($array, array($val['member_id']));
		}
		return $array;
	}
	/**
	 * 身份验证
	 */
	protected function checkIdentity($type){		// c圈主 m管理 cm圈主和管理
		$this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
		$identity = intval($this->cm_info['is_identity']); $sign = false;
		switch ($type){
			case 'c':
				if($identity != 1) $sign = true;
				break;
			case 'm':
				if($identity != 2) $sign = true;
				break;
			case 'cm':
				if($identity != 1 && $identity != 2) $sign = true;
				break;
			default:
				$sign = true;
				break;
		}
		if($sign){
			return L('circle_permission_denied');
		}
	}
	/**
	 * 会员加入的圈子
	 */
	protected function memberJoinCircle(){
		// 所属圈子信息
		$circle_array = Model()->table('circle,circle_member')->field('circle.*,circle_member.is_identity')
						->join('inner')->on('circle.circle_id=circle_member.circle_id')
						->where(array('circle_member.member_id'=>$_SESSION['member_id']))->select();
		Tpl::output('circle_array', $circle_array);
	}
	/**
	 * Top Navigation
	 */
	protected  function sidebar_menu($sign, $child_sign=''){
		$menu = array(
					'index'=>array('menu_name'=>L('circle_basic_setting'), 'menu_url'=>'index.php?act=manage&c_id='.$this->c_id),
					'member'=>array('menu_name'=>L('circle_member_manage'), 'menu_url'=>'index.php?act=manage&op=member_manage&c_id='.$this->c_id),
					'applying'=>array('menu_name'=>L('circle_wait_apply'), 'menu_url'=>'index.php?act=manage&op=applying&c_id='.$this->c_id),
					'level'=>array('menu_name'=>L('circle_member_level'), 'menu_url'=>'index.php?act=manage_level&op=level&c_id='.$this->c_id),
					'class'=>array('menu_name'=>L('circle_tclass'), 'menu_url'=>'index.php?act=manage&op=class&c_id='.$this->c_id),
					'inform'=>array(
								'menu_name'=>L('circle_inform'),
								'menu_url'=>'index.php?act=manage_inform&op=inform&c_id='.$this->c_id,
								'menu_child'=>array(
											'untreated'=>array('name'=>L('circle_inform_untreated'), 'url'=>'index.php?act=manage_inform&op=inform&c_id='.$this->c_id),
											'treated'=>array('name'=>L('circle_inform_treated'), 'url'=>'index.php?act=manage_inform&op=inform&type=treated&c_id='.$this->c_id)
										),
							),
					'managerapply'=>array('menu_name'=>L('circle_mapply'), 'menu_url'=>'index.php?act=manage_mapply&c_id='.$this->c_id),
					'friendship'=>array('menu_name'=>L('fcircle'), 'menu_url'=>'index.php?act=manage&op=friendship&c_id='.$this->c_id)
				);
		if($this->identity == 2){
			unset($menu['index']);unset($menu['member']);unset($menu['level']);unset($menu['class']);unset($menu['friendship']);
			unset($menu['inform']['menu_child']['untreated']);unset($menu['managerapply']);
		}
		Tpl::output('sidebar_menu', $menu);
		Tpl::output('sidebar_sign', $sign);
		Tpl::output('sidebar_child_sign', $child_sign);
	}
}
class BaseCirclePersonalControl extends BaseCircleControl{
	protected  $m_id = 0;	// memeber ID
	public function __construct(){
		parent::__construct();
		if(!$_SESSION['is_login']){
			@header("location: ".CIRCLE_SITE_URL);
		}
		$this->m_id = $_SESSION['member_id'];
	
		// member information
		$this->circleMemberInfo();
	}
	/**
	 * member information
	 */
	protected function circleMemberInfo(){
		// member information list
		$circlemember_list = Model()->table('circle_member')->where(array('member_id'=>$this->m_id))->select();

		$data = array();
		if(!empty($circlemember_list)){
			$data['cm_thcount']		= 0;
			$data['cm_comcount']	= 0;
			$data['member_id']		= $this->m_id;
			$data['member_name']	= $circlemember_list[0]['member_name'];
			foreach ($circlemember_list as $val){
				$data['cm_thcount']		+= $val['cm_thcount'];
				$data['cm_comcount']	+= $val['cm_comcount'];
			}
		}
		Tpl::output('cm_info', $data);
	}
	
}
