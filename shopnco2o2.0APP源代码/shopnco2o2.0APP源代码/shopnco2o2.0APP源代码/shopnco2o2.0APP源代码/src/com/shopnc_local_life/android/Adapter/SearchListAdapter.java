/**
 * ClassName:MyAdapter.java
 * PackageName:com.example.android_zimu_list
 * Create On 2013-8-2下午4:10:59
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.Adapter;

import java.util.ArrayList;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AbsListView;
import android.widget.AbsListView.OnScrollListener;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.modle.City;
import com.shopnc_local_life.android.widget.PinnedHeaderListView;
import com.shopnc_local_life.android.widget.PinnedHeaderListView.PinnedHeaderAdapter;

/**
 * Author:hjgang Create On 2013-8-2下午4:10:59 Site:http://weibo.com/hjgang or
 * http://t.qq.com/hjgang_ EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-2 hjgang All rights reserved.
 */
public class SearchListAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<String> datas = new ArrayList<String>();

	public SearchListAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}


	public ArrayList<String> getDatas() {
		return datas;
	}


	public void setDatas(ArrayList<String> datas) {
		this.datas = datas;
	}


	@Override
	public int getCount() {
		return datas.size();
	}

	@Override
	public Object getItem(int position) {
		return datas.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_city_item, null);
			holder = new ViewHolder();
			holder.tv = (Button) convertView.findViewById(R.id.tv);
			holder.text_title = (TextView) convertView
					.findViewById(R.id.text_title);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		String str = datas.get(position);
		holder.tv.setText(str);
		return convertView;
	}

	class ViewHolder {
		Button tv;
		TextView text_title;
	}
}
