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
public class CardListDetails {
	public static class Attr{
		public static final String STORE_ID = "store_id";
		public static final String STORE_NAME = "store_name";
		public static final String CARD_DISCOUNT = "card_discount";
		public static final String ADDRESS = "address";
		public static final String CARD_DES = "card_des";
		public static final String STATE = "state";
	}
	private long store_id;
	private String store_name;
	private String card_discount;
	private String address;
	private String card_des;
	private String state;
	
	public CardListDetails() {
	}

	public CardListDetails(long store_id, String store_name,
			String card_discount, String address, String card_des,String state) {
		super();
		this.store_id = store_id;
		this.store_name = store_name;
		this.card_discount = card_discount;
		this.address = address;
		this.card_des = card_des;
		this.state=state;
	}

	public static CardListDetails newInstance(String json){
		CardListDetails cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if(obj.length()> 0){
				cld = new CardListDetails();
				cld.setStore_id(obj.optLong(Attr.STORE_ID));
				cld.setStore_name(obj.optString(Attr.STORE_NAME));
				cld.setAddress(obj.optString(Attr.ADDRESS));
				cld.setCard_des(obj.optString(Attr.CARD_DES));
				cld.setCard_discount(obj.optString(Attr.CARD_DISCOUNT));
				cld.setState(obj.optString(Attr.STATE));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
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

	public String getCard_des() {
		return card_des;
	}

	public void setCard_des(String card_des) {
		this.card_des = card_des;
	}

	public String getState() {
		return state;
	}

	public void setState(String state) {
		this.state = state;
	}

	@Override
	public String toString() {
		return "CardListDetails [store_id=" + store_id + ", store_name="
				+ store_name + ", card_discount=" + card_discount
				+ ", address=" + address + ", card_des=" + card_des
				+ ", state=" + state + "]";
	}
}
