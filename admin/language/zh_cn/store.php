<?php
defined('InShopNC') or exit('Access Invalid!');

/**
 * 商户管理
 */
$lang['nc_admin_store_manage']			= '商户管理';
$lang['nc_admin_store_store_name']		= '商铺名称';
$lang['nc_admin_store_alisa']			= '别名';
$lang['nc_admin_store_category']		= '分类';
$lang['nc_admin_store_pic']				= '商铺图片';
$lang['nc_admin_store_side']			= '靠近';
$lang['nc_admin_store_click']			= '点击数';
$lang['nc_admin_store_commend_count']	= '评论数';
$lang['nc_admin_store_telephone']		= '联系电话';
$lang['nc_admin_store_person_consume']	= '人均消费';
$lang['nc_admin_store_state']			= '状态';
$lang['nc_admin_store_start']			= '开启';
$lang['nc_admin_store_address']			= '地址';
$lang['nc_admin_store_bus']				= '公交线路';
$lang['nc_admin_store_subway']			= '地铁线路';
$lang['nc_admin_store_map']				= '地图';
$lang['nc_admin_store_description']		= '商铺描述';
$lang['nc_admin_store_manage']			= '商铺管理';
$lang['nc_admin_store_view']			= '查看';
$lang['nc_admin_store_close']			= '关闭';
$lang['nc_admin_store_close_reason']	= '关闭原因';
$lang['nc_admin_store_business_hour']	= '营业时间';
$lang['nc_admin_store_bus']				= '公交线路';
$lang['nc_apply_store']					= '申请开店';
$lang['nc_close_store']					= '关闭商铺';
$lang['nc_admin_store_is_not_exists']	= '该商铺不存在';
$lang['nc_admin_store_op_succ']			= '操作成功';
$lang['nc_admin_store_op_fail']			= '操作失败';
$lang['nc_admin_store_create_apply']	= '开店申请';
$lang['nc_admin_store_close_reason']	= '关闭原因';
$lang['nc_admin_create_shop']			= '创建商铺账号';
$lang['nc_admin_store_account']			= '账号';
$lang['nc_admin_store_password']		= '密码';
$lang['nc_store_account_is_not_null']	= '账号不能为空';
$lang['nc_store_password_is_not_null']	= '密码不能为空';
$lang['nc_store_account_is_exists']		= '该账号已经存在';
$lang['nc_store_create_store_succ']		= '创建商铺成功';
$lang['nc_store_create_store_fail']		= '创建商铺失败';
$lang['nc_store_manage_help1']			= '显示商户列表，可以进行浏览、删除等操作';
$lang['nc_store_close_succ']			= '操作成功';
$lang['nc_store_close_fail']			= '操作失败';
$lang['nc_store_store_audit']			= '审核';
$lang['nc_store_store_audit_wait']		= '待审核';
$lang['nc_store_store_audit_yes']		= '审核通过';
$lang['nc_store_store_audit_no']		= '审核未通过';
$lang['nc_store_store_audit_succ']		= '审核成功';
$lang['nc_store_store_audit_fail']		= '审核失败';

/**
 * 商户分类
 */
$lang['nc_admin_store_class']		= '商户分类';
$lang['nc_admin_store_class_help1']	= '通过修改排序数字可以控制前台线下商城分类的显示顺序，数字越小越靠前';
$lang['nc_admin_store_class_help2']	= '可以设置分类是否被推荐到首页的热门分类区进行展示（最多显示6个一级分类组）';
$lang['nc_admin_store_class_help3']	= '点击行首的"+"号，可以展开下级分类';
$lang['nc_sort']					= '排序';
$lang['nc_store_class_name']		= '分类名称';
$lang['nc_store_parent_class']		= '上级分类';
$lang['nc_store_image']				= '分类图片';
$lang['nc_store_class_name_error']	= '分类名称错误';
$lang['nc_store_class_sort_error']	= '分类排序错误';
$lang['nc_store_class_add_succ']	= '分类添加成功';
$lang['nc_store_class_add_fail']	= '分类添加失败';
$lang['nc_store_class_edit_succ']	= '分类编辑成功';
$lang['nc_store_class_edit_fail']	= '分类编辑失败';
$lang['nc_store_class_detele_succ']	= '分类删除成功';
$lang['nc_store_class_detele_fail']	= '分类删除失败';
$lang['nc_store_class_name_is_not_null']	= '分类不能为空';
$lang['nc_store_class_name_length']	= '分类长度不能超过10个字符';
$lang['nc_store_class_sort_is_not_null']	= '排序不能为空';
$lang['nc_store_class_sort_range']	= '排序必须是数字，区间在0-255';
$lang['nc_store_add_new_class']		= '新增下级';


/**
 * 预约管理
 */
$lang['nc_admin_appoint_manage']		= '预约管理';
$lang['nc_admin_appoint_store_name']	= '商铺名称';
$lang['nc_admin_appoint_member_name']	= '会员';
$lang['nc_admin_appoint_time']			= '预约时间';
$lang['nc_admin_appoint_message']		= '预约信息';

/**
 * 评论管理
 */
$lang['nc_admin_comment_manage']		= '评论管理';
$lang['nc_admin_comment_store_name']	= '商铺名称';
$lang['nc_admin_comment_member_name']	= '会员名称';
$lang['nc_admin_comment_person_cost']	= '人均消费';
$lang['nc_admin_comment']				= '评论内容';
$lang['nc_admin_comment_parking']		= '停车情况';
$lang['nc_admin_comment_recommend']		= '推荐';
$lang['nc_admin_comment_type']			= '类型';
$lang['nc_admin_comment_amount_score']	= '评分';
$lang['nc_admin_comment_comment']	= '评论内容';
$lang['nc_admin_comment_delete_succ']	= '评论删除成功';
$lang['nc_admin_comment_delete_fail']	= '评论删除失败';
$lang['nc_admin_comment_help1']			= '评论管理可以对评论进行删除、推荐到首页、取消推荐等操作';
$lang['nc_admin_comment_help2']			= '列表显示商铺名称、会员名称、人均消费、停车情况、推荐、评论内容等信息';
$lang['nc_admin_comment_recommend_succ']= '操作成功';
$lang['nc_admin_comment_recommend_fail']= '操作失败';
$lang['nc_admin_comment_operation']		= '确认操作';
$lang['nc_admin_confirm_delete']	=	'确认删除?';
/**
 * 区域管理
 */
$lang['nc_admin_manage']				= '区域管理';
$lang['nc_admin_area_name']				= '区域名称';
$lang['nc_admin_first_letter']			= '首字母';
$lang['nc_admin_area_number']			= '区号';
$lang['nc_admin_add_time']				= '添加时间';
$lang['nc_admin_area_name_error']		= '区域名称不能为空';
$lang['nc_admin_first_letter']			= '首字母';
$lang['nc_admin_area_add_success']		= '区域添加成功';
$lang['nc_admin_area_add_fail']			= '区域添加失败';
$lang['nc_admin_area_edit_success']		= '区域编辑成功';
$lang['nc_admin_area_edit_fail']		= '区域编辑失败';
$lang['nc_admin_area_delete_success']	= '区域删除成功';
$lang['nc_admin_area_delete_fail']		= '区域删除失败';
$lang['nc_admin_first_area']			= '顶级区域';
$lang['nc_admin_up_area']				= '上级区域';
$lang['nc_admin_view_mall_street']		= '查看商区';
$lang['nc_admin_hot_city']				= '热门城市';
$lang['nc_admin_del_succ']				= '删除成功';
$lang['nc_admin_del_fail']				= '删除失败';
$lang['nc_admin_area_number']			= '区号';
$lang['nc_admin_post']					= '邮编';
$lang['nc_admin_area_number_is_error']  = '区域号必须是数字';
$lang['nc_admin_post_is_error']			= '邮编必须是数字';
$lang['nc_admin_area_help']				= '区域管理可以对城市编辑、删除、查看，可以新增下级，对城市进行查询';
$lang['nc_admin_area_help1']			= '列表显示区域名称、首字母、区号、邮编、热门城市、添加时间等信息';
$lang['nc_admin_view_area']				= '查看区域';
$lang['nc_admin_belong_to_city']		= '所属城市';
$lang['nc_admin_belong_to_area']		= '所属区域';
$lang['nc_admin_area_add_time']			= '添加时间';
$lang['nc_admin_add_area_name']			= '添加商区';
$lang['nc_admin_view_mall']				= '查看商区';
$lang['nc_admin_area_store_num']		= '商铺数';
$lang['nc_admin_area_is_hot']			= '是否热门推荐';

/*
 * 品牌管理
 */
$lang['nc_admin_brand_manage']			= '品牌管理';
$lang['nc_admin_brand_name']			= '品牌名称';
$lang['nc_admin_brand_des']				= '品牌描述';
$lang['nc_admin_brand_pic']				= '品牌图片';
$lang['nc_admin_brand_sort']			= '排序';
$lang['nc_admin_brand_add_succ']		= '添加品牌成功';
$lang['nc_admin_brand_add_fail']		= '添加品牌失败';
$lang['nc_admin_brand_edit_succ']		= '编辑品牌成功';
$lang['nc_admin_brand_edit_fail']		= '编辑品牌失败';
$lang['nc_admin_brand_del_succ']		= '删除品牌成功';
$lang['nc_admin_brand_del_fail']		= '删除品牌失败';


?>
