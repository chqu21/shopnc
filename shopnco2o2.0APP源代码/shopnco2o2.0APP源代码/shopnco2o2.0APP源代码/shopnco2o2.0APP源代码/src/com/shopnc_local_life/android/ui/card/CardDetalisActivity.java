/**
 * ClassName:CardDetalisActivity.java
 * PackageName:android_shopnc_local_life
 * Create On 2013-9-22 上午10:52:44
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-9-22 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.card;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.os.Bundle;
import android.text.Html;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.CardListDetails;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.ui.my.MyCardActivity;
import com.shopnc_local_life.android.widget.MyProcessDialog;

/**
 *  Author:hjgang
 *  Create On 2013-9-22 上午10:52:44
 *  Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 *  EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 *  Copyrights 2013-9-22 hjgang All rights reserved.
 */
public class CardDetalisActivity extends Activity{
	private String store_id;
	private MyApp myApp;
	private MyProcessDialog dialog;
	private ImageButton btn_back_id;
	private TextView text_card_detalis_name;
	private TextView text_card_detalis_address;
	private TextView text_card_detalis_title;
	private TextView text_card_detalis_context;
	private Button btu_join_member;
 
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.card_detalis);
		store_id=CardDetalisActivity.this.getIntent().getStringExtra("store_id");
		myApp=(MyApp) CardDetalisActivity.this.getApplication();
		dialog= new MyProcessDialog(CardDetalisActivity.this);
		text_card_detalis_name = (TextView) findViewById(R.id.text_card_detalis_name);
		text_card_detalis_address = (TextView) findViewById(R.id.text_card_detalis_address);
		text_card_detalis_title = (TextView) findViewById(R.id.text_card_detalis_title);
		text_card_detalis_context = (TextView) findViewById(R.id.text_card_detalis_context);
		btu_join_member  = (Button) findViewById(R.id.btu_join_member);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		ListViewInFo();
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				CardDetalisActivity.this.finish();
			}
		});
		btu_join_member.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
		    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
					Toast.makeText(CardDetalisActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
				}else{
					send_join_member();
				}
			}
		});
	}
	
	public void send_join_member(){
		dialog.show();
		if(store_id == null || store_id.equals("") || "null".equals(store_id)){
			dialog.dismiss();
			Toast.makeText(CardDetalisActivity.this, "会员卡ID没有获取到，请稍后重试", Toast.LENGTH_SHORT).show();
			return ;
		}
		String url=Constants.URL_JOIN_MEMBER+"&store_id="+store_id+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key();
		RemoteDataHandler.asyncGet3(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					if(json.equals("1")){
						Toast.makeText(CardDetalisActivity.this, "添加会员卡成功", Toast.LENGTH_SHORT).show();
						btu_join_member.setVisibility(View.GONE);
					}else{
						Toast.makeText(CardDetalisActivity.this, "添加会员卡失败，请稍后重试", Toast.LENGTH_SHORT).show();
					}
				}else{
					Toast.makeText(CardDetalisActivity.this, "添加会员卡失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	public void ListViewInFo() {
		dialog.show();
		if(store_id == null || store_id.equals("") || "null".equals(store_id)){
			dialog.dismiss();
			Toast.makeText(CardDetalisActivity.this, "会员卡ID没有获取到，请稍后重试", Toast.LENGTH_SHORT).show();
			return ;
		}
		String url=Constants.URL_CARD_DETALIS+"&store_id="+store_id;
		if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
//    		Toast.makeText(CardDetalisActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
    		dialog.dismiss();
    	}else{
    		url=Constants.URL_CARD_DETALIS+"&store_id="+store_id+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key();
    	}
		RemoteDataHandler.asyncGet2(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if (data.getCode() == HttpStatus.SC_OK) {
					String json = data.getJson();
					CardListDetails cld = CardListDetails.newInstance(json);
					text_card_detalis_name.setText(cld.getStore_name());
					text_card_detalis_address.setText(cld.getAddress());
					text_card_detalis_title.setText(Html.fromHtml("会员独享<font color=\"#FF9D03\">"+cld.getCard_discount()+"折</font>"));
					text_card_detalis_context.setText(cld.getCard_des());
					if(cld.getState().equals("1")){
						btu_join_member.setVisibility(View.GONE);
					}else if(cld.getState().equals("2")){
						btu_join_member.setVisibility(View.GONE);
					}else  if(cld.getState().equals("3")){
						btu_join_member.setVisibility(View.VISIBLE);
					}
				} else {
					Toast.makeText(CardDetalisActivity.this, "加载会员卡详情数据失败，请稍后重试",
							Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
}
