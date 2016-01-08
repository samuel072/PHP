<?php
require_once(ykfile('source/dbtables/db.php'));
require_once(ykfile('source/model/score_rule_model.php'));
	
class ScoreRuleTable extends DB
{
	public function __construct($host = DB_HOST, $username = DB_USER, $password = DB_PASSWORD, $dbname = DB_NAME) {
		parent::__construct($host, $username, $password, $dbname);
	}

	public function table_name() {
		return 'score_rule';
	}

	public function dbobj_to_model($obj) {
		$rule = new ScoreRuleModel();
		$rule->id = $obj->id;
		$rule->title = $obj->title;
		$rule->detail = $obj->detail;
		$rule->times_in_day = $obj->times_in_day;
		$rule->times_in_hour = $obj->times_in_hour;
		$rule->point->id = $obj->point;
		$rule->amount = $obj->amount;
		$rule->start_time = $obj->start_time;
		$rule->end_time = $obj->end_time;

		return $rule;
	}

	public function get_rules() {
		$table = $this->table_name();
		$sql = "select * from $table";

		return $this->get_list_by_sql($sql);
	}

	public function get_valid_rules($point) {
		$table = $this->table_name();
		$today = date('Y-m-d H:m:s');

		if($point === NULL) {
			$sql = "select * from $table where start_time < '$today' and end_time > '$today'";
		} else {
			$sql = "select * from $table where point = $point and start_time < '$today' and end_time > '$today'";
		}

		return $this->get_list_by_sql($sql);
	}

	public function insert_rule($rule) {
		$table = $this->table_name();
		$title = $rule->title;
		$detail = $rule->detail;
		$times_in_day = $rule->times_in_day;
		$times_in_hour = $rule->times_in_hour;
		$point = $rule->point->id;
		$amount = $rule->amount;
		$start_time = $rule->start_time;
		$end_time = $rule->end_time;

		$sql = "insert into $table (title, detail, times_in_day, times_in_hour, point, amount, start_time, end_time) values ('$title', '$detail', $times_in_day, $times_in_hour, $point, $amount, '$start_time', '$end_time')";

		$result = mysql_query($sql, $this->conn);
		if($result) {
			return mysql_insert_id($this->conn);
		} else {
			file_put_contents("/tmp/yike.log", mysql_error() . "\n", FILE_APPEND);
			return false;
		}
	}

	public function update_rule($rule) {
		$table = $this->table_name();
		$sid = $rule->id;
		$title = $rule->title;
		$detail = $rule->detail;
		$times_in_day = $rule->times_in_day;
		$times_in_hour = $rule->times_in_hour;
		$point = $rule->point->id;
		$amount = $rule->amount;
		$start_time = $rule->start_time;
		$end_time = $rule->end_time;

		$sql = "update $table set title = '$title', detail = '$detail', times_in_day = $times_in_day, times_in_hour = $times_in_hour, point = $point, amount = $amount, start_time = '$start_time', end_time = '$end_time' where id = $sid";

		$result = mysql_query($sql, $this->conn);
		if($result) {
			return $sid;
		} else {
			return false;
		}
	}
	
	// 根据积分点查询规则
	public function apply_rule_by_point($point) {
		date_default_timezone_set("Asia/Shanghai");
		$nowTime = date("Y-m-d H:i:s");
		
		$sql = "SELECT t.* FROM score_rule  t WHERE point = $point and '$nowTime' >= t.start_time AND '$nowTime' <= t.end_time" ;
		return $this->get_list_by_sql($sql);
	}
}

?>