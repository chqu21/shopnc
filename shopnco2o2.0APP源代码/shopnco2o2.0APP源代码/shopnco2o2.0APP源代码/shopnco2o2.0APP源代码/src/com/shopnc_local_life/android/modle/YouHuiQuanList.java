/**
 * ClassName:City.java
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
 * Author:hjgang Create On 2013-9-16 下午3:56:26 Site:http://weibo.com/hjgang or
 * http://t.qq.com/hjgang_ EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-9-16 hjgang All rights reserved.
 */
public class YouHuiQuanList {
	public static class Attr {
		public static final String COUPON_ID = "coupon_id";
		public static final String COUPON_NAME = "coupon_name";
		public static final String COUPON_PIC = "coupon_pic";
		public static final String COUPON_START_TIME = "coupon_start_time";
		public static final String COUPON_END_TIME = "coupon_end_time";
		public static final String DOWNLOAD_COUNT = "download_count";
	}

	private long coupon_id;
	private String coupon_name;
	private String coupon_pic;
	private String coupon_start_time;
	private String coupon_end_time;
	private String download_count;

	public YouHuiQuanList() {
	}

	public YouHuiQuanList(long coupon_id, String coupon_name,
			String coupon_pic, String coupon_start_time, String coupon_end_time,String download_count) {
		super();
		this.coupon_id = coupon_id;
		this.coupon_name = coupon_name;
		this.coupon_pic = coupon_pic;
		this.coupon_start_time = coupon_start_time;
		this.coupon_end_time = coupon_end_time;
		this.download_count=download_count;
	}

	public static ArrayList<YouHuiQuanList> newInstanceList(String json) {
		ArrayList<YouHuiQuanList> c_list = new ArrayList<YouHuiQuanList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for (int i = 0; i < size; i++) {
				JSONObject obj = arr.getJSONObject(i);
				long coupon_id = obj.optLong(Attr.COUPON_ID);
				String coupon_name = obj.optString(Attr.COUPON_NAME);
				String coupon_pic = obj.optString(Attr.COUPON_PIC);
				String coupon_start_time = obj.optString(Attr.COUPON_START_TIME);
				String coupon_end_time = obj.optString(Attr.COUPON_END_TIME);
				String download_count = obj.optString(Attr.DOWNLOAD_COUNT);

				c_list.add(new YouHuiQuanList(coupon_id, coupon_name,
						coupon_pic, coupon_start_time, coupon_end_time,download_count));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
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

	public String getDownload_count() {
		return download_count;
	}

	public void setDownload_count(String download_count) {
		this.download_count = download_count;
	}

	@Override
	public String toString() {
		return "YouHuiQuanList [coupon_id=" + coupon_id + ", coupon_name="
				+ coupon_name + ", coupon_pic=" + coupon_pic
				+ ", coupon_start_time=" + coupon_start_time
				+ ", coupon_end_time=" + coupon_end_time + ", download_count="
				+ download_count + "]";
	}

}
