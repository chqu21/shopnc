/**
 * 
 */
package com.shopnc_local_life.android.ui.youhuiquan;

import java.io.File;

import android.app.Activity;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.ImageHelper;
import com.shopnc_local_life.android.common.ImageLoader;

/**
 * @author jingang
 * 
 */
public class YouHuiQuanShowPhotoDownActivity extends Activity {
	private ImageView image_youhuiquan;
	private ImageButton btn_down_id;
	private String coupon_pic;
	private Bitmap bmp;
	private String store_name;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.youhuiquan_show_photo_down);
		coupon_pic = YouHuiQuanShowPhotoDownActivity.this.getIntent().getStringExtra("coupon_pic");
		store_name  = YouHuiQuanShowPhotoDownActivity.this.getIntent().getStringExtra("store_name");
		image_youhuiquan = (ImageView) findViewById(R.id.image_youhuiquan);
		btn_down_id = (ImageButton) findViewById(R.id.btn_down_id);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btn_down_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if(bmp!=null){
					File dest = new File(Constants.CACHE_IMAGE,Constants.PHOTO_PATH+"_"+store_name+"_"+System.currentTimeMillis()+".png");
					if(!dest.exists()){
						ImageHelper.write(bmp, dest);
						Toast.makeText(YouHuiQuanShowPhotoDownActivity.this, "图片保存成功，请到"+Constants.CACHE_IMAGE+"目录查找", Toast.LENGTH_SHORT).show();
					}else{
						Toast.makeText(YouHuiQuanShowPhotoDownActivity.this, "图片保存失败，稍后重试", Toast.LENGTH_SHORT).show();
					}
				}else{
					Toast.makeText(YouHuiQuanShowPhotoDownActivity.this, "图片保存失败，稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				YouHuiQuanShowPhotoDownActivity.this.finish();
			}
		});
		if(coupon_pic !=null){
			//加载远程图片
			ImageLoader.getInstance().asyncLoadBitmap(coupon_pic, new ImageLoader.ImageCallback() {
				@Override
				public void imageLoaded(Bitmap bmp, String url) {
					if(bmp!=null){
						YouHuiQuanShowPhotoDownActivity.this.bmp= bmp;
						image_youhuiquan.setImageDrawable(new BitmapDrawable(bmp));
					}else{
						image_youhuiquan.setImageResource(R.drawable.avatar_96);
					}
				}
			});
		}else{
			image_youhuiquan.setImageResource(R.drawable.avatar_96);
		}
	}
}
