/**
 * 
 */
package com.shopnc_local_life.android.ui.Store;

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
import android.widget.ListView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.StoreCommentListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.modle.StoreComment;
/**
 * @author jingang
 *
 */
public class CommentAllListActivity extends Activity implements OnScrollListener {
	private ListView listview;
	private StoreCommentListViewAdapter adapter;
	private ArrayList<StoreComment> datas;
	private int pageno = 1;
	private View moreView; // 加载更多页面
	private int lastItem;
	private boolean list_flag = false;
	private String store_id;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.comment_all_list);
		store_id = CommentAllListActivity.this.getIntent().getStringExtra("store_id");
		listview = (ListView) findViewById(R.id.listview);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		moreView = getLayoutInflater().inflate(R.layout.list_more_load, null);
		adapter=new StoreCommentListViewAdapter(CommentAllListActivity.this,null);
		datas =new ArrayList<StoreComment>();
		listview.addFooterView(moreView);
		listview.setAdapter(adapter);
		listview.setOnScrollListener(CommentAllListActivity.this);
		info_page_list(pageno = 1);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				CommentAllListActivity.this.finish();
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
	public void info_page_list(int pangeno){
		String url=Constants.URL_STORE_ALL_COMMENT+"&store_id="+store_id+"&pagenumber="+pangeno+"&pagesize=5";
		RemoteDataHandler.asyncGet(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					int count = 0;
					if(pageno == 1){
						datas.clear();
						adapter.notifyDataSetChanged();
					}else{
						count = ((pageno-1)*Constants.PARAM_PAGESIZE);
					}
					if(data.isHasMore()){
						list_flag=false;
						listview.removeFooterView(moreView);
						listview.addFooterView(moreView);
					}else{
						list_flag=true;
						listview.removeFooterView(moreView);
					}
					listview.setSelection(count);
					ArrayList<StoreComment> list = StoreComment.newInstanceList(json);
					datas.addAll(list);
					adapter.setDatas(datas);
					adapter.notifyDataSetChanged();
				}else{
					listview.removeFooterView(moreView);
					Toast.makeText(CommentAllListActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
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
}
