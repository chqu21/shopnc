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
public class OrderDetalis {
	public static class Attr{
		public static final String GROUP_NAME = "group_name";
		public static final String NUMBER = "number";
		public static final String PRICE = "price";
		public static final String ORDER_SN = "order_sn";
		public static final String PREDEPOSIT = "predeposit";
	}
	private String group_name;
	private String number;
	private String price;
	private String order_sn;
	private String predeposit;
	
	public OrderDetalis() {
	}

	public static OrderDetalis newInstance(String json){
		OrderDetalis cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if(obj.length()> 0){
				cld = new OrderDetalis();
				cld.setGroup_name(obj.optString(Attr.GROUP_NAME));
				cld.setNumber(obj.optString(Attr.NUMBER));
				cld.setPrice(obj.optString(Attr.PRICE));
				cld.setOrder_sn(obj.optString(Attr.ORDER_SN));
				cld.setPredeposit(obj.optString(Attr.PREDEPOSIT));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
	}

	public String getGroup_name() {
		return group_name;
	}

	public void setGroup_name(String group_name) {
		this.group_name = group_name;
	}

	public String getNumber() {
		return number;
	}

	public void setNumber(String number) {
		this.number = number;
	}

	public String getPrice() {
		return price;
	}

	public void setPrice(String price) {
		this.price = price;
	}

	public String getOrder_sn() {
		return order_sn;
	}

	public void setOrder_sn(String order_sn) {
		this.order_sn = order_sn;
	}

	public String getPredeposit() {
		return predeposit;
	}

	public void setPredeposit(String predeposit) {
		this.predeposit = predeposit;
	}

	@Override
	public String toString() {
		return "OrderDetalis [group_name=" + group_name + ", number=" + number
				+ ", price=" + price + ", order_sn=" + order_sn
				+ ", predeposit=" + predeposit + "]";
	}
	
}
