<?php

/**
 * 会员中心预约管理
 * */
defined('InShopNC') or exit('Access Invalid!');
class memberappointmentControl extends memberCenterControl{
    function __construct(){
        parent::__construct();
        $this->menu('appointment');
		Tpl::output('menu_sign','appointment_manage');
    }
    
    /**
     * 预约列表
     * */
    public function listOp(){
        $model  =   Model();
        $page   =   10;
        $order  =   '`appointtime` desc';
        $where = array('member_id'=>$_SESSION['member_id']);
        //搜索
        if($_GET['s_content'] != ''){
        	$where['store_name'] = array('like','%'.$_GET['s_content'].'%');
        }
        $list   =   $model->table('appointment')->where($where)->page($page)->order($order)->select();
        Tpl::output('list',$list);
        Tpl::output('show_page',$model->showpage());
        Tpl::showpage('appointment.list');
    }
    
    /**
     * 预约详情
     * */
    public function appointdetailOp(){
        $id = intval($_GET['appoint_id']);
        $appoint = Model()->table('appointment')->where(array('id'=>$id))->find();
    	if(empty($appoint)){
			$this->showTip('该记录不存在','','html','error');
		}
        $store = array();
        if(!empty($appoint) && is_array($appoint)){
            $store = Model()->table('store')->where(array('store_id'=>$appoint['store_id']))->find();
        }
        Tpl::output('appoint',$appoint);
        Tpl::output('store_info',$store);
        Tpl::showpage('appointment.info');
    }
}
