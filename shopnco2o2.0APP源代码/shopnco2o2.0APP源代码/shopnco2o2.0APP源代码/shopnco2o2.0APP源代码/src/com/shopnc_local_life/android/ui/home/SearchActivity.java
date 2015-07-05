/**
 * 
 */
package com.shopnc_local_life.android.ui.home;

import java.util.ArrayList;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnKeyListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.SearchListAdapter;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.dao.SearchDao;
import com.shopnc_local_life.android.ui.Store.StoreListActivity;

/**
 * @author jingang
 *
 */
public class SearchActivity extends Activity {
	private EditText edit_search;
	private ListView listview;
	private MyApp myApp;
	private SearchDao s_dao;
	private SearchListAdapter adapter;
	private ArrayList<String> arrayList;
	private Button btu_delete_all;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.search_view);
		myApp= (MyApp) SearchActivity.this.getApplication();
		edit_search = (EditText) findViewById(R.id.edit_search);
		listview= (ListView) findViewById(R.id.listview);
		btu_delete_all =(Button) findViewById(R.id.btu_delete_all);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		s_dao=myApp.getSearch_dao();
		arrayList = s_dao.array_string_findall();
		adapter = new SearchListAdapter(SearchActivity.this);
		adapter.setDatas(arrayList);
		listview.setAdapter(adapter);
		adapter.notifyDataSetChanged();
		btu_delete_all.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				s_dao.deleteAll();
				arrayList = s_dao.array_string_findall();
				adapter.setDatas(arrayList);
				adapter.notifyDataSetChanged();
			}
		});
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				SearchActivity.this.finish();
			}
		});
		listview.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				String key=(String) listview.getItemAtPosition(arg2);
				Intent intent=new Intent(SearchActivity.this,StoreListActivity.class);
				intent.putExtra("key",key);
				intent.putExtra("url_flag","searchstore");
				SearchActivity.this.startActivity(intent);
				SearchActivity.this.finish();
			}
		});
		edit_search.setOnKeyListener(new OnKeyListener() {
			@Override
			public boolean onKey(View v, int keyCode, KeyEvent event) {
				if (keyCode == KeyEvent.KEYCODE_ENTER && event.getAction() == KeyEvent.ACTION_DOWN) {
					String keyString = edit_search.getText().toString();
					Intent intent=new Intent(SearchActivity.this,StoreListActivity.class);
					if(keyString == null || keyString.equals("") || keyString.equals("null")){
//						Toast.makeText(SearchActivity.this, "搜索内容不能为空", Toast.LENGTH_SHORT).show();
						intent.putExtra("key","");
						intent.putExtra("url_flag","searchstore");
					}else{
						s_dao.insert(keyString);
						intent.putExtra("key",keyString);
						intent.putExtra("url_flag","searchstore");
					}
					SearchActivity.this.startActivity(intent);
					SearchActivity.this.finish();
					return true;
				}
				return false;
			}
		});
	}
}
