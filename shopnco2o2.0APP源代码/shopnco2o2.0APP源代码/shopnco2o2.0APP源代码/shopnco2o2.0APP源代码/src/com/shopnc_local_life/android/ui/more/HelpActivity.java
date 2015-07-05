/**
 * 
 */
package com.shopnc_local_life.android.ui.more;

import android.app.Activity;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageButton;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;

/**
 * @author jingang
 *
 */
public class HelpActivity extends Activity{
	private WebView webview;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.more_help_web_view);
		webview = (WebView) findViewById(R.id.webview);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		WebSettings settings = webview.getSettings();  
//		settings.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN);
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
		webview.loadUrl(Constants.URL_HELP);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				HelpActivity.this.finish();
			}
		});
	}
}
