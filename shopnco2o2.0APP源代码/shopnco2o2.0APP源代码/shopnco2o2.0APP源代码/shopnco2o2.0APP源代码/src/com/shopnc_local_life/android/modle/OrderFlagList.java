/**
 * ClassName:OrderFlagList.java
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
public class OrderFlagList {
	public static class Attr{
		public static final String ORDER_SN = "order_sn";
		public static final String ITEM_NAME = "item_name";
		public static final String PRICE = "price";
		public static final String STATE = "state";
		public static final String GROUP_PIC = "group_pic";
	}
	private String order_sn;
	private String item_name;
	private String price;
	private String state;
	private String group_pic;

	public OrderFlagList() {
	}
	

	public OrderFlagList(String order_sn, String item_name, String price,
			String state, String group_pic) {
		super();
		this.order_sn = order_sn;
		this.item_name = item_name;
		this.price = price;
		this.state = state;
		this.group_pic = group_pic;
	}


	public static ArrayList<OrderFlagList> newInstanceList(String json){
		ArrayList<OrderFlagList> c_list = new ArrayList<OrderFlagList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				String order_sn = obj.optString(Attr.ORDER_SN);
				String item_name = obj.optString(Attr.ITEM_NAME);
				String price = obj.optString(Attr.PRICE);
				String state = obj.optString(Attr.STATE);
				String group_pic = obj.optString(Attr.GROUP_PIC);
				
				c_list.add(new OrderFlagList(order_sn, item_name, price, state, group_pic));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}
	public String getOrder_sn() {
		return order_sn;
	}
	public void setOrder_sn(String order_sn) {
		this.order_sn = order_sn;
	}
	public String getItem_name() {
		return item_name;
	}
	public void setItem_name(String item_name) {
		this.item_name = item_name;
	}
	public String getPrice() {
		return price;
	}
	public void setPrice(String price) {
		this.price = price;
	}
	public String getState() {
		return state;
	}
	public void setState(String state) {
		this.state = state;
	}
	public String getGroup_pic() {
		return group_pic;
	}
	public void setGroup_pic(String group_pic) {
		this.group_pic = group_pic;
	}
	@Override
	public String toString() {
		return "OrderFlagList [order_sn=" + order_sn + ", item_name="
				+ item_name + ", price=" + price + ", state=" + state
				+ ", group_pic=" + group_pic + "]";
	}
}
