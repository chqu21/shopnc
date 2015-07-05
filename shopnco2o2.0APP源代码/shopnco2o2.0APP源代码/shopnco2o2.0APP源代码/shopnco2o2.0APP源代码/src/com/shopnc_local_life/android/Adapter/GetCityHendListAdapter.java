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
public class GetCityHendListAdapter extends BaseAdapter implements OnScrollListener,
		PinnedHeaderAdapter {
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<City> list = new ArrayList<City>();

	public GetCityHendListAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}

	public ArrayList<City> getList() {
		return list;
	}

	public void setList(ArrayList<City> list) {
		this.list = list;
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public Object getItem(int position) {
		return list.get(position);
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
		City city = list.get(position);
		holder.tv.setText("" + city.getArea_name());
		return convertView;
	}

	class ViewHolder {
		Button tv;
		TextView text_title;
	}

	@Override
	public void onScrollStateChanged(AbsListView view, int scrollState) {

	}

	@Override
	public void onScroll(AbsListView view, int firstVisibleItem,
			int visibleItemCount, int totalItemCount) {
		if (view instanceof PinnedHeaderListView) {
			((PinnedHeaderListView) view).configureHeaderView(firstVisibleItem);
		}
	}

	@Override
	public int getPinnedHeaderState(int position) {
		return 0;
	}

	@Override
	public void configurePinnedHeader(View header, int position, int alpha) {

	}

}
