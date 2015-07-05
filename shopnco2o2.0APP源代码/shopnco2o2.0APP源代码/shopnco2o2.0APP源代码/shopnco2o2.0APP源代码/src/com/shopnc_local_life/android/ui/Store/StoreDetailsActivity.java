/**
 * 
 */
package com.shopnc_local_life.android.ui.Store;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.text.Html;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.StoreCommentListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyAsynaTask;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.modle.StoreComment;
import com.shopnc_local_life.android.modle.StoreDetails;
import com.shopnc_local_life.android.widget.MyListView;
import com.shopnc_local_life.android.widget.MyProcessDialog;

/**
 * @author jingang
 *
 */
public class StoreDetailsActivity extends Activity{
	private String store_id;
	private TextView text_store_name;
	private TextView text_tuan_person_consume;
	private TextView text_business_hour;
	private TextView text_store_address;
	private TextView text_store_telephone;
	private TextView text_bus;
	private TextView text_subway;
	private ImageView image_logo_pic;
	private MyListView listView;
	private StoreCommentListViewAdapter adapter; 
	private ImageButton btn_dianping;
	private String store_name;
	private ImageButton btn_back_id;
	private LinearLayout lay_out_top;
	private MyProcessDialog dialog; 
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.store_details);
		dialog = new MyProcessDialog(StoreDetailsActivity.this);
		store_id = StoreDetailsActivity.this.getIntent().getStringExtra("store_id");
		text_store_name = (TextView) findViewById(R.id.text_store_name);
		text_tuan_person_consume = (TextView) findViewById(R.id.text_tuan_person_consume);
		text_business_hour = (TextView) findViewById(R.id.text_business_hour);
		text_store_address = (TextView) findViewById(R.id.text_store_address);
		text_store_telephone = (TextView) findViewById(R.id.text_store_telephone);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		text_bus = (TextView) findViewById(R.id.text_bus);
		text_subway = (TextView) findViewById(R.id.text_subway);
		image_logo_pic = (ImageView) findViewById(R.id.image_logo_pic);
		listView = (MyListView) findViewById(R.id.listview);
		btn_dianping = (ImageButton) findViewById(R.id.btn_dianping);
		lay_out_top = (LinearLayout) findViewById(R.id.lay_out_top);
		lay_out_top.setFocusable(true);///////解决scrollView问题 打开activity之后
		lay_out_top.setFocusableInTouchMode(true);////屏幕初始位置不是顶部 而是在中间 
		lay_out_top.requestFocus(); ////也就是scroll滚动条不在上面 而是在中间的问题
		adapter =new StoreCommentListViewAdapter(StoreDetailsActivity.this,store_id);
		listView.setAdapter(adapter);
		info();
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				StoreDetailsActivity.this.finish();
			}
		});
		btn_dianping.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent intent =new Intent(StoreDetailsActivity.this, AddCommentActivity.class);
				intent.putExtra("store_name", store_name);
				intent.putExtra("store_id", store_id);
				StoreDetailsActivity.this.startActivity(intent);
			}
		});
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
            	info();
            }
        } 
         
    }; 
    public void registerBoradcastReceiver(){ 
        IntentFilter myIntentFilter = new IntentFilter(); 
        myIntentFilter.addAction(Constants.FLAG); 
        //注册广播       
        registerReceiver(mBroadcastReceiver, myIntentFilter); 
    } 
	public void info(){
		dialog.show();
		String url = Constants.URL_STORE_DETAILS+"&store_id="+store_id;
		System.out.println("url-->"+url);
    	RemoteDataHandler.asyncGet2(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if(data.getCode() == HttpStatus.SC_OK){
					  String json = data.getJson();
					  StoreDetails sd = StoreDetails.newInstance(json);
					  text_store_name.setText(sd.getStore_name());
					  store_name = sd.getStore_name();
					  text_tuan_person_consume.setText(Html.fromHtml("人均:<font color='#E64D5E'>"+sd.getPerson_consume()+"</font>元"));
					  text_business_hour.setText(sd.getBusiness_hour());
					  text_store_address.setText(sd.getAddress());
					  text_store_telephone.setText(sd.getTelephone());
					  text_bus.setText("公交:"+sd.getBus());
					  text_subway.setText("地铁:"+sd.getSubway());
					  MyAsynaTask myAsynaTask=new MyAsynaTask(sd.getLogo(), image_logo_pic);
					  myAsynaTask.execute();
					  adapter.setDatas(StoreComment.newInstanceList(sd.getComment()));
					  adapter.notifyDataSetChanged();
				}else{
					Toast.makeText(StoreDetailsActivity.this, "加载数据失败，请稍后重试", Toast.LENGTH_SHORT).show();
		    		return ;
				}
			}
		});
	}
}
