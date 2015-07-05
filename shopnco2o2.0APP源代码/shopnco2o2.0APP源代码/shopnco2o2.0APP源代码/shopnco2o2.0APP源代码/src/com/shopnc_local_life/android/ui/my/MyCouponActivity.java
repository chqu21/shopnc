package com.shopnc_local_life.android.ui.my;

import java.util.ArrayList;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AbsListView;
import android.widget.AbsListView.OnScrollListener;
import android.widget.ImageButton;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.MyCouponListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.MyCouponList;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.widget.PullView;
import com.shopnc_local_life.android.widget.PullView.OnRefreshListener;

/**
 * @author jingang
 */
public class MyCouponActivity extends Activity implements OnScrollListener {
	private PullView listview;
	private MyCouponListViewAdapter adapter;
	private ArrayList<MyCouponList> datas;
	private MyApp myApp;
	private int pageno = 1;
	private View moreView; // 加载更多页面
	private int lastItem;
	private boolean list_flag = false;
	private ImageButton btn_back_id;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.my_coupon_list);
		myApp = (MyApp) MyCouponActivity.this.getApplication();
		listview = (PullView) findViewById(R.id.listview);
		btn_back_id= (ImageButton) findViewById(R.id.btn_back_id);
		moreView = getLayoutInflater().inflate(R.layout.list_more_load, null);
		adapter = new MyCouponListViewAdapter(MyCouponActivity.this);
		datas = new ArrayList<MyCouponList>();
		listview.setAdapter(adapter);
		info_page_list(pageno = 1);
		listview.setOnScrollListener(this); //设置listview的滚动事件
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				MyCouponActivity.this.finish();
			}
		});
		listview.setonRefreshListener(new OnRefreshListener() {
			@Override
			public void onRefresh() {
				listview.removeFooterView(moreView);
				info_page_list(pageno=1);
			}
		});

	}

	public void info_page_list(int pangeno) {
		if (myApp.getMember_id() == null || myApp.getMember_id().equals("")
				|| myApp.getMember_id().equals("null")
				|| myApp.getMember_key() == null
				|| myApp.getMember_key().equals("")
				|| myApp.getMember_key().equals("null")) {
			listview.removeFooterView(moreView);
			listview.onRefreshComplete();
			Toast.makeText(MyCouponActivity.this, "您还没有登陆，请先登陆",
					Toast.LENGTH_SHORT).show();
			return;
		}

		String url = Constants.URL_MEMBER_COUPON + "&member_id="
				+ myApp.getMember_id() + "&sign=" + myApp.getMember_key()+"&pagenumber="+pangeno+"&pagesize="+Constants.PARAM_PAGESIZE;
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				listview.onRefreshComplete();
				if (data.getCode() == HttpStatus.SC_OK) {
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
						adapter.notifyDataSetChanged();
					}else{
						count = ((pageno-1)*Constants.PARAM_PAGESIZE);
					}
					listview.setSelection(count);
					ArrayList<MyCouponList> list = MyCouponList.newInstanceList(json);
					datas.addAll(list);
					adapter.setDatas(datas);
					adapter.notifyDataSetChanged();
				} else {
					listview.removeFooterView(moreView);
					Toast.makeText(MyCouponActivity.this, "加载数据失败，请稍后重试",
							Toast.LENGTH_SHORT).show();
				}
			}
		});
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

	// 声明Handler
	private Handler mHandler = new Handler() {
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0:
				pageno = pageno + 1;
				info_page_list(pageno); // 加载更多数据，这里可以使用异步加载
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
