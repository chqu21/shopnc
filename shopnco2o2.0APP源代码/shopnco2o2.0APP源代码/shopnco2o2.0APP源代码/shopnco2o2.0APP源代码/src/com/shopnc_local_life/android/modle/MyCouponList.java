/**
 * ClassName:MyCouponList.java
 * PackageName:android_shopnc_local_life
 * Create On 2013-9-16 下午3:56:26
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-9-16 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.modle;

import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *  Author:hjgang
 *  Create On 2013-9-16 下午3:56:26
 *  Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 *  EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 *  Copyrights 2013-9-16 hjgang All rights reserved.
 */
public class MyCouponList {
	public static class Attr{
		public static final String COUPON_NAME = "coupon_name";
		public static final String DOWNLOAD_TIME = "download_time";
		public static final String DOWNLOAD_TYPE = "download_type";
	}
	private String coupon_name;
	private String download_time;
	private String download_type;

	public MyCouponList() {
	}
	

	public MyCouponList(String coupon_name, String download_time,
			String download_type) {
		super();
		this.coupon_name = coupon_name;
		this.download_time = download_time;
		this.download_type = download_type;
	}


	public static ArrayList<MyCouponList> newInstanceList(String json){
		ArrayList<MyCouponList> c_list = new ArrayList<MyCouponList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				String coupon_name = obj.optString(Attr.COUPON_NAME);
				String download_time = obj.optString(Attr.DOWNLOAD_TIME);
				String download_type = obj.optString(Attr.DOWNLOAD_TYPE);
				
				c_list.add(new MyCouponList(coupon_name, download_time, download_type));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}


	public String getCoupon_name() {
		return coupon_name;
	}


	public void setCoupon_name(String coupon_name) {
		this.coupon_name = coupon_name;
	}


	public String getDownload_time() {
		return download_time;
	}


	public void setDownload_time(String download_time) {
		this.download_time = download_time;
	}


	public String getDownload_type() {
		return download_type;
	}


	public void setDownload_type(String download_type) {
		this.download_type = download_type;
	}


	@Override
	public String toString() {
		return "MyCouponList [coupon_name=" + coupon_name + ", download_time="
				+ download_time + ", download_type=" + download_type + "]";
	}

}
