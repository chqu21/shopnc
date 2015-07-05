/**
 * ClassName:MoreActivity.java
 * PackageName:com.shopnc_local_life.android.ui.more
 * Create On 2013-8-7下午4:29:33
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.more;

import java.util.ArrayList;
import java.util.HashMap;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.SubmenuListViewAdapter;
import com.shopnc_local_life.android.Adapter.SubmenuListViewAdapter02;
import com.shopnc_local_life.android.ui.MainActivity;
import com.shopnc_local_life.android.ui.my.MyActivity;

/**
 * Author:hjgang
 * Create On 2013-8-7下午4:29:33
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-7 hjgang All rights reserved.
 */
public class MoreActivity extends Activity{
	private ListView lv;
	private ListView lv2;
	private ListView lv3;
	private SubmenuListViewAdapter02 adapter;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_more);
		lv = (ListView)this.findViewById(R.id.lv);
		lv2 = (ListView)this.findViewById(R.id.lv2);
		lv3 = (ListView)this.findViewById(R.id.lv3);
		lv.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long id) {
				Intent intent = null;
				switch((int)id){
				case R.string.more_01:
					intent = new Intent(MoreActivity.this, HelpActivity.class);
					break;
				case R.string.more_02:
					intent = new Intent(MoreActivity.this, AboutActivity.class);
					break;	
				case R.string.more_03:
//					intent = new Intent(MoreActivity.this, HelpActivity.class);
					intent=new Intent("android.intent.action.CALL", Uri.parse("tel:"+MoreActivity.this.getString(R.string.more_04)));
					break;
				}
				
				if(null != intent){
					MoreActivity.this.startActivity(intent);
				}
			}
		});
	}
	@Override
	protected void onResume() {
		super.onResume();
		
		//Init ListView Item Data
		ArrayList<HashMap<String, Object>> datas = new ArrayList<HashMap<String,Object>>();
//		ArrayList<HashMap<String, Object>> datas2 = new ArrayList<HashMap<String,Object>>();
//		ArrayList<HashMap<String, Object>> datas3 = new ArrayList<HashMap<String,Object>>();
		
		HashMap<String, Object> map1 = new HashMap<String, Object>();
		map1.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT, this.getString(R.string.more_01));
		map1.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT_ID, R.string.more_01);
		datas.add(map1);
		
		HashMap<String, Object> map2 = new HashMap<String, Object>();
		map2.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT, this.getString(R.string.more_02));
		map2.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT_ID, R.string.more_02);
		datas.add(map2);
		
		HashMap<String, Object> map3 = new HashMap<String, Object>();
		map3.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT, this.getString(R.string.more_03));
		map3.put(SubmenuListViewAdapter02.TAG_ITEM_TEXT_ID, R.string.more_03);
		datas.add(map3);
		
//		HashMap<String, Object> map2 = new HashMap<String, Object>();
//		map2.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_02));
//		datas2.add(map2);
//		
//		HashMap<String, Object> map3 = new HashMap<String, Object>();
//		map3.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_03));
//		datas2.add(map3);
//		
//		HashMap<String, Object> map4 = new HashMap<String, Object>();
//		map4.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_04));
//		datas3.add(map4);
//		
//		HashMap<String, Object> map5 = new HashMap<String, Object>();
//		map5.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_05));
//		datas3.add(map5);
//		
//		HashMap<String, Object> map6= new HashMap<String, Object>();
//		map6.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_06));
//		datas3.add(map6);
//		
//		HashMap<String, Object> map7= new HashMap<String, Object>();
//		map7.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.more_07));
//		datas3.add(map7);
		
		adapter = new SubmenuListViewAdapter02(MoreActivity.this, datas);
		lv.setAdapter(adapter);
//		adapter = new SubmenuListViewAdapter02(MoreActivity.this, datas2);
//		lv2.setAdapter(adapter);
//		adapter = new SubmenuListViewAdapter02(MoreActivity.this, datas3);
//		lv3.setAdapter(adapter);
	}
	 @Override
		public boolean onKeyDown(int keyCode, KeyEvent event) {
			if (keyCode == KeyEvent.KEYCODE_BACK) {
				((MainActivity) MoreActivity.this.getParent()).dialog.show();
				return true;
			} else {
				return super.onKeyDown(keyCode, event);
			}
		}
}
