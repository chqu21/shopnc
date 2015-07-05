/**
 *  ClassName: Constants.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.modle;


/**
 * 响应数据
 * @author hjgang
 */
public class ResponseData {
	public static final class Attr{
		public static final String CODE = "code";
		public static final String HASMORE = "haveMore";
		public static final String JSON = "json";
		public static final String RESULT = "result";
		public static final String COUNT = "count";
	}
	/** 状态码:200 | 304 | 404 | 500 */
	private int code;
	/** 是否有下一页 */
	private boolean haveMore;
	/** JSON格式的字符串 */
	private String json;
	/** 字符串结果 */
	private String result;
	/** 总记录数 */
	private long count;
	
	public int getCode() {
		return code;
	}
	public void setCode(int code) {
		this.code = code;
	}
	public boolean isHasMore() {
		return haveMore;
	}
	public void setHasMore(boolean haveMore) {
		this.haveMore = haveMore;
	}
	public String getJson() {
		return json;
	}
	public void setJson(String json) {
		this.json = json;
	}
	public String getResult() {
		return result;
	}
	public void setResult(String result) {
		this.result = result;
	}
	public long getCount() {
		return count;
	}
	public void setCount(long count) {
		this.count = count;
	}
	@Override
	public String toString() {
		return "ResponseData [code=" + code + ", hasMore=" + haveMore
				+ ", json=" + json + ", result=" + result + ", count=" + count
				+ "]";
	}
}
