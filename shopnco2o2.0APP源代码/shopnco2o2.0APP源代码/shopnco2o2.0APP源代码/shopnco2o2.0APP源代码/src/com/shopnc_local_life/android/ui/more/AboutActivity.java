/**
 * 
 */
package com.shopnc_local_life.android.ui.more;

import com.shopnc_local_life.android.R;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

/**
 * @author jingang
 *
 */
public class AboutActivity extends Activity{
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.more_about_view);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				AboutActivity.this.finish();
			}
		});
	}
}
