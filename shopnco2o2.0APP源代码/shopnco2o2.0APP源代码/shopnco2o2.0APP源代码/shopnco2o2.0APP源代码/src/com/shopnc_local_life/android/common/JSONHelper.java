/**
 *  ClassName: MyApp.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.common;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;

/**
 * json字符串的工具类
 * @author hjgang
 */
public class JSONHelper {
	
	/**
	 * 从asserts下的faces/facetab.txt中获取所有笑脸信息转换成JSONArray
	 * @param ctx
	 * @return
	 */
	public static JSONArray getFaces(Context ctx) {
		JSONArray arr = null;
		BufferedReader br = null;
		try {
			br = new BufferedReader(new InputStreamReader(ctx.getAssets().open(
					"faces/facetab.txt"), "UTF-8"));
			StringBuilder sb = new StringBuilder();
			for (String str = null; (str = br.readLine()) != null;) {
				sb.append(str);
			}

			JSONObject obj = new JSONObject(sb.toString());
			if (obj.has("child")) {
				arr = obj.getJSONArray("child");
			}
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (JSONException e) {
			e.printStackTrace();
		} finally {
			if (br != null) {
				try {
					br.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
		}

		return arr;
	}

	public static String string2Json(String s) {
		StringBuffer sb = new StringBuffer();
		for (int i = 0; i < s.length(); i++) {
			char c = s.charAt(i);
			switch (c) {
			case '\"':
				sb.append("\\\"");
				break;
			case '\\':
				sb.append("\\\\");
				break;
			case '/':
				sb.append("\\/");
				break;
			case '\b':
				sb.append("\\b");
				break;
			case '\f':
				sb.append("\\f");
				break;
			case '\n':
				sb.append("\\n");
				break;
			case '\r':
				sb.append("\\r");
				break;
			case '\t':
				sb.append("\\t");
				break;
			default:
				sb.append(c);
			}
		}
		return sb.toString();
	}

	public static String getNickName(String json) {
		String nickName = "";
		try {
			JSONArray array = new JSONArray(json);
			int size = array == null ? 0 : array.length();
			if (size > 0) {
				JSONObject obj = (JSONObject) array.get(0);
				if (obj.has("name")) {
					nickName = obj.getString("name");
				}
			}
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return nickName;
	}

	public static void main(String[] args) {
		
		 String str =
		 "[{\"name\":\"移动办公\",\"icon\":\"Yidong.png\",\"subs\":[{\"name\":\"在办件\",\"icon\":\"ibox.png\", \"url\":\"Yidong/inbox.aspx\"},{\"name\":\"已办件\",\"icon\":\"h.png\", \"url\":\"Yidong/hadbox.aspx\"},{\"name\":\"发出件\",\"icon\":\"s.png\", \"url\":\"Yidong/sendbox.aspx\"}]},"
		 ; str +=
		 "{\"name\":\"物品管理\",\"icon\":\"w.png\",\"subs\":[{\"name\":\"物品列表\",\"icon\":\"Wp.png\", \"url\":\"Wupin/list.aspx\"},{\"name\":\"新增物品\",\"icon\":\"Xz.png\", \"url\":\"Wupin/new.aspx\"}]},"
		 ; str +=
		 "{\"name\":\"工具箱\",\"icon\":\"Tool.png\",\"subs\":[{\"name\":\"万年历\",\"icon\":\"Wn.png\", \"url\":\"Tool/wn.aspx\"},{\"name\":\"计算器\",\"icon\":\"j.png\", \"url\":\"Tool/jsuan.aspx\"}]}]"
		 ;
		 
		 String json =
		 "[{\"name\":\"移动办公\",\"icon\":\"Yidong.png\",\"type\":\"0\",\"subs\":[{\"name\":\"在办件\",\"icon\":\"ibox.png\", \"url\":\"Yidong/inbox.aspx\"},{\"name\":\"已办件\",\"icon\":\"h.png\", \"url\":\"Yidong/hadbox.aspx\"},{\"name\":\"发出件\",\"icon\":\"s.png\", \"url\":\"Yidong/sendbox.aspx\"}]},"
		; json +=
		  "{\"name\":\"物品管理\",\"icon\":\"w.png\",\"type\":\"2\",\"url\":\"Wupin/list.aspx\"},"
		 ; json +=
		  "{\"name\":\"工具箱\",\"icon\":\"Tool.png\",\"type\":\"1\",\"subs\":[{\"name\":\"万年历\",\"icon\":\"Wn.png\", \"url\":\"Tool/wn.aspx\", \"tips\":\"查看从古至今的日历\"},{\"name\":\"计算器\",\"icon\":\"j.png\", \"url\":\"Tool/jsuan.aspx\", \"tips\":\"执行快速准确的计算功能\"}]}]"
		 ;
	}
}
