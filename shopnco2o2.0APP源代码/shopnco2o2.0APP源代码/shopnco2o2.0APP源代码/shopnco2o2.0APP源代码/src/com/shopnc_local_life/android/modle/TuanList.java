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
public class TuanList {
	public static class Attr {
		public static final String GROUP_ID = "group_id";
		public static final String GROUP_NAME = "group_name";
		public static final String ORIGINAL_PEICE = "original_price";
		public static final String GROUP_PRICE = "group_price";
		public static final String BUYER_COUNT = "buyer_count";
		public static final String GROUP_PIC = "group_pic";
	}

	private long group_id;
	private String group_name;
	private String original_price;
	private String group_price;
	private String buyer_count;
	private String group_pic;

	public TuanList() {
	}

	public TuanList(long group_id, String group_name, String original_price,
			String group_price, String buyer_count, String group_pic) {
		super();
		this.group_id = group_id;
		this.group_name = group_name;
		this.original_price = original_price;
		this.group_price = group_price;
		this.buyer_count = buyer_count;
		this.group_pic = group_pic;
	}

	public static ArrayList<TuanList> newInstanceList(String json) {
		ArrayList<TuanList> c_list = new ArrayList<TuanList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for (int i = 0; i < size; i++) {
				JSONObject obj = arr.getJSONObject(i);
				long group_id = obj.optLong(Attr.GROUP_ID);
				String group_name = obj.optString(Attr.GROUP_NAME);
				String original_price = obj.optString(Attr.ORIGINAL_PEICE);
				String group_price = obj.optString(Attr.GROUP_PRICE);
				String buyer_count = obj.optString(Attr.BUYER_COUNT);
				String group_pic = obj.optString(Attr.GROUP_PIC);

				c_list.add(new TuanList(group_id, group_name, original_price, 
						group_price, buyer_count, group_pic));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}

	public long getGroup_id() {
		return group_id;
	}

	public void setGroup_id(long group_id) {
		this.group_id = group_id;
	}

	public String getGroup_name() {
		return group_name;
	}

	public void setGroup_name(String group_name) {
		this.group_name = group_name;
	}

	public String getOriginal_price() {
		return original_price;
	}

	public void setOriginal_price(String original_price) {
		this.original_price = original_price;
	}

	public String getGroup_price() {
		return group_price;
	}

	public void setGroup_price(String group_price) {
		this.group_price = group_price;
	}

	public String getBuyer_count() {
		return buyer_count;
	}

	public void setBuyer_count(String buyer_count) {
		this.buyer_count = buyer_count;
	}

	public String getGroup_pic() {
		return group_pic;
	}

	public void setGroup_pic(String group_pic) {
		this.group_pic = group_pic;
	}

	@Override
	public String toString() {
		return "TuanList [group_id=" + group_id + ", group_name=" + group_name
				+ ", original_price=" + original_price + ", group_price="
				+ group_price + ", buyer_count=" + buyer_count + ", group_pic="
				+ group_pic + "]";
	}

}
