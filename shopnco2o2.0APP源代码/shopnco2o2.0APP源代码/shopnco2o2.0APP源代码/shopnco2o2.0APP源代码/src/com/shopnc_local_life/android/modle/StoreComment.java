/**
 * ClassName:StoreComment.java
 * PackageName:android_shopnc_local_life
 * Create On 2013-9-16 下午3:56:26
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-9-16 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.modle;

import java.util.ArrayList;
import java.util.Arrays;

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
public class StoreComment {
	public static class Attr{
		public static final String COMMENT_ID = "comment_id";
		public static final String COMMENT = "comment";
		public static final String PHOTO = "photo";
		public static final String PERSON_COST = "person_cost";
		public static final String MEMBER_NAME = "member_name";
		public static final String ADD_TIME = "add_time";
		public static final String AVATAR = "avatar";
	}
	private String comment_id;
	private String comment;
	private String[] photo;
	private String person_cost;
	private String member_name;
	private String add_time;
	private String avatar;

	public StoreComment() {
	}

	public StoreComment(String comment_id, String comment, String[] photo,
			String person_cost, String member_name, String add_time,String avatar) {
		super();
		this.comment_id = comment_id;
		this.comment = comment;
		this.photo = photo;
		this.person_cost = person_cost;
		this.member_name = member_name;
		this.add_time = add_time;
		this.avatar=avatar;
	}

	public static ArrayList<StoreComment> newInstanceList(String json){
		ArrayList<StoreComment> c_list = new ArrayList<StoreComment>();
		try {
			JSONArray arr = new JSONArray(json);
			int size = null == arr ? 0 : arr.length();
			for(int i = 0; i < size; i++){
				JSONObject obj = arr.getJSONObject(i);
				String comment_id = obj.optString(Attr.COMMENT_ID);
				String comment = obj.optString(Attr.COMMENT);
				String photo_str = obj.optString(Attr.PHOTO);
				String[] photo = null;
				if(photo_str != null && !photo_str.equals("null") && !photo_str.equals("")){
					photo = photo_str.split(",");
				}
				String person_cost = obj.optString(Attr.PERSON_COST);
				String member_name = obj.optString(Attr.MEMBER_NAME);
				String add_time = obj.optString(Attr.ADD_TIME);
				String avatar=obj.optString(Attr.AVATAR);
				
				c_list.add(new StoreComment(comment_id, comment, photo, person_cost, 
						member_name, add_time, avatar));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return c_list;
	}

	public String getComment_id() {
		return comment_id;
	}

	public void setComment_id(String comment_id) {
		this.comment_id = comment_id;
	}

	public String getComment() {
		return comment;
	}

	public void setComment(String comment) {
		this.comment = comment;
	}

	public String[] getPhoto() {
		return photo;
	}

	public void setPhoto(String[] photo) {
		this.photo = photo;
	}

	public String getPerson_cost() {
		return person_cost;
	}

	public void setPerson_cost(String person_cost) {
		this.person_cost = person_cost;
	}

	public String getMember_name() {
		return member_name;
	}

	public void setMember_name(String member_name) {
		this.member_name = member_name;
	}

	public String getAdd_time() {
		return add_time;
	}

	public void setAdd_time(String add_time) {
		this.add_time = add_time;
	}
	
	public String getAvatar() {
		return avatar;
	}

	public void setAvatar(String avatar) {
		this.avatar = avatar;
	}

	@Override
	public String toString() {
		return "StoreComment [comment_id=" + comment_id + ", comment="
				+ comment + ", photo=" + Arrays.toString(photo)
				+ ", person_cost=" + person_cost + ", member_name="
				+ member_name + ", add_time=" + add_time + ", avatar=" + avatar
				+ "]";
	}

}
