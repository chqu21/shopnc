/**
 * 
 */
package com.shopnc_local_life.android.ui.my;

import android.app.TabActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.RadioButton;
import android.widget.TabHost;

import com.shopnc_local_life.android.R;

/**
 * @author jingang
 *
 */
public class OrderTabItemActivity extends TabActivity{
	/** tab标签名*/
	public final static String TAB_TAG_TEST1 = "test1";
	public final static String TAB_TAG_TEST2 = "test2";
	public final static String TAB_TAG_TEST3 = "test3";
	private TabHost tabHost;
	/** 启动每个操作项的Intent */
	private Intent test1Intent;
	private Intent test2Intent;
	private Intent test3Intent;
	/** 界面上的各个单选按钮 */
	private RadioButton btn_test1;
	private RadioButton btn_test2;
	private RadioButton btn_test3;
	
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.order_tab_item);
		
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		
		test1Intent = new Intent(this, OrderFlagListActivity.class);
		test1Intent.putExtra("order_state","1");
		test2Intent = new Intent(this, OrderFlagListActivity.class);
		test2Intent.putExtra("order_state","2");
		test3Intent = new Intent(this, OrderFlagListActivity.class);
		test3Intent.putExtra("order_state","3");
		
		tabHost = this.getTabHost();
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST1).setIndicator(TAB_TAG_TEST1).setContent(test1Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST2).setIndicator(TAB_TAG_TEST2).setContent(test2Intent));
		tabHost.addTab(tabHost.newTabSpec(TAB_TAG_TEST3).setIndicator(TAB_TAG_TEST3).setContent(test3Intent));
		
		tabHost.setCurrentTab(0);
		////////////////////// find View ////////////////////////////
		btn_test1 = (RadioButton)this.findViewById(R.id.order_index_dingdan);
		btn_test2 = (RadioButton)this.findViewById(R.id.order_index_youhuiquan);
		btn_test3 = (RadioButton)this.findViewById(R.id.order_index_huiyuanka);
		
		MyRadioButtonClickListener listener = new MyRadioButtonClickListener();
		btn_test1.setOnClickListener(listener);
		btn_test2.setOnClickListener(listener);
		btn_test3.setOnClickListener(listener);
		
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				OrderTabItemActivity.this.finish();
			}
		});
	}
	
	class MyRadioButtonClickListener implements View.OnClickListener{
		public void onClick(View v) {
			RadioButton btn = (RadioButton)v;
			switch(btn.getId()){
			case R.id.order_index_dingdan:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST1);
				break;
			case R.id.order_index_youhuiquan:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST2);
				break;
			case R.id.order_index_huiyuanka:
				tabHost.setCurrentTabByTag(TAB_TAG_TEST3);
				break;
			}
		}
		}
}
