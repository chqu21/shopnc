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
import android.content.Intent;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup.LayoutParams;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.common.SystemHelper;
import com.shopnc_local_life.android.modle.StoreComment;
import com.shopnc_local_life.android.ui.Store.CommentAllListActivity;
import com.shopnc_local_life.android.ui.Store.StoreDetailsActivity;
import com.shopnc_local_life.android.widget.MyGridView;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class StoreCommentListViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private ArrayList<StoreComment> datas;
	private StoreCommentListGridViewAdapter adapter;
	private String store_id;
	public StoreCommentListViewAdapter(Context context,String store_id) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
//		this.adapter = new StoreCommentListGridViewAdapter(context);
		this.store_id=store_id;
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

	public ArrayList<StoreComment> getDatas() {
		return datas;
	}
	public void setDatas(ArrayList<StoreComment> datas) {
		this.datas = datas;
	}
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.listview_store_comment_item, null);
			holder = new ViewHolder();
			holder.text_member_name=(TextView) convertView.findViewById(R.id.text_member_name);
			holder.text_person_cost=(TextView) convertView.findViewById(R.id.text_person_cost);
			holder.text_comment=(TextView) convertView.findViewById(R.id.text_comment);
			holder.text_comment_time=(TextView) convertView.findViewById(R.id.text_comment_time);
			holder.GridView=(MyGridView) convertView.findViewById(R.id.GridView);
			holder.image_avatar_bg =  (ImageView) convertView.findViewById(R.id.image_avatar_bg);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		StoreComment sc=datas.get(position);
		holder.text_member_name.setText(sc.getMember_name());
		holder.text_person_cost.setText(Html.fromHtml("人均：<font color='#E64D5F'>"+sc.getPerson_cost()+"</font>元"));
		holder.text_comment.setText(sc.getComment());
		holder.text_comment_time.setText(SystemHelper.getTimeStr(sc.getAdd_time()));
		MyAsynaTask myTask =new MyAsynaTask(sc.getAvatar(), holder.image_avatar_bg);
		myTask.execute();
		adapter = new StoreCommentListGridViewAdapter(context);
		holder.GridView.setAdapter(adapter);
		if(sc.getPhoto() ==null || sc.getPhoto().length == 1){
			holder.GridView.setNumColumns(1);
		}else{
			holder.GridView.setNumColumns(3);
		}
		if(sc.getPhoto()!=null){
			adapter.setDatas(sc.getPhoto());
		}
		adapter.notifyDataSetChanged();
		convertView.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if(store_id!=null && !store_id.equals("null") && !store_id.equals("")){
					Intent intent =new Intent(context, CommentAllListActivity.class);
					intent.putExtra("store_id", store_id);
					context.startActivity(intent);
				}
			}
		});
		
		return convertView;
	}
	class ViewHolder {
		TextView text_member_name;
		TextView text_person_cost;
		TextView text_comment;
		TextView text_comment_time;
		MyGridView GridView;
		ImageView image_avatar_bg;
	}
}
