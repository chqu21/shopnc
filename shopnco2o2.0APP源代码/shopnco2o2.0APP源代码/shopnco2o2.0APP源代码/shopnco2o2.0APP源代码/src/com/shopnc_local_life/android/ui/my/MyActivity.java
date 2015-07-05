/**
 * ClassName:MyActivity.java
 * PackageName:com.shopnc_local_life.android.ui.my
 * Create On 2013-8-7下午2:16:28
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.my;

import java.util.ArrayList;
import java.util.HashMap;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.text.Html;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.SubmenuListViewAdapter;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.common.MyImageSrcAsynaTask;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.MyDetails;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.ui.MainActivity;

/**
 * Author:hjgang
 * Create On 2013-8-7下午2:16:28
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-7 hjgang All rights reserved.
 */
public class MyActivity extends Activity{
	private ListView lv;
	private ListView lv2;
	private ImageButton login_btu;
	private MyApp myApp;
	private TextView text_member_name;
	private TextView text_member_usercity;
	private TextView text_member_comment_num;
	private ImageView image_member_avatar;
	private ImageView image_member_gender;
	private RelativeLayout r_lay_out_my_details;
	private SubmenuListViewAdapter adapter;
	private  MyDetails myDetails;
	private ImageButton image_btu_out;
		@Override
		protected void onCreate(Bundle savedInstanceState) {
			super.onCreate(savedInstanceState);
			setContentView(R.layout.tab_my);	
			myApp=(MyApp) MyActivity.this.getApplication();
			lv = (ListView)this.findViewById(R.id.lv);
			lv2 = (ListView)this.findViewById(R.id.lv2);
			login_btu=(ImageButton) findViewById(R.id.login_btu);
			image_btu_out=(ImageButton) findViewById(R.id.image_btu_out);
			text_member_name = (TextView) findViewById(R.id.text_member_name);
			text_member_usercity = (TextView) findViewById(R.id.text_member_usercity);
			text_member_comment_num = (TextView) findViewById(R.id.text_member_comment_num);
			image_member_avatar = (ImageView) findViewById(R.id.image_member_avatar);
			image_member_gender = (ImageView) findViewById(R.id.image_member_gender);
			r_lay_out_my_details = (RelativeLayout) findViewById(R.id.r_lay_out_my_details);
			text_member_usercity.setText(Html.fromHtml("常居地:<font color='#E64D5E'>未知</font>"));
			info();//
//			text_member_usercity.setOnClickListener(new OnClickListener() {
//				@Override
//				public void onClick(View v) {
//					Intent intent=new Intent(MyActivity.this,CityActivity.class);
//					MyActivity.this.startActivity(intent);
//				}
//			});
			r_lay_out_my_details.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					if(myDetails !=null){
						Intent intent=new Intent(MyActivity.this,EditMyDetailsActivity.class);
						intent.putExtra("nichen", myDetails.getNickname());
						intent.putExtra("sex",myDetails.getGender()+"");
						MyActivity.this.startActivity(intent);
					}
				}
			});
			lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
				public void onItemClick(AdapterView<?> parent, View view,
						int postion, long id) {
					if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
			    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
					Toast.makeText(MyActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
		    		return ;
					}
					Intent intent = null;
					switch((int)id){
					case R.drawable.ioc_my_order_bg:
						intent = new Intent(MyActivity.this, OrderTabListActivity.class);
						intent.putExtra("flag", 0);
						break;
					case R.drawable.ioc_my_youhuiquan_bg:
						intent = new Intent(MyActivity.this, OrderTabListActivity.class);
						intent.putExtra("flag", 1);
						break;	
					case R.drawable.ioc_my_card_bg:
						intent = new Intent(MyActivity.this, OrderTabListActivity.class);
						intent.putExtra("flag", 2);
						break;
					}
					if(null != intent){
						MyActivity.this.startActivity(intent);
					}
				}
			});
//			lv2.setOnItemClickListener(new AdapterView.OnItemClickListener() {
//				public void onItemClick(AdapterView<?> parent, View view,
//						int position, long id) {
//				}
//			});
			login_btu.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					Intent intent =new Intent(MyActivity.this,LoginActivity.class);
					MyActivity.this.startActivity(intent);
				}
			});
			image_btu_out.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
			    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
						return;
					}
					createSetNetworkDialog().show();
				}
			});
		}
		public AlertDialog createSetNetworkDialog(){
			Builder builder = new AlertDialog.Builder(this)
				.setIcon(android.R.drawable.ic_dialog_info)
				.setTitle("注销帐号")
				.setMessage("您确认注销当前帐号么");
			
			builder.setPositiveButton("确认", new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int which) {
					dialog.cancel();
					myApp.setMember_id("");
					myApp.setMember_key("");
					login_btu.setVisibility(View.VISIBLE);
					image_btu_out.setVisibility(View.GONE);
					Toast.makeText(MyActivity.this, "您的帐号已退出", Toast.LENGTH_SHORT).show();
					text_member_name.setText("请先登录");
					text_member_usercity.setText(Html.fromHtml("常居地:<font color='#E64D5E'>未知</font>"));
					text_member_comment_num.setText("0");
					image_member_gender.setVisibility(View.GONE);
					image_member_avatar.setImageResource(R.drawable.avatar_96);
				}
			});
			
			builder.setNegativeButton("取消", new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int which) {
					dialog.cancel();
				}
			});
			return builder.create();
		}
		@Override
		protected void onResume() {
			super.onResume();
			
			//Init ListView Item Data
			ArrayList<HashMap<String, Object>> datas = new ArrayList<HashMap<String,Object>>();
			HashMap<String, Object> map1 = new HashMap<String, Object>();
			map1.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_01));
			map1.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.ioc_my_order_bg));
			datas.add(map1);
			
			HashMap<String, Object> map2 = new HashMap<String, Object>();
			map2.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_02));
			map2.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.ioc_my_youhuiquan_bg));
			datas.add(map2);
			
			HashMap<String, Object> map3 = new HashMap<String, Object>();
			map3.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_03));
			map3.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.ioc_my_card_bg));
			datas.add(map3);
//			
//			HashMap<String, Object> map4 = new HashMap<String, Object>();
//			map4.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_04));
//			map4.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.my_tickets_icon_normal));
//			datas.add(map4);
//			
//			ArrayList<HashMap<String, Object>> datas2 = new ArrayList<HashMap<String,Object>>();
//			
//			HashMap<String, Object> map5 = new HashMap<String, Object>();
//			map5.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_05));
//			map5.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.my_draft_icon_normal));
//			datas2.add(map5);
//			
//			HashMap<String, Object> map6= new HashMap<String, Object>();
//			map6.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_06));
//			map6.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.my_favorite_icon_normal));
//			datas2.add(map6);
//			
//			HashMap<String, Object> map7= new HashMap<String, Object>();
//			map7.put(SubmenuListViewAdapter.TAG_ITEM_TEXT, this.getString(R.string.my_07));
//			map7.put(SubmenuListViewAdapter.TAG_ITEM_ICON, Integer.valueOf(R.drawable.my_tuan_fav_icon_normal));
//			datas2.add(map7);
			adapter = new SubmenuListViewAdapter(MyActivity.this, datas);
			lv.setAdapter(adapter);
//			adapter = new SubmenuListViewAdapter(MyActivity.this, datas2);
//			lv2.setAdapter(adapter);
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
	            	info();
	            }
	        } 
	    }; 
	    public void registerBoradcastReceiver(){ 
	        IntentFilter myIntentFilter = new IntentFilter(); 
	        myIntentFilter.addAction(Constants.FLAG); 
	        //注册广播       
	        MyActivity.this.registerReceiver(mBroadcastReceiver, myIntentFilter); 
	    } 
	    
	    public void info(){
	    	if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
	    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
//	    		Toast.makeText(MyActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
	    		login_btu.setVisibility(View.VISIBLE);
	    		return ;
	    	}
	    	String url = Constants.URL_MEMBERINFO+"&member_id="+myApp.getMember_id()+"&sign="+myApp.getMember_key();
	    	RemoteDataHandler.asyncGet2(url, new Callback() {
				@Override
				public void dataLoaded(ResponseData data) {
					if(data.getCode() == HttpStatus.SC_OK){
						  String json = data.getJson();
						  myDetails = MyDetails.newInstance(json);
						  image_btu_out.setVisibility(View.VISIBLE);
						  login_btu.setVisibility(View.GONE);
						  text_member_name.setText(myDetails.getNickname());
						  text_member_usercity.setText(Html.fromHtml("常居地:<font color='#E64D5E'>"+myDetails.getCityname()+"</font>"));
						  text_member_comment_num.setText(myDetails.getComment_num());
						  image_member_gender.setVisibility(View.VISIBLE);
						  if(myDetails.getGender().equals("1")){
							  image_member_gender.setBackgroundResource(R.drawable.icon_male);
						  }else if(myDetails.getGender().equals("2")){
							  image_member_gender.setBackgroundResource(R.drawable.icon_female);
						  }
						  MyImageSrcAsynaTask m =new MyImageSrcAsynaTask(myDetails.getAvatar(), image_member_avatar);
						  m.execute();
					}else{
						image_btu_out.setVisibility(View.GONE);
						login_btu.setVisibility(View.VISIBLE);
						Toast.makeText(MyActivity.this, "加载个人信息失败，请稍后重试", Toast.LENGTH_SHORT).show();
			    		return ;
					}
				}
			});
	    	
	    }
	    @Override
		public boolean onKeyDown(int keyCode, KeyEvent event) {
			if (keyCode == KeyEvent.KEYCODE_BACK) {
				((MainActivity) MyActivity.this.getParent()).dialog.show();
				return true;
			} else {
				return super.onKeyDown(keyCode, event);
			}
		}
}
