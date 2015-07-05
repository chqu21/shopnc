/**
 * ClassName:CardList.java
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
public class MyCardList {
	public static class Attr {
		public static final String STORE_NAME = "store_name";
		public static final String CARD_NUMBER = "card_number";
	}

	private String store_name;
	private String card_number;

	public MyCardList() {
	}

	public MyCardList(String store_name, String card_number) {
		super();
		this.store_name = store_name;
		this.card_number = card_number;
	}

	public static ArrayList<MyCardList> newInstanceList(String json) {
		ArrayList<MyCardList> c_list = new ArrayList<MyCardList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for (int i = 0; i < size; i++) {
				JSONObject obj = arr.getJSONObject(i);
				String store_name = obj.optString(Attr.STORE_NAME);
				String card_number = obj.optString(Attr.CARD_NUMBER);

				c_list.add(new MyCardList(store_name, card_number));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}

	public String getStore_name() {
		return store_name;
	}

	public void setStore_name(String store_name) {
		this.store_name = store_name;
	}

	public String getCard_number() {
		return card_number;
	}

	public void setCard_number(String card_number) {
		this.card_number = card_number;
	}

	@Override
	public String toString() {
		return "MyCardList [store_name=" + store_name + ", card_number="
				+ card_number + "]";
	}

}
