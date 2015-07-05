<?php
/**
 * 任务计划 - 订单处理
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class  groupbuyControl {

    /**
     * 初始化对象
     */
    public function __construct(){
        register_shutdown_function(array($this,"shutdown"));
    }

    /**
     * 订单回收
     */	
	public function groupbuyOp(){
		

		$model = Model();
		$order = $model->table('order')->where(array('state'=>2))->select();
		
		if(!empty($order)){
			
			$remind_arr		= $model->table('setting')->where(array('name'=>'remind_groupbuy'))->find();
			$remind_time	= $remind_arr['value']*12*3600;
			
				
			foreach($order as $val){
				$params = array();
				$params['order_id'] = $val['order_id'];
				$params['state']	= 1;
				
				$order_pwd = $model->table('order_pwd')->where($params)->count();
				if($order_pwd>0){
					if(($val['end_time']-time())<$remind_time){
						//发送短信
						$post_data	=	array(
							'phone'		=>	$val['mobile'],
							'text'		=>	'您的团购'.$val['item_name'].',即将过期，请您尽快使用。'
						);
						
						$ch	=	curl_init();
						curl_setopt($ch,CURLOPT_URL,BASE_SITE_URL."/api/message/demo.php");
						curl_setopt($ch,CURLOPT_HEADER, 0);
						curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch,CURLOPT_POST, 1);
						curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
						$output = curl_exec($ch);
						curl_close($ch);	
					}
				}
			}
		}

		
	}



    /**
     * 执行完成提示信息
     *
     */
    public function shutdown(){
        exit("success at ".date('Y-m-d H:i:s',TIMESTAMP)."\n");
    }
}