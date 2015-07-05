/**
 * ClassName:TopicActivity.java
 * PackageName:com.shopnc_local_life.android.ui.topic
 * Create On 2013-8-7上午11:51:05
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.topic;

import android.app.Activity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ListView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.TopicListViewAdapter;

/**
 * Author:hjgang
 * Create On 2013-8-7上午11:51:05
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-7 hjgang All rights reserved.
 */
public class TopicActivity extends Activity {
	private ListView listview;
	private TopicListViewAdapter adapter;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_topic);
		listview = (ListView) findViewById(R.id.listview);
		View v=LayoutInflater.from(TopicActivity.this)
				.inflate(R.layout.topic_list_head, null);
		listview.addHeaderView(v);
		adapter = new TopicListViewAdapter(TopicActivity.this);
		listview.setAdapter(adapter);
		adapter.notifyDataSetChanged();
	}
}