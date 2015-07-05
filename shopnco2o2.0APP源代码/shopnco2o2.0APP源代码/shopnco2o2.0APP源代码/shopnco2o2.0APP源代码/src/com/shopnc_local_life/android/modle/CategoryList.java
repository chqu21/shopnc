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
public class CategoryList {
	public static class Attr{
		public static final String CLASS_ID = "class_id";
		public static final String CLASS_NAME = "class_name";
	}
	private String class_id;
	private String class_name;

	public CategoryList() {
	}

	public CategoryList(String class_id, String class_name) {
		super();
		this.class_id = class_id;
		this.class_name = class_name;
	}

	public static ArrayList<CategoryList> newInstanceList(String json){
		ArrayList<CategoryList> c_list = new ArrayList<CategoryList>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				String class_id = obj.optString(Attr.CLASS_ID);
				String class_name = obj.optString(Attr.CLASS_NAME);
				
				c_list.add(new CategoryList(class_id, class_name));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}

	public String getClass_id() {
		return class_id;
	}

	public void setClass_id(String class_id) {
		this.class_id = class_id;
	}

	public String getClass_name() {
		return class_name;
	}

	public void setClass_name(String class_name) {
		this.class_name = class_name;
	}

	@Override
	public String toString() {
		return "CategoryList [class_id=" + class_id + ", class_name="
				+ class_name + "]";
	}


}
