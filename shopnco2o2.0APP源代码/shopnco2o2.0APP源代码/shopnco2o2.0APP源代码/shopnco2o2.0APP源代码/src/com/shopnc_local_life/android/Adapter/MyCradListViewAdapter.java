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
import android.widget.ImageView;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.modle.MyCardList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class MyCradListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<MyCardList> datas;
	public MyCradListViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas == null ? 0 : datas.size();
	}

	public ArrayList<MyCardList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<MyCardList> datas) {
		this.datas = datas;
	}
	@Override
	public Object getItem(int position) {
		return position;
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_mycard_item, null);
			holder = new ViewHolder();
			holder.text_mycard_name = (TextView) convertView.findViewById(R.id.text_mycard_name);
			holder.text_mycard_num = (TextView) convertView.findViewById(R.id.text_mycard_num);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		MyCardList mcl=datas.get(position);
		holder.text_mycard_name.setText(mcl.getStore_name());
		holder.text_mycard_num.setText("NO."+mcl.getCard_number());
		return convertView;
	}
	class ViewHolder {
		ImageView image_pic;
		TextView text_mycard_name;
		TextView text_mycard_num;
	}
}
