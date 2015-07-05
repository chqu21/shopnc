/**
 * 
 */
package com.shopnc_local_life.android.ui.my;

import java.util.HashMap;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.ui.city.CityActivity;

/**
 * @author hjgang
 */
public class EditMyDetailsActivity extends Activity {
	private String nichen;
	private String sex;
	private EditText et_my_nichen;
	private MyApp myApp;
	private TextView tv_my_address;
	private TextView tv_my_sex;
	private ImageButton btn_back_id;
	private Button btu_edit_mydetails_sbumit;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.edit_mydetails);
		nichen = EditMyDetailsActivity.this.getIntent().getStringExtra("nichen");
		sex = EditMyDetailsActivity.this.getIntent().getStringExtra("sex");
		myApp = (MyApp) EditMyDetailsActivity.this.getApplication();
		et_my_nichen = (EditText) findViewById(R.id.et_my_nichen);
		tv_my_address = (TextView) findViewById(R.id.tv_my_address);
		tv_my_sex = (TextView) findViewById(R.id.tv_my_sex);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btu_edit_mydetails_sbumit = (Button) findViewById(R.id.btu_edit_mydetails_sbumit);

		et_my_nichen.setText(nichen == null ? "" : nichen);
		tv_my_address.setText(myApp.getCity_name() == null ? "" : myApp.getCity_name());
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				EditMyDetailsActivity.this.finish();
			}
		});
		if (sex.equals("1")) {
			tv_my_sex.setText("男");
		} else if (sex.equals("2")) {
			tv_my_sex.setText("女");
		}
		tv_my_address.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent intent=new Intent(EditMyDetailsActivity.this,CityActivity.class);
				EditMyDetailsActivity.this.startActivity(intent);
			}
		});
		tv_my_sex.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				dialog(sex);
			}
		});
		btu_edit_mydetails_sbumit.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				info_tijiao();
			}
		});
	}

	public void info_tijiao(){
//		HashMap<String, String>  params=new HashMap<String, String>();
//		params.put("city_id", myApp.getCity_id());
//		params.put("nickname", et_my_nichen.getText().toString());
//		params.put("gender", sex);
	  	if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
    		Toast.makeText(EditMyDetailsActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
    		return ;
    	}
    	String url = Constants.URL_UPDATEMEMBER+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key()+"&city_id="
    	+myApp.getCity_id()+"&nickname="+et_my_nichen.getText().toString()+"&gender="+sex;
    	RemoteDataHandler.asyncGet3(url, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				if(data.getCode() == HttpStatus.SC_OK){
					String json=data.getJson();
					if(json.equals("1")){
						Toast.makeText(EditMyDetailsActivity.this, "保存成功", Toast.LENGTH_SHORT).show();
						Intent mIntent = new Intent(Constants.FLAG);
						sendBroadcast(mIntent); // 发送广播
						EditMyDetailsActivity.this.finish();
					}else if(json.equals("2")){
						Toast.makeText(EditMyDetailsActivity.this, "保存失败，请稍后重试", Toast.LENGTH_SHORT).show();
					}
				}else{
					Toast.makeText(EditMyDetailsActivity.this, "保存失败，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
	
	}
	@Override
	protected void onStart() {
		super.onStart();
		registerBoradcastReceiver();
	}
	@Override
	protected void onDestroy() {
		super.onDestroy();
		unregisterReceiver(mBroadcastReceiver);
	}
	private BroadcastReceiver mBroadcastReceiver = new BroadcastReceiver(){ 
        @Override 
        public void onReceive(Context context, Intent intent) { 
            String action = intent.getAction(); 
            if(action.equals(Constants.FLAG)){
            	tv_my_address.setText(myApp.getCity_name() == null ? "" : myApp.getCity_name());
            }
        } 
    }; 
    public void registerBoradcastReceiver(){ 
        IntentFilter myIntentFilter = new IntentFilter(); 
        myIntentFilter.addAction(Constants.FLAG); 
        //注册广播       
        EditMyDetailsActivity.this.registerReceiver(mBroadcastReceiver, myIntentFilter); 
    } 
	public void dialog(String sex1) {
		new AlertDialog.Builder(EditMyDetailsActivity.this).setTitle("请选择性别")
				.setSingleChoiceItems(R.array.pd_list_itemArray,
						Integer.parseInt(sex1) - 1,
						new DialogInterface.OnClickListener() {

							@Override
							public void onClick(DialogInterface dialog,
									int which) {
								String st[] = getResources().getStringArray(
										R.array.pd_list_itemArray);
								switch (which) {
								case 0:
									sex = "1";
									tv_my_sex.setText("男");
									// Toast.makeText(EditMyDetailsActivity.this,"您选择了  "+st[0],
									// Toast.LENGTH_SHORT).show();
									break;
								case 1:
									sex = "2";
									tv_my_sex.setText("女");
									// Toast.makeText(EditMyDetailsActivity.this,"您选择了  "+st[1],
									// Toast.LENGTH_SHORT).show();
								}
								dialog.dismiss();
							}
						}).show();
	}

}
