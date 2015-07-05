/**
 * ClassName:CheckActivity.java
 * PackageName:com.shopnc_local_life.android.ui.check
 * Create On 2013-8-7上午11:17:00
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.check;

import android.app.Activity;
import android.os.Bundle;
import android.widget.ListView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.CheckListViewAdapter;

/**
 * Author:hjgang
 * Create On 2013-8-7上午11:17:00
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-7 hjgang All rights reserved.
 */
public class CheckActivity extends Activity{
	private ListView listview;
	private CheckListViewAdapter adapter;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_check);
		listview = (ListView) findViewById(R.id.listview);
		adapter = new CheckListViewAdapter(CheckActivity.this);
		listview.setAdapter(adapter);
		adapter.notifyDataSetChanged();
	}
}
