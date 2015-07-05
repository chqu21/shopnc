package com.shopnc_local_life.android.ui.tuan;

import java.util.HashMap;

import org.apache.http.HttpStatus;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.ui.Store.AddCommentActivity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

public class SubmitOrderActivity extends Activity{
	private String group_price;
	private String group_name;
	private String group_id;
	private String buyer_limit;
	private TextView text_order_name;
	private TextView text_order_number;
	private TextView text_order_count;
	private ImageButton image_btu_jian;
	private ImageButton image_btu_jia;
	private int number=1;
	private Button btu_order_submit;
	private MyApp myApp;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.submit_order_view);
		myApp=(MyApp) SubmitOrderActivity.this.getApplication();
		group_price = SubmitOrderActivity.this.getIntent().getStringExtra("group_price");
		group_name = SubmitOrderActivity.this.getIntent().getStringExtra("group_name");
		group_id = SubmitOrderActivity.this.getIntent().getStringExtra("group_id");
		buyer_limit = SubmitOrderActivity.this.getIntent().getStringExtra("buyer_limit");
		
		text_order_name = (TextView) findViewById(R.id.text_order_name);
		text_order_number = (TextView) findViewById(R.id.text_order_number);
		text_order_count = (TextView) findViewById(R.id.text_order_count);
		image_btu_jian = (ImageButton) findViewById(R.id.image_btu_jian);
		image_btu_jia = (ImageButton) findViewById(R.id.image_btu_jia);
		btu_order_submit = (Button) findViewById(R.id.btu_order_submit);
		btn_back_id= (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				SubmitOrderActivity.this.finish();
			}
		});
		
		text_order_name.setText(group_name.equals("null")  ? "" : group_name );
		text_order_number.setText(number+"");
		text_order_count.setText("￥"+Double.parseDouble(group_price.equals("null")  ? "0" : group_price)*number);
		if(number <= 1){
			image_btu_jian.setBackgroundResource(R.drawable.btn_minus_pressed);
		}
		
		btu_order_submit.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if(group_id == null || group_id.equals("") || group_id.equals("null")){
					Toast.makeText(SubmitOrderActivity.this, "提交订单失败，请稍后重试",Toast.LENGTH_SHORT).show();
					return ;
				}
				if(number == 0){
					Toast.makeText(SubmitOrderActivity.this, "提交订单失败，请稍后重试",Toast.LENGTH_SHORT).show();
					return ;
				}
				send_order();
			}
		});
		image_btu_jia.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				number= number+1;
				if(number <= Integer.parseInt(buyer_limit) ){
					if(number >= 1){
						image_btu_jian.setBackgroundResource(R.drawable.btn_minus_normal);
						text_order_number.setText(number+"");
						text_order_count.setText("￥"+Double.parseDouble(group_price.equals("null")  ? "0" : group_price)*number);
					}
				}else{
					number = number-1;
					image_btu_jia.setBackgroundResource(R.drawable.btn_plus_pressed);
					Toast.makeText(SubmitOrderActivity.this, "您的购买数量已到达上限",Toast.LENGTH_SHORT).show();
				}
			}
		});
		image_btu_jian.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				number= number-1;
				if(number <= Integer.parseInt(buyer_limit)){
					image_btu_jia.setBackgroundResource(R.drawable.btn_plus_normal);
				}
				if(number > 1){
					image_btu_jian.setBackgroundResource(R.drawable.btn_minus_normal);
					text_order_number.setText(number+"");
					text_order_count.setText("￥"+Double.parseDouble(group_price.equals("null")  ? "0" : group_price)*number);	
				}else{
					number=1;
					image_btu_jian.setBackgroundResource(R.drawable.btn_minus_pressed);
					text_order_number.setText(number+"");
					text_order_count.setText("￥"+Double.parseDouble(group_price.equals("null")  ? "0" : group_price)*number);
				}
			}
		});
		
	}
	
	public void send_order(){
		if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
    		Toast.makeText(SubmitOrderActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
    		return ;
    	} 
		String url = Constants.URL_SEND_ORDER;
		HashMap<String, String> params = new HashMap<String, String>();
		params.put("group_id", group_id);
		params.put("quantity", number+"");
		params.put("sign", myApp.getMember_key());
		params.put("member_id", myApp.getMember_id());
		RemoteDataHandler.asyncLoginPost(url, params, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					Toast.makeText(SubmitOrderActivity.this, "提交订单成功",Toast.LENGTH_SHORT).show();
					Intent intent =new Intent(SubmitOrderActivity.this,ConfirmOrderActivity.class);
					intent.putExtra("json", json);
					SubmitOrderActivity.this.startActivity(intent);
					SubmitOrderActivity.this.finish();
				}else{
					Toast.makeText(SubmitOrderActivity.this, "提交订单失败，请稍后重试",Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
}
