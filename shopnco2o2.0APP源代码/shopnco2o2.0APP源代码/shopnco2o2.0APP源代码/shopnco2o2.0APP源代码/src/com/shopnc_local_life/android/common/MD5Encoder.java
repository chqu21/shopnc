/**
 *  ClassName: MyApp.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.common;

import java.security.MessageDigest;

/**
 * 
 * 类说明:为密码字符串进行MD5加密
 * 
 * @author hjgang
 * @version v1.0 Oct 11, 2008
 */
public class MD5Encoder {
	/**
	 * 
	 * 方法说明:加密字符串
	 * 
	 * @param 源字符串
	 * @return 加密后的字符串
	 */
	public static String encode(String src) {
		String resultString = null;
		try {
			resultString = new String(src);
			MessageDigest md = MessageDigest.getInstance("MD5");
			//进行加密
			resultString = byte2hexString(md.digest(resultString.getBytes()));
		} catch (Exception ex) {
		}
		return resultString;
	}

	/**
	 * 
	 * 方法说明:把字节数组转换成字符串.
	 * 
	 * @param bytes
	 * @return
	 */
	private static final String byte2hexString(byte[] bytes) {
		StringBuffer buf = new StringBuffer(bytes.length * 2);
		for (int i = 0; i < bytes.length; i++) {
			if (((int) bytes[i] & 0xff) < 0x10) {
				buf.append("0");
			}
			buf.append(Long.toString((int) bytes[i] & 0xff, 16));
		}
		return buf.toString();
	}

}
