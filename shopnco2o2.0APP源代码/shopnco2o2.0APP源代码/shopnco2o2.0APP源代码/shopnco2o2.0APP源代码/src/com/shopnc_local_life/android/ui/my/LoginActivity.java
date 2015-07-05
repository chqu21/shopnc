/**
 * ClassName:HtmlLoginActivity.java
 * PackageName:com.shopnc_local_life.android.ui.my
 * Create On 2013-8-29下午3:30:14
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@aliyun.com
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.my;

import java.util.HashMap;

import org.apache.http.HttpStatus;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.widget.MyProcessDialog;

/**
 * Author:hjgang
 * Create On 2013-8-29下午3:30:14
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-29 hjgang All rights reserved.
 */
public class LoginActivity extends Activity {
	private EditText et_login_name;
	private EditText et_login_pwd;
	private Button btu_login_sbmit;
	private ImageButton btn_back_id;
	private MyProcessDialog dialog;
	private MyApp myApp;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.my_login);
		dialog=new MyProcessDialog(LoginActivity.this);
		myApp= (MyApp) LoginActivity.this.getApplication();
		et_login_name = (EditText) findViewById(R.id.et_login_name);
		et_login_pwd = (EditText) findViewById(R.id.et_login_pwd);
		btu_login_sbmit = (Button) findViewById(R.id.btu_login_sbmit);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);

		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				LoginActivity.this.finish();
			}
		});
		btu_login_sbmit.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				String login_name=et_login_name.getText().toString();
				String login_pwd=et_login_pwd.getText().toString();
				info_login(login_name, login_pwd);
			}
		});
	}
	
	public void info_login(String login_name,String login_pwd){
		dialog.show();
		if(login_name == null || "".equals(login_name) || "null".equals(login_name)){
			dialog.dismiss();
			Toast.makeText(LoginActivity.this, "用户名不能为空，请输入用户名", Toast.LENGTH_SHORT).show();
			return ;
		}
		if(login_pwd == null || "".equals(login_pwd) || "null".equals(login_pwd)){
			dialog.dismiss();
			Toast.makeText(LoginActivity.this, "密码不能为空，请输入密码", Toast.LENGTH_SHORT).show();
			return ;
		}
		String url=Constants.URL_LOGIN;
		HashMap<String, String> params =new HashMap<String, String>();
		params.put("username", login_name);
		params.put("password", login_pwd);
		
		RemoteDataHandler.asyncLoginPost(url, params , new Callback() {
			
			@Override
			public void dataLoaded(ResponseData data) {
				dialog.dismiss();
				if(data.getCode() == HttpStatus.SC_OK){
					String json = data.getJson();
				try {
					JSONObject obj=new JSONObject(json);
					String member_id=obj.getString("member_id");
					String sign = obj.getString("sign");
					if(!member_id.equals("0")){
						myApp.setMember_id(member_id);
						myApp.setMember_key(sign);
						Toast.makeText(LoginActivity.this, "登录成功",Toast.LENGTH_SHORT).show();
						LoginActivity.this.finish();
						Intent mIntent = new Intent(Constants.FLAG);
						sendBroadcast(mIntent); // 发送广播
					}else{
						Toast.makeText(LoginActivity.this, "用户名密码有误，请稍后重试", Toast.LENGTH_SHORT).show();
					}
				} catch (JSONException e) {
					e.printStackTrace();
				}
				}else{
					Toast.makeText(LoginActivity.this, "登录失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
}
