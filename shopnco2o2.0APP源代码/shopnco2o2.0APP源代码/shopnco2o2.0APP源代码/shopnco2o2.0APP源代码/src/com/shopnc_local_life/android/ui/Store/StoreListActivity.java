/**
 * 
 */
package com.shopnc_local_life.android.ui.Store;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.util.ArrayList;

import org.apache.http.HttpStatus;
import org.apache.http.protocol.HTTP;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AbsListView;
import android.widget.AbsListView.OnScrollListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.StoreListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.modle.StoreList;
import com.shopnc_local_life.android.widget.MyProcessDialog;

/**
 * @author jingang
 */
public class StoreListActivity extends Activity implements OnScrollListener {
	private TextView textView_key;
	private TextView text_nono;
	private ListView listView;
	private String key;
	private StoreListViewAdapter adapter;
	
	private ArrayList<StoreList> datas;
	private int pageno = 1;
	private View moreView; // 加载更多页面
	private int lastItem;
	private boolean list_flag = false;
	
	private String url_flag;
	private String class_id;
	private MyApp myApp;
	
	private ImageButton btn_back_id;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.store_list);
		myApp= (MyApp) StoreListActivity.this.getApplication();
		key = StoreListActivity.this.getIntent().getStringExtra("key");
		url_flag = StoreListActivity.this.getIntent().getStringExtra("url_flag");
		class_id = StoreListActivity.this.getIntent().getStringExtra("class_id");
		listView = (ListView) findViewById(R.id.listview);
		textView_key = (TextView) findViewById(R.id.textView_key);
		text_nono = (TextView) findViewById(R.id.text_nono);
		btn_back_id =(ImageButton) findViewById(R.id.btn_back_id);
		moreView = getLayoutInflater().inflate(R.layout.list_more_load, null);
		textView_key.setText(key);
		adapter =new StoreListViewAdapter(StoreListActivity.this);
		datas =new ArrayList<StoreList>();
		listView.addFooterView(moreView);
		listView.setAdapter(adapter);
		
		listView.setOnScrollListener(this); //设置listview的滚动事件
		
		if(url_flag.equals("searchstore")){
			info_key_page_list(pageno = 1);
		}else if(url_flag.equals("storeclass")){
			info_storeclass_page_list(pageno = 1);
		}
		
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				StoreListActivity.this.finish();
			}
		});
		
		listView.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				StoreList sl=(StoreList) listView.getItemAtPosition(arg2);
				Intent intent =new Intent(StoreListActivity.this,StoreDetailsActivity.class);
				intent.putExtra("store_id", sl.getStore_id());
				StoreListActivity.this.startActivity(intent);
			}
		});
	}
	public void info_key_page_list(final int pangeno){
		if(key == null || key.equals("null")){
    		Toast.makeText(StoreListActivity.this, "没找到关键词", Toast.LENGTH_SHORT).show();
    		listView.removeFooterView(moreView);
    		text_nono.setVisibility(View.VISIBLE);
    		return ;
    	}
		
		String url = null;
		try {
			url = Constants.URL_SEARCHSTORE+"&keyword="+URLEncoder.encode(key, HTTP.UTF_8)+"&city_id="+myApp.getCity_id()+"&pagenumber="+pangeno+"&pagesize="+Constants.PARAM_PAGESIZE;
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		};
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					if(json.equals("[]")){
						text_nono.setVisibility(View.VISIBLE);
					}else{
						text_nono.setVisibility(View.GONE);
					}
					int count = 0;
					if(pangeno == 1){
						datas.clear();
						adapter.notifyDataSetChanged();
					}else{
						count = ((pangeno-1)*Constants.PARAM_PAGESIZE);
					}
					listView.setSelection(count);
					if(data.isHasMore()){
						list_flag=false;
						listView.addFooterView(moreView);
					}else{
						list_flag=true;
						listView.removeFooterView(moreView);
					}
					ArrayList<StoreList> sl = StoreList.newInstanceList(json);
					datas.addAll(sl);
					adapter.setDatas(datas);
					adapter.notifyDataSetChanged();
				}else{
					text_nono.setVisibility(View.VISIBLE);
					listView.removeFooterView(moreView);
					Toast.makeText(StoreListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	public void info_storeclass_page_list(final int pangeno){
		if( myApp.getCity_id() == null || myApp.getCity_id().equals("") || myApp.getCity_id().equals("null")
				|| myApp.getCity_id().equals("0")){
    		Toast.makeText(StoreListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
    		listView.removeFooterView(moreView);
    		text_nono.setVisibility(View.VISIBLE);
    		return ;
    	}
		if( class_id == null || class_id.equals("") || class_id.equals("null") || class_id.equals("0")){
    		Toast.makeText(StoreListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
    		listView.removeFooterView(moreView);
    		text_nono.setVisibility(View.VISIBLE);
    		return ;
    	}
		
		String url =  Constants.URL_STORECLASS_LIST+"&class_id="+class_id+"&city_id="+myApp.getCity_id()+"&pagenumber="+pangeno+"&pagesize="+Constants.PARAM_PAGESIZE;
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					if(json.equals("[]")){
						text_nono.setVisibility(View.VISIBLE);
					}else{
						text_nono.setVisibility(View.GONE);
					}
					int count = 0;
					if(pangeno == 1){
						datas.clear();
						adapter.notifyDataSetChanged();
					}else{
						count = ((pangeno-1)*Constants.PARAM_PAGESIZE);
					}
					listView.setSelection(count);
					if(data.isHasMore()){
						list_flag=false;
						listView.addFooterView(moreView);
					}else{
						list_flag=true;
						listView.removeFooterView(moreView);
					}
					ArrayList<StoreList> sl = StoreList.newInstanceList(json);
					datas.addAll(sl);
					adapter.setDatas(datas);
					adapter.notifyDataSetChanged();
				}else{
					text_nono.setVisibility(View.VISIBLE);
					listView.removeFooterView(moreView);
					Toast.makeText(StoreListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	@Override
	public void onScrollStateChanged(AbsListView view, int scrollState) {
		// 下拉到空闲是，且最后一个item的数等于数据的总数时，进行更新
		if (lastItem == listView.getCount() - 1
				&& scrollState == this.SCROLL_STATE_IDLE) {
			if (list_flag) {
			} else {
				mHandler.sendEmptyMessage(0);
			}
		}

	}

	// 声明Handler
	private Handler mHandler = new Handler() {
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0:
				pageno = pageno + 1;
//				info_page_list(pageno); // 加载更多数据，这里可以使用异步加载
				if(url_flag.equals("searchstore")){
					info_key_page_list(pageno = 1);
				}else if(url_flag.equals("storeclass")){
					info_storeclass_page_list(pageno = 1);
				}
				adapter.notifyDataSetChanged();

				break;
			case 1:
				break;
			default:
				break;
			}
		};
	};

	@Override
	public void onScroll(AbsListView view, int firstVisibleItem,
			int visibleItemCount, int totalItemCount) {
		lastItem = firstVisibleItem + visibleItemCount - 1; // 减1是因为上面加了个addFooterView
	}
}
