/**
 * 
 */
package com.shopnc_local_life.android.ui.Store;

import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;

import org.apache.http.HttpStatus;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.shopnc_local_life.android.R;
import com.shopnc_local_life.android.Adapter.StoreCommentListGridViewAdapter2;
import com.shopnc_local_life.android.common.Constants;
import com.shopnc_local_life.android.common.ImageHelper;
import com.shopnc_local_life.android.common.MyApp;
import com.shopnc_local_life.android.handler.RemoteDataHandler;
import com.shopnc_local_life.android.handler.RemoteDataHandler.Callback;
import com.shopnc_local_life.android.modle.ResponseData;
import com.shopnc_local_life.android.widget.MyGridView;

/**
 * @author jingang
 */
public class AddCommentActivity extends Activity{
	private EditText edit_comment;
	private EditText edit_person_cost;
	private TextView text_store_name;
	private MyGridView GridView;
	private Button btu_add_image;
//	private HashMap<String, Integer> map;
	private ArrayList<String> datas;
	private MyApp myApp;
	private String camera_fileName;
	private StoreCommentListGridViewAdapter2 adapter;
	private Button btu_login_sbmit;
	private String store_name;
	private String store_id;
	private ImageButton btn_back_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.add_comment);
		myApp = (MyApp) AddCommentActivity.this.getApplication();
		store_name = AddCommentActivity.this.getIntent().getStringExtra("store_name");
		store_id = AddCommentActivity.this.getIntent().getStringExtra("store_id");
		edit_comment= (EditText) findViewById(R.id.edit_comment);
		edit_person_cost = (EditText) findViewById(R.id.edit_person_cost);
		btu_add_image = (Button) findViewById(R.id.btu_add_image);
		GridView = (MyGridView) findViewById(R.id.GridView);
		btu_login_sbmit = (Button) findViewById(R.id.btu_login_sbmit);
		text_store_name = (TextView) findViewById(R.id.text_store_name);
		btn_back_id = (ImageButton) findViewById(R.id.btn_back_id);
		text_store_name.setText("("+store_name+")");
//		map = new HashMap<String, Integer>();
		datas= new ArrayList<String>();
		adapter=new StoreCommentListGridViewAdapter2(AddCommentActivity.this);
		GridView.setAdapter(adapter);
		btu_add_image.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				if (Environment.MEDIA_MOUNTED.equals(Environment.getExternalStorageState())) {
				dialog();
				}else{
					Toast.makeText(AddCommentActivity.this, "没有找到SD卡，暂时不能使用上传功能，请稍后重试", Toast.LENGTH_SHORT).show();
				}
			}
		});
		btu_login_sbmit.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				send_comment();
			}
		});
		btn_back_id.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				AddCommentActivity.this.finish();
			}
		});
	}
	
	public void send_comment(){
		if(myApp.getMember_id() == null || myApp.getMember_id().equals("") || myApp.getMember_id().equals("null")
    			||myApp.getMember_key() == null || myApp.getMember_key().equals("") || myApp.getMember_key().equals("null")){
    		Toast.makeText(AddCommentActivity.this, "您还没有登陆，请先登陆", Toast.LENGTH_SHORT).show();
    		return ;
    	}
		String comment = edit_comment.getText().toString();
		String person_cost = edit_person_cost.getText().toString();
		if(comment==null || "".equals(comment) || "null".equals(comment)){
			Toast.makeText(AddCommentActivity.this, "评论内容不能为空！", Toast.LENGTH_SHORT).show();
			return;
		}
		if(person_cost==null || "".equals(person_cost) || "null".equals(person_cost)){
			Toast.makeText(AddCommentActivity.this, "人均消费不能为空！", Toast.LENGTH_SHORT).show();
			return;
		}
		HashMap<String,String> params = new HashMap<String, String>();
		params.put("person_cost", person_cost);
		params.put("comment", comment);
		params.put("member_id", myApp.getMember_id());
		params.put("sign", myApp.getMember_key());
		params.put("store_id", store_id);
		
		HashMap<String, File> fileMap = new HashMap<String, File>();
		for (int i = 1; i <= datas.size(); i++) {
			fileMap.put("pic_"+i, new File(datas.get(i-1)));
		}
		
		String url = Constants.URL_ADD_COMMENT;
		
		RemoteDataHandler.asyncMultipartPost(url, params, fileMap, new Callback() {
			@Override
			public void dataLoaded(ResponseData data) {
				  if(data.getCode() == HttpStatus.SC_OK){
					  String json= data.getJson();
					  if(json.equals("true")){
						  Toast.makeText(AddCommentActivity.this, "添加评论成功！", Toast.LENGTH_SHORT).show();
						  Intent mIntent = new Intent(Constants.FLAG); 
			              sendBroadcast(mIntent); 
						  AddCommentActivity.this.finish();
					  }else if(json.equals("false")){
						  Toast.makeText(AddCommentActivity.this, "添加评论失败,请稍后重试！", Toast.LENGTH_SHORT).show();
					  }
				  }else{
					  Toast.makeText(AddCommentActivity.this, "添加评论失败,请稍后重试！", Toast.LENGTH_SHORT).show();
				  }
			}
		});
	}
	
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		if (resultCode != RESULT_OK) {
			return;
		}
		switch (requestCode) {
		case Constants.RESULT_CODE_CAMERA:// 手机拍照完成
			Uri uri=null;
			camera_fileName=myApp.getPhoto_path();
			if(!camera_fileName.equals("")&&!camera_fileName.equals("null")&&
					camera_fileName!=null){
				uri = Uri.fromFile(new File(camera_fileName));
			}else{
				uri =  data.getData();
			}
			startPhotoZoom(uri);
			break;
		case Constants.RESULT_CODE_PHOTO_PICKED:// 相册选图完成
			Uri uri2 = data.getData();
			startPhotoZoom(uri2); 
			break;
		case Constants.RESULT_CODE_PHOTO_CUT: // 裁剪后
			Bundle extras = data.getExtras();
			if (extras != null) {
				String pathname = Constants.CACHE_DIR_UPLOADING_IMG + "/shop_"
						+ System.currentTimeMillis() + ".jpg";
				Bitmap photo = extras.getParcelable("data");
				ImageHelper.write(photo, pathname);
				datas.add(pathname);
				adapter.setDatas(datas);
				adapter.notifyDataSetChanged();
			}
			break;
		}
	}

	/**  
     * 裁剪图片方法实现  
     * @param uri  
     */ 
    public void startPhotoZoom(Uri uri) {  
        Intent intent = new Intent("com.android.camera.action.CROP");  
        intent.setDataAndType(uri, Constants.IMAGE_UNSPECIFIED);
        intent.putExtra("crop", "true");
        intent.putExtra("noFaceDetection", true);
         //宽高的比例
        intent.putExtra("aspectX", 1);
        intent.putExtra("aspectY", 1);
         //裁剪图片宽高
        intent.putExtra("outputX", 320);
        intent.putExtra("outputY", 320);
        intent.putExtra("scale", true);
        intent.putExtra("return-data", true);
        
        startActivityForResult(intent, Constants.RESULT_CODE_PHOTO_CUT);
    }  
    public void dialog() {
		new AlertDialog.Builder(AddCommentActivity.this).setTitle("上传照片")
				.setSingleChoiceItems(R.array.photo_list_itemArray,0,
						new DialogInterface.OnClickListener() {

							@Override
							public void onClick(DialogInterface dialog,
									int which) {
								String st[] = getResources().getStringArray(R.array.photo_list_itemArray);
								switch (which) {
								case 0:
									if(datas.size() <4){
										//拍照
										 Intent cameraIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE); 
								         File file = new File(Constants.CACHE_DIR_UPLOADING_IMG+"/shop_"+ System.currentTimeMillis() + ".jpg");
								         cameraIntent.putExtra(MediaStore.EXTRA_OUTPUT, Uri.fromFile(file));
								         myApp.setPhoto_path(file.getAbsolutePath());
								         camera_fileName = file.getAbsolutePath()+"";
								         startActivityForResult(cameraIntent, Constants.RESULT_CODE_CAMERA); 
									}else{
										Toast.makeText(AddCommentActivity.this, "最多只能传4张图", Toast.LENGTH_SHORT).show();
									}
									break;
								case 1:
									///图库
									Intent localIntent = new Intent("android.intent.action.GET_CONTENT");
									localIntent.setType(Constants.IMAGE_UNSPECIFIED);
									startActivityForResult(Intent.createChooser(localIntent, "选择图片"),
											Constants.RESULT_CODE_PHOTO_PICKED);
								}
								dialog.dismiss();
							}
						}).show();
	}
}
