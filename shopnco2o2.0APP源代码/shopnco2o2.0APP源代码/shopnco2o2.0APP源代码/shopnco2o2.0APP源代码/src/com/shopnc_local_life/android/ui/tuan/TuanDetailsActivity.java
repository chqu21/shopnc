/**
 * ClassName:TuanDetailsActivity.java
 * PackageName:com.shopnc_local_life.android.ui.tuan
 * Create On 2013-8-26下午5:11:42
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@aliyun.com
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.tuan;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebSettings;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.ImageLoader;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.modle.TuanListDetails;
import com.shopnc_local_life.android.widget.MyProcessDialog;

/**
 * Author:hjgang
 * Create On 2013-8-26下午5:11:42
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-26 hjgang All rights reserved.
 */
public class TuanDetailsActivity extends Activity {
	private String group_id;
//	private TextView tvtv;
	private WebView webview_group_help;
	private ImageView image_tuan_details_pic;
	private TextView text_tuan_details_group_price;
	private TextView text_tuan_details_original_price;
	private TextView text_tuan_detalis_name;
	private WebView webview_group_intro;
	private TextView text_tuan_details_buyer_count;
	private Button btu_tuan_detalis_go;
	private TuanListDetails tld;
	private ImageButton btn_back_id;
	private MyProcessDialog dialog;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tuan_details);
		group_id = TuanDetailsActivity.this.getIntent().getStringExtra("group_id");
//		tvtv=(TextView) findViewById(R.id.tvtv);
		dialog= new MyProcessDialog(TuanDetailsActivity.this);
		image_tuan_details_pic=(ImageView) findViewById(R.id.image_tuan_details_pic);
		text_tuan_details_group_price=(TextView) findViewById(R.id.text_tuan_details_group_price);
		text_tuan_details_original_price=(TextView) findViewById(R.id.text_tuan_details_original_price);
		text_tuan_detalis_name=(TextView) findViewById(R.id.text_tuan_detalis_name);
		webview_group_intro=(WebView) findViewById(R.id.webview_group_intro);
		text_tuan_details_buyer_count=(TextView) findViewById(R.id.text_tuan_details_buyer_count);
		webview_group_help = (WebView) findViewById(R.id.webview_group_help);
		btu_tuan_detalis_go = (Button) findViewById(R.id.btu_tuan_detalis_go);
		btn_back_id= (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				TuanDetailsActivity.this.finish();
			}
		});
		WebSettings settings = webview_group_help.getSettings();  
		webview_group_help.pageUp(true);
		settings.setUseWideViewPort(false); //双击放大
		settings.setSupportZoom(false);
		settings.setBuiltInZoomControls(true);
		settings.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN); 
		webview_group_help.loadDataWithBaseURL(null, "","text/html", "utf-8",null); 
		webview_group_help.setWebViewClient(new WebViewClient() {
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
		
		WebSettings settings2 = webview_group_intro.getSettings();
		webview_group_intro.pageUp(true);
		settings2.setUseWideViewPort(false); //双击放大
		settings2.setSupportZoom(false);
		settings2.setBuiltInZoomControls(true);
		settings2.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN);
		webview_group_intro.loadDataWithBaseURL(null, "","text/html", "utf-8",null); 
		webview_group_intro.setWebViewClient(new WebViewClient() {
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
//		tvtv.setText(Html.fromHtml("离<br/>你<br/>最<br/>近"));
//		text_id.setText(Html.fromHtml(str, new SmileyImageGetter(TuanDetailsActivity.this), null));
		info();
		btu_tuan_detalis_go.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if(tld != null){
					Intent intent =new Intent(TuanDetailsActivity.this,SubmitOrderActivity.class);
					intent.putExtra("group_price", tld.getGroup_price());
					intent.putExtra("group_name", tld.getGroup_name());
					intent.putExtra("group_id", tld.getGroup_id());
					intent.putExtra("buyer_limit", tld.getBuyer_limit());
					TuanDetailsActivity.this.startActivity(intent);	
				}
			}
		});
	}
	
	public void info(){
		dialog.show();
		String url=Constants.URL_GROUPBUGDETAILS+"&group_id="+group_id;
		RemoteDataHandler.asyncGet2(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if (data.getCode() == HttpStatus.SC_OK) {
					String json = data.getJson();
					tld = TuanListDetails.newInstance(json);
//					abc=tld.getGroup_intro().replaceAll("\"", "\\\\\"");
//					text_id.setText(Html.fromHtml(abc, new SmileyImageGetter(TuanDetailsActivity.this), null));
					
					if(tld.getGroup_pic() !=null){
						//加载远程图片
						ImageLoader.getInstance().asyncLoadBitmap(tld.getGroup_pic(), new ImageLoader.ImageCallback() {
							@Override
							public void imageLoaded(Bitmap bmp, String url) {
								if(bmp!=null){
									image_tuan_details_pic.setBackgroundDrawable(new BitmapDrawable(bmp));
								}else{
									image_tuan_details_pic.setBackgroundResource(R.drawable.avatar_96);
								}
							}
						});
					}else{
						image_tuan_details_pic.setBackgroundResource(R.drawable.avatar_96);
					}
					text_tuan_details_group_price.setText(" ￥ "+tld.getGroup_price());
					text_tuan_details_original_price.setText("价值 ￥ "+tld.getOriginal_price());
					text_tuan_detalis_name.setText(tld.getGroup_name());
					text_tuan_details_buyer_count.setText(tld.getBuyer_num()+"人购买,"+"仅剩"+(Integer.parseInt(tld.getBuyer_count())-Integer.parseInt(tld.getBuyer_num()))+"个");
					webview_group_intro.loadDataWithBaseURL(null, tld.getGroup_intro().replaceAll("\\\\",""), "text/html","utf-8", null);
					webview_group_help.loadDataWithBaseURL(null, tld.getGroup_help().replaceAll("\\\\",""), "text/html","utf-8", null);
				} else {
					Toast.makeText(TuanDetailsActivity.this, "加载详情数据失败，请稍后重试",Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
}
