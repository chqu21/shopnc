/**
 *  ClassName: MyProcessDialog.java
 *  created on 2012-3-17
 *  Copyrights 2011-2012 qjyong All rights reserved.
 *  site: http://blog.csdn.net/qjyong
 *  email: qjyong@gmail.com
 */
package com.shopnc_local_life.android.widget;

import android.app.Dialog;
import android.content.Context;
import android.widget.EditText;
import android.widget.TextView;

import com.shopnc_local_life.android.R;

/**
 * 等待对话框
 * @author hjgang
 */
public class MyYouHuiQuanPhoneDialog extends Dialog {
	public EditText edit_search;
	public TextView text_btu_on;
	public TextView text_btu_off;
	public MyYouHuiQuanPhoneDialog(Context context) {
		super(context, R.style.MyProgressDialog);
		this.setContentView(R.layout.youhuiquan_phone_dialog);
		edit_search = (EditText) findViewById(R.id.edit_search);
		text_btu_on = (TextView) findViewById(R.id.text_btu_on);
		text_btu_off = (TextView) findViewById(R.id.text_btu_off);
	}
	public String get_phone(){
		String mobile =edit_search.getText().toString();
		 return mobile;
	}
}
