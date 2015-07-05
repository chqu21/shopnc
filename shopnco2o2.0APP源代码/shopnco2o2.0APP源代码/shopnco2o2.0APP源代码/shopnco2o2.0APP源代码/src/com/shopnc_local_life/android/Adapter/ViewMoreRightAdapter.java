/**
 * ClassName:TuanListViewAdapter.java
 * PackageName:com.shopnc_local_life.android.Adapter
 * Create On 2013-8-6下午2:09:25
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
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.modle.CategoryList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class ViewMoreRightAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<CategoryList> datas;
	private int selectItem=-1;
	public ViewMoreRightAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas  == null ? 0 : datas.size();
	}

	@Override
	public Object getItem(int position) {
		return datas.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	public ArrayList<CategoryList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<CategoryList> datas) {
		this.datas = datas;
	}
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_item, null);
			holder = new ViewHolder();
			holder.tv = (TextView) convertView.findViewById(R.id.tv);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		
		CategoryList cl=datas.get(position);
		holder.tv.setText(cl.getClass_name());
		if (position == selectItem) {
			convertView.setBackgroundResource(R.drawable.intropanel_bg2);
			notifyDataSetChanged();
		} else {
			convertView.setBackgroundResource(R.drawable.intropanel_bg2);
		}

		return convertView;
	}
	public void setSelectItem(int selectItem) {
		this.selectItem = selectItem;
		}
	class ViewHolder {
		TextView tv;
	}
}
