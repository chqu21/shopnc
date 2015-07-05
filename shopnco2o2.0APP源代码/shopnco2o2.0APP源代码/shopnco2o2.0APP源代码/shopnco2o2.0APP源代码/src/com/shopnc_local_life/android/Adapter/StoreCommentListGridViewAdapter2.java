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
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.ImageView.ScaleType;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.modle.StoreComment;
import com.shopnc_local_life.android.widget.MyGridView;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class StoreCommentListGridViewAdapter2 extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<String> datas;
	public StoreCommentListGridViewAdapter2(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas  == null ? 0 : datas.size();
	}

	@Override
	public Object getItem(int position) {
		return position;
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	public  ArrayList<String> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<String> datas) {
		this.datas = datas;
	}
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.store_comment_list_grid_item2, null);
			holder = new ViewHolder();
			holder.imageview=(ImageView) convertView.findViewById(R.id.imageview);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		
		BitmapDrawable bd = new BitmapDrawable(BitmapFactory.decodeFile(datas.get(position)));
		holder.imageview.setBackgroundDrawable(bd);
//			MyAsynaTask myTask= new MyAsynaTask(datas.get(position),holder.imageview);
//			myTask.execute();
		return convertView;
	}
	class ViewHolder {
		ImageView imageview;
	}
}
