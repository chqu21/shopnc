/**
 * ClassName:MyAsynaTask.java
 * PackageName:android_shopnc_local_life
 * Create On 2013-9-18 下午2:01:32
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-9-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.common;

import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.os.AsyncTask;
import android.widget.ImageView;

import com.shopnc_local_life.android.R;

/**
 *  Author:hjgang
 *  Create On 2013-9-18 下午2:01:32
 *  Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 *  EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 *  Copyrights 2013-9-18 hjgang All rights reserved.
 */
public class MyAsynaTask extends AsyncTask<String,Void,String>{
	private String themb;
	private ImageView iv;

	public MyAsynaTask(String themb,ImageView iv){
		this.themb=themb;
		this.iv=iv;
	}
	@Override
	protected String doInBackground(String... params) {
		if(themb!=null){
			return themb;
		}
		return null;
	}
	
	@Override
	protected void onPostExecute(String result) {
		super.onPostExecute(result);
		if(result!=null && !"".equals(result)&& !"null".equals(result)){
//			//加载远程图片
			ImageLoader.getInstance().asyncLoadBitmap(result, new ImageLoader.ImageCallback() {
				@Override
				public void imageLoaded(Bitmap bmp, String url) {
					if(bmp!=null){
						iv.setBackgroundDrawable(new BitmapDrawable(bmp));
					}else{
						iv.setBackgroundResource(R.drawable.avatar_96);
					}
				}
			});
		}else{
			iv.setBackgroundResource(R.drawable.avatar_96);
		}
	}
	@Override
	protected void onCancelled() {
		super.onCancelled();
	}
	}