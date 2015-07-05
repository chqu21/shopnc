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
public class MyDetails {
	public static class Attr {
		public static final String MEMBER_NAME = "member_name";
		public static final String COMMENT_NUM = "comment_num";
		public static final String AVATAR = "avatar";
		public static final String USERCITY = "usercity";
		public static final String CITYNAME = "cityname";
		public static final String GENDER = "gender";
		public static final String NICKNAME = "nickname";
	}

	private String member_name;
	private String comment_num;
	private String avatar;
	private String usercity;
	private String gender;
	private String cityname;
	private String nickname;

	public MyDetails() {
	}

	public MyDetails(String member_name, String comment_num, String avatar,
			String usercity, String gender,String cityname,String nickname) {
		super();
		this.member_name = member_name;
		this.comment_num = comment_num;
		this.avatar = avatar;
		this.usercity = usercity;
		this.gender = gender;
		this.cityname=cityname;
		this.nickname=nickname;
	}

	public static MyDetails newInstance(String json) {
		MyDetails cld = null;
		try {
			JSONObject obj = new JSONObject(json);
			if (obj.length() > 0) {
				cld = new MyDetails();
				cld.setMember_name(obj.optString(Attr.MEMBER_NAME));
				cld.setComment_num(obj.optString(Attr.COMMENT_NUM));
				cld.setAvatar(obj.optString(Attr.AVATAR));
				cld.setUsercity(obj.optString(Attr.USERCITY));
				cld.setGender(obj.optString(Attr.GENDER));
				cld.setCityname(obj.optString(Attr.CITYNAME));
				cld.setNickname(obj.optString(Attr.NICKNAME));
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return cld;
	}

	public String getMember_name() {
		return member_name;
	}

	public void setMember_name(String member_name) {
		this.member_name = member_name;
	}

	public String getComment_num() {
		return comment_num;
	}

	public void setComment_num(String comment_num) {
		this.comment_num = comment_num;
	}

	public String getAvatar() {
		return avatar;
	}

	public void setAvatar(String avatar) {
		this.avatar = avatar;
	}

	public String getUsercity() {
		return usercity;
	}

	public void setUsercity(String usercity) {
		this.usercity = usercity;
	}

	public String getGender() {
		return gender;
	}

	public void setGender(String gender) {
		this.gender = gender;
	}

	public String getCityname() {
		return cityname;
	}

	public void setCityname(String cityname) {
		this.cityname = cityname;
	}

	public String getNickname() {
		return nickname;
	}

	public void setNickname(String nickname) {
		this.nickname = nickname;
	}

	@Override
	public String toString() {
		return "MyDetails [member_name=" + member_name + ", comment_num="
				+ comment_num + ", avatar=" + avatar + ", usercity=" + usercity
				+ ", gender=" + gender + ", cityname=" + cityname
				+ ", nickname=" + nickname + "]";
	}
}
