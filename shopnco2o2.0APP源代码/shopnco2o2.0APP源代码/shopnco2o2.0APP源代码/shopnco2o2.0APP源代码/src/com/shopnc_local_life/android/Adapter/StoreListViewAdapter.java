/**
 * ClassName:StoreListViewAdapter.java
 * PackageName:com.shopnc_local_life.android.Adapter
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.Adapter;

import java.util.ArrayList;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Paint;
import android.graphics.drawable.BitmapDrawable;
import android.os.AsyncTask;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.ImageLoader;
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.modle.StoreList;
import com.shopnc_local_life.android.modle.TuanList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class StoreListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<StoreList> datas;
	public StoreListViewAdapter(Context context) {
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

	public ArrayList<StoreList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<StoreList> datas) {
		this.datas = datas;
	}
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_store_list_item, null);
			holder = new ViewHolder();
			holder.image_pic = (ImageView) convertView.findViewById(R.id.image_pic);
			holder.text_tuan_name = (TextView) convertView.findViewById(R.id.text_tuan_name);
			holder.text_tuan_person_consume = (TextView) convertView.findViewById(R.id.text_tuan_person_consume);
			holder.text_tuan_address = (TextView) convertView.findViewById(R.id.text_tuan_address);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		StoreList sl=datas.get(position);
		holder.text_tuan_name.setText(sl.getStore_name());
		holder.text_tuan_person_consume.setText("人均:"+sl.getPerson_consume());
		holder.text_tuan_address.setText(sl.getAddress());
		
		MyAsynaTask myAsynaTask = new MyAsynaTask(sl.getPic(), holder.image_pic);
		myAsynaTask.execute();
		
		return convertView;
	}
	class ViewHolder {
		TextView text_tuan_name;
		TextView text_tuan_person_consume;
		TextView text_tuan_address;
		ImageView image_pic;
	}
}
