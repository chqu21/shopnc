<?php
defined('InShopNC') or exit('Access Invalid!');
class batch_handleControl extends BaseHomeControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 旧版本升级到2.1版本需要执行的数据库批处理操作
	 */
	public function update21Op(){
		$model = Model();
		$comment_list = $model->table('comment')->where(true)->order('add_time desc')->select();
		//批量计算评价得分+批量写入点评图片信息
		$store_array = array();
		$cp_array = array();
		if(!empty($comment_list)){
			foreach ($comment_list as $val){
				$store_array[$val['store_id']][] = $val['amount_score'];
				if($val['photo'] != ''){
					$tmp_cp = explode(',', $val['photo']);
					foreach ($tmp_cp as $tcp){
						$cp_array[] = array(
							'pic_name'=>$tcp,
							'member_id'=>$val['member_id'],
							'member_name'=>$val['member_name'],
							'store_id'=>$val['store_id'],
							'store_name'=>$val['store_name'],
							'comment_id'=>$val['comment_id'],
							'add_time'=>$val['add_time']
						);
					}
					unset($tmp_cp);
				}
			}
		}
		if(!empty($store_array)){
			foreach ($store_array as $sk=>$sv){
				$tmp_score = 0;
				foreach ($sv as $ssv){
					$tmp_score += $ssv;
				}
				$tmp_score = round($tmp_score/count($sv));
				$model->table('store')->where(array('store_id'=>$sk))->update(array('store_score'=>$tmp_score));
				unset($tmp_score);
			}
		}
		if(!empty($cp_array)){
			$model->table('comment_pic')->where(true)->delete();
			$model->table('comment_pic')->insertAll($cp_array);
		}
		//将之前会员的等级置为1
		$model->table('member')->where(true)->update(array('member_degree'=>1));
		echo '批量数据库操作执行完成！';
	}
}