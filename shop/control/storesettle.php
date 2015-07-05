<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class storesettleControl extends memberstoreControl{
	public function __construct(){
		parent::__construct();
		Tpl::output('sign','settle');
	}
	public function indexOp(){
		$model = Model();
		$condition = array();
		$condition['store_id'] = $_SESSION['store_id'];
		//搜索
		if(isset($_POST['state']) && intval($_POST['state']) > 0){
			$condition['state'] = intval($_POST['state']);	
			Tpl::output('state',intval($_POST['state']));
		}
		//调取结算清单
		$settle_list = $model->table('settle')->where($condition)->order('settle_time desc')->page(15)->select();
		Tpl::output('settle_list',$settle_list);
		Tpl::output('show_page',$model->showpage(2));
		Tpl::showpage('storesettle.list');
	}
	public function settle_state_changeOp(){
		$model = Model();
		$new_state = intval($_GET['new_state']);
		$settle_id = intval($_GET['settle_id']);
		if(($new_state != 3 && $new_state != 5) || $settle_id == 0){
			$this->showTip('参数错误','index.php?act=settle&op=settle_manage','succ');
		}
		$rs = $model->table('settle')->where(array('settle_id'=>$settle_id))->update(array('state'=>$new_state));
		if($rs){
			$this->showTip('操作成功！','index.php?act=storesettle','succ');
		}else{
			$this->showTip('操作失败','','html','error');
		}
	}
}