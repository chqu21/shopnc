/**
 *  ClassName: MyDetails.java
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
public class StoreDetails {
	public static class Attr {
		public static final String STORE_ID = "store_id";
		public static final String STORE_NAME = "store_name";
		public static final String PERSON_CONSUME = "person_consume";
		public static final String TELEPHONE = "telephone";
		public static final String ADDRESS = "address";
		public static final String LOGO = "logo";
		public static final String SIDE = "side";
		public static final String BUS = "bus";
		public static final String SUBWAY = "subway";
		public static final String COMMENT = "comment";
		public static final String BUSINESS_HOUR = "business_hour";
	}

	private String store_id;
	private String store_name;
	private String person_consume;
	private String telephone;
	private String address;
	private String logo;
	private String side;
	private String bus;
	private String subway;
	private String comment;
	private String business_hour;

	public StoreDetails() {
	}


	public static StoreDetails newInstance(String json) {
		StoreDetails cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if (obj.length() > 0) {
				cld = new StoreDetails();
				cld.setAddress(obj.optString(Attr.ADDRESS));
				cld.setBus(obj.optString(Attr.BUS));
				cld.setBusiness_hour(obj.optString(Attr.BUSINESS_HOUR));
				cld.setComment(obj.optString(Attr.COMMENT));
				cld.setLogo(obj.optString(Attr.LOGO));
				cld.setPerson_consume(obj.optString(Attr.PERSON_CONSUME));
				cld.setSide(obj.optString(Attr.SIDE));
				cld.setStore_id(obj.optString(Attr.STORE_ID));
				cld.setStore_name(obj.optString(Attr.STORE_NAME));
				cld.setSubway(obj.optString(Attr.SUBWAY));
				cld.setTelephone(obj.optString(Attr.TELEPHONE));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
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


	public String getTelephone() {
		return telephone;
	}


	public void setTelephone(String telephone) {
		this.telephone = telephone;
	}


	public String getAddress() {
		return address;
	}


	public void setAddress(String address) {
		this.address = address;
	}


	public String getLogo() {
		return logo;
	}


	public void setLogo(String logo) {
		this.logo = logo;
	}


	public String getSide() {
		return side;
	}


	public void setSide(String side) {
		this.side = side;
	}


	public String getBus() {
		return bus;
	}


	public void setBus(String bus) {
		this.bus = bus;
	}


	public String getSubway() {
		return subway;
	}


	public void setSubway(String subway) {
		this.subway = subway;
	}


	public String getComment() {
		return comment;
	}


	public void setComment(String comment) {
		this.comment = comment;
	}


	public String getBusiness_hour() {
		return business_hour;
	}


	public void setBusiness_hour(String business_hour) {
		this.business_hour = business_hour;
	}


	@Override
	public String toString() {
		return "StoreDetails [store_id=" + store_id + ", store_name="
				+ store_name + ", person_consume=" + person_consume
				+ ", telephone=" + telephone + ", address=" + address
				+ ", logo=" + logo + ", side=" + side + ", bus=" + bus
				+ ", subway=" + subway + ", comment=" + comment
				+ ", business_hour=" + business_hour + "]";
	}

}
