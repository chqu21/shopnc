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
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.common.SystemHelper;
import com.shopnc_local_life.android.modle.YouHuiQuanList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class YouHuiQuanListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<YouHuiQuanList> datas;
	public YouHuiQuanListViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas == null ? 0 : datas.size();
	}

	public ArrayList<YouHuiQuanList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<YouHuiQuanList> datas) {
		this.datas = datas;
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
			convertView = inflater.inflate(R.layout.listview_youhuiquan_item, null);
			holder = new ViewHolder();
			holder.image_pic = (ImageView) convertView.findViewById(R.id.image_pic);
			holder.text_youhuiquan_name = (TextView) convertView.findViewById(R.id.text_youhuiquan_name);
			holder.text_youhuiquan_down = (TextView) convertView.findViewById(R.id.text_youhuiquan_down);
			holder.text_youhuiquan_start= (TextView) convertView.findViewById(R.id.text_youhuiquan_start);
			holder.text_youhuiquan_end= (TextView) convertView.findViewById(R.id.text_youhuiquan_end);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		YouHuiQuanList youhuiquan=datas.get(position);
		holder.text_youhuiquan_name.setText(youhuiquan.getCoupon_name());
		holder.text_youhuiquan_down.setText(youhuiquan.getDownload_count());
		holder.text_youhuiquan_start.setText(youhuiquan.getCoupon_start_time() == null ? "" :SystemHelper.getTimeStr3(youhuiquan.getCoupon_start_time()));
		holder.text_youhuiquan_end.setText(youhuiquan.getCoupon_end_time() == null ? "" :SystemHelper.getTimeStr3(youhuiquan.getCoupon_end_time()));
		MyAsynaTask mt=new MyAsynaTask(youhuiquan.getCoupon_pic(), holder.image_pic);
		
		mt.execute();
		return convertView;
	}
	class ViewHolder {
		ImageView image_pic;
		TextView text_youhuiquan_name;
		TextView text_youhuiquan_down;
		TextView text_youhuiquan_start;
		TextView text_youhuiquan_end;
	}
}
