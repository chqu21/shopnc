/**
 *  ClassName: MyApp.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.common;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

/**
 * IO帮助类
 * @author hjgang
 */
public class IOHelper {
	
	/**
	 * 从网络路径中获取资源名称
	 * @param url
	 * @return
	 */
	public static String getName(String url){
		String result = null;
		if(null != url){
			result =  url.substring(url.lastIndexOf("smiley/") + 7);
			result =  result.replace("/", "-");
		}
		return result;
	}
	
	public static String getExtension(String name){
		return name.substring(name.lastIndexOf(".") + 1);
	}
	
	public static void copy(File src, File dest){
		BufferedInputStream bis = null;
		BufferedOutputStream bos = null;
		
		byte[] b = new byte[1024];
		
		try {
			bis = new BufferedInputStream(new FileInputStream(src));
			bos = new BufferedOutputStream(new FileOutputStream(dest));
			
			for(int count = -1; (count = bis.read(b)) != -1;){
				bos.write(b, 0, count);
			}
			bos.flush();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}finally{
			if(null!= bis){
				try {
					bis.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
			if(null != bos){
				try {
					bos.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
		}
	}
	
	/**
	 * 统计指定目录下的子文件的大小（字节数），包括子孙目录下的所有文件
	 * @param baseDir
	 * @return
	 */
	public static long totalFileSize(File baseDir){
		long size = 0; 
		if ((baseDir != null) && (baseDir.isDirectory())) {
			File[] subs = baseDir.listFiles();
			int length = subs == null ? 0 : subs.length;
			for(int i = 0; i < length; i++){
				File sub = subs[i];
				if(sub.isFile()){
					size += sub.length();
				}else{
					size += totalFileSize(sub);
				}
			}
		}
		return size;
	}
	
	/**
	 * 刪除指定目录下的所有文件，包括子孙目录下的文件，并返回被删除的文件数量
	 * @param baseDir
	 * @return 被删除的文件数量
	 */
	public static int clearCacheFolder(File baseDir) {
		int count = 0;
		if ((baseDir != null) && (baseDir.isDirectory())) {
			File[] subs = baseDir.listFiles();
			int length = subs == null ? 0 : subs.length;
			for(int i = 0; i < length; i++){
				File sub = subs[i];
				if(sub.isFile()){
					if(sub.delete()){
						count++;
					}
				}else{
					if((!sub.getName().equals("smiley")))
						count += clearCacheFolder(sub);
				}
			}
		}
		return count;
	}
}
