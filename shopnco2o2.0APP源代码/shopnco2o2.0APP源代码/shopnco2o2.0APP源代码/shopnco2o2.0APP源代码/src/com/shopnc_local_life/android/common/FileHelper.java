/**
 *  ClassName: MyApp.java
 *  created on 2013-1-24
 *  Copyrights 2013-1-24 hjgang All rights reserved.
 *  site: http://t.qq.com/hjgang2012
 *  email: hjgang@yahoo.cn
 */
package com.shopnc_local_life.android.common;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import android.graphics.Bitmap;
import android.graphics.Bitmap.CompressFormat;

/**
 * @author hjgang
 */
public class FileHelper {

	public static void saveFile(Bitmap bm, String fileName) throws IOException{
		
		FileOutputStream fos = null;
		try {
			/**
			if(Environment.getExternalStorageState().equals(Environment.MEDIA_MOUNTED)){
				fos = new FileOutputStream(new File(Environment.getExternalStorageDirectory(), fileName));
			}else{
				//fos = ctx.openFileOutput(fileName, Context.MODE_PRIVATE);
				//Toast.makeText(ctx, "没有SD卡，文件保存失败", Toast.LENGTH_SHORT).show();
			}*/
			fos = new FileOutputStream(new File(fileName));
			// 把位图输出到指定文件中
			bm.compress(CompressFormat.JPEG, 100, fos);
			
		} catch (IOException e) {
			throw e;
		}finally{
			if(fos != null){
				try {
					fos.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
		}
	}
}