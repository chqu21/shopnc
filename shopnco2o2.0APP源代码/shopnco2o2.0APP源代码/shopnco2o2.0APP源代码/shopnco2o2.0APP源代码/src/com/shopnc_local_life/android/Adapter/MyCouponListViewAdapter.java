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
import com.shopnc_local_life.android.common.SystemHelper;
import com.shopnc_local_life.android.modle.MyCouponList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class MyCouponListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<MyCouponList> datas;
	public MyCouponListViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas == null ? 0 : datas.size();
	}

	public ArrayList<MyCouponList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<MyCouponList> datas) {
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
			convertView = inflater.inflate(R.layout.listview_my_coupon_item, null);
			holder = new ViewHolder();
			holder.text_mycard_name = (TextView) convertView.findViewById(R.id.text_mycard_name);
			holder.text_mycard_num = (TextView) convertView.findViewById(R.id.text_mycard_num);
			holder.text_mycard_num2 = (TextView) convertView.findViewById(R.id.text_mycard_num2);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		MyCouponList mcl=datas.get(position);
		holder.text_mycard_name.setText(mcl.getCoupon_name());
		holder.text_mycard_num.setText(SystemHelper.getTimeStr(mcl.getDownload_time()));
		if(mcl.getDownload_type().equals("1")){
			holder.text_mycard_num2.setText("打印");
		}else if(mcl.getDownload_type().equals("2")){
			holder.text_mycard_num2.setText("短信");
		}
		return convertView;
	}
	class ViewHolder {
		ImageView image_pic;
		TextView text_mycard_name;
		TextView text_mycard_num;
		TextView text_mycard_num2;
	}
}
