/**
 * 
 */
package com.shopnc_local_life.android.ui.Store;

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
public class StoreCommentShowPhotoDownActivity extends Activity {
	private ImageView image_youhuiquan;
	private String coupon_pic;
	private Bitmap bmp;
	private String store_name;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.store_comment_show_photo_down);
		coupon_pic = StoreCommentShowPhotoDownActivity.this.getIntent().getStringExtra("coupon_pic");
		store_name  = StoreCommentShowPhotoDownActivity.this.getIntent().getStringExtra("store_name");
		image_youhuiquan = (ImageView) findViewById(R.id.image_youhuiquan);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				StoreCommentShowPhotoDownActivity.this.finish();
			}
		});
		if(coupon_pic !=null){
			//加载远程图片
			ImageLoader.getInstance().asyncLoadBitmap(coupon_pic, new ImageLoader.ImageCallback() {
				@Override
				public void imageLoaded(Bitmap bmp, String url) {
					if(bmp!=null){
						StoreCommentShowPhotoDownActivity.this.bmp= bmp;
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
