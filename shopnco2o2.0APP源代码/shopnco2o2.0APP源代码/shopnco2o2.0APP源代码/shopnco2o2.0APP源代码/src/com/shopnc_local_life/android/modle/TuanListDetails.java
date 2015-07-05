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
public class TuanListDetails {
	public static class Attr{
		public static final String GROUP_ID = "group_id";
		public static final String GROUP_NAME = "group_name";
		public static final String GROUP_HELP = "group_help";
		public static final String STORE_ID = "store_id";
		public static final String STORE_NAME = "store_name";
		public static final String ORIGINAL_PRICE = "original_price";
		public static final String GROUP_PRICE = "group_price";
		public static final String BUYER_COUNT = "buyer_count";
		public static final String BUYER_LIMIT = "buyer_limit";
		public static final String BUYER_NUM = "buyer_num";
		public static final String GROUP_INTRO = "group_intro";
		public static final String GROUP_PIC = "group_pic";
	}
	private String group_id;
	private String group_name;
	private String group_help;
	private String store_id;
	private String store_name;
	private String original_price;
	private String group_price;
	private String buyer_count;
	private String buyer_limit;
	private String buyer_num;
	private String group_intro;
	private String group_pic;
	
	public TuanListDetails() {
	}

	public TuanListDetails(String group_id, String group_name,
			String group_help, String store_id, String store_name,
			String original_price, String group_price, String buyer_count,
			String buyer_limit, String buyer_num, String group_intro,
			String group_pic) {
		super();
		this.group_id = group_id;
		this.group_name = group_name;
		this.group_help = group_help;
		this.store_id = store_id;
		this.store_name = store_name;
		this.original_price = original_price;
		this.group_price = group_price;
		this.buyer_count = buyer_count;
		this.buyer_limit = buyer_limit;
		this.buyer_num = buyer_num;
		this.group_intro = group_intro;
		this.group_pic = group_pic;
	}

	public static TuanListDetails newInstance(String json){
		TuanListDetails cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if(obj.length()> 0){
				cld = new TuanListDetails();
				cld.setBuyer_count(obj.optString(Attr.BUYER_COUNT));
				cld.setBuyer_limit(obj.optString(Attr.BUYER_LIMIT));
				cld.setBuyer_num(obj.optString(Attr.BUYER_NUM));
				cld.setGroup_help(obj.optString(Attr.GROUP_HELP));
				cld.setGroup_id(obj.optString(Attr.GROUP_ID));
				cld.setGroup_intro(obj.optString(Attr.GROUP_INTRO));
				cld.setGroup_name(obj.optString(Attr.GROUP_NAME));
				cld.setGroup_pic(obj.optString(Attr.GROUP_PIC));
				cld.setGroup_price(obj.optString(Attr.GROUP_PRICE));
				cld.setOriginal_price(obj.optString(Attr.ORIGINAL_PRICE));
				cld.setStore_id(obj.optString(Attr.STORE_ID));
				cld.setStore_name(obj.optString(Attr.STORE_NAME));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
	}

	public String getGroup_id() {
		return group_id;
	}

	public void setGroup_id(String group_id) {
		this.group_id = group_id;
	}

	public String getGroup_name() {
		return group_name;
	}

	public void setGroup_name(String group_name) {
		this.group_name = group_name;
	}

	public String getGroup_help() {
		return group_help;
	}

	public void setGroup_help(String group_help) {
		this.group_help = group_help;
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

	public String getBuyer_limit() {
		return buyer_limit;
	}

	public void setBuyer_limit(String buyer_limit) {
		this.buyer_limit = buyer_limit;
	}

	public String getBuyer_num() {
		return buyer_num;
	}

	public void setBuyer_num(String buyer_num) {
		this.buyer_num = buyer_num;
	}

	public String getGroup_intro() {
		return group_intro;
	}

	public void setGroup_intro(String group_intro) {
		this.group_intro = group_intro;
	}

	public String getGroup_pic() {
		return group_pic;
	}

	public void setGroup_pic(String group_pic) {
		this.group_pic = group_pic;
	}
}
