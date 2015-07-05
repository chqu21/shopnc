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
 *  Author:hjgang
 *  Create On 2013-9-16 下午3:56:26
 *  Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 *  EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 *  Copyrights 2013-9-16 hjgang All rights reserved.
 */
public class CardList {
	public static class Attr{
		public static final String STORE_ID = "store_id";
		public static final String STORE_NAME = "store_name";
		public static final String CARD_DISCOUNT = "card_discount";
		public static final String ADDRESS = "address";
		public static final String IS_STORE = "is_store";
	}
	private long store_id;
	private String store_name;
	private String card_discount;
	private String address;
	private String is_store;

	public CardList() {
	}

	public CardList(long store_id, String store_name, String card_discount,
			String address, String is_store) {
		super();
		this.store_id = store_id;
		this.store_name = store_name;
		this.card_discount = card_discount;
		this.address = address;
		this.is_store = is_store;
	}


	public static ArrayList<CardList> newInstanceList(String json){
		ArrayList<CardList> c_list = new ArrayList<CardList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				Long store_id = obj.optLong(Attr.STORE_ID);
				String store_name = obj.optString(Attr.STORE_NAME);
				String card_discount = obj.optString(Attr.CARD_DISCOUNT);
				String address = obj.optString(Attr.ADDRESS);
				String is_store = obj.optString(Attr.IS_STORE);
				
				c_list.add(new CardList(store_id, store_name, card_discount, address, is_store));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}

	public long getStore_id() {
		return store_id;
	}

	public void setStore_id(long store_id) {
		this.store_id = store_id;
	}

	public String getStore_name() {
		return store_name;
	}

	public void setStore_name(String store_name) {
		this.store_name = store_name;
	}

	public String getCard_discount() {
		return card_discount;
	}

	public void setCard_discount(String card_discount) {
		this.card_discount = card_discount;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getIs_store() {
		return is_store;
	}

	public void setIs_store(String is_store) {
		this.is_store = is_store;
	}

	@Override
	public String toString() {
		return "CardList [store_id=" + store_id + ", store_name=" + store_name
				+ ", card_discount=" + card_discount + ", address=" + address
				+ ", is_store=" + is_store + "]";
	}


}
