<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
define('MYSQL_RESULT_TYPE',1);
class indexControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
        Language::read('indexs');
        Tpl::output('index_sign','index');
	}

	/**
	 * 本地生活首页
	 */
	public function indexOp(){ 
		//分类列表
		$this->classlist();
		//热门分类
		
		//商区列表
		$this->arealist();

		//优惠券
		$model = Model();
		$coupon_condition			=	array();
		$coupon_condition['coupon.coupon_start_time']		=	array('elt',time());
		$coupon_condition['coupon.coupon_end_time']		=	array('egt',time());
		$coupon_condition['coupon.audit']	=	2;
		$coupon_condition['coupon.city_id'] =	$this->city_info['area_id'];
		$coupon_condition['coupon.is_recommend'] =	1;
		$coupon_condition['store.store_state']   =	2;
		$coupon_list	=	$model->table('coupon,store')->join('left join')->on('coupon.store_id=store.store_id')->where($coupon_condition)->order('coupon.coupon_id desc')->limit(10)->select();
		Tpl::output('coupon_list',$coupon_list);
		
		//会员榜
		$memberlist = $model->table('member')->order('comment_num desc')->where(array('usercity'=>$this->city_info['area_id']))->order('comment_num desc')->limit(6)->select();
		Tpl::output('memberlist',$memberlist);
		
		//团购
		$groupbuy_model = Model();
		$groupbuy_condition		=	array();
		$groupbuy_condition['groupbuy.start_time']	=	array('elt',time());
		$groupbuy_condition['groupbuy.end_time']		=	array('egt',time());
		$groupbuy_condition['groupbuy.is_open']		=	1;//1.开启 2.关闭
		$groupbuy_condition['groupbuy.city_id']		= 	$this->city_info['area_id'];
		$groupbuy_condition['groupbuy.is_audit']	=	2;//1.待审核 2.审核通过 3.审核未通过
		$groupbuy_condition['store.store_state']    =	2;
		$grouplist = $groupbuy_model->table('groupbuy,store')->join('left join')->on('groupbuy.store_id=store.store_id')->where($groupbuy_condition)->order('groupbuy.group_id desc')->limit(10)->select();
		Tpl::output('grouplist',$grouplist);

		//推荐评论
		$model_comment = Model();
		$comment_condition = array();
		$comment_condition['comment.is_recommend'] = 1;
		$comment_condition['comment.city_id'] = $this->city_info['area_id'];
		$comment_condition['store.store_state'] = 2;
		$commentlist = $model_comment->field('comment.*,member.avatar')->table('comment,store,member')->join('left join')->on('comment.store_id=store.store_id,comment.member_id=member.member_id')->where($comment_condition)->order('comment.add_time desc')->limit(12)->select();
		Tpl::output('commentlist',$commentlist);
		
		//商户数
		$count = $model->table('store')->where(array('city_id'=>$this->city_info['area_id']))->count();
		Tpl::output('count',$count);
		
		if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 1){
			$nopayment = $model->table('order')->where(array('member_id'=>$_SESSION['member_id'],'state'=>1))->count();
			$payment = $model->table('order')->where(array('member_id'=>$_SESSION['member_id'],'state'=>2))->count();
			$consume = $model->table('order')->where(array('member_id'=>$_SESSION['member_id'],'state'=>3))->count();
			
			Tpl::output('nopayment',$nopayment);
			Tpl::output('payment',$payment);
			Tpl::output('consume',$consume);
		}

		//推荐店铺
		$recommend_store = $model->table('store')->where(array('store_recommend'=>1,'store_state'=>2,'city_id'=>$this->city_info['area_id']))->limit(5)->order('store_click desc')->select();
		Tpl::output('recommend_store',$recommend_store);
		//文章输出
		$list = $this->_article();
		Tpl::showpage('index');
	}

	/**
	 * 商铺列表
	 */
	public function listOp(){
		$condition	=	array();
		//搜索查询
		if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
			$condition['store_name']	=	array(array('like',"%{$_GET['keyword']}%"));
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
		
		//价格区间
		if(isset($_GET['pconsume']) && !empty($_GET['pconsume'])){
			switch($_GET['pconsume']){
				case 1:
					$condition['person_consume']	=	array('lt',20);
					break;
				case 2:
					$condition['person_consume']	=	array('between','20,49');
					break;
				case 3:
					$condition['person_consume']	=	array('between','50,79');
					break;
				case 4:
					$condition['person_consume']	=	array('between','80,119');
					break;
				case 5:
					$condition['person_consume']	=	array('between','120,199');
					break;
				case 6:
					$condition['person_consume']	=	array('between','200,500');
					break;
				case 7:
					$condition['person_consume']	=	array('gt',500);
					break;
			}
			Tpl::output('pconsume',intval($_GET['pconsume']));
		}

		//排序
		$orderby = '';
		if(isset($_GET['orderby']) && isset($_GET['sort'])){
			Tpl::output('orderby',trim($_GET['orderby']));
			
			switch($_GET['orderby']){
				case 'person_consume':
					$orderby = 'person_consume';
					break;
				case 'add_time':
					$orderby = 'add_time';
					break;
				case 'comment_count':
					$orderby = 'comment_count';
					break;
				case 'groupbuy_num':
					$orderby = 'groupbuy_num';
					break;
				default:
					$orderby = 'store_id';
					break;
			}
			

			if(!empty($_GET['sort'])){
				$orderby = $orderby.' '.($_GET['sort']=='desc'?'desc':'asc');
			}else{
				$orderby = $orderby.' desc';
			}

			if(trim($_GET['sort'])=='asc'){
				Tpl::output('sort','desc');
			}else{
				Tpl::output('sort','asc');
			}
		}else{
			$orderby = 'store_id desc';
			Tpl::output('sort',empty($_GET['sort'])?'desc':$_GET['sort']);
		}
		

		$store_model = Model('store');
		$condition['store_state'] = 2;//1.创建 2.开启 3.关闭
		$condition['is_audit']	  = 2;//1.待审核 2.审核通过 3.审核未通过
		$list = $store_model->getList($condition,'20',$orderby);
		
		if(!empty($list)){
			$model = Model();
			foreach($list as $key=>$value){
				//该商铺是否有优惠活动
				$iscoupon= $model->table('coupon')->where(array('store_id'=>$value['store_id']))->count();
				if($iscoupon>0){
					$list[$key]['iscoupon'] = 1;
				}
			}
		}
		
		Tpl::output('list',$list);
		Tpl::output('show_page',$store_model->showpage(2));
		
		//分类列表
		$this->classlist();

		//商区列表
		$this->arealist();
		
		//优惠券列表
		$this->coupon();
		$personconsume	=	$this->pconsume();
		Tpl::output('personconsume',$personconsume);

		Tpl::showpage('store.list');
	}
	
	/*
	 * 优惠券
	 */
	private function coupon(){
		$coupon_model = Model('coupon');
		$condition	=	array();
		$condition['store.store_state'] = 2;
		$condition['coupon.audit'] = 2;
		$couponlist = $coupon_model->table('coupon,store')->join('left join')->on('coupon.store_id=store.store_id')->where($condition)->order('coupon.download_count desc')->limit("0,10")->select();
		Tpl::output('couponlist',$couponlist);
	}
    
   	
   	/*
	 * 文章输出
	 */
	private function _article() {

		if (file_exists(BASE_CACHE_PATH.'/index/article.php')){
			include(BASE_CACHE_PATH.'/index/article.php');
			Tpl::output('show_article',$show_article);
			Tpl::output('article_list',$article_list);
			return ;		
		}
		$model_article_class	= Model('article_class');
		$model_article	= Model('article');
		$show_article = array();//商城公告
		$article_list	= array();//下方文章
		$notice_class	= array('notice','store','about');
		$code_array	= array('member','store','payment','sold','service','about');
		$notice_limit	= 5;
		$faq_limit	= 5;

		$class_condition	= array();
		$class_condition['home_index'] = 'home_index';
		$class_condition['order'] = 'ac_sort asc';
		$article_class	= $model_article_class->getClassList($class_condition);
		$class_list	= array();
		if(!empty($article_class) && is_array($article_class)){
			foreach ($article_class as $key => $val){
				$ac_code = $val['ac_code'];
				$ac_id = $val['ac_id'];
				$val['list']	= array();//文章
				$class_list[$ac_id]	= $val;
			}
		}
		
		$condition	= array();
		$condition['article_show'] = '1';
		$condition['home_index'] = 'home_index';
		$condition['field'] = 'article.article_id,article.ac_id,article.article_url,article.article_title,article.article_time,article_class.ac_name,article_class.ac_parent_id';
		$condition['order'] = 'article_sort desc,article_time desc';
		$condition['limit'] = '300';
		$article_array	= $model_article->getJoinList($condition);
		if(!empty($article_array) && is_array($article_array)){
			foreach ($article_array as $key => $val){
				$ac_id = $val['ac_id'];
				$ac_parent_id = $val['ac_parent_id'];
				if($ac_parent_id == 0) {//顶级分类
					$class_list[$ac_id]['list'][] = $val;
				} else {
					$class_list[$ac_parent_id]['list'][] = $val;
				}
			}
		}
		if(!empty($class_list) && is_array($class_list)){
			foreach ($class_list as $key => $val){
				$ac_code = $val['ac_code'];
				if(in_array($ac_code,$notice_class)) {
					$list = $val['list'];
					array_splice($list, $notice_limit);
					$val['list'] = $list;
					$show_article[$ac_code] = $val;
				}
				if (in_array($ac_code,$code_array)){
					$list = $val['list'];
					$val['class']['ac_name']	= $val['ac_name'];
					array_splice($list, $faq_limit);
					$val['list'] = $list;
					$article_list[] = $val;
				}
			}
		}
		$string = "<?php\n\$show_article=".var_export($show_article,true).";\n";
		$string .= "\$article_list=".var_export($article_list,true).";\n?>";
		file_put_contents(BASE_CACHE_PATH.'/index/article.php',compress_code($string));

		Tpl::output('show_article',$show_article);
		Tpl::output('article_list',$article_list);
	}
}