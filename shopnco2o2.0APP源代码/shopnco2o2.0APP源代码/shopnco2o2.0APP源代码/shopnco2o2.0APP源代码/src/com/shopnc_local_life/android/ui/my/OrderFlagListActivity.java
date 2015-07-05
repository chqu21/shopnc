package com.shopnc_local_life.android.ui.my;

import java.util.ArrayList;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.AbsListView;
import android.widget.AbsListView.OnScrollListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.MyOrderListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.OrderFlagList;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.ui.tuan.ConfirmOrderActivity;
import com.shopnc_local_life.android.widget.PullView;
import com.shopnc_local_life.android.widget.PullView.OnRefreshListener;

/**
 * @author jingang
 */
public class OrderFlagListActivity extends Activity  implements OnScrollListener{
	private String order_state;
	private MyOrderListViewAdapter adapter;
	private PullView listview ;
	private MyApp myApp;
	private ArrayList<OrderFlagList> datas;
	private int pageno=1;
	private View moreView; //加载更多页面
	private boolean list_flag=false;
	private int lastItem;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.order_weishiyong_list);
		myApp = (MyApp) OrderFlagListActivity.this.getApplication();
		listview = (PullView) findViewById(R.id.listview);
		order_state = OrderFlagListActivity.this.getIntent().getStringExtra("order_state");
		moreView = getLayoutInflater().inflate(R.layout.list_more_load, null);
		adapter = new MyOrderListViewAdapter(OrderFlagListActivity.this);
		datas= new ArrayList<OrderFlagList>();
		listview.setAdapter(adapter);
		listview.setOnScrollListener(this); //设置listview的滚动事件
		info_page_list();
		listview.setonRefreshListener(new OnRefreshListener() {
			@Override
			public void onRefresh() {
				pageno=1;
				listview.removeFooterView(moreView);
				info_page_list();
			}
		});
		listview.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				if(order_state.equals("1")){
					OrderFlagList ofl=(OrderFlagList) listview.getItemAtPosition(arg2);
					send_order(ofl.getOrder_sn());
				}
			}
		});
	}
	public void send_order(String order_sn){
		if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
    		Toast.makeText(OrderFlagListActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
    		return ;
    	} 
		String url = Constants.URL_REPAYMENT+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key()+"&order_sn="+order_sn;
		RemoteDataHandler.asyncGet3(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					Toast.makeText(OrderFlagListActivity.this, "提交订单成功",Toast.LENGTH_SHORT).show();
					Intent intent =new Intent(OrderFlagListActivity.this,ConfirmOrderActivity.class);
					intent.putExtra("json", json);
					OrderFlagListActivity.this.startActivity(intent);
				}else{
					Toast.makeText(OrderFlagListActivity.this, "提交订单失败，请稍后重试",Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	@Override
	public void onScroll(AbsListView view, int firstVisibleItem,
			int visibleItemCount, int totalItemCount) {
		lastItem = firstVisibleItem + visibleItemCount - 1; // 减1是因为上面加了个addFooterView
	}
	@Override
	public void onScrollStateChanged(AbsListView view, int scrollState) {
		// 下拉到空闲是，且最后一个item的数等于数据的总数时，进行更新
		if (lastItem == listview.getCount() - 1
				&& scrollState == this.SCROLL_STATE_IDLE) {
			if (list_flag) {
			} else {
				mHandler.sendEmptyMessage(0);
			}
		}

	}
	public void info_page_list(){
		if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
			listview.removeFooterView(moreView);
			Toast.makeText(OrderFlagListActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
			listview.onRefreshComplete();
    		return ;
    	}
		if(order_state.equals("") || order_state.equals("null") || order_state == null){
			listview.removeFooterView(moreView);
			Toast.makeText(OrderFlagListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
			listview.onRefreshComplete();
    		return ;
		}
		String url=Constants.URL_MEMBER_ORDER+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key()+"&state="+order_state+"&pagenumber="+pageno+"&pagesize="+Constants.PARAM_PAGESIZE;
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				listview.onRefreshComplete();
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					if(data.isHasMore()){
						list_flag=false;
						listview.addFooterView(moreView);
					}else{
						list_flag=true;
						listview.removeFooterView(moreView);
					}
					int count = 0;
					if(pageno == 1){
						datas.clear();
					}else{
						count = ((pageno-1)*Constants.PARAM_PAGESIZE);
					}
					listview.setSelection(count);
					ArrayList<OrderFlagList> ofl_datas = OrderFlagList.newInstanceList(json);
					datas.addAll(ofl_datas);
					adapter.setDatas(datas);
					adapter.notifyDataSetChanged();
				}else{
					listview.removeFooterView(moreView);
					Toast.makeText(OrderFlagListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}

	// 声明Handler
	private Handler mHandler = new Handler() {
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0:
				pageno = pageno + 1;
				info_page_list(); // 加载更多数据，这里可以使用异步加载
				adapter.notifyDataSetChanged();

				break;
			case 1:
				break;
			default:
				break;
			}
		};
	};
}
