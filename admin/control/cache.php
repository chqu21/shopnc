<?php
defined('InShopNC') or exit('Access Invalid!');
class cacheControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}
	public function cache_clearOp(){
		if (chksubmit()){
			//清理所有缓存
			if($_POST['cls_full']==1){
				H('setting',true);
				$this->cache_adv();
				$this->clear_cache_dir('class');
				$this->clear_cache_dir('city');
				$this->cache_member_degree();
				@unlink(BASE_DATA_PATH.'/cache/index/article.php');
		        showMessage('缓存清理完毕！');exit;
			}
			//清理基本缓存
			if (@in_array('setting',$_POST['cache'])){
				H('setting',true);
			}
			//清理广告缓存
			if (@in_array('adv',$_POST['cache'])){
				$this->cache_adv();
			}
			//清除商户分类缓存
			if (@in_array('class',$_POST['cache'])){
				$this->clear_cache_dir('class');
			}
			//清除地区缓存
			if (@in_array('area',$_POST['cache'])){
				$this->clear_cache_dir('city');
			}
			//会员等级相关缓存
			if (@in_array('member_degree',$_POST['cache'])){
				$this->cache_member_degree();
			}
			if(@in_array('article',$_POST['cache'])){
				@unlink(BASE_DATA_PATH.'/cache/index/article.php');
			}
			showMessage('缓存清理完毕！');
		}
		Tpl::showpage('cache.clear');
	}
	private function cache_adv(){
		$model = Model();
		$adv_list = $model->table('adv_position')->where(array('is_use'=>1))->select();
		if(!empty($adv_list)){
			foreach ($adv_list as $k=>$v){
				write_file(BASE_DATA_PATH.'/cache/rec_position/'.$v['ap_id'].'.php',$v);
			}
		}
	}
	private function clear_cache_dir($path){
		$dir_path = BASE_DATA_PATH.'/cache/'.$path;
		$dir = @opendir($dir_path);
		while (($file = readdir($dir)) !== false){
			if ($file != '.' && $file != '..' && is_file($dir_path.'/'.$file)){
				@unlink($dir_path.'/'.$file);
			}
  		}
  		closedir($dir);
	}
	private function cache_member_degree(){
		$model = Model();
		//会员等级
		$tmp_list = $model->table('member_degree')->order('md_id asc')->select();
		$member_degree = array();
		if(!empty($tmp_list)){
			foreach ($tmp_list as $val){
				$member_degree[$val['md_from'].'-'.$val['md_to']] = $val;
			}
		}
		write_file(BASE_DATA_PATH.'/cache/member_degree.php',$member_degree);
		//分数设置
		$tmp_list = $model->table('score_setting')->order('ss_id asc')->select();
		$score_setting = array();
		if(!empty($tmp_list)){
			foreach ($tmp_list as $val){
				$score_setting[$val['ss_code']] = $val;
			}
		}
		write_file(BASE_DATA_PATH.'/cache/score_setting.php',$score_setting);
	}
}