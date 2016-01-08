<?php

require_once('user_model.php');
require_once('activity_model.php');

class AppointmentModel
{
	const state_waiting = 0;
	const state_passed = 1;
	const state_confirmed = 2;
	const state_joined = 3;

	public $id;			//预约信息ID
	public $user;		//预约用户，可能是注册的，也可能是游客
	public $name;		//用户名字
	public $mobile;		//用户手机号
	public $com_address;//公司地址
	public $activity;	//报名的活动
	public $state;		//状态 0:待审核, 1:通过, 2:用户确认要来, 3:已参加
	public $message;	//审核驳回的原因
	public $appoint_time;	//报名时间

	public function __construct() {
		$this->user = new UserModel();
		$this->activity = new ActivityModel();
	}
}

?>
