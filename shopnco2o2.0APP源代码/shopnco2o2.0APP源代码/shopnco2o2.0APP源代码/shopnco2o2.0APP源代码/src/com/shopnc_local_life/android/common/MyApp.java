/**
 * ClassName:MyApp.java
 * PackageName:com.shopnc_local_life.android.common
 * Create On 2013-8-6下午4:52:02
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.common;

import java.io.File;

import android.app.Application;
import android.content.SharedPreferences;
import android.os.Environment;
import android.util.DisplayMetrics;
import android.widget.RadioButton;
import android.widget.TabHost;
import android.widget.Toast;

import com.shopnc_local_life.android.dao.SearchDao;

/**
 * Author:hjgang
 * Create On 2013-8-6下午4:52:02
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class MyApp extends Application{
	/** 系统初始化配置文件操作器 */
	private SharedPreferences sysInitSharedPreferences;
	/** 记录默认城市名称 */
	private String city_id;
	private String city_name;
	private boolean city_id_flag;
	private String member_id;
	private String member_key;
	private String  first_start_flag;
	
	private static int screenWidth;
	private static int screenHeight;
	
	private SearchDao  search_dao;
	
	private String Photo_path;
	
	private TabHost tabHost;
	private RadioButton btn_test2;
	
	@Override
	public void onCreate() {
		super.onCreate();
		sysInitSharedPreferences = getSharedPreferences(
				Constants.SYSTEM_INIT_FILE_NAME, MODE_PRIVATE);
		search_dao = new SearchDao(this);
		city_id = sysInitSharedPreferences.getString("city_id", "0");
		city_name = sysInitSharedPreferences.getString("city_name", "");
		member_id = sysInitSharedPreferences.getString("member_id", "");
		member_key = sysInitSharedPreferences.getString("member_key", "");
		city_id_flag= sysInitSharedPreferences.getBoolean("city_id_flag", false);
		Photo_path = sysInitSharedPreferences.getString("Photo_path", "");
		first_start_flag = sysInitSharedPreferences.getString("first_start_flag", "0");
		DisplayMetrics dm = SystemHelper.getScreenInfo(this);
		screenWidth = dm.widthPixels;
		screenHeight = dm.heightPixels;
		createCacheDir();
	}

	public static int getScreenWidth() {
		return screenWidth;
	}

	public SearchDao getSearch_dao() {
		return search_dao;
	}


	public String getFirst_start_flag() {
		return first_start_flag;
	}

	public void setFirst_start_flag(String first_start_flag) {
		this.first_start_flag = first_start_flag;
		sysInitSharedPreferences.edit().putString("first_start_flag", this.first_start_flag).commit();
	}

	public RadioButton getBtn_test2() {
		return btn_test2;
	}

	public void setBtn_test2(RadioButton btn_test2) {
		this.btn_test2 = btn_test2;
	}

	public TabHost getTabHost() {
		return tabHost;
	}

	public void setTabHost(TabHost tabHost) {
		this.tabHost = tabHost;
	}

	public void setSearch_dao(SearchDao search_dao) {
		this.search_dao = search_dao;
	}

	public void setScreenWidth(int screenWidth) {
		this.screenWidth = screenWidth;
	}

	public static int getScreenHeight() {
		return screenHeight;
	}

	public void setScreenHeight(int screenHeight) {
		this.screenHeight = screenHeight;
	}

	public String getCity_id() {
		return city_id;
	}

	public String getPhoto_path() {
		return Photo_path;
	}

	public void setPhoto_path(String photo_path) {
		Photo_path = photo_path;
		sysInitSharedPreferences.edit().putString("Photo_path", this.Photo_path).commit();
	}

	public void setCity_id(String city_id) {
		this.city_id = city_id;
		sysInitSharedPreferences.edit().putString("city_id", this.city_id).commit();
	}

	public String getMember_id() {
		return member_id;
	}

	public void setMember_id(String member_id) {
		this.member_id = member_id;
		sysInitSharedPreferences.edit().putString("member_id", this.member_id).commit();
	}

	public String getMember_key() {
		return member_key;
	}

	public void setMember_key(String member_key) {
		this.member_key = member_key;
		sysInitSharedPreferences.edit().putString("member_key", this.member_key).commit();
	}

	public String getCity_name() {
		return city_name;
	}

	public void setCity_name(String city_name) {
		this.city_name = city_name;
		sysInitSharedPreferences.edit().putString("city_name", this.city_name).commit();
	}

	public boolean isCity_id_flag() {
		return city_id_flag;
	}

	public void setCity_id_flag(boolean city_id_flag) {
		this.city_id_flag = city_id_flag;
		sysInitSharedPreferences.edit().putBoolean("city_id_flag", this.city_id_flag).commit();
	}

	/**
	 * 获取系统初始化文件操作器
	 * 
	 * @return
	 */
	public SharedPreferences getSysInitSharedPreferences() {
		return sysInitSharedPreferences;
	}
	
	// 创建SD卡缓存目录
		private void createCacheDir() {
			if (Environment.MEDIA_MOUNTED.equals(Environment.getExternalStorageState())) {
				File f = new File(Constants.CACHE_DIR);
				if (f.exists()) {
					System.out.println("SD卡缓存目录:已存在!");
				} else {
					if (f.mkdirs()) {
						System.out.println("SD卡缓存目录:" + f.getAbsolutePath()+ "已创建!");
					} else {
						System.out.println("SD卡缓存目录:创建失败!");
					}
				}
				File ff = new File(Constants.CACHE_IMAGE);
				if (ff.exists()) {
					System.out.println("SD卡照片缓存目录:已存在!");
				} else {
					if (ff.mkdirs()) {
						System.out.println("SD卡照片缓存目录:" + ff.getAbsolutePath()+ "已创建!");
					} else {
						System.out.println("SD卡照片缓存目录:创建失败!");
					}
				}
				File fff = new File(Constants.CACHE_DIR_IMAGE);
				if (fff.exists()) {
					System.out.println("SD卡缓存目录:已存在!");
				} else {
					if (fff.mkdirs()) {
						System.out.println("SD卡照片缓存目录:" + fff.getAbsolutePath()+ "已创建!");
					} else {
						System.out.println("SD卡照片缓存目录:创建失败!");
					}
				}

				File ffff = new File(Constants.CACHE_DIR_UPLOADING_IMG);
				if (ffff.exists()) {
					System.out.println("SD卡上传缓存目录:已存在!");
				} else {
					if (ffff.mkdirs()) {
						System.out.println("SD卡上传缓存目录:" + ffff.getAbsolutePath()+ "已创建!");
					} else {
						System.out.println("SD卡上传缓存目录:创建失败!");
					}
				}
			} else {
				Toast.makeText(MyApp.this, "亲，您的SD不在了，可能有的功能不能用奥，赶快看看吧。",Toast.LENGTH_SHORT).show();
			}
		}
	
}
