/**
 * ClassName:CityActivity.java
 * PackageName:com.shopnc_local_life.android.ui.city
 * Create On 2013-8-6上午10:03:45
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.city;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.GetCityHendListAdapter;
import com.shopnc_local_life.android.Adapter.GetCityListAdapter;
import com.shopnc_local_life.android.common.Cheeses;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.common.PingYinUtil;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.City;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.widget.MyLetterListView;
import com.shopnc_local_life.android.widget.MyLetterListView.OnTouchingLetterChangedListener;
import com.shopnc_local_life.android.widget.MyListView;
import com.shopnc_local_life.android.widget.MyProcessDialog;
import com.shopnc_local_life.android.widget.PinnedHeaderListView;

/**
 * Author:hjgang Create On 2013-8-6上午10:03:45 Site:http://weibo.com/hjgang or
 * http://t.qq.com/hjgang_ EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class CityActivity extends Activity {
	private PinnedHeaderListView mDisPlay;
	private MyLetterListView mMyLetterListView;
	private TextView mOverlay;
	private GetCityListAdapter myAdapter;
	private GetCityHendListAdapter mylistAdapter;
	private OverlayThread mOverlayThread;
	private ArrayList<City> list = new ArrayList<City>();
	private Map<String, Integer> mPageFirstNamePosition = new HashMap<String, Integer>();
	private RelativeLayout rt;
	private String city_name;
	private ImageButton btn_back_id;
	private MyProcessDialog dialog;
	private LinearLayout lay_out;
	private MyListView mylistview;
	private ArrayList<City> H_list = new ArrayList<City>();
	private MyApp myApp;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.city_list_view);
		city_name = CityActivity.this.getIntent().getStringExtra("city_name");
		rt = (RelativeLayout) findViewById(R.id.rt);
		myApp =(MyApp) CityActivity.this.getApplication();
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		mDisPlay = (PinnedHeaderListView) findViewById(R.id.page_display);
		mMyLetterListView = (MyLetterListView) findViewById(R.id.page_myletterlistview);
		dialog=new MyProcessDialog(CityActivity.this);
		mOverlayThread = new OverlayThread();
		LayoutInflater inflater = LayoutInflater.from(CityActivity.this);
		mOverlay = (TextView) inflater.inflate(R.layout.friends_overlay, null);
		lay_out = (LinearLayout) inflater.inflate(R.layout.listview_city_hend, null);
		mylistview = (MyListView) lay_out.findViewById(R.id.mylistview);
		mDisPlay.addHeaderView(lay_out);
		mOverlay.setVisibility(View.INVISIBLE);
		RelativeLayout.LayoutParams lp = new RelativeLayout.LayoutParams(
				LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT);
		lp.addRule(RelativeLayout.CENTER_VERTICAL, RelativeLayout.TRUE);
		lp.addRule(RelativeLayout.CENTER_HORIZONTAL, RelativeLayout.TRUE);
		rt.addView(mOverlay, lp);
		myAdapter = new GetCityListAdapter(CityActivity.this);
		mylistAdapter =new GetCityHendListAdapter(CityActivity.this);
		myAdapter.setList(list);
		mylistAdapter.setList(H_list);
		mDisPlay.setAdapter(myAdapter);
		mylistview.setAdapter(mylistAdapter);
		myAdapter.notifyDataSetChanged();
		mDisPlay.setOnScrollListener(myAdapter);
		ListViewInFo();
		
		mDisPlay.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				City city = (City) mDisPlay.getItemAtPosition(position);
				myApp.setCity_id(""+city.getArea_id());
				if (CityActivity.this.city_name != null
						&& CityActivity.this.city_name.equals(city.getArea_name())
						&& !"".equals(CityActivity.this.city_name)) {
					CityActivity.this.finish();
					myApp.setCity_id_flag(false);
				} else {
					Intent mIntent = new Intent(Constants.FLAG);
					mIntent.putExtra("city_name", city.getArea_name());
					sendBroadcast(mIntent); // 发送广播
					CityActivity.this.finish();
					myApp.setCity_id_flag(true);
					myApp.setCity_name(city.getArea_name());
				}
			}
		});
		mylistview.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				City city = (City) mylistview.getItemAtPosition(position);
				myApp.setCity_id(""+city.getArea_id());
				if (CityActivity.this.city_name != null
						&& CityActivity.this.city_name.equals(city.getArea_name())
						&& !"".equals(CityActivity.this.city_name)) {
					CityActivity.this.finish();
					myApp.setCity_id_flag(false);
				} else {
					Intent mIntent = new Intent(Constants.FLAG);
					mIntent.putExtra("city_name", city.getArea_name());
					sendBroadcast(mIntent); // 发送广播
					CityActivity.this.finish();
					myApp.setCity_id_flag(true);
					myApp.setCity_name(city.getArea_name());
				}
			}
		});
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				CityActivity.this.finish();
			}
		});
		mMyLetterListView.setOnTouchingLetterChangedListener(new OnTouchingLetterChangedListener() {
					public void onTouchingLetterChanged(String s) {
						if(s.equals("热门")){
							mDisPlay.setSelection(0);
						}else if (mPageFirstNamePosition.get(s.toLowerCase()) != null) {
							Cheeses.flag = true;
							mDisPlay.setSelection(mPageFirstNamePosition.get(s.toLowerCase())+1);
						}
						mOverlay.setText(s);
						mOverlay.setVisibility(View.VISIBLE);
						handler.removeCallbacks(mOverlayThread);
						handler.postDelayed(mOverlayThread, 800);
					}
				});
	}

	private class OverlayThread implements Runnable {

		public void run() {
			mOverlay.setVisibility(View.GONE);
		}
	}
	public void ListViewInFo() {

		dialog.show();
		RemoteDataHandler.asyncGet(Constants.URL_GET_CITY, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if (data.getCode() == HttpStatus.SC_OK) {
					String json = data.getJson();
					ArrayList<City> city_list = City.newInstanceList(json);
					for (int i = 0; i < city_list.size(); i++) {
						// Arrays.sort(Cheeses.city_Str);
						City city = city_list.get(i);
						if(city.getHot_city().equals("1")){
							H_list.add(city);
						}else{
							String zhuanhan = new PingYinUtil().getFrist(city
									.getArea_name());
							if (mPageFirstNamePosition.get(zhuanhan) == null) {
								mPageFirstNamePosition.put(zhuanhan, i);
							}
						}
					}
					myAdapter.setList(city_list);
					mylistAdapter.setList(H_list);
					myAdapter.notifyDataSetChanged();
					mylistAdapter.notifyDataSetChanged();
				} else {
					Toast.makeText(CityActivity.this, "加载城市列表失败，请稍后重试",
							Toast.LENGTH_SHORT).show();
				}
			}
		});

	}

	Handler handler = new Handler() {
		public void handleMessage(Message msg) {
			super.handleMessage(msg);
			myAdapter.notifyDataSetChanged();
		}
	};
}
