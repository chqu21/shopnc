package com.shopnc_local_life.android.ui.test;



import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.view.animation.TranslateAnimation;
import android.widget.ImageView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.ui.MainActivity;
import com.shopnc_local_life.android.ui.city.CityActivity;
import com.shopnc_local_life.android.ui.home.HomeActivity;

public class Viewdoor extends Activity {
	
	private ImageView mLeft;
	/*private ImageView mRight;*/
	private MyApp myApp;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.start_open);
        mLeft = (ImageView)findViewById(R.id.imageLeft);
        myApp = (MyApp) Viewdoor.this.getApplication();
        /* mRight = (ImageView)findViewById(R.id.imageRight);*/
        
//        AnimationSet anim = new AnimationSet(true);
//		TranslateAnimation mytranslateanim = new TranslateAnimation(Animation.RELATIVE_TO_SELF,0f,Animation.RELATIVE_TO_SELF,-1f,Animation.RELATIVE_TO_SELF,0f,Animation.RELATIVE_TO_SELF,0f);
//		mytranslateanim.setDuration(2000);
//		anim.addAnimation(mytranslateanim);
//		anim.setFillAfter(true);
        Animation animation = AnimationUtils.loadAnimation(this, R.anim.my_alpha_action);
		mLeft.startAnimation(animation);
//		
//		AnimationSet anim1 = new AnimationSet(true);
//		TranslateAnimation mytranslateanim1 = new TranslateAnimation(Animation.RELATIVE_TO_SELF,0f,Animation.RELATIVE_TO_SELF,+1f,Animation.RELATIVE_TO_SELF,0f,Animation.RELATIVE_TO_SELF,0f);
//		mytranslateanim1.setDuration(2000);
//		anim1.addAnimation(mytranslateanim1);
//		anim1.setFillAfter(true);
//		mRight.startAnimation(anim1);
		
		
		new Handler().postDelayed(new Runnable(){
			@Override
			public void run(){
				Intent intent = new Intent (Viewdoor.this,MainActivity.class);			
				Viewdoor.this.startActivity(intent);			
				Viewdoor.this.finish();
			}
		}, 2000);
    }

    
}
