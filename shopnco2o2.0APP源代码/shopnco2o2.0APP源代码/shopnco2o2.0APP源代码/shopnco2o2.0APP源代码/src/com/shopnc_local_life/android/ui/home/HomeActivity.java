/**
 * ClassName:HomeActivity.java
 * PackageName:com.shopnc_local_life.android.ui.home
 * Create On 2013-8-5下午1:41:01
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.home;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.ui.MainActivity;
import com.shopnc_local_life.android.ui.card.CardListActivity;
import com.shopnc_local_life.android.ui.city.CityActivity;

/**
 * Author:hjgang Create On 2013-8-5下午1:41:01 Site:http://weibo.com/hjgang or
 * http://t.qq.com/hjgang_ EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-5 hjgang All rights reserved.
 */
public class HomeActivity extends Activity {
	private TextView txt_city_id;
	private TextView text_more;
	private TextView text_btu_01;
	private TextView text_btu_02;
	private TextView text_btu_03;
	private TextView text_btu_04;
	private TextView text_btu_05;
//	private String city_name;
	private MyApp myApp;
	private LinearLayout lay_out_card;
	private LinearLayout lay_out_youhuiquan;
	private TextView text_search;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_home);
		myApp = (MyApp) HomeActivity.this.getApplication();
//		city_name=HomeActivity.this.getIntent().getStringExtra("city_name");
		txt_city_id=(TextView) findViewById(R.id.txt_city_id);
		lay_out_card= (LinearLayout) findViewById(R.id.lay_out_card);
		lay_out_youhuiquan =  (LinearLayout) findViewById(R.id.lay_out_youhuiquan);
		text_search = (TextView) findViewById(R.id.text_search);
		text_more = (TextView) findViewById(R.id.text_more);
		text_btu_01 = (TextView) findViewById(R.id.text_btu_01);
		text_btu_02 = (TextView) findViewById(R.id.text_btu_02);
		text_btu_03 = (TextView) findViewById(R.id.text_btu_03);
		text_btu_04 = (TextView) findViewById(R.id.text_btu_04);
		text_btu_05 = (TextView) findViewById(R.id.text_btu_05);
		
//		if(city_name!=null && !"".equals(city_name)){
//			txt_city_id.setText(city_name);
//		}
		
		text_more.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","2");
				it.putExtra("position",0);
				HomeActivity.this.startActivity(it);
			}
		});
		text_btu_01.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","2");
				it.putExtra("position",0);
				HomeActivity.this.startActivity(it);
			}
		});
		text_btu_02.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","3");
				it.putExtra("position",1);
				HomeActivity.this.startActivity(it);
			}
		});
		text_btu_03.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","7");
				it.putExtra("position",2);
				HomeActivity.this.startActivity(it);
			}
		});
		text_btu_04.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","26");
				it.putExtra("position",3);
				HomeActivity.this.startActivity(it);
			}
		});
		text_btu_05.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,MoreCategoryActivity.class);
				it.putExtra("class_id","27");
				it.putExtra("position",4);
				HomeActivity.this.startActivity(it);
			}
		});
		
		txt_city_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,CityActivity.class);
				it.putExtra("city_name", txt_city_id.getText().toString());
				HomeActivity.this.startActivity(it);
			}
		});
		lay_out_card.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,CardListActivity.class);
				HomeActivity.this.startActivity(it);
			}
		});
		lay_out_youhuiquan.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				myApp.getTabHost().setCurrentTab(2);
				myApp.getBtn_test2().setChecked(true);
			}
		});
		text_search.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent it=new Intent(HomeActivity.this,SearchActivity.class);
				HomeActivity.this.startActivity(it);
			}
		});
		if(myApp.getCity_name()!=null && !"".equals(myApp.getCity_name())){
			txt_city_id.setText(myApp.getCity_name());
		}else{
			Intent it=new Intent(HomeActivity.this,CityActivity.class);
			HomeActivity.this.startActivity(it);
			return ;
		}
	}
	@Override
	protected void onStart() {
		super.onStart();
		registerBoradcastReceiver();
	}
	@Override
	protected void onDestroy() {
		super.onDestroy();
		unregisterReceiver(mBroadcastReceiver);
	}
	private BroadcastReceiver mBroadcastReceiver = new BroadcastReceiver(){ 
        @Override 
        public void onReceive(Context context, Intent intent) { 
            String action = intent.getAction(); 
            if(action.equals(Constants.FLAG)){
            	String city_name=intent.getStringExtra("city_name");
            	if(city_name!=null && !"".equals(city_name)){
        			txt_city_id.setText(city_name);
        		}
            }
        } 
         
    }; 
    public void registerBoradcastReceiver(){ 
        IntentFilter myIntentFilter = new IntentFilter(); 
        myIntentFilter.addAction(Constants.FLAG); 
        //注册广播       
        registerReceiver(mBroadcastReceiver, myIntentFilter); 
    } 
    @Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		if (keyCode == KeyEvent.KEYCODE_BACK) {
			((MainActivity) HomeActivity.this.getParent()).dialog.show();
			return true;
		} else {
			return super.onKeyDown(keyCode, event);
		}
	}
}
