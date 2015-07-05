<?php
/**
 * 菜单
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
/**
 * top 数组是顶部菜单 ，left数组是左侧菜单
 * left数组中'args'=>'welcome,dashboard,dashboard',三个分别为op,act,nav，权限依据act来判断
 */
$arr = array(
		'top' => array(
			0 => array(
				'args' 	=> 'dashboard',
				'text' 	=> $lang['nc_console']),
			1 => array(
				'args' 	=> 'setting',
				'text' 	=> $lang['nc_config']),
			2 => array(
				'args' 	=> 'goods',
				'text' 	=> $lang['nc_goods']),
			3 => array(
				'args' 	=> 'store',
				'text' 	=> $lang['nc_store']),
			4 => array(
				'args'	=> 'member',
				'text'	=> $lang['nc_member']),
			5 => array(
				'args' 	=> 'trade',
				'text'	=> $lang['nc_trade']),
			6 => array(
				'args'	=> 'website',
				'text' 	=> $lang['nc_website']),
			7 => array(
				'args'	=> 'operation',
				'text'	=> $lang['nc_operation']),
			8 => array(
				'args'	=> 'tool',
				'text'	=> $lang['nc_tool']),
		),
		'left' =>array(
			0 => array(
				'nav' => 'dashboard',
				'text' => $lang['nc_normal_handle'],
				'list' => array(
					array('args'=>'welcome,dashboard,dashboard',			'text'=>$lang['nc_welcome_page']),
					array('args'=>'aboutus,dashboard,dashboard',			'text'=>$lang['nc_aboutus']),
					array('args'=>'base,setting,dashboard',	'text'=>$lang['nc_web_set']),
					array('args'=>'member,member,dashboard',				'text'=>$lang['nc_member_manage']),
					array('args'=>'store,store,dashboard',					'text'=>$lang['nc_store_manage']),
					array('args'=>'goods,goods,dashboard',					'text'=>$lang['nc_goods_manage']),
					array('args'=>'order_manage,trade,dashboard',			'text'=>$lang['nc_order_manage']),
				)
			),
			1 => array(
				'nav' => 'setting',
				'text' => $lang['nc_config'],
				'list' => array(
					array('args'=>'base,setting,setting',			'text'=>$lang['nc_web_set']),
					array('args'=>'ucenter,account,setting',		'text'=>$lang['nc_web_account_syn']),
					array('args'=>'param,upload,setting',			'text'=>$lang['nc_upload_set']),
					array('args'=>'seo,setting,setting',			'text'=>$lang['nc_seo_set']),
					array('args'=>'email,message,setting',			'text'=>$lang['nc_message_set']),
					array('args'=>'system,payment,setting',			'text'=>$lang['nc_pay_method']),
					array('args'=>'admin,admin,setting',			'text'=>$lang['nc_limit_manage']),
					array('args'=>'index,express,setting',			'text'=>$lang['nc_admin_express_set'])
				)
			),
			2 => array(
				'nav' => 'goods',
				'text' => $lang['nc_goods'],
				'list' => array(
					array('args'=>'goods_class,goods_class,goods',			'text'=>$lang['nc_class_manage']),
					//array('args'=>'brand,brand,goods',					'text'=>$lang['nc_brand_manage']),
					array('args'=>'goods,goods,goods',						'text'=>$lang['nc_goods_manage']),
					array('args'=>'type,type,goods',						'text'=>$lang['nc_type_manage']),
					array('args'=>'spec,spec,goods',						'text'=>$lang['nc_spec_manage']),
					array('args'=>'list,goods_album,goods',					'text'=>$lang['nc_album_manage']),
				)
			),
			3 => array(
				'nav' => 'store',
				'text' => $lang['nc_store'],
				'list' => array(
					array('args'=>'store,store,store',						'text'=>$lang['nc_store_manage']),
					array('args'=>'store_grade,store_grade,store',			'text'=>$lang['nc_store_grade']),
					array('args'=>'store_class,store_class,store',			'text'=>$lang['nc_store_class']),
					array('args'=>'credit,store_credit,store',				'text'=>$lang['nc_store_credit']),
					array('args'=>'store_domain_setting,domain,store',		'text'=>$lang['nc_domain_manage']),
					array('args'=>'stracelist,sns_strace,store',			'text'=>$lang['nc_s_snstrace']),
				)
			),
			4 => array(
				'nav' => 'member',
				'text' => $lang['nc_member'],
				'list' => array(
					array('args'=>'member,member,member',					'text'=>$lang['nc_member_manage']),
					array('args'=>'notice,notice,member',					'text'=>$lang['nc_member_notice']),
					array('args'=>'addpoints,points,member',				'text'=>$lang['nc_member_pointsmanage']),
					array('args'=>'predeposit,predeposit,member',			'text'=>$lang['nc_member_predepositmanage']),
					array('args'=>'sharesetting,sns_sharesetting,member',	'text'=>$lang['nc_binding_manage']),
					array('args'=>'class_list,sns_malbum,member',			'text'=>$lang['nc_member_album_manage']),
					array('args'=>'tracelist,snstrace,member',				'text'=>$lang['nc_snstrace']),
					array('args'=>'member_tag,sns_member,member',			'text'=>$lang['nc_member_tag'])
				)
			),
			5 => array(
				'nav' => 'trade',
				'text' => $lang['nc_trade'],
				'list' => array(
					array('args'=>'order_manage,trade,trade',				'text'=>$lang['nc_order_manage']),
					array('args'=>'consulting,consulting,trade',			'text'=>$lang['nc_consult_manage']),
					array('args'=>'inform_list,inform,trade',				'text'=>$lang['nc_inform_config']),
					array('args'=>'evalgoods_list,evaluate,trade',			'text'=>$lang['nc_goods_evaluate']),
					array('args'=>'complain_new_list,complain,trade',		'text'=>$lang['nc_complain_config']),					
				)
			),
			6 => array(
				'nav' => 'website',
				'text' => $lang['nc_website'],
				'list' => array(
					array('args'=>'article_class,article_class,website',	'text'=>$lang['nc_article_class']),
					array('args'=>'article,article,website',				'text'=>$lang['nc_article_manage']),
					array('args'=>'document,document,website',				'text'=>$lang['nc_document']),
					array('args'=>'link,link,website',						'text'=>$lang['nc_partner']),
					array('args'=>'navigation,navigation,website',			'text'=>$lang['nc_navigation']),
					array('args'=>'ap_manage,adv,website',					'text'=>$lang['nc_adv_manage']),
					array('args'=>'web_config,web_config,website',			'text'=>$lang['nc_web_index']),
					array('args'=>'rec_list,rec_position,website',			'text'=>$lang['nc_admin_res_position']),
				)
			),
			7 => array(
				'nav' => 'operation',
				'text' => $lang['nc_operation'],
				'list' => array(
					array('args'=>'setting,operation,operation',			'text'=>$lang['nc_operation_set']),
					array('args'=>'groupbuy_template_list,groupbuy,operation',	'text'=>$lang['nc_groupbuy_manage']),
					
					array('args'=>'gold_buy,gold_buy,operation',				'text'=>$lang['nc_gold_buy']),
					array('args'=>'ztc_setting,ztc_class,operation',			'text'=>$lang['nc_ztc_manage']),

					array('args'=>'activity,activity,operation',				'text'=>$lang['nc_activity_manage']),
					array('args'=>'xianshi_apply,promotion_xianshi,operation',				'text'=>$lang['nc_promotion_xianshi']),
					array('args'=>'bundling_apply,promotion_bundling,operation',			'text'=>$lang['nc_promotion_bundling']),
					array('args'=>'mansong_apply,promotion_mansong,operation',				'text'=>$lang['nc_promotion_mansong']),
					array('args'=>'pointprod,pointprod,operation',				'text'=>$lang['nc_pointprod']),
					array('args'=>'voucher_apply,voucher,operation','text'=>$lang['nc_voucher_price_manage']),
					array('args'=>'coupon,coupon,operation',					'text'=>$lang['nc_coupon_manage']),
				)
			),
			8 => array(
				'nav' => 'tool',
				'text' => $lang['nc_tool'],
				'list' => array(
					array('args'=>'clear,cache,tool',					'text'=>$lang['nc_admin_clear_cache']),
					array('args'=>'liststat,updatestat,tool',			'text'=>$lang['nc_updatestat']),
					array('args'=>'db,db,tool',							'text'=>$lang['nc_db']),
					array('args'=>'perform,perform,tool',				'text'=>$lang['nc_admin_perform_opt']),
					array('args'=>'search,search,tool',					'text'=>$lang['nc_admin_search_set']),
					array('args'=>'list,admin_log,tool',				'text'=>$lang['nc_admin_log']),
				)
			),
		)
);
/*if(C('mobile_isuse') == null){
	$arr['top'][] = array(
				'args'	=> 'mobile',
				'text'	=> $lang['nc_mobile']);
	$arr['left'][] = array(
				'nav' => 'mobile',
				'text' => $lang['nc_mobile'],
				'list' => array(
					array('args'=>'mb_ad_list,mb_ad,mobile',				'text'=>$lang['nc_mobile_adset']),
					array('args'=>'mb_category_list,mb_category,mobile',	'text'=>$lang['nc_mobile_catepic']),
					array('args'=>'flist,feedback,mobile',					'text'=>$lang['nc_mobile_feedback']),
					array('args'=>'mb_cache,mb_cache,mobile',				'text'=>$lang['nc_mobile_update_cache'])
				)
			);
}*/
if(C('flea_isuse')==1){
	$arr['top'][] = array(
				'args'	=> 'flea',
				'text'	=> $lang['nc_flea']);
	$arr['left'][] = array(
				'nav' => 'flea',
				'text' => $lang['nc_flea'],
				'list' => array(
					0 => array('args'=>'flea_index,flea_index,flea',			'text'=>$lang['nc_flea_seo_manage']),
					1 => array('args'=>'flea_class,flea_class,flea',			'text'=>$lang['nc_flea_class_manage']),
					2 => array('args'=>'flea_class_index,flea_class_index,flea','text'=>$lang['nc_flea_index_class_manage']),
					3 => array('args'=>'flea,flea,flea',						'text'=>$lang['nc_flea_manage']),
					4 => array('args'=>'flea_region,flea_region,flea',			'text'=>$lang['nc_flea_area_manage']),
				)
			);
}
if(C('microshop_isuse') !== null){
	$arr['top'][] = array(
				'args'	=> 'microshop',
				'text'	=> $lang['nc_microshop']);
	$arr['left'][] = array(
				'nav' => 'microshop',
				'text' => $lang['nc_microshop'],
				'list' => array(
					0 => array('args'=>'manage,microshop,microshop','text'=>$lang['nc_microshop_manage']),
					1 => array('args'=>'goods_manage,microshop,microshop','text'=>$lang['nc_microshop_goods_manage']),
					2 => array('args'=>'goodsclass_list,microshop,microshop','text'=>$lang['nc_microshop_goods_class']),
					3 => array('args'=>'personal_manage,microshop,microshop','text'=>$lang['nc_microshop_personal_manage']),
					4 => array('args'=>'personalclass_list,microshop,microshop','text'=>$lang['nc_microshop_personal_class']),
					5 => array('args'=>'store_manage,microshop,microshop','text'=>$lang['nc_microshop_store_manage']),
					6 => array('args'=>'comment_manage,microshop,microshop','text'=>$lang['nc_microshop_comment_manage']),
					7 => array('args'=>'adv_manage,microshop,microshop','text'=>$lang['nc_microshop_adv_manage']),
				)
			);
}
if(C('cms_isuse') !== null){
	$arr['top'][] = array(
				'args'	=> 'cms',
				'text'	=> $lang['nc_cms']);
	$arr['left'][] = array(
				'nav' => 'cms',
				'text' => $lang['nc_cms'],
				'list' => array(
					0 => array('args'=>'cms_manage,cms_manage,cms','text'=>$lang['nc_cms_manage']),
                    1 => array('args'=>'cms_index,cms_index,cms','text'=>$lang['nc_cms_index_manage']),
                    2 => array('args'=>'cms_article_list,cms_article,cms','text'=>$lang['nc_cms_article_manage']),
                    3 => array('args'=>'cms_article_class_list,cms_article_class,cms','text'=>$lang['nc_cms_article_class']),
                    4 => array('args'=>'cms_picture_list,cms_picture,cms','text'=>$lang['nc_cms_picture_manage']),
                    5 => array('args'=>'cms_picture_class_list,cms_picture_class,cms','text'=>$lang['nc_cms_picture_class']),
                    6 => array('args'=>'cms_special_list,cms_special,cms','text'=>$lang['nc_cms_special_manage']),
                    7 => array('args'=>'cms_navigation_list,cms_navigation,cms','text'=>$lang['nc_cms_navigation_manage']),
                    8 => array('args'=>'cms_tag_list,cms_tag,cms','text'=>$lang['nc_cms_tag_manage']),
                    9 => array('args'=>'comment_manage,cms_comment,cms','text'=>$lang['nc_cms_comment_manage']),
				)
			);
}
	
 if(C('circle_isuse') !== null){
	$arr['top'][] = array(
			'args'	=> 'circle',
			'text'	=> $lang['nc_circle']);
	$arr['left'][] = array(
			'nav'	=> 'circle',
			'text'	=> $lang['nc_circle'],
			'list'	=> array(
					0 => array('args'=>'index,circle_setting,circle','text'=>$lang['nc_circle_setting']),
					1 => array('args'=>'class_list,circle_class,circle','text'=>$lang['nc_circle_classmanage']),
					2 => array('args'=>'circle_list,circle_manage,circle','text'=>$lang['nc_circle_manage']),
					3 => array('args'=>'theme_list,circle_theme,circle','text'=>$lang['nc_circle_thememanage']),
					4 => array('args'=>'member_list,circle_member,circle','text'=>$lang['nc_circle_membermanage']),
					5 => array('args'=>'adv_manage,circle_setting,circle','text'=>$lang['nc_circle_advmanage'])
			)
	);
 }
return $arr;
?>