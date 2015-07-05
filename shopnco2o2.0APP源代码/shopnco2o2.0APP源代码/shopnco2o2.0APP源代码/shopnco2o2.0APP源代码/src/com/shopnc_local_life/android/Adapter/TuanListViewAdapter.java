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
import com.shopnc_local_life.android.modle.TuanList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class TuanListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<TuanList> datas;
	public TuanListViewAdapter(Context context) {
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

	public ArrayList<TuanList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<TuanList> datas) {
		this.datas = datas;
	}
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_tuan_item, null);
			holder = new ViewHolder();
			holder.text_tuan_name=(TextView) convertView.findViewById(R.id.text_tuan_name);
			holder.text_tuan_price=(TextView) convertView.findViewById(R.id.text_tuan_price);
			holder.text_tuan_original_price=(TextView) convertView.findViewById(R.id.text_tuan_original_price);
			holder.text_tuan_buyer_count=(TextView) convertView.findViewById(R.id.text_tuan_buyer_count);
			holder.image_pic = (ImageView) convertView.findViewById(R.id.image_pic);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		holder.text_tuan_original_price.getPaint().setFlags(Paint. STRIKE_THRU_TEXT_FLAG|Paint.ANTI_ALIAS_FLAG); //中划线
		TuanList tuan=datas.get(position);
		holder.text_tuan_name.setText(tuan.getGroup_name());
		holder.text_tuan_price.setText("￥"+tuan.getGroup_price());
		holder.text_tuan_original_price.setText("￥"+tuan.getOriginal_price());
		holder.text_tuan_buyer_count.setText(tuan.getBuyer_count()+"人");
		MyAsynaTask mt=new MyAsynaTask(tuan.getGroup_pic(), holder.image_pic);
		mt.execute();
		
		return convertView;
	}
	class ViewHolder {
		TextView text_tuan_name;
		TextView text_tuan_original_price;
		TextView text_tuan_price;
		TextView text_tuan_buyer_count;
		ImageView image_pic;
	}
}
