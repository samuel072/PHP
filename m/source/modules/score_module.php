<?php 
require_once(ykfile('source/dbtables/score_rule_table.php'));
require_once(ykfile('source/model/score_point.php'));
require_once(ykfile('source/dbtables/score_record_table.php'));

class ScoreModule
{
	private $rule_table;

	const point_signin = 0; // 登录
	const point_signup = 1; // 注册
	const point_comment = 2; // 评论
	const point_share = 3; // 分享
	const point_checkin = 4; // 签到
	const point_appoint = 5; //报名
	const point_like = 6; //喜欢
	const point_collect = 7; //收藏

	public function __construct() {
		$this->rule_table = new ScoreRuleTable();
	}

	public function get_by_id($rule_id) {
		$rule = $this->rule_table->get_by_id($rule_id);
		if($rule === DB_ERR_NO_DATA) {
			return DB_ERR_NO_DATA;
		}
		if($rule) {
			$points = $this->get_score_points();
			$rule->point->title = $points[$rule->point->id]->title;
		}
		return $rule;
	}

	public function get_rules() {
		$rules = $this->rule_table->get_rules();

		foreach($rules as $rule) {
			$points = $this->get_score_points();
			$rule->point->title = $points[$rule->point->id]->title;
		}

		return $rules;
	}
	
	
	public function get_valid_rules() {
		return $this->rule_table->get_valid_rules();
	}

	// 根据id判断，有ID则更新，无ID则新建
	// 成功返回ID，失败返回false
	public function save_rule($rule) {

		if($rule->id) {
			return $this->rule_table->update_rule($rule);
		} else {
			return $this->rule_table->insert_rule($rule);
		}
	}

	public function get_rule_count() {
		return $this->rule_table->get_count();
	}

	public function get_score_points() {
		$index = array(ScoreModule::point_signin,
					ScoreModule::point_signup,
					ScoreModule::point_comment,
					ScoreModule::point_share,
					ScoreModule::point_checkin,
					ScoreModule::point_appoint,
					ScoreModule::point_like,
					ScoreModule::point_collect);
		$title = array("登录", "注册", "评论", "分享", "签到", "报名", "喜欢", "收藏");

		$points = array();
		for($i = 0; $i < count($index); $i ++) {
			$point = new ScorePoint();
			$point->id = $index[$i];
			$point->title = $title[$i];
			$points[] = $point;
		}

		return $points;
	}

	
	// 根据条件查询对应的积分记录
	public function get_all($condition, $next_id, $count) {
		$sco_rec_ta = new ScoreRecordTable();
		return $sco_rec_ta->get_all($condition, $next_id, $count);
	}
	
	// 根据条件查询对应数据的记录条数
	public function get_score_count($condition) {
		$sco_rec_ta = new ScoreRecordTable();
		return $sco_rec_ta->get_score_count($condition);
	}

	// 根据积分点查询规则
	public function apply_rule_by_point($point) {
		$srt = new ScoreRuleTable();
		return $srt->apply_rule_by_point($point);
		
	}
	
	public function get_record_count_by_day($rule_id, $uuid) {
		$sco_rec_ta = new ScoreRecordTable();
		return $sco_rec_ta->get_record_count_by_day($rule_id, $uuid);
	}
	
	public function get_record_count_by_hour($rule_id, $uuid) {
		$sco_rec_ta = new ScoreRecordTable();
		return $sco_rec_ta->get_record_count_by_hour($rule_id, $uuid);
	}
	
	public function add_record($record) {
		$sco_rec_ta = new ScoreRecordTable();
		return $sco_rec_ta->insert_record($record);
	}
}

?>
