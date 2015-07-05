/**
 * 
 */
package com.shopnc_local_life.android.ui.tuan;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.modle.OrderDetalis;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;

/**
 * @author jingang
 *
 */
public class ConfirmOrderActivity extends Activity{
	private String json;
	private TextView text_order_name;
	private TextView text_order_number;
	private TextView text_order_count;
	private TextView text_order_predeposit;
	private TextView text_order_so_price;
	private LinearLayout l_out_zhifufangshi;
	private Button btu_order_submit;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.confirm_order_view);
		json = ConfirmOrderActivity.this.getIntent().getStringExtra("json");
		
		text_order_name = (TextView) findViewById(R.id.text_order_name);
		text_order_number = (TextView) findViewById(R.id.text_order_number);
		text_order_count = (TextView) findViewById(R.id.text_order_count);
		text_order_predeposit = (TextView) findViewById(R.id.text_order_predeposit);
		text_order_so_price = (TextView) findViewById(R.id.text_order_so_price);
		l_out_zhifufangshi= (LinearLayout) findViewById(R.id.l_out_zhifufangshi);
		btu_order_submit = (Button) findViewById(R.id.btu_order_submit);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		
		
		final OrderDetalis orderDetalis = OrderDetalis.newInstance(json);
		if(orderDetalis != null){
			text_order_name.setText(orderDetalis.getGroup_name());
			text_order_number.setText("x"+orderDetalis.getNumber());
			text_order_count.setText("￥"+orderDetalis.getPrice());
			text_order_predeposit.setText("￥"+(orderDetalis.getPredeposit().equals("null")  ? "0" : orderDetalis.getPredeposit()));
			double predeposit =Double.parseDouble(orderDetalis.getPredeposit().equals("null")  ? "0" : orderDetalis.getPredeposit());
			double price =Double.parseDouble(orderDetalis.getPrice().equals("null") ? "0" : orderDetalis.getPrice() );
			if(predeposit >= price && predeposit != 0 && predeposit != 0.0){
				l_out_zhifufangshi.setVisibility(View.GONE);
				text_order_so_price.setText("￥0.00");
			}else{
				double count=predeposit-price;
				if(count >= 0){
					text_order_so_price.setText("￥"+(predeposit-price));
				}else{
					text_order_so_price.setText("￥"+(-(predeposit-price)));
				}
				l_out_zhifufangshi.setVisibility(View.VISIBLE);
			}
		}
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				ConfirmOrderActivity.this.finish();
			}
		});
		btu_order_submit.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				Intent intent =new Intent(ConfirmOrderActivity.this,FukuanActivity.class);
				intent.putExtra("order_sn", orderDetalis.getOrder_sn());
				ConfirmOrderActivity.this.startActivity(intent);
				ConfirmOrderActivity.this.finish();
			}
		});
	}
}
