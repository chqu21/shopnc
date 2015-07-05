<?php
defined('InShopNC') or exit('Access Invalid!');

/**
 * 站点设置
 */
$lang['web_set']			= '站点设置';
$lang['base_information']	= '基本设置';
$lang['web_name']			= '网站名称';
$lang['web_name_notice']	= '网站名称，将显示在前台顶部欢迎信息等位置';
$lang['icp_number']			= 'ICP证书号';
$lang['site_logo']			= '网站Logo';
$lang['member_center_logo'] = '会员中心logo';
$lang['seller_center_logo'] = '卖家中心logo';
$lang['flow_static_code']	= '第三方流量统计代码';
$lang['flow_static_code_notice']	= '前台页面底部可以显示第三方统计';
$lang['time_zone_set']		= '时区';
$lang['set_sys_use_time_zone'] = '设置系统使用的时区，中国为';
$lang['default_city']		= '默认城市';
$lang['site_state']			= '站点状态';
$lang['closed_reason']		= '关闭原因';
$lang['nc_admin_site_succ']		= '编辑站点信息成功';
$lang['nc_admin_site_fail']		= '编辑站点信息失败';
$lang['icp_number_notice']		= '前台页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入你的授权码，它将显示在前台页面底部，如果没有请留空';
$lang['nc_upload_fail']		= '上传失败';
$lang['nc_site_open_and_close']	= '开启关闭网站';

/**
 * SEO设置
 */
$lang['web_set']			= '站点设置';
$lang['nc_admin_item_is_not_exists']			= '该项目不存在';
$lang['nc_seo_set']			= 'SEO设置';
$lang['seo_set_index']		= '首页';
$lang['seo_set_coupon']		= '优惠券';
$lang['seo_set_groupbuy']	= '团购';
$lang['seo_set_card']		= '会员卡';
$lang['seo_set_prompt'] 	= '插入的变量必需包括花括号“{}”，当应用范围不支持该变量时，该变量将不会在前台显示(变量后边的分隔符也不会显示)，留空为系统默认设置，SEO自定义支持手写。以下是可用SEO变量: <br/><a href="javascript:void(0);" id="toggmore">显示/隐藏全部提示...</a>';
$lang['seo_set_tips1'] 	= '站点名称 {sitename}，（应用范围：全站）';
$lang['seo_set_tips2'] 	= '名称 {name}，（应用范围：团购名称、商品名称、品牌名称、优惠券名称、文章标题、分类名称）';
$lang['seo_set_tips3'] 	= '文章分类名称 {article_class}，（应用范围：文章分类页）';
$lang['seo_set_tips4'] 	= '店铺名称 {shopname}，（应用范围：店铺页）';
$lang['seo_set_tips5'] 	= '关键词 {key}，（应用范围：商品关键词、文章关键词、店铺关键词）';
$lang['seo_set_tips6'] 	= '简单描述 {description}，（应用范围：商品描述、文章摘要、店铺关键词）';
$lang['seo_set_tips7'] 	= '<a>提交保存后，需要到 设置 -> 清理缓存 清理SEO，新的SEO设置才会生效</a>';
$lang['seo_set_group_content'] 		= '团购内容';
$lang['seo_set_brand_list'] 		= '某一品牌商品列表';
$lang['seo_set_coupon_content'] 	= '优惠券内容';
$lang['seo_set_point_content'] 		= '积分中心商品内容';
$lang['seo_set_atricle_list'] 		= '文章分类列表';
$lang['seo_set_atricle_content'] 	= '文章内容';
$lang['seo_set_insert_tips'] 		= '可用的代码，点击插入';
$lang['nc_admin_seo_edit_succ'] 	= '编辑成功';
$lang['nc_admin_seo_edit_fail'] 	= '编辑失败';
$lang['seo_set_write_information']  = '请填写title、keyword、description信息';
/**
 * 短信设置
 */

/**
 * Email设置
 */
$lang['email_type_open']		 = '邮件功能开启';

$lang['smtp_server']             = 'SMTP 服务器';
$lang['set_smtp_server_address'] = '设置 SMTP 服务器的地址，如 smtp.163.com';
$lang['smtp_port']               = 'SMTP 端口';
$lang['set_smtp_port']           = '设置 SMTP 服务器的端口，默认为 25';
$lang['sender_mail_address']     = '发信人邮件地址';
$lang['if_smtp_authentication']  = '使用SMTP协议发送的邮件地址，如 shopnc@163.com';
$lang['smtp_user_name']          = 'SMTP 身份验证用户名';
$lang['smtp_user_name_tip']      = '如 shopnc';
$lang['smtp_user_pwd']           = 'SMTP 身份验证密码';
$lang['smtp_user_pwd_tip']       = 'shopnc@163.com邮件的密码，如 123456';
$lang['test_mail_address']       = '测试接收的邮件地址';
$lang['test']                    = '测试';
$lang['nc_admin_save_succ']		 = '保存成功';
$lang['nc_admin_save_fail']		 = '保存失败';
$lang['test_email']           = '测试邮件';
$lang['this_is_to']           = '这是一封来自';
$lang['test_email_set_ok']    = '的测试邮件，证明您所邮件设置正常';
$lang['test_email_send_fail'] = '测试邮件发送失败，请重新配置邮件服务器';
$lang['test_email_send_ok']   = '测试邮件发送成功';
/**
 * 管理员管理
 */
$lang['nc_email_set']			=	'Email设置';
$lang['nc_admin_admin_manage']	=	'管理员管理';
$lang['nc_admin_admin_name']	=	'账号';
$lang['nc_admin_admin_password']=	'密码';
$lang['nc_admin_admin_confirm_password']=	'确认密码';
$lang['nc_admin_login_time']	=	'登录时间';
$lang['nc_admin_login_num']		=	'登录次数';
$lang['nc_admin_admin_name_tip']		=	'首先输入您要添加的管理员用户名';
$lang['nc_admin_admin_password_tip']	=	'首先输入您要添加的管理员密码';
$lang['nc_admin_admin_password_is_not_null']	=	'密码不能为空';
$lang['nc_admin_password_confirm_is_not_null']		= '确认密码不能为空';
$lang['nc_admin_password_confirm']		= '密码不一致';
$lang['nc_admin_admin_name_is_not_null']		=	'账号不能为空';
$lang['nc_admin_admin_name_range']		=	'用户名长度为3-20';
$lang['nc_admin_admin_name_is_exist']		=	'该管理员名称已存在';

$lang['nc_admin_admin_password_range']		=	'密码长度为6-20';
$lang['nc_admin_add_account_succ']	=	'添加账号成功';
$lang['nc_admin_add_account_fail']	=	'添加账号失败';
$lang['nc_admin_edit_account_succ']	=	'编辑成功';
$lang['nc_admin_edit_account_fail']	=	'编辑失败';
$lang['nc_admin_del_account_succ']	=	'删除成功';
$lang['nc_admin_del_account_fail']	=	'删除失败';
$lang['nc_admin_del_selected']		=	'请选择相关信息';
$lang['nc_admin_confirm_delete']	=	'确认删除?';

/**
 * 支付管理
 */
$lang['nc_admin_payment_manage']	= '支付管理';
$lang['nc_admin_payment_name']		= '支付方式名称';
$lang['nc_admin_payment_use']		= '启用';
$lang['nc_admin_payment_alipay_account']	= '支付宝支付账号';
$lang['nc_admin_payment_alipay_key']	= '交易安全校验码（key）';
$lang['nc_admin_payment_alipay_partner']= '合作者身份（partner ID）';


/*
 * 登陆方式
 */
$lang['nc_admin_setting_login']			= '登陆设置';
$lang['nc_admin_setting_qq']			= 'QQ互联';
$lang['nc_admin_setting_qq_isuse']		= '是否启用QQ互联功能';
$lang['nc_admin_setting_weibo_isuse']	= '新浪微博登录功能';
$lang['site_state_notice']				= '开启后可使用QQ账号登录商城系统';
$lang['qq_appcode']						= '域名验证信息';
$lang['qq_appid']						= '应用标识';
$lang['qq_appkey']						= '应用密钥';
$lang['nc_admin_setting_sina']			= '新浪微博';
$lang['nc_admin_setting_renren']		= '人人登陆';
$lang['nc_admin_setting_qq_login']		= '保存设置';
$lang['nc_admin_setting_weibo_login']	= '保存设置';
$lang['nc_admin_setting_renren_login']	= '保存设置';
$lang['qq_apply_link']					= '立即在线申请';

/**
 * 关于我们
 */
$lang['dashboard_aboutus_idea']			= '我们的理念';
$lang['dashboard_aboutus_idea_content']	= '用户的成长会带动我们成长，我们的成长会促进用户成长。我们乐于与用户分享成长，同时，我们欢迎所有用户也可以与我们分享，无论是您对我们的肯定，对产品的意见建议，Bug反馈，还是对我们提出的批评。';
$lang['dashboard_aboutus_team']			= '我们的团队';
$lang['dashboard_aboutus_developer']	= '核心开发者';
$lang['dashboard_aboutus_developer_name']	= '王景辰&nbsp;&nbsp;&nbsp;&nbsp;李梓平';
$lang['dashboard_aboutus_designer']		= '设计师';
$lang['dashboard_aboutus_designer_name']	= '岳颖';
$lang['dashboard_aboutus_near_us']		= '走近我们';
$lang['dashboard_aboutus_bbs']			= '官方论坛';
$lang['dashboard_aboutus_bbs_tip']		= '您可以在此交流ShopNC的使用心得，获得帮助，扩展等，您也可以在此给我们献言献策，让ShopNC变得更好更加适合您';
$lang['dashboard_aboutus_website']		= '官方网站';
$lang['dashboard_aboutus_website_tip']	= '您可以在此获知ShopNC的最新动态，获得个性化的服务或获取我们的联系方式';
$lang['dashboard_aboutus_thanks']		= '贡献者';
$lang['dashboard_aboutus_thanks_content']	= '非常感谢我们的贡献者';
$lang['dashboard_aboutus_thanks_developer_name'] = '王德斌，周斌';
$lang['dashboard_aboutus_notice']		= '相关声明';
$lang['dashboard_aboutus_notice1']		= '天津市网城创想科技有限责任公司';
$lang['dashboard_aboutus_notice2']		= '拥有';
$lang['dashboard_aboutus_notice3']		= '的所有版权';
$lang['dashboard_aboutus_notice4']		= '本项目引用了以下开源项目';
$lang['dashboard_aboutus_notice5']		= '等';
$lang['dashboard_aboutus_notice6']		= '原作者拥有其所有版权';
?>
