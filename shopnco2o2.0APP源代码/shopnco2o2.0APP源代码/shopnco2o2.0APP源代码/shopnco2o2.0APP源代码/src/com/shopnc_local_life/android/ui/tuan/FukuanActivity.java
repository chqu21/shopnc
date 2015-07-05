/**
 * 
 */
package com.shopnc_local_life.android.ui.tuan;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebSettings;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageButton;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;

/**
 * @author jingang
 *
 */
public class FukuanActivity extends Activity {
	private WebView webview;
	private String order_sn;
	private MyApp myApp;
	 private Handler mHandler = new Handler();
	 private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.fukuan_web);
		order_sn=FukuanActivity.this.getIntent().getStringExtra("order_sn");
		myApp= (MyApp) FukuanActivity.this.getApplication();
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				FukuanActivity.this.finish();
			}
		});
		
		webview = (WebView) findViewById(R.id.webview);
		WebSettings settings = webview.getSettings();  
		settings.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN);
		settings.setUseWideViewPort(false); //双击放大
		settings.setSupportZoom(false);
		settings.setBuiltInZoomControls(true);
		settings.setJavaScriptEnabled(true);
		webview.pageUp(true);
		webview.setWebViewClient(new WebViewClient() {
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
		webview.loadUrl(Constants.URL_PAYMENT+"&order_sn="+order_sn+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key());
		webview.addJavascriptInterface(new DemoJavaScriptInterface(), "demo");
	}
	 // 这是他定义由 addJavascriptInterface 提供的一个Object  
	 final class DemoJavaScriptInterface {  
		 DemoJavaScriptInterface() {  
	     }  

	     /** 
	      * This is not called on the UI thread. Post a runnable to invoke 
	      * 这不是呼吁界面线程。发表一个运行调用 
	      * loadUrl on the UI thread. 
	      * loadUrl在UI线程。 
	      */  
	     public void checkPaymentAndroid(final String flag) {        
	    	 // 注意这里的名称。它为clickOnAndroid(),注意，注意，严重注意  
	         mHandler.post(new Runnable() {  
	             public void run() {  
	                 // 此处调用 HTML 中的javaScript 函数  
	            	 if(flag.equals("success")){
	            		 Toast.makeText(FukuanActivity.this, "支付成功", Toast.LENGTH_SHORT).show();
//	            		 Intent mIntent = new Intent(Constants.FLAG); 
//			                //发送广播 
//						 sendBroadcast(mIntent); 
						 FukuanActivity.this.finish();
	            	 }else if(flag.equals("fail")){
	            		 Toast.makeText(FukuanActivity.this, "支付失败，请稍后重试", Toast.LENGTH_SHORT).show();
	            		 FukuanActivity.this.finish();
	            	 }
	             }  
	         });  
	     }  
	 }  
}
