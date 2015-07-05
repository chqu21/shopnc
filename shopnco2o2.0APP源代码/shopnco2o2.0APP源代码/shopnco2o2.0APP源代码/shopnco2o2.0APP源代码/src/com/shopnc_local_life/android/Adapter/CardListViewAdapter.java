/**
 * ClassName:CardListViewAdapter.java
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
import com.shopnc_local_life.android.modle.CardList;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class CardListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<CardList> datas;
	public CardListViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
	}
	@Override
	public int getCount() {
		return datas == null ? 0 : datas.size();
	}

	public ArrayList<CardList> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<CardList> datas) {
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
			convertView = inflater.inflate(R.layout.listview_card_item, null);
			holder = new ViewHolder();
			holder.text_card_name = (TextView) convertView.findViewById(R.id.text_card_name);
			holder.text_card_discount = (TextView) convertView.findViewById(R.id.text_card_discount);
			holder.text_card_address = (TextView) convertView.findViewById(R.id.text_card_address);
			holder.image_card_flag= (ImageView) convertView.findViewById(R.id.image_card_flag);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		CardList cl=datas.get(position);
		holder.text_card_name.setText(cl.getStore_name());
		holder.text_card_discount.setText("会员专享"+cl.getCard_discount()+"折");
		holder.text_card_address.setText(cl.getAddress());
		if(cl.getIs_store().equals("0")){
			holder.image_card_flag.setBackgroundResource(R.drawable.mc_addvip);
		}else if(cl.getIs_store().equals("1")){
			holder.image_card_flag.setBackgroundResource(R.drawable.mc_icon_joined);
		}
		return convertView;
	}
	class ViewHolder {
		TextView text_card_name;
		TextView text_card_discount;
		TextView text_card_address;
		ImageView image_card_flag;
	}
}
