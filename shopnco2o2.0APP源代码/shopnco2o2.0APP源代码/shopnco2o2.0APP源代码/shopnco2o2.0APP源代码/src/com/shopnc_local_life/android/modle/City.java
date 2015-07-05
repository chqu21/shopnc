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
 *  Author:hjgang
 *  Create On 2013-9-16 下午3:56:26
 *  Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 *  EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 *  Copyrights 2013-9-16 hjgang All rights reserved.
 */
public class City {
	public static class Attr{
		public static final String AREA_ID = "area_id";
		public static final String AREA_NAME = "area_name";
		public static final String FIRST_LETTER = "first_letter";
		public static final String HOT_CITY = "hot_city";
	}
	private long area_id;
	private String area_name;
	private String first_letter;
	private String hot_city;

	public City() {
	}
	

	public City(long area_id, String area_name, String first_letter, String hot_city) {
		super();
		this.area_id = area_id;
		this.area_name = area_name;
		this.first_letter = first_letter;
		this.hot_city = hot_city;
	}


	public static ArrayList<City> newInstanceList(String json){
		ArrayList<City> c_list = new ArrayList<City>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				long area_id = obj.optLong(Attr.AREA_ID);
				String area_name = obj.optString(Attr.AREA_NAME);
				String first_letter = obj.optString(Attr.FIRST_LETTER);
				String hot_city = obj.optString(Attr.HOT_CITY);
				
				c_list.add(new City(area_id, area_name,first_letter, hot_city));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}


	public long getArea_id() {
		return area_id;
	}


	public void setArea_id(long area_id) {
		this.area_id = area_id;
	}


	public String getArea_name() {
		return area_name;
	}


	public void setArea_name(String area_name) {
		this.area_name = area_name;
	}




	public String getFirst_letter() {
		return first_letter;
	}


	public void setFirst_letter(String first_letter) {
		this.first_letter = first_letter;
	}




	public String getHot_city() {
		return hot_city;
	}


	public void setHot_city(String hot_city) {
		this.hot_city = hot_city;
	}


	@Override
	public String toString() {
		return "City [area_id=" + area_id + ", area_name=" + area_name
				+ ", first_letter=" + first_letter + ", hot_city=" + hot_city
				+ "]";
	}
	
}
