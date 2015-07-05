/**
 *  ClassName: SearchInFoDao.java
 *  created on 2012-10-25
 *  Copyrights 2012-10-25 hjgang All rights reserved.
 *  site: http://www.hjgang.tk
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.dao;

import java.text.MessageFormat;
import java.util.ArrayList;

import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.DbHelper;
import com.shopnc_local_life.android.modle.Search;

/**
 * @author hjgang
 * @category File
 * @日期 2012-10-25
 * @时间 上午9:54:13
 * @年份 2012
 */
public class SearchDao {
	private DbHelper dbHelper;

	public SearchDao(Context context) {
		dbHelper = new DbHelper(context);
	}

	/**
	 * 删除表中的所有数据
	 * @param null
	 * @return null
	 * */
	public void deleteAll() {
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();

			db.execSQL(Constants.SQL_SEARCH_DROP);

			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
	}
	/**
	 * 删除表中的一个数据
	 * @param null
	 * @return null
	 * */
	public void delete(int s_id) {
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();

			String sql = MessageFormat.format(Constants.SQL_SEARCH_DELETE_BY,s_id);
			db.execSQL(sql);

			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
	}

	/**
	 * 新增一条数据
	 * @param Search
	 * @return null
	 * */
	public void insert(String s) {
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();

			Object[] paramValues = {s};

			db.execSQL(Constants.SQL_SEARCH_INSERT, paramValues);

			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
	}

	/**
	 * 查询所有数据
	 * @param null
	 * @return ArrayList<Search>
	 * */
	public ArrayList<Search> findall() {
		ArrayList<Search> favos = new ArrayList<Search>();
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();
			Cursor c = db.rawQuery(Constants.SQL_SEARCH_SELECT_ALL, null);
			while (c.moveToNext()) {
				Search s = new Search();
				s.setS_id(c.getString(c.getColumnIndex("s_id")));
				s.setS_title(c.getString(c.getColumnIndex("s_title")));
				favos.add(s);
			}
			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
		return favos;
	}
	/**
	 * 查询所有数据
	 * @param null
	 * @return ArrayList<Search>
	 * */
	public ArrayList<String> array_string_findall() {
		ArrayList<String> favos = new ArrayList<String>();
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();
			Cursor c = db.rawQuery(Constants.SQL_SEARCH_SELECT_ALL, null);
			while (c.moveToNext()) {
				favos.add(c.getString(c.getColumnIndex("s_title")));
			}
			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
		return favos;
	}
	

	/**
	 * 查询一个数据
	 * @param String
	 * @return Search
	 * */
	public Search select(int s_id) {
		Search Search = new Search();
		SQLiteDatabase db = null;
		try {
			db = dbHelper.getSQLiteDatabase();
			db.beginTransaction();
			String sql = MessageFormat.format(Constants.SQL_SEARCH_SELECT_BY, s_id);
			Cursor c = db.rawQuery(sql, null);
			while (c.moveToNext()) {
				Search.setS_id(c.getString(c.getColumnIndex("s_id")));
				Search.setS_title(c.getString(c.getColumnIndex("s_title")));
			}
			db.setTransactionSuccessful();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			if (db != null) {
				db.endTransaction();
				db.close();
			}
		}
		return Search;
	}
}
