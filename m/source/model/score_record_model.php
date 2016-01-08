<?php

require_once('score_rule_model.php');
require_once('user_model.php');

// 积分变更记录
class ScoreRecordModel
{
	public $id;			//全局唯一标识
	public $user;		//对应用户
	public $type;		//0:积分获取，1:积分兑换
	public $amount;		//变量积分数, 永远为正值
	public $rule;		//对应的积分规则
	public $create_time; // 对应的创建时间

	public function __construct() {
		$this->rule = new ScoreRuleModel();
		$this->user = new UserModel();
	}
}

?>
