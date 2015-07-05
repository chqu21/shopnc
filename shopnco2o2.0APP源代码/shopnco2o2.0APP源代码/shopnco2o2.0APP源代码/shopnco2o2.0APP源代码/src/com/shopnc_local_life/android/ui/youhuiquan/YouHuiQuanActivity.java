/**
 * ClassName:YouHuiQuanActivity.java
 * PackageName:com.shopnc_local_life.android.ui.youhuiquan
 * Create On 2013-8-26下午1:47:13
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@aliyun.com
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.youhuiquan;

import java.util.ArrayList;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.KeyEvent;
import android.view.View;
import android.widget.AbsListView;
import android.widget.AbsListView.OnScrollListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.YouHuiQuanListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.modle.YouHuiQuanList;
import com.shopnc_local_life.android.ui.MainActivity;
import com.shopnc_local_life.android.widget.ExpandTabView;
import com.shopnc_local_life.android.widget.PullView;
import com.shopnc_local_life.android.widget.ViewMiddle;
import com.shopnc_local_life.android.widget.PullView.OnRefreshListener;

/**
 * Author:hjgang
 * Create On 2013-8-26下午1:47:13
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-26 hjgang All rights reserved.
 */
public class YouHuiQuanActivity extends Activity implements OnScrollListener{
	private PullView listview;
	private YouHuiQuanListViewAdapter adapter;

	private ExpandTabView expandTabView;
	private ArrayList<View> mViewArray = new ArrayList<View>();
	private ArrayList<String> mTextArray = new ArrayList<String>();
	private ViewMiddle viewMiddle;
	private ViewMiddle view_l;
	private ViewMiddle view_r;
	
//	private MyProcessDialog dialog;
	private MyApp myApp;
	private int pageno=1;
	private View moreView; //加载更多页面
	private boolean list_flag=false;
	private int lastItem;
	private ArrayList<YouHuiQuanList> youhuiquan_list;
	private String flag;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_youhuiquan);
//		dialog =new MyProcessDialog(YouHuiQuanActivity.this);
		myApp = (MyApp) YouHuiQuanActivity.this.getApplication();
		listview = (PullView) findViewById(R.id.listview);
		moreView = getLayoutInflater().inflate(R.layout.list_more_load, null);
		adapter = new YouHuiQuanListViewAdapter(YouHuiQuanActivity.this);
		youhuiquan_list =new ArrayList<YouHuiQuanList>();
		listview.setAdapter(adapter);
		adapter.notifyDataSetChanged();
		listview.setOnScrollListener(this); //设置listview的滚动事件

		ListViewInFo(pageno=1);

		expandTabView = (ExpandTabView) findViewById(R.id.expandtab_view);
		viewMiddle = new ViewMiddle(this);
		view_l= new ViewMiddle(this);
		view_r= new ViewMiddle(this);
		
		
		mViewArray.add(viewMiddle);
		mViewArray.add(view_l);
		mViewArray.add(view_r);
		mTextArray.add("全部地区");
		mTextArray.add("全部分类");
		mTextArray.add("默认排序");
		expandTabView.setValue(mTextArray, mViewArray);

		viewMiddle.setOnSelectListener(new ViewMiddle.OnSelectListener() {

			@Override
			public void getValue(String showText) {

				onRefresh(viewMiddle, showText);

			}
		});
		listview.setonRefreshListener(new OnRefreshListener() {
			@Override
			public void onRefresh() {
				listview.removeFooterView(moreView);
				ListViewInFo(pageno=1);
			}
		});
		listview.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				YouHuiQuanList you=(YouHuiQuanList) listview.getItemAtPosition(arg2);
				Intent intent=new Intent(YouHuiQuanActivity.this,YouHuiQuanDetalisActivity.class);
				intent.putExtra("coupon_id", you.getCoupon_id()+"");
				YouHuiQuanActivity.this.startActivity(intent);
			}
		});
	}

	@Override
	protected void onResume() {
		super.onResume();
//		if(flag !=null && !flag.equals("0") && !flag.equals("")
//				&& !myApp.getCity_id().equals(flag)){
//			listview.addFooterView(moreView);
//			youhuiquan_list.clear();
//			adapter.notifyDataSetChanged();
//			ListViewInFo(1);
//		}
		if(!myApp.getCity_id().equals(flag) && !myApp.getCity_id().equals("0")){
			listview.addFooterView(moreView);
			youhuiquan_list.clear();
			adapter.notifyDataSetChanged();
			ListViewInFo(1);
		}
	}
	public void ListViewInFo(int pangeno) {
//		dialog.show();
		if(myApp.getCity_id() ==null || myApp.getCity_id().equals("0") || myApp.getCity_id().equals("")){
//			dialog.dismiss();
			Toast.makeText(YouHuiQuanActivity.this, "城市没有获取到，请稍后重试", Toast.LENGTH_SHORT).show();
			listview.removeFooterView(moreView);
			listview.onRefreshComplete();
			return ;
		}
		flag=myApp.getCity_id();
		String url=Constants.URL_COUPON_LIST+"&city_id="+myApp.getCity_id()+"&pagenumber="+pangeno+"&pagesize="+Constants.PARAM_PAGESIZE;
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
//				dialog.dismiss();
				listview.onRefreshComplete();
				if (data.getCode() == HttpStatus.SC_OK) {
					String json = data.getJson();
//					if(data.getCount() <= pageno * Constants.PARAM_PAGESIZE){
//						list_flag=true;
//						listview.removeFooterView(moreView);
//					}else{
//						list_flag=false;
//						moreView.setVisibility(View.VISIBLE);
//					}
					int count = 0;
					if(pageno == 1){
						youhuiquan_list.clear();
						adapter.notifyDataSetChanged();
					}else{
						count = ((pageno-1)*Constants.PARAM_PAGESIZE);
					}
					listview.setSelection(count);
					if(data.isHasMore()){
						list_flag=false;
						listview.addFooterView(moreView);
					}else{
						list_flag=true;
						listview.removeFooterView(moreView);
					}
					ArrayList<YouHuiQuanList> list = YouHuiQuanList.newInstanceList(json);
					youhuiquan_list.addAll(list);
					adapter.setDatas(youhuiquan_list);
					adapter.notifyDataSetChanged();
				} else {
					listview.removeFooterView(moreView);
					listview.onRefreshComplete();
					Toast.makeText(YouHuiQuanActivity.this, "加载优惠券列表失败，请稍后重试",
							Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	
	@Override
	public void onScroll(AbsListView view, int firstVisibleItem,
			int visibleItemCount, int totalItemCount) {
		lastItem = firstVisibleItem + visibleItemCount - 1;  //减1是因为上面加了个addFooterView
	}

	@Override
	public void onScrollStateChanged(AbsListView view, int scrollState) { 
		//下拉到空闲是，且最后一个item的数等于数据的总数时，进行更新
		if(lastItem == listview.getCount()-1  && scrollState == this.SCROLL_STATE_IDLE){ 
		    if(list_flag){
		    }else{
		    	mHandler.sendEmptyMessage(0);
		    }
		}
		
	}
	
	//声明Handler
			private Handler mHandler = new Handler(){
				public void handleMessage(android.os.Message msg) {
					switch (msg.what) {
					case 0:
						pageno=pageno+1;
						ListViewInFo(pageno); //加载更多数据，这里可以使用异步加载
						adapter.notifyDataSetChanged();
						
						break;
		           case 1:
						break;
					default:
						break;
					}
				};
			};
	private void onRefresh(View view, String showText) {

		expandTabView.onPressBack();
		int position = getPositon(view);
		if (position >= 0 && !expandTabView.getTitle(position).equals(showText)) {
			expandTabView.setTitle(showText, position);
		}
		Toast.makeText(YouHuiQuanActivity.this, showText, Toast.LENGTH_SHORT).show();

	}

	private int getPositon(View tView) {
		for (int i = 0; i < mViewArray.size(); i++) {
			if (mViewArray.get(i) == tView) {
				return i;
			}
		}
		return -1;
	}

	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		if (keyCode == KeyEvent.KEYCODE_BACK) {
//			if (!expandTabView.onPressBack()) {
//				finish();
//			}
			((MainActivity) YouHuiQuanActivity.this.getParent()).dialog.show();
			return true;
		} else {
			return super.onKeyDown(keyCode, event);
		}
	}
}
