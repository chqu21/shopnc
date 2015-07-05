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
public class StoreList {
	public static class Attr{
		public static final String STORE_ID = "store_id";
		public static final String STORE_NAME = "store_name";
		public static final String PERSON_CONSUME = "person_consume";
		public static final String PIC = "pic";
		public static final String ADDRESS = "address";
	}
	private String store_id;
	private String store_name;
	private String person_consume;
	private String pic;
	private String address;

	public StoreList() {
	}
	

	public StoreList(String store_id, String store_name, String person_consume,
			String pic, String address) {
		super();
		this.store_id = store_id;
		this.store_name = store_name;
		this.person_consume = person_consume;
		this.pic = pic;
		this.address = address;
	}


	public static ArrayList<StoreList> newInstanceList(String json){
		ArrayList<StoreList> c_list = new ArrayList<StoreList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				String store_id = obj.optString(Attr.STORE_ID);
				String store_name = obj.optString(Attr.STORE_NAME);
				String person_consume = obj.optString(Attr.PERSON_CONSUME);
				String pic = obj.optString(Attr.PIC);
				String address = obj.optString(Attr.ADDRESS);
				
				c_list.add(new StoreList(store_id, store_name, person_consume, pic, address));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}


	public String getStore_id() {
		return store_id;
	}


	public void setStore_id(String store_id) {
		this.store_id = store_id;
	}


	public String getStore_name() {
		return store_name;
	}


	public void setStore_name(String store_name) {
		this.store_name = store_name;
	}


	public String getPerson_consume() {
		return person_consume;
	}


	public void setPerson_consume(String person_consume) {
		this.person_consume = person_consume;
	}


	public String getPic() {
		return pic;
	}


	public void setPic(String pic) {
		this.pic = pic;
	}


	public String getAddress() {
		return address;
	}


	public void setAddress(String address) {
		this.address = address;
	}


	@Override
	public String toString() {
		return "StoreList [store_id=" + store_id + ", store_name=" + store_name
				+ ", person_consume=" + person_consume + ", pic=" + pic
				+ ", address=" + address + "]";
	}

}
