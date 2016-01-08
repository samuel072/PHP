<?php
require_once(ykfile('source/model/score_point.php'));

// 积分规则
class ScoreRuleModel
{
	public $id;			//全局唯一标识
	public $title;		//规则标题
	public $detail;		//规则文字说明,给用户看的
	public $times_in_day;	//一天之内最多领取次数, 0为不限
	public $times_in_hour;	//一小时之内最多领取次数, 0为不限制
	public $point;		//积分点
	public $amount;		//增加的积分数
	public $start_time;	//开始时间
	public $end_time;	//结束时间

	public function __construct() {
		$this->point = new ScorePoint();
	}
}
?>
