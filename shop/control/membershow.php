<?php
/**
 * 会员页面
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class membershowControl extends BaseHomeControl{
	public function __construct() {
		parent::__construct();
		/**
		 * 设置模板文件夹路径
		 */
		Tpl::setDir('home');
		/**
		 * 设置布局文件内容
		 */
		Tpl::setLayout('member_show_layout');
    }
    private function basic_info($mid){
    	$model = Model();
    	//调取会员基本信息
    	$minfo = $model->field('member.*,member_more.*,area.area_name')->table('member,member_more,area')->join('left join')->on('member.member_id=member_more.member_id,member.usercity=area.area_id')->where(array('member.member_id'=>$mid))->find();
    	$md_list = F('member_degree');
    	foreach ($md_list as $val){
    		if($val['md_id'] == $minfo['member_degree']){
    			$minfo['md_name'] = $val['md_name'];
    		}
    	}
    	Tpl::output('minfo',$minfo);
    }
    /**
     * 会员主页
     */
    public function indexOp(){
    	$model = Model();
    	$mid = intval($_GET['mid']);
    	if($mid <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取会员基本信息
    	$this->basic_info($mid);
    	//调取会员点评信息
    	$comment_list = $model->table('comment')->where(array('member_id'=>$mid))->order('add_time desc')->select();
    	Tpl::output('cnum',count($comment_list));
    	Tpl::output('comment_list',$comment_list);
    	//调取会员图片信息
    	$pic_list = $model->table('comment_pic')->where(array('member_id'=>$mid))->order('add_time desc')->select();
    	Tpl::output('pic_list',$pic_list);
    	Tpl::output('pnum',count($pic_list));
    	//调取会员收藏信息
    	$fav_list = $model->field('store.*,store_class.class_name,area.area_name')->table('favorites,store,store_class,area')->join('left join')->on('favorites.fav_id=store.store_id,store.s_class_id=store_class.class_id,store.mall_id=area.area_id')->where(array('member_id'=>$mid,'fav_type'=>'store'))->order('fav_time desc')->select();
    	Tpl::output('fnum',count($fav_list));
    	Tpl::output('fav_list',$fav_list);	
    	Tpl::showpage('member_show.index');
    }
	/**
     * 会员点评
     */
    public function commentOp(){
    	$model = Model();
    	$mid = intval($_GET['mid']);
    	if($mid <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取会员基本信息
    	$this->basic_info($mid);
    	//调取会员点评信息
    	$comment_list = $model->table('comment')->where(array('member_id'=>$mid))->page(10)->order('add_time desc')->select();
    	$cnum = $model->field('count(*) as num')->table('comment')->where(array('member_id'=>$mid))->find();
    	Tpl::output('cnum',$cnum['num']);
    	Tpl::output('comment_list',$comment_list);
    	Tpl::output('show_page',$model->showpage());
    	Tpl::showpage('member_show.comment');
    }
	/**
     * 会员收藏
     */
    public function favOp(){
    	$model = Model();
    	$mid = intval($_GET['mid']);
    	if($mid <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取会员基本信息
    	$this->basic_info($mid);
    	$type = trim($_GET['type']);
    	if($type == '' || $type == 'store'){
    		//调取店铺收藏列表
	    	$store_fav = $model->field('store.*,store_class.class_name,area.area_name,favorites.fav_time')->table('favorites,store,store_class,area')->join('left join')->on('favorites.fav_id=store.store_id,store.s_class_id=store_class.class_id,store.area_id=area.area_id')->where(array('member_id'=>$mid,'fav_type'=>'store'))->page(10)->order('fav_time desc')->select();
	    	Tpl::output('store_list',$store_fav);
	    	Tpl::output('show_page',$model->showpage());
	    	
    	}else{
    		//调取评价收藏列表
    		$comment_fav = $model->field('favorites.*,comment.*,store.store_score,store.address,store.person_consume')->table('favorites,comment,store')->join('left join')->on('favorites.fav_id=comment.comment_id,comment.store_id=store.store_id')->where(array('favorites.member_id'=>$mid,'favorites.fav_type'=>'comment'))->page(10)->select();
    		Tpl::output('comment_list',$comment_fav);
	    	Tpl::output('show_page',$model->showpage());
    	}
    	//收藏数量统计
    	$snum = $model->field('count(*) as num')->table('favorites')->where(array('member_id'=>$mid,'fav_type'=>'store'))->find();
	    Tpl::output('snum',$snum['num']);
	    $cnum = $model->field('count(*) as num')->table('favorites')->where(array('member_id'=>$mid,'fav_type'=>'comment'))->find();
	    Tpl::output('cnum',$cnum['num']);
	    //调取人气店铺
	    $hot_store = $model->field('store.*,area.area_name')->table('store,area')->join('left_join')->on('store.area_id=area.area_id')->where(array('city_id'=>$this->city_info['area_id'],'is_audit'=>2,'store_state'=>2))->order('store_click desc')->limit(5)->select();
	    Tpl::output('hot_store',$hot_store);
    	Tpl::showpage('member_show.fav');
    }
	/**
     * 会员图片
     */
    public function picOp(){
    	$model = Model();
    	$mid = intval($_GET['mid']);
    	if($mid <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取会员基本信息
    	$this->basic_info($mid);
    	//读取图片信息数据
    	$pic_list = $model->table('comment_pic')->where(array('member_id'=>$mid))->page(9)->order('add_time desc')->select();
    	Tpl::output('pic_list',$pic_list);
	    Tpl::output('show_page',$model->showpage());
	    $pnum = $model->field('count(*) as num')->table('comment_pic')->where(array('member_id'=>$mid))->find();
	    Tpl::output('pnum',$pnum['num']);
    	Tpl::showpage('member_show.pic');
    }
    /**
     * 图片页
     */
    public function pic_showOp(){
    	$model = Model();
    	$mid = intval($_GET['mid']);
    	if($mid <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取会员基本信息
    	$this->basic_info($mid);
    	$cp_id = intval($_GET['cp_id']);
    	if($cp_id <= 0){
    		$this->showTip('参数错误','','html','error');
    	}
    	//调取图片信息
    	$pic_info = $model->table('comment_pic')->where(array('cp_id'=>$cp_id))->find();
    	Tpl::output('pic_info',$pic_info);
    	Tpl::showpage('member_show.pic_show');
    }
}