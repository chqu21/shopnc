/**
 *  ClassName: CardListDetails.java
 *  created on 2013-2-16
 *  Copyrights 2013-2-16 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.modle;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * @author hjgang
 * @日期 2013-2-16
 * @时间 上午10:33:40
 * @年份 2013
 */
public class CouponDetails {
	public static class Attr{
		public static final String COUPON_ID = "coupon_id";
		public static final String COUPON_NAME = "coupon_name";
		public static final String COUPON_PIC = "coupon_pic";
		public static final String COUPON_START_TIME = "coupon_start_time";
		public static final String COUPON_END_TIME = "coupon_end_time";
		public static final String COUPON_DES = "coupon_des";
		public static final String STORE_NAME = "store_name";
		public static final String MESSAGE = "message";
		public static final String DOWNLOAD_COUNT = "download_count";
		public static final String VIEW_COUNT = "view_count";
		public static final String LIMIT = "limit";
		public static final String SHORT_MESSAGE = "short_message";
	}
	private long coupon_id;
	private String coupon_name;
	private String coupon_pic;
	private String coupon_start_time;
	private String coupon_end_time;
	private String coupon_des;
	private String store_name;
	private String message;
	private String download_count;
	private String view_count;
	private String short_message;
	
	public CouponDetails() {
	}

	public static CouponDetails newInstance(String json){
		CouponDetails cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if(obj.length()> 0){
				cld = new CouponDetails();
				cld.setCoupon_des(obj.optString(Attr.COUPON_DES));
				cld.setCoupon_end_time(obj.optString(Attr.COUPON_END_TIME));
				cld.setCoupon_id(obj.optLong(Attr.COUPON_ID));
				cld.setCoupon_name(obj.optString(Attr.COUPON_NAME));
				cld.setCoupon_pic(obj.optString(Attr.COUPON_PIC));
				cld.setCoupon_start_time(obj.optString(Attr.COUPON_START_TIME));
				cld.setDownload_count(obj.optString(Attr.DOWNLOAD_COUNT));
				cld.setMessage(obj.optString(Attr.MESSAGE));
				cld.setShort_message(obj.optString(Attr.SHORT_MESSAGE));
				cld.setStore_name(obj.optString(Attr.STORE_NAME));
				cld.setView_count(obj.optString(Attr.VIEW_COUNT));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
	}

	public long getCoupon_id() {
		return coupon_id;
	}

	public void setCoupon_id(long coupon_id) {
		this.coupon_id = coupon_id;
	}

	public String getCoupon_name() {
		return coupon_name;
	}

	public void setCoupon_name(String coupon_name) {
		this.coupon_name = coupon_name;
	}

	public String getCoupon_pic() {
		return coupon_pic;
	}

	public void setCoupon_pic(String coupon_pic) {
		this.coupon_pic = coupon_pic;
	}

	public String getCoupon_start_time() {
		return coupon_start_time;
	}

	public void setCoupon_start_time(String coupon_start_time) {
		this.coupon_start_time = coupon_start_time;
	}

	public String getCoupon_end_time() {
		return coupon_end_time;
	}

	public void setCoupon_end_time(String coupon_end_time) {
		this.coupon_end_time = coupon_end_time;
	}

	public String getCoupon_des() {
		return coupon_des;
	}

	public void setCoupon_des(String coupon_des) {
		this.coupon_des = coupon_des;
	}

	public String getStore_name() {
		return store_name;
	}

	public void setStore_name(String store_name) {
		this.store_name = store_name;
	}

	public String getMessage() {
		return message;
	}

	public void setMessage(String message) {
		this.message = message;
	}

	public String getDownload_count() {
		return download_count;
	}

	public void setDownload_count(String download_count) {
		this.download_count = download_count;
	}

	public String getView_count() {
		return view_count;
	}

	public void setView_count(String view_count) {
		this.view_count = view_count;
	}

	public String getShort_message() {
		return short_message;
	}

	public void setShort_message(String short_message) {
		this.short_message = short_message;
	}

	@Override
	public String toString() {
		return "CouponDetails [coupon_id=" + coupon_id + ", coupon_name="
				+ coupon_name + ", coupon_pic=" + coupon_pic
				+ ", coupon_start_time=" + coupon_start_time
				+ ", coupon_end_time=" + coupon_end_time + ", coupon_des="
				+ coupon_des + ", store_name=" + store_name + ", message="
				+ message + ", download_count=" + download_count
				+ ", view_count=" + view_count + ", short_message="
				+ short_message + "]";
	}
	
}
