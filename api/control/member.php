<?php
defined('InShopNC') or exit('Access Invalid!');

class memberControl extends APIControl {

	private $input = array();

	public function __construct(){
		$input = decrypt($_POST['input'],APP_KEY);
		parse_str($input,$this->input);
	}

	/**
	 * 登录
	 *
	 * @return int -1 用户名/密码 错误 -2 账号被停用 >0 用户ID
	 */
	public function loginOp(){
		$model_member	= Model('member');
		if(C('ucenter_status')) {
			$model_ucenter = Model('ucenter');
			$member_id = $model_ucenter->userLogin($this->input['user_name'],$this->input['password']);
			if(intval($member_id) == 0) {
				$result =  -1;
			}else{
				$result = $member_id;
			}
		}
		if (!isset($result)){
			$array	= array();
			$array['member_name']	= $this->input['user_name'];
			$array['member_passwd']	= md5($this->input['password']);
			$member_info = $model_member->infoMember($array,'member_id,member_state');
			if(is_array($member_info) and !empty($member_info)) {
				if(!$member_info['member_state']){
					$result = -2;
				}
			}else{
				$result =  -1;
			}
			if (!isset($result)) $result = $member_info['member_id'];			
		}
		exit($this->callback($member_info['member_id']));
	}

	/**
	 * 获得单个会员信息
	 * @return string
	 */
	public function infoOp(){
		if (empty($this->input['uid']) || (intval($this->input['uid']) <= 0 && empty($this->input['user_name']))){
			$member_info = null;
		}else{
			$condition = array();
			if (intval($this->input['uid']) > 0){
				$condition['member_id'] = intval($this->input['uid']);
			}else{
				$condition['member_name'] = $this->input['user_name'];
			}
			$model_member	= Model('member');
			$member_info = $model_member->memberCache($condition);
		}
		echo $this->callback(json_encode($member_info));exit;
	}

	/**
	 * 同步登录通知
	 *
	 * @return string
	 */
	public function synloginOp() {
		require(BASE_PATH.'/apps.php');
		$synstr = '';
		foreach ((array)$nc_apps as $key=>$app) {
			if ($key == 'shop'){
				$synstr .= '<script type="text/javascript" src="'.$app['app_url'].'/nc_client/nc.php?time='.time().'&code='.urlencode(encrypt('action=synlogin&member_id='.$this->input['uid'].'&time='.time(),$app['app_key'])).'"></script>';
				break;
			}
		}
		if(C('ucenter_status')) {
			$model_ucenter = Model('ucenter');
			$synstr .= $model_ucenter->outputLogin($this->input['uid'],trim($_POST['password']));
		}
		echo $synstr;exit;
	}

	/**
	 * 同步登出通知
	 *
	 * @return string
	 */
	public function synloginoutOp() {
		require(BASE_PATH.'/apps.php');
		$synstr = '';
		foreach ((array)$nc_apps as $key => $app) {
			if ($key == 'shop'){
				$synstr .= '<script type="text/javascript" src="'.$app['app_url'].'/nc_client/nc.php?time='.time().'&code='.urlencode(encrypt('action=synloginout&member_id='.$this->input['uid'].'&time='.time(),$app['app_key'])).'"></script>';
				break;
			}
		}
		if(C('ucenter_status')) {
			$model_ucenter = Model('ucenter');
			$synstr .= $model_ucenter->userLogout();
		}
		echo $synstr;exit;
	}

	/**
	 * 配置测试
	 *
	 * @return string
	 */
	public function testOp() {
		require(BASE_PATH.'/nc_server/apps.php');
		foreach ((array)$nc_apps as $key => $app) {
			$synstr .= '<script type="text/javascript" src="'.$app['app_url'].'/nc_client/nc.php?time='.time().'&code='.urlencode(encrypt('action=test&time='.time(),$app['app_key'])).'"></script>';
		}
		echo $synstr;exit;
	}
}
?>