/**
 * ClassName:TuanListViewAdapter.java
 * PackageName:com.shopnc_local_life.android.Adapter
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.Adapter;

import java.io.ByteArrayOutputStream;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Matrix;
import android.graphics.Paint;
import android.graphics.PorterDuffXfermode;
import android.graphics.Rect;
import android.graphics.RectF;
import android.graphics.Bitmap.Config;
import android.graphics.PorterDuff.Mode;
import android.graphics.drawable.BitmapDrawable;
import android.os.AsyncTask;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ImageView.ScaleType;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.ImageLoader;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.ImageZoom;
import com.shopnc_local_life.android.ui.Store.StoreCommentShowPhotoDownActivity;

/**
 * Author:hjgang
 * Create On 2013-8-6下午2:09:25
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-6 hjgang All rights reserved.
 */
public class StoreCommentListGridViewAdapter extends BaseAdapter{
	private Context context;
	private LayoutInflater inflater;
	private String[] datas;
	private MyApp myApp;
	public StoreCommentListGridViewAdapter(Context context) {
		this.context = context;
		this.inflater = LayoutInflater.from(context);
		myApp = (MyApp) context.getApplicationContext();
	}
	@Override
	public int getCount() {
		return datas  == null ? 0 : datas.length;
	}

	@Override
	public Object getItem(int position) {
		return position;
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	public  String[] getDatas() {
		return datas;
	}
	public void setDatas( String[] datas) {
		this.datas = datas;
	}
	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		ViewHolder holder;
		if (null == convertView) {
			convertView = inflater.inflate(R.layout.store_comment_list_grid_item, null);
			holder = new ViewHolder();
			holder.imageview=(ImageView) convertView.findViewById(R.id.imageview);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		LayoutParams ps = holder.imageview.getLayoutParams();
		if(datas.length == 1){
		}else{
			ps.height = 100;
		    ps.width = 100;
		}
		holder.imageview.setLayoutParams(ps); 
			MyAsynaTask02 myTask= new MyAsynaTask02(datas[position],holder.imageview,datas.length,context);
			myTask.execute();
			holder.imageview.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					Intent itIntent = new Intent(context,StoreCommentShowPhotoDownActivity.class);
					itIntent.putExtra("coupon_pic", datas[position]);
					context.startActivity(itIntent);
				}
			});
			
		return convertView;
	}
	class ViewHolder {
		ImageView imageview;
	}
}
class MyAsynaTask02 extends AsyncTask<String,Void,String>{
	private String themb;
	private ImageView iv;
	private int count ;
	private Context context;

	public MyAsynaTask02(String themb,ImageView iv,int count, Context context){
		this.themb=themb;
		this.iv=iv;
		this.count= count;
		this.context=context;
	}
	@Override
	protected String doInBackground(String... params) {
		if(themb!=null){
			return themb;
		}
		return null;
	}
	 public static Bitmap getRoundedCornerBitmap(Bitmap bitmap) {
	        Bitmap output = Bitmap.createBitmap(bitmap.getWidth(),
	            bitmap.getHeight(), Config.ARGB_8888);
	        Canvas canvas = new Canvas(output);

	        final int color = 0xff424242;
	        final Paint paint = new Paint();
	        final Rect rect = new Rect(0, 0, 100, 100);
	        final RectF rectF = new RectF(rect);
	        final float roundPx = 0;

	        paint.setAntiAlias(true);
	        canvas.drawARGB(0, 0, 0, 0);
	        paint.setColor(color);
	        canvas.drawRoundRect(rectF, roundPx, roundPx, paint);

	        paint.setXfermode(new PorterDuffXfermode(Mode.SRC_IN));
	        canvas.drawBitmap(bitmap, rect, rect, paint);

	        return output;
	    }
	@Override
	protected void onPostExecute(String result) {
		super.onPostExecute(result);
		if(result!=null && !"".equals(result)&& !"null".equals(result)){
//			//加载远程图片
			ImageLoader.getInstance().asyncLoadBitmap(result, new ImageLoader.ImageCallback() {
				@Override
				public void imageLoaded(Bitmap bmp, String url) {
					if(count == 1){
						iv.setBackgroundDrawable(new BitmapDrawable(bmp));
					}else{
						iv.setScaleType(ScaleType.FIT_XY);
						iv.setAdjustViewBounds(true);
						iv.setMaxWidth(100);
						iv.setMaxHeight(100);
						LayoutParams ps = iv.getLayoutParams();
						ps.height = 100;
					    ps.width = LayoutParams.FILL_PARENT;
					    iv.setLayoutParams(ps); 
						iv.setBackgroundDrawable(new BitmapDrawable(bmp));
					}
					/*int w = MyApp.getScreenWidth();
					int h = MyApp.getScreenHeight();
					BitmapDrawable bd=null;
					LayoutParams ps = iv.getLayoutParams();
					if(bmp==null){
						bmp = BitmapFactory.decodeResource(context.getResources(), R.drawable.avatar_96);
					}
					if(count == 1){
						iv.setImageBitmap(bmp);
//						 iv.setBackgroundDrawable(bd);
					}else{
//						ps.height = LayoutParams.FILL_PARENT;
//					    ps.width = LayoutParams.FILL_PARENT;
//					    iv.setLayoutParams(ps); 
//					    iv.setBackgroundDrawable(bd);
						ByteArrayOutputStream stream = new ByteArrayOutputStream();  
						bmp.compress(Bitmap.CompressFormat.JPEG, 75, stream);// (0 - 100)压缩文件  
						bmp= Bitmap.createScaledBitmap(bmp, 200, 200, true);
						ps.height = LayoutParams.FILL_PARENT;
					    ps.width = LayoutParams.FILL_PARENT;
					    iv.setLayoutParams(ps); 
					    iv.setImageBitmap(bmp);*/
//					}
				}
			});
		}else{
			LayoutParams ps = iv.getLayoutParams();
			Bitmap bmp = BitmapFactory.decodeResource(context.getResources(), R.drawable.avatar_96);
			BitmapDrawable bd = new BitmapDrawable(bmp);
			if(count == 1){
			}else{
				ps.height = 100;
			    ps.width = 100;
			}
			iv.setLayoutParams(ps); 
			iv.setBackgroundDrawable(bd);
		}
	}
	@Override
	protected void onCancelled() {
		super.onCancelled();
	}
	}
