/**
 *  ClassName: Constants.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.common;

import android.os.Environment;

/**
 * @author hjgang
 * @category 全局变量
 * @日期 2013-1-24
 * @时间 下午2:05:25
 * @年份 2013
 */
public final class Constants {
	/** 系统初始化配置文件名 */
	public static final String SYSTEM_INIT_FILE_NAME = "shopnc_bendishenghuo_sysini";
	public static final String FLAG = "com.shopnc_local_life.android";
	/** 用于标识请求照相功能的activity结果码*/    
	public static final int RESULT_CODE_CAMERA = 1; 
	/** 用来标识请求相册gallery的activity结果码*/    
	public static final int RESULT_CODE_PHOTO_PICKED = 2; 
	public static final int RESULT_CODE_PHOTO_CUT=3;
	/** 图片类型 */
	public static final String IMAGE_UNSPECIFIED = "image/*";
	/** 本地缓存目录 */
	public static final String CACHE_DIR;
	/** 图片缓存目录 */
	public static final String CACHE_DIR_IMAGE;
	/** 待上传图片缓存目录 */
	public static final String CACHE_DIR_UPLOADING_IMG;
	/** 图片目录 */
	public static final String CACHE_IMAGE;
	/** 图片名称*/
	public static final String PHOTO_PATH="ShopNC_BenDiShengHuo";
	static {
		if (Environment.MEDIA_MOUNTED.equals(Environment.getExternalStorageState())) {
			CACHE_DIR = Environment.getExternalStorageDirectory().getAbsolutePath() + "/ShopNC_BenDiShengHuo/";
		} else {
			CACHE_DIR = Environment.getRootDirectory().getAbsolutePath() + "/ShopNC_BenDiShengHuo/";
		}
		
		CACHE_IMAGE= CACHE_DIR + "/image";
		CACHE_DIR_IMAGE = CACHE_DIR + "/pic";
		CACHE_DIR_UPLOADING_IMG = CACHE_DIR + "/uploading_img";
	}
	private Constants(){}
	/** 数据库版本号 */
	public static final int DB_VERSION = 2;
	/** 数据库名 */
	public static final String DB_NAME = "shopnc_bendishenghuo.db";
	
	/** 记录搜索内容 */
	public static final String SQL_SEARCH_CREATE = "CREATE TABLE search(s_id varchar(64) primary key, s_title varchar(255))";
	public static final String SQL_SEARCH_DROP = "delete from search";//DROP TABLE search
	public static final String SQL_SEARCH_SELECT_ALL = "SELECT distinct s_title FROM search";
	public static final String SQL_SEARCH_SELECT_BY = "SELECT * FROM search WHERE s_id=''{0}''";
	public static final String SQL_SEARCH_INSERT = "INSERT INTO search(s_title) VALUES(?)";
	public static final String SQL_SEARCH_DELETE_BY = "DELETE FROM search WHERE s_id=?";

	/** 加载情况分页参数 */
	public static final int PARAM_PAGENO = 1;
	public static final int PARAM_PAGESIZE = 10;
	/** 与服务器端连接的协议名 */
	public static final String PROTOCOL = "http://";
	/** 服务器IP */
	public static final String HOST = "www.shopnctest.com/o2o/demo";
	/** 服务器端口号 */
	public static final String PORT = "80";
	/** 应用上下文名 */
	public static final String APP = "/mobile/";//
	/** 应用上下文完整路径 */
	public static final String URL_CONTEXTPATH = PROTOCOL +HOST + APP + "28aeb56bf14c9a5f826f8ad65bc6d7f0.php";
	/**
	 * 获取城市信息
	 * “?commend=city”
     * @area_name 
     * @first_letter 
     * @hot_city 
	 * **/
	public static final String URL_GET_CITY=URL_CONTEXTPATH +"?commend=city";
	/**
	 * commend = groupbuy @命令类型 参数: city_id 城市ID pagenumber 页数 pagesize 长度
	 * **/
	public static final String URL_GROUPBUY_LIST=URL_CONTEXTPATH +"?commend=groupbuy";
	/**
	 * 输入参数[GET方式] commend = coupon @命令类型 参数: city_id 城市ID pagenumber 页数
	 * pagesize 长度
	 * **/
	public static final String URL_COUPON_LIST=URL_CONTEXTPATH +"?commend=coupon";
	/**
	 * 请求会员卡列表 输入参数[GET方式] commend = card @命令类型 参数: city_id 城市ID pagenumber 页数
	 * pagesize 长度
	 * **/
	public static final String URL_CARD_LIST=URL_CONTEXTPATH +"?commend=card";
	/**
	 * 会员卡详细页面 输入参数[GET方式] commend = cardinfo @命令类型 参数: store_id 商铺ID
	 * **/
	public static final String URL_CARD_DETALIS=URL_CONTEXTPATH +"?commend=cardinfo";
	/**
	 * 会员卡详细页面 输入参数[GET方式] commend = cardinfo @命令类型 参数: store_id 商铺ID
	 * **/
	public static final String URL_LOGIN=URL_CONTEXTPATH +"?commend=login";
	/**
	 * 会员卡详细页面 输入参数[GET方式] commend = cardinfo @命令类型 参数: store_id 商铺ID
	 * **/
	public static final String URL_MEMBERINFO=URL_CONTEXTPATH +"?commend=memberinfo";
	/**
	 * 编辑会员 输入参数[GET,POST方式] commend = updatemember get数据 member_id(会员member_id)
	 * sign(加密字符串) post数据 city_id(城市ID) nickname(昵称) gender(性别1.男 2.女)
	 * **/
	public static final String URL_UPDATEMEMBER=URL_CONTEXTPATH +"?commend=editinfo";
	/**
	 * 会员会员卡列表 输入参数[GET] commend = member_card get数据 member_id(会员member_id)
	 * sign(加密字符串)
	 * **/
	public static final String URL_MEMBER_CARD=URL_CONTEXTPATH +"?commend=member_card";
	/**
	 * 会员订单 输入参数[GET] commend = member_groupbuy get数据 member_id(会员member_id))
	 * sign(加密字符串) state(订单状态 1.未支付 2.已支付 3.已消费)
	 * 
	 * **/
	public static final String URL_MEMBER_ORDER = URL_CONTEXTPATH+ "?commend=member_groupbuy";
	/**
	 * 会员优惠券下载 输入参数[GET] commend = member_coupon get数据 member_id(会员member_id))
	 * sign(加密字符串)
	 * **/
	public static final String URL_MEMBER_COUPON = URL_CONTEXTPATH+ "?commend=member_coupon";
	/**
	 * 输入参数[GET] commend = searchstore get数据 keyword(关键字)
	 * **/
	public static final String URL_SEARCHSTORE = URL_CONTEXTPATH+ "?commend=searchstore";
	/**
	 * 输入参数[GET] commend = store get数据 store_id(店铺ID)
	 * **/
	public static final String URL_STORE_DETAILS = URL_CONTEXTPATH+ "?commend=store";
	/**
	 * 输入参数[GET] commend = store get数据 store_id(店铺ID)
	 * **/
	public static final String URL_STORE_ALL_COMMENT = URL_CONTEXTPATH+ "?commend=allcomment";
	/**
	 * 输入参数[POST] commend = addcomment
	 * **/
	public static final String URL_ADD_COMMENT = URL_CONTEXTPATH+ "?commend=addcomment";
	/**
	 * 输入参数[GET] commend = category get数据 class_id @一级分类id
	 * **/
	public static final String URL_CATEGORY_LIST = URL_CONTEXTPATH+ "?commend=category";
	/**
	 * 输入参数[GET] commend = storeclass get数据 class_id @一级分类 city_id @城市ID
	 * pagenumber @页数 pagesize @长度
	 * **/
	public static final String URL_STORECLASS_LIST = URL_CONTEXTPATH+ "?commend=storeclass";
	/**
	 * 输入参数[GET] commend = groupbuydetail get数据 group_id @团购ID
	 * **/
	public static final String URL_GROUPBUGDETAILS = URL_CONTEXTPATH+ "?commend=groupbuydetail";
	/**
	 * 输入参数[GET] commend = groupbuydetail get数据 group_id @团购ID
	 * **/
	public static final String URL_COUPONDETAIL = URL_CONTEXTPATH+ "?commend=coupondetail";
	/**
	 * 优惠券下载 输入参数[GET] commend = coupondownload get数据 coupon_id @优惠券ID mobile @手机号
	 * code @相应状态(200) datas @true 发送成功 false发送失败
	 * **/
	public static final String URL_COUPONDOWNLOAD = URL_CONTEXTPATH+ "?commend=coupondownload";
	/**
	 * 输入参数[POST] commend = order post数据 group_id @团购ID quantity @数量
	 * **/
	public static final String URL_SEND_ORDER = URL_CONTEXTPATH+ "?commend=order";
	/**
	 * 支付接口 输入参数[POST] commend = payment
	 * **/
	public static final String URL_PAYMENT = URL_CONTEXTPATH+ "?commend=payment";
	/**
	 * 新手帮助 commend = article
	 * **/
	public static final String URL_HELP = URL_CONTEXTPATH+ "?commend=article";
	/**
	 * 加入我们 输入参数[GET] commend = join_member
	 * **/
	public static final String URL_JOIN_MEMBER = URL_CONTEXTPATH+ "?commend=join_member";
	/**
	 * 输入参数[GET] commend = repayment get数据 member_id @会员ID sign @加密字符串 order_sn @订单号
	 * **/
	public static final String URL_REPAYMENT = URL_CONTEXTPATH+ "?commend=repayment";
}
