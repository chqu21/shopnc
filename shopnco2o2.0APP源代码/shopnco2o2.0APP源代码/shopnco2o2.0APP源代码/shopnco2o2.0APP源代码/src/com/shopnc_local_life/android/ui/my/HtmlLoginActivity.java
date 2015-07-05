/**
 * ClassName:HtmlLoginActivity.java
 * PackageName:com.shopnc_local_life.android.ui.my
 * Create On 2013-8-29下午3:30:14
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@aliyun.com
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.my;

import android.app.Activity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebSettings.LayoutAlgorithm;

import com.shopnc_local_life.android.R;

/**
 * Author:hjgang
 * Create On 2013-8-29下午3:30:14
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-29 hjgang All rights reserved.
 */
public class HtmlLoginActivity extends Activity{
	private WebView webview;
		@Override
		protected void onCreate(Bundle savedInstanceState) {
			super.onCreate(savedInstanceState);
			setContentView(R.layout.my_html_login);
			webview=(WebView) findViewById(R.id.webview);
			WebSettings ws= webview.getSettings();
			ws.setSupportZoom(true);
			ws.setBuiltInZoomControls(true);
			ws.setLayoutAlgorithm(LayoutAlgorithm.SINGLE_COLUMN); 
			webview.loadUrl("file:///android_asset/my_login.htm");
		}
}
