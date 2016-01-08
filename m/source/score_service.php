<?php

require_once(ykfile('source/modules/score_module.php'));
require_once(ykfile('source/modules/user_module.php'));

class ScoreService
{
	private $scoremod;

	public function __construct() {
		$this->scoremod = new ScoreModule();
	}

	public function get_rule_by_id($rule_id) {
		return $this->scoremod->get_by_id($rule_id);
	}

	public function get_rules() {
		return $this->scoremod->get_rules();
	}

	public function get_valid_rules() {
		return $this->scoremod->get_valid_rules();
	}

	public function save_rule($rule) {
		return $this->scoremod->save_rule($rule);
	}

	public function get_rule_count() {
		return $this->scoremod->get_rule_count();
	}

	public function get_score_points() {
		return $this->scoremod->get_score_points();
	}
	
	// 根据条件查询对应的积分记录
	public function get_all($condition, $next_id, $count) {
		if($next_id === NULL || $count === NULL) {
			$next_id = 0;
			$count = 10;
		}
		$score_record_list = $this->scoremod->get_all($condition, $next_id, $count);
		
		foreach($score_record_list as $score_record) {
			// 人物名称
			$user_id = $score_record->user->uuid;
			$userMod = new UserModule($user_id);
			$user_info = $userMod->get_by_id($user_id);
			$score_record->user = $user_info[0];
			
			// 规则名称
			$rule_id = $score_record->rule->id;
			$rule_info = $this->scoremod->get_by_id($rule_id);
			$score_record->rule = $rule_info;
		}
		
		return $score_record_list;
	}
	
	// 根据条件查询对应数据的记录条数
	public function get_score_count($condition) {
		return $this->scoremod->get_score_count($condition);
	}
	
	
	// 根据积分点  判断加多少分
	public function apply_rule ($user, $type, $point) {
		$rule_list = $this->scoremod->apply_rule_by_point($point);
	
	if(!$rule_list) {
			return null;
		}
	
		$rules = "";
		foreach ($rule_list as $rule) {
			$score_record = new ScoreRecordModel();
			$score_record->user->uuid = $user->uuid;
			$score_record->type = $type;
			$score_record->amount = $rule->amount;
			$score_record->rule->id = $rule->id;
			$score_record->create_time = date("Y-m-d H:i:s");
			
			// day
			if($rule->times_in_day) {
				$times = $this->scoremod->get_record_count_by_day($rule->id, $user->uuid);
				if($times < $rule->times_in_day) {
					$this->add_score($user, $score_record);
				}
			}else if($rule->times_in_hour) {
				$times = $this->scoremod->get_record_count_by_hour($rule->id, $user->uuid);
				if($times < $rule->times_in_hour) {
					$this->add_score($user, $score_record);
				}
			}else {
				$this->add_score($user, $score_record);
			}
			$rules[] = $rule;
		}
		
		return $rules;
	}
	
	
	// 添加积分 和 积分记录
	public function add_score($user, $record) {
		$userMod = new UserModule($user->uuid);
		$score_record = $this->scoremod->add_record($record);		 // 添加积分记录
		if($score_record) {
			if($record ->type == 1) {
				$amount = -($record->amount);
			}else {
				$amount = $record->amount;
			}
			$userMod->sub_score($user->uuid, $amount); // 添加积分
		}
	}
	
	
}
?>

