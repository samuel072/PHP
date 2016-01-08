<?php

require_once('user_model.php');
require_once('activity_model.php');

class FavorModel
{
	public $id;		//收藏信息ID
	public $user;		//用户
	public $activity;	//收藏的活动
	public $type; // 0: 喜欢  1： 收藏

	function __construct() {
		$this->user = new UserModel();
		$this->activity = new ActivityModel();
	}
}

?>
