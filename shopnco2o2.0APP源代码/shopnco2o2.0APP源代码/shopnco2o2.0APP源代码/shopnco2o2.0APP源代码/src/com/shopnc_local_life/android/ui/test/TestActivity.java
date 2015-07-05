/**
 * ClassName:TestActivity.java
 * PackageName:com.shopnc_local_life.android.ui.test
 * Create On 2013-8-7上午10:55:26
 * Site:http://weibo.com/hjgang or http://t.qq.com/hjgang_
 * EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-2-18 hjgang All rights reserved.
 */
package com.shopnc_local_life.android.ui.test;

import java.util.Timer;
import java.util.TimerTask;

import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnTouchListener;
import android.view.ViewGroup.LayoutParams;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;
import android.widget.ViewFlipper;

import com.shopnc_local_life.android.R;

/**
 * Author:hjgang Create On 2013-8-7上午10:55:26 Site:http://weibo.com/hjgang or
 * http://t.qq.com/hjgang_ EMAIL:hjgang@bizpower.com or hjgang@yahoo.cn
 * Copyrights 2013-8-7 hjgang All rights reserved.
 */
public class TestActivity extends Activity {
	private ViewFlipper flipper;
	private LinearLayout layout;
	private int now = 0;
	private int pictureCounts = 4;
	private float ox, x;
	public static boolean status;
	private Timer mTimer = null;
	private TimerTask mTimerTask = null;
	private int[] images ={ 
			R.drawable.ad1, R.drawable.ad2,
			R.drawable.ad3, R.drawable.ad4};

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.test);
		 flipper = (ViewFlipper) findViewById(R.id.view_fliper);
	     addView();
	   	 layout=(LinearLayout) this.findViewById(R.id.relayout);
	   	 generatePageControl() ;
			flipper.setDisplayedChild(now);

			flipper.setOnTouchListener(new OnTouchListener(){

				@Override
				public boolean onTouch(View v, MotionEvent event) {
					
					if(event.getAction()==MotionEvent .ACTION_DOWN){
						status=true;
						ox = event.getRawX();
					}else  if(event.getAction()==MotionEvent.ACTION_UP){
						status=false;
						x = event.getRawX();
						if(x-ox>100){
							flipper.setInAnimation(AnimationUtils.loadAnimation(
				                     TestActivity.this, R.anim.push_left_in));
				             flipper.setOutAnimation(AnimationUtils.loadAnimation(
				            		 TestActivity.this, R.anim.push_left_out));
							   flipper.showPrevious();
							   now--;
					            if(now    <    0){
					                now    =    pictureCounts    -    1;
					            }
					            generatePageControl();
					        //    return true;
					           // Toast.makeText(frontPage.this, "右滑动", Toast.LENGTH_SHORT).show();
						  
						}else if(ox-x >100){
							flipper.setInAnimation(AnimationUtils.loadAnimation(
				                     TestActivity.this, R.anim.push_right_in));
				             flipper.setOutAnimation(AnimationUtils.loadAnimation(
				            		 TestActivity.this, R.anim.push_right_out));
							   flipper.showNext();
							   now++;
					            if(now    >    pictureCounts    -    1){
					                now    =    0;
					            }
					            generatePageControl();
					           // return true;
					          //  Toast.makeText(frontPage.this, "左滑动", Toast.LENGTH_SHORT).show();
						}else {
							  int cout=now;
							  Toast.makeText(TestActivity.this, "点击事件", Toast.LENGTH_SHORT).show();
						}
						
					}
				
					return true;
				}});
			StartTimer();
	    }
	    private void generatePageControl() {
			 layout.removeAllViews();
		        

		        for (int i = 0; i < pictureCounts; i++) {
		                ImageView imageView = new ImageView(this);
		                imageView.setPadding(2, 5, 3, 5);
		                
		                if (now  == i) {
		                        imageView.setImageResource(R.drawable.price_filter_node_selected);//选中的圆点图片下面的反之
		                } else {
		                        imageView.setImageResource(R.drawable.price_filter_node_normal);
		                }
		                this.layout.addView(imageView);
		        }
		    }
	    public void StartTimer() {  
		      
	        if (mTimer == null) {  
	            mTimerTask = new TimerTask() {  
	            public void run() {  
	                //mTimerTaskÓëmTimerÖŽÐÐµÄÇ°ÌáÏÂÃ¿¹ý1ÃëœøÒ»ŽÎÕâÀï  
	                
	                Message message = new Message();  
	                message.what = 1; 
	               handler.sendMessage(message);  
	            }  
	            };  
	            mTimer = new Timer();  
	            
	            
	            mTimer.schedule(mTimerTask, 5000, 5000);  
	        }  
	      
	        }  
	      
	        public void CloseTimer() {  
	      
	        //ÔÚÕâÀï¹Ø±ÕmTimer Óë mTimerTask  
	        if (mTimer != null) {  
	            mTimer.cancel();  
	            mTimer = null;  
	        }  
	        if (mTimerTask != null) {  
	            mTimerTask = null;  
	        }   
	        }  
	    	private Handler handler = new Handler()
	    	{
	    		@Override
	    		public void handleMessage(Message msg) {
	    			switch(msg.what)
	    			{
	    			//main list-view data update
	    			case 1:
	    				
	    				   flipper.showNext();
	    				   now++;
	    		            if(now    >    pictureCounts    -    1){
	    		                now    =    0;
	    		            }
	    		            generatePageControl();
	    		       
	    				break;
	    			}
	    		}
	    		};
	    		public void addView(){
	    			
	 				for(int i=0;i<4;i++)
	 				{
	 					ImageView image = new ImageView(TestActivity.this);
	 					image.setScaleType(ImageView.ScaleType.FIT_XY);  
	 					image.setImageResource(images[i]);
	 					
	 					flipper.addView(image,new LayoutParams(dip2px(320),dip2px(140)));
	 				
	 					image = null;
	 				}
	 				
	    		}
	public  int dip2px( float dpValue) {
		final float scale = this.getResources().getDisplayMetrics().density;
		return (int) (dpValue * scale + 0.5f);
	}
}
