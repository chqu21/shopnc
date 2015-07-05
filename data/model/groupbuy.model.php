<?php
/**
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');
class groupbuyModel extends Model{

    public function __construct(){
        parent::__construct('groupbuy');
    }

	/**
	 * 读取列表 
	 * @param array $condition
	 *
	 */
	public function getList($condition,$page=null,$order='',$field='*',$limit = ''){
        $result = $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
        return $result;
	}

    /**
	 * 读取单条记录
	 * @param array $condition
	 *
	 */
    public function getOne($condition,$order=''){

        $result = $this->where($condition)->order($order)->find();
        return $result;

    }

	/*
	 *  判断是否存在 
	 *  @param array $condition
     *
	 */
	public function isExist($condition) {

        $result = $this->getOne($condition);
        if(empty($result)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
	}

	/*
	 * 增加 
	 * @param array $param
	 * @return bool
	 */
    public function save($param){

        return $this->insert($param);	

    }
	
	/*
	 * 更新
	 * @param array $update
	 * @param array $condition
	 * @return bool
	 */
    public function modify($update, $condition){

        return $this->where($condition)->update($update);

    }
	
	/*
	 * 删除
	 * @param array $condition
	 * @return bool
	 */
    public function drop($condition){

        return $this->where($condition)->delete();

    }
	
}

