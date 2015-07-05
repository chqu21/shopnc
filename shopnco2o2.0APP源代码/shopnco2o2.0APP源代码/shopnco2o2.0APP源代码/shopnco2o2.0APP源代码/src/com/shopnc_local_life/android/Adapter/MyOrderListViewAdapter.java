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
import android.graphics.Paint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.modle.MyCardList;
import com.shopnc_local_life.android.modle.OrderFlagList;
import com.shopnc_local_life.android.modle.TuanList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class MyOrderListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<OrderFlagList> datas;
	public MyOrderListViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas == null ? 0 : datas.size();
	}
	
	public ArrayList<OrderFlagList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<OrderFlagList> datas) {
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
			convertView = inflater.inflate(R.layout.listview_my_order_item, null);
			holder = new ViewHolder();
			holder.text_tuan_name=(TextView) convertView.findViewById(R.id.text_tuan_name);
			holder.text_tuan_price=(TextView) convertView.findViewById(R.id.text_tuan_price);
			holder.text_tuan_buyer_count=(TextView) convertView.findViewById(R.id.text_tuan_buyer_count);
			holder.image_pic = (ImageView) convertView.findViewById(R.id.image_pic);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		OrderFlagList ofl=datas.get(position);
		holder.text_tuan_name.setText(ofl.getItem_name());
		holder.text_tuan_price.setText("￥"+ofl.getPrice());
		if(ofl.getState().equals("1")){
			holder.text_tuan_buyer_count.setText("未支付");
		}else if(ofl.getState().equals("2")){
			holder.text_tuan_buyer_count.setText("已支付");
		}else if(ofl.getState().equals("3")){
			holder.text_tuan_buyer_count.setText("已消费");
		}
		MyAsynaTask mt=new MyAsynaTask(ofl.getGroup_pic(), holder.image_pic);
		mt.execute();
		return convertView;
	}
	class ViewHolder {
		TextView text_tuan_name;
		TextView text_tuan_price;
		TextView text_tuan_buyer_count;
		ImageView image_pic;
	}
}
