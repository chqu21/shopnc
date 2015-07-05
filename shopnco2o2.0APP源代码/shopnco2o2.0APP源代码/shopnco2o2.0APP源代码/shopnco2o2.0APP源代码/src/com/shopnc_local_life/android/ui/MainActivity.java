package com.shopnc_local_life.android.ui;

import android.app.TabActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.RadioButton;
import android.widget.TabHost;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.ui.home.HomeActivity;
import com.shopnc_local_life.android.ui.more.MoreActivity;
import com.shopnc_local_life.android.ui.my.MyActivity;
import com.shopnc_local_life.android.ui.topic.TopicActivity;
import com.shopnc_local_life.android.ui.tuan.TuanAcitivity;
import com.shopnc_local_life.android.ui.youhuiquan.YouHuiQuanActivity;
import com.shopnc_local_life.android.widget.MyMainOutDialog;

public class MainActivity extends TabActivity{
	/** tab标签名*/
	public final static String TAB_TAG_HOME = "home";
	public final static String TAB_TAG_TEST1 = "test1";
	public final static String TAB_TAG_TEST2 = "test2";
	public final static String TAB_TAG_TEST3 = "test3";
	public final static String TAB_TAG_TEST4 = "test4";
	public final static String TAB_TAG_TEST5 = "test5";
	
	private TabHost tabHost;
	
	/** 启动每个操作项的Intent */
	private Intent homeIntent;
	private Intent test1Intent;
	private Intent test2Intent;
	private Intent test3Intent;
	private Intent test4Intent;
	private Intent test5Intent;
	
	/** 界面上的各个单选按钮 */
	private RadioButton btn_home;
	private RadioButton btn_test1;
	private RadioButton btn_test2;
	private RadioButton btn_test3;
	private RadioButton btn_test4;
	private RadioButton btn_test5;
	
	private String city_name;
	
	private MyApp myApp; 
	
	public MyMainOutDialog dialog;
	
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_main);
		
		myApp = (MyApp) MainActivity.this.getApplication();
		
		dialog=new MyMainOutDialog(MainActivity.this);
		
		city_name=MainActivity.this.getIntent().getStringExtra("city_name");
		
		homeIntent = new Intent(this, HomeActivity.class);
		homeIntent.putExtra("city_name", city_name);
		test1Intent = new Intent(this, TuanAcitivity.class);
		test2Intent = new Intent(this, YouHuiQuanActivity.class);
		test3Intent = new Intent(this, MyActivity.class);
		test4Intent = new Intent(this, MoreActivity.class);
		test5Intent = new Intent(this, TopicActivity.class);
		
		tabHost = this.getTabHost();
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_HOME).setIndicator(TAB_TAG_HOME).setContent(homeIntent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST1).setIndicator(TAB_TAG_TEST1).setContent(test1Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST2).setIndicator(TAB_TAG_TEST2).setContent(test2Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST3).setIndicator(TAB_TAG_TEST3).setContent(test3Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST4).setIndicator(TAB_TAG_TEST4).setContent(test4Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST5).setIndicator(TAB_TAG_TEST5).setContent(test5Intent));
		
		tabHost.setCurrentTab(0);
		////////////////////// find View ////////////////////////////
		btn_home = (RadioButton)this.findViewById(R.id.main_index_search);
		btn_test1 = (RadioButton)this.findViewById(R.id.main_index_tuan);
		btn_test2 = (RadioButton)this.findViewById(R.id.main_index_checkin);
		btn_test3 = (RadioButton)this.findViewById(R.id.main_index_my);
		btn_test4 = (RadioButton)this.findViewById(R.id.main_index_more);
		btn_test5 = (RadioButton)this.findViewById(R.id.main_index_topic);
		
		myApp.setFirst_start_flag("1");
		myApp.setTabHost(tabHost);
		myApp.setBtn_test2(btn_test2);
		
		MyRadioButtonClickListener listener = new MyRadioButtonClickListener();
		btn_home.setOnClickListener(listener);
		btn_test1.setOnClickListener(listener);
		btn_test2.setOnClickListener(listener);
		btn_test3.setOnClickListener(listener);
		btn_test4.setOnClickListener(listener);
		btn_test5.setOnClickListener(listener);
		
		dialog.text_btu_on.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				MainActivity.this.finish();
			}
		});
		dialog.text_btu_off.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				dialog.dismiss();
			}
		});
		
	}
	
//	@Override
//	protected void onStart() {
//		super.onStart();
//		registerBoradcastReceiver();
//	}
//	@Override
//	protected void onDestroy() {
//		super.onDestroy();
//		unregisterReceiver(mBroadcastReceiver);
//	}
//	private BroadcastReceiver mBroadcastReceiver = new BroadcastReceiver(){ 
//        @Override 
//        public void onReceive(Context context, Intent intent) { 
//            String action = intent.getAction(); 
//            if(action.equals(Constants.FLAG)){
//            	String city_name=intent.getStringExtra("city_name");
//            	if(city_name.equals("北京首都")){
//            		btn_home.setVisibility(View.VISIBLE);
//            		btn_test1.setVisibility(View.VISIBLE);
//            		btn_test2.setVisibility(View.VISIBLE);
//            		btn_test3.setVisibility(View.VISIBLE);
//            		btn_test4.setVisibility(View.VISIBLE);
//            		btn_test5.setVisibility(View.GONE);
//        		}else if(city_name.equals("上海虹桥")){
//        			btn_home.setVisibility(View.VISIBLE);
//            		btn_test1.setVisibility(View.VISIBLE);
//            		btn_test2.setVisibility(View.GONE);
//            		btn_test3.setVisibility(View.VISIBLE);
//        			btn_test4.setVisibility(View.VISIBLE);
//        			btn_test5.setVisibility(View.VISIBLE);
//        		}else if(city_name.equals("澳门")){
//        			btn_test1.setVisibility(View.GONE);
//        			btn_test2.setVisibility(View.GONE);
//        			btn_home.setVisibility(View.VISIBLE);
//            		btn_test3.setVisibility(View.VISIBLE);
//            		btn_test4.setVisibility(View.VISIBLE);
//            		btn_test5.setVisibility(View.VISIBLE);
//        		}else{
//        			btn_home.setVisibility(View.VISIBLE);
//            		btn_test1.setVisibility(View.VISIBLE);
//            		btn_test2.setVisibility(View.VISIBLE);
//            		btn_test3.setVisibility(View.VISIBLE);
//        			btn_test4.setVisibility(View.VISIBLE);
//        			btn_test5.setVisibility(View.GONE);
//        		}
//            }
//        } 
//         
//    }; 
//    public void registerBoradcastReceiver(){ 
//        IntentFilter myIntentFilter = new IntentFilter(); 
//        myIntentFilter.addAction(Constants.FLAG); 
//        //注册广播       
//        registerReceiver(mBroadcastReceiver, myIntentFilter); 
//    } 
	class MyRadioButtonClickListener implements View.OnClickListener{
		public void onClick(View v) {
			RadioButton btn = (RadioButton)v;
			switch(btn.getId()){
			case R.id.main_index_search:
				tabHost.setCurrentTabByTag(TAB_TAG_HOME);
				break;
			case R.id.main_index_tuan:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST1);
				break;
			case R.id.main_index_checkin:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST2);
				break;
			case R.id.main_index_my:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST3);
				break;
			case R.id.main_index_more:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST4);
				break;
			case R.id.main_index_topic:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST5);
				break;
			}
		}
	}
}