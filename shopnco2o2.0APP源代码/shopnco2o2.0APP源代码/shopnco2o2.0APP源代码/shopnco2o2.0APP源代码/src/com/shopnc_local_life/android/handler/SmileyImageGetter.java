package com.shopnc_local_life.android.handler;

import java.net.URL;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.os.Handler;
import android.os.Message;
import android.text.Html.ImageGetter;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.IOHelper;
import com.shopnc_local_life.android.common.MyApp;

/**
 * 本地缓存图片获取器
 * 
 * @author hjgang
 */
public class SmileyImageGetter implements ImageGetter {
	private BitmapDrawable bd = null;
	private Context c;
	private String themb;
	private  Handler mHandler;;
	Drawable drawable = null;  
	public SmileyImageGetter(Context c) {
		this.c = c;
	}
	public void update(){
		getDrawable(themb);
	}
	@Override
	public Drawable getDrawable(String source) {
		final int w = MyApp.getScreenWidth();
		final int h = MyApp.getScreenHeight();
		String smiley = IOHelper.getName(source);
		themb = source;
		Bitmap b = BitmapFactory.decodeResource(c.getResources(),
				R.drawable.avatar_96);
		ImageZoom iz = new ImageZoom();
		int dw = b.getWidth();
		int dh = b.getHeight();
		iz.zoomImage(dw - 20, dh - 20, w, h);
		bd = new BitmapDrawable(b);
		bd.setBounds(0, 0, iz.getWidth(), iz.getHeight());
		// Drawable d = Drawable.createFromPath(Constants.CACHE_DIR_IMAGE + "/"
		// + smiley);
		// if(d != null){
		// d.setBounds(0, 0, 35, 35);
		// return d;
		// }else{
		int idx1 = source.indexOf("<");
		int idx2 = source.indexOf(">");
		if (idx1 > -1 && idx2 > -1 && idx1 < idx2) {
			source = source.substring(0, idx1);
		}
//		// 配图异步下载
//		ImageLoader.getInstance().asyncLoadBitmap(source, new ImageCallback() {
//			@Override
//			public void imageLoaded(Bitmap bmp, String url) {
//				if (bmp != null && !"".equals(bmp)) {
//					bd = new BitmapDrawable(bmp);
//					ImageZoom iz = new ImageZoom();
//					int dw = bmp.getWidth();
//					int dh = bmp.getHeight();
//					iz.zoomImage(dw - 20, dh - 20, w, h);
//					bd.setBounds(0, 0, iz.getWidth(), iz.getHeight());
//				} else {
//					bd.setBounds(0, 0, 0, 0);
//				}
//			}
//		});
//		return bd;
		// }
//         mHandler = new Handler() {  
//             @Override  
//             public void handleMessage(Message msg) {  
//                 super.handleMessage(msg);  
                 System.out.println("themb1-->"+themb);
                	 URL url;  
                     try {  
                    	 System.out.println("themb-->"+themb);
                         url = new URL(themb);  
                         drawable = Drawable.createFromStream(url.openStream(), Constants.CACHE_IMAGE); // 获取网路图片  
                         drawable.setBounds(0, 0, drawable.getIntrinsicWidth(),  
            	                  drawable.getIntrinsicHeight());  
                     } catch (Exception e) {  
                         e.printStackTrace();  
                     }   
//             }  
//         };  
//         mHandler.post(update); 
//         System.out.println("drawable-->"+drawable);
		return drawable;  
	}
	private Runnable update = new Runnable() {  
        @Override  
        public void run() {  
            mHandler.postDelayed(update, 10);  
        }  
    };  
}
