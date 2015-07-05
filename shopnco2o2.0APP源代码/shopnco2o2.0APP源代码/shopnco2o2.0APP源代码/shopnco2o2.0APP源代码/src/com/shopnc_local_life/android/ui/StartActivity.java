/**
 * ClassName:StartActivity.java
 * PackageName:com.shopnc_local_life.android.ui
 * Create On 2013-8-26下午2:31:27
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@aliyun.com
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.Gallery;
import android.widget.ImageView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.ui.test.Viewdoor;

/**
 * Author:hjgang
 * Create On 2013-8-26下午2:31:27
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-26 hjgang All rights reserved.
 */
public class StartActivity extends Activity {
	private Gallery start_g;
	private StartGalleryAdapter adapter;
	private int[] num={
			R.drawable.guidance_new1,
			R.drawable.guidance_new2,
//			R.drawable.guidance_new3,
	};
	private MyApp myApp;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.tab_start);
		myApp=(MyApp) StartActivity.this.getApplication();
		if(myApp.getFirst_start_flag().equals("0")){
			start_g=(Gallery) findViewById(R.id.start_g);
			adapter=new StartGalleryAdapter(StartActivity.this);
			start_g.setAdapter(adapter);
			start_g.setAnimation(AnimationUtils.loadAnimation(
					StartActivity.this, R.anim.push_left_in));
		}else if(myApp.getFirst_start_flag().equals("1")){
			Intent intent =new Intent(StartActivity.this,Viewdoor.class);
			StartActivity.this.startActivity(intent);
			StartActivity.this.finish();
		}
	}
	class StartGalleryAdapter extends BaseAdapter{
		private Context mContext;
		private LayoutInflater inflater;
		public StartGalleryAdapter(Context context) {
			mContext = context;
			this.inflater = LayoutInflater.from(context);
		}

		public int getCount() {
			return num.length;
		}

		public Object getItem(int position) {
			return position;
		}

		public long getItemId(int position) {
			return position;
		}

		public View getView(int position, View convertView, ViewGroup parent) {
			View view = inflater.inflate(R.layout.start_gallery_item, null);
			ImageView image = (ImageView) view.findViewById(R.id.image);
			Button btu_in = (Button)  view.findViewById(R.id.btu_in);
			image.setBackgroundResource(num[position]);
			image.setAdjustViewBounds(true);
			if(position==num.length-1){
				btu_in.setVisibility(View.VISIBLE);
			}else{
				btu_in.setVisibility(View.GONE);
			}
			btu_in.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					Intent intent =new Intent(StartActivity.this,Viewdoor.class);
					StartActivity.this.startActivity(intent);
					StartActivity.this.finish();
				}
			});
			return view;
		}
	}
}
