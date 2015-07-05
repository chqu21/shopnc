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
import android.widget.TextView;

import com.shopnc_local_life.android.R;

/**
 * 等待对话框
 * @author hjgang
 */
public class MyProcessDialog extends Dialog {
	private TextView txt_info;

	public MyProcessDialog(Context context) {
		super(context, R.style.MyProgressDialog);
		this.setContentView(R.layout.progress_dialog);
		txt_info = (TextView)this.findViewById(R.id.txt_wait);
	}
	
	public void setMsg(String msg){
		if(null != txt_info){
			txt_info.setText(msg);
		}
	}
}
