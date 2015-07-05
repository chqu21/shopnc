package com.shopnc_local_life.android.Adapter;

import java.util.ArrayList;
import java.util.HashMap;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.shopnc_local_life.android.R;

/**
 * ListView选项带子菜单样式的适配器<br/>
 * 注意：此类使用ListView每个选项中前置图标在R类中的标识值(R.drawable.xxx)作为选项的ID值
 * @author hjgang
 */
public class SubmenuListViewAdapter extends BaseAdapter {
	/**  */
	public static final String TAG_ITEM_TEXT = "text";
	/**  */
	public static final String TAG_ITEM_ICON = "icon";
	
	private ArrayList<HashMap<String, Object>> datas;
	private int size;
	private LayoutInflater inflater;
	/**
	 * 构造方法
	 * @param ctx
	 */
	public SubmenuListViewAdapter(Context ctx, ArrayList<HashMap<String, Object>> datas){
		inflater = LayoutInflater.from(ctx);
		this.datas = datas;
		size = datas == null ? 0 : datas.size();
	}

	public int getCount() {
		return size;
	}

	public Object getItem(int index) {
		return datas.get(index);
	}

	public long getItemId(int index) {
		HashMap<String, Object> item = datas.get(index);
		
		Integer icon_id = (Integer)item.get(TAG_ITEM_ICON);
		if(icon_id != null){
			return icon_id.intValue();
		}else{
			return index;
		}
	}

	public View getView(int position, View convertView, ViewGroup parent) {
		if (convertView == null) {
			convertView = inflater.inflate(R.layout.listview_item_icon_text_icon, null);
		}
		
		ImageView iv = (ImageView)convertView.findViewById(R.id.item_image);
		TextView tv = (TextView)convertView.findViewById(R.id.item_text);
		HashMap<String, Object> item = datas.get(position);
		iv.setImageResource(((Integer)item.get(TAG_ITEM_ICON)).intValue());
		tv.setText((String)item.get(TAG_ITEM_TEXT));
		if(size == 1){
			convertView.setBackgroundResource(R.drawable.list_item_single);
		}else if(position == 0){
			convertView.setBackgroundResource(R.drawable.list_item_first);
		}else if(position == size - 1){
			convertView.setBackgroundResource(R.drawable.list_item_last);
		}else{
			convertView.setBackgroundResource(R.drawable.list_item_plain);
		}
		
		return convertView;
	}
}
