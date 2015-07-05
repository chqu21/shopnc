package com.shopnc_local_life.android.ui.youhuiquan;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebSettings;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.SystemHelper;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.CouponDetails;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.widget.MyProcessDialog;
import com.shopnc_local_life.android.widget.MyYouHuiQuanPhoneDialog;

public class YouHuiQuanDetalisActivity extends Activity{
	private String coupon_id;
	private TextView text_coupon_name;
	private TextView text_coupon_time;
	private TextView text_coupon_down;
	private WebView webview_coupon_des;
	private ImageButton btn_down_id;
	private Button btu_down_phone_photo;
	private String coupon_pic;
	private String store_name;
	private MyYouHuiQuanPhoneDialog down_phone_dialog;;
	private ImageButton btn_back_id;
	private MyProcessDialog dialog;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.coupon_detalis);
		coupon_id = YouHuiQuanDetalisActivity.this.getIntent().getStringExtra("coupon_id");
		dialog = new MyProcessDialog(YouHuiQuanDetalisActivity.this);
		down_phone_dialog = new MyYouHuiQuanPhoneDialog(YouHuiQuanDetalisActivity.this);
		text_coupon_name = (TextView) findViewById(R.id.text_coupon_name);
		text_coupon_time = (TextView) findViewById(R.id.text_coupon_time);
		text_coupon_down = (TextView) findViewById(R.id.text_coupon_down);
		webview_coupon_des = (WebView) findViewById(R.id.webview_coupon_des);
		btn_down_id = (ImageButton) findViewById(R.id.btn_down_id);
		btu_down_phone_photo = (Button) findViewById(R.id.btu_down_phone_photo);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				YouHuiQuanDetalisActivity.this.finish();
			}
		});
		WebSettings settings = webview_coupon_des.getSettings();
		settings.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN); 
		settings.setLoadsImagesAutomatically(true);
		settings.setJavaScriptEnabled(true);
		settings.setUseWideViewPort(false); //双击放大
		settings.setSupportZoom(false);
		settings.setBuiltInZoomControls(true);
		webview_coupon_des.pageUp(true);
		webview_coupon_des.setWebViewClient(new WebViewClient() {
			public boolean shouldOverrideUrlLoading(WebView view, String url) {
				view.loadUrl(url);
				return true;
			}
			@Override
			public void onPageStarted(WebView view, String url, Bitmap favicon) {
				super.onPageStarted(view, url, favicon);
			}

			@Override
			public void onPageFinished(WebView view, String url) {
				super.onPageFinished(view, url);
			}
			@Override
			public void onReceivedError(WebView view, int errorCode,
					String description, String failingUrl) {
				view.loadUrl("file:///android_asset/error.html");
			}
		});
		webview_coupon_des.loadDataWithBaseURL(null, "","text/html", "utf-8",null); 
		info();
		btn_down_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent intent =new Intent(YouHuiQuanDetalisActivity.this,YouHuiQuanShowPhotoDownActivity.class);
				intent.putExtra("coupon_pic", coupon_pic);
				intent.putExtra("store_name", store_name);
				YouHuiQuanDetalisActivity.this.startActivity(intent);
			}
		});
		btu_down_phone_photo.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				down_phone_dialog.show();
//				final String mobile = down_phone_dialog.edit_search.getText().toString();
				down_phone_dialog.text_btu_on.setOnClickListener(new OnClickListener() {
					@Override
					public void onClick(View v) {
						String mobile =  down_phone_dialog.get_phone();
						phone_down(mobile);
					}
				});
				down_phone_dialog.text_btu_off.setOnClickListener(new OnClickListener() {
					@Override
					public void onClick(View v) {
						down_phone_dialog.dismiss();
					}
				});
			}
		});
	}
	public void info(){
		dialog.show();
		String url=Constants.URL_COUPONDETAIL+"&coupon_id="+coupon_id;
		RemoteDataHandler.asyncGet2(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if (data.getCode() == HttpStatus.SC_OK) {
					String json = data.getJson();
					CouponDetails cd = CouponDetails.newInstance(json);
					coupon_pic = cd.getCoupon_pic();
					store_name = cd.getStore_name();
					text_coupon_name.setText(cd.getCoupon_name());
					text_coupon_time.setText(SystemHelper.getTimeStr3(cd.getCoupon_start_time())+"至"+SystemHelper.getTimeStr3(cd.getCoupon_end_time()));
					text_coupon_down.setText("已下载"+cd.getDownload_count()+"次");
					webview_coupon_des.loadDataWithBaseURL(null, cd.getCoupon_des().replaceAll("\\\\",""), "text/html","utf-8", null);
				} else {
					Toast.makeText(YouHuiQuanDetalisActivity.this, "加载详情数据失败，请稍后重试",Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	
	public void phone_down(String mobile){
		Pattern p = Pattern.compile("^\\d{11}$");
		Matcher m = p.matcher(mobile);
		if(!m.matches()){
			Toast.makeText(YouHuiQuanDetalisActivity.this, "手机号格式不正确",Toast.LENGTH_SHORT).show();
				 return ;
		 }
		String url= Constants.URL_COUPONDOWNLOAD+"&coupon_id="+coupon_id+"&mobile="+mobile;
		RemoteDataHandler.asyncGet3(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				down_phone_dialog.dismiss();
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
					if(json.equals("true")){
						Toast.makeText(YouHuiQuanDetalisActivity.this, "向手机发送短息成功，注意查收",Toast.LENGTH_SHORT).show();
					}else if(json.equals("false")){
						Toast.makeText(YouHuiQuanDetalisActivity.this, "向手机发送短息失败，请稍后重试",Toast.LENGTH_SHORT).show();
					}
				}else{
					Toast.makeText(YouHuiQuanDetalisActivity.this, "加载详情数据失败，请稍后重试",Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	
}
