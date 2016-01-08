<?php
require_once(ykfile('source/dbtables/db.php'));
require_once(ykfile('source/model/score_record_model.php'));
	
class ScoreRecordTable extends DB
{
	public function table_name() {
		return 'score_record';
	}

	public function dbobj_to_model($obj) {
		$record = new ScoreRecordModel();
		$record->id = $obj->id;
		$record->user->uuid = $obj->user_id;
		$record->type = $obj->type;
		$record->amount = $obj->amount;
		$record->rule->id = $obj->rule_id;
		$record->create_time = $obj->create_time;
		return $record;
	}

	public function get_records($user_id, $nexd_id, $count) {
		$table = $this->table_name();
		$sql = "select * from $table where user_id = $user_id limit $next_id, $count";

		return $this->get_list_by_sql($sql);
	}

	public function insert_record($record) {
		$table = $this->table_name();
		$user_id = $record->user->uuid;
		$type = $record->type;
		$amount = $record->amount;
		$rule_id = $record->rule->id;

		$sql = "insert into $table (user_id, type, amount, rule_id) values ('$user_id', $type, $amount, $rule_id)";
		$result = mysql_query($sql, $this->conn);

		if($result) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}

	public function update_record($record) {
		$table = $this->table_name();
		$id = $record->id;
		$user_id = $record->user->uuid;
		$type = $record->type;
		$amount = $record->amount;
		$rule_id = $record->rule->id;
		
		$sql = "update $table set user_id = '$user_id', type = $type, amount = $amount, rule_id = $rule_id where id = $id";

		$result = mysql_query($sql, $this->conn);
		if($result) {
			return $sid;
		} else {
			return false;
		}
	}
	
	// 获取对应的积分记录
	public function get_all($condition ,$next_id, $count) {
		$table = $this->table_name();
		//if($condition === NULL) {
			$sql = "select t.* from $table AS t order by create_time desc limit $next_id, $count";
		/*}else {
			$id = $condition->id;
			$user_id = $condition->user->uuid;
			$type = $condition->type;
			$amount = $condition->amount;
			$rule_id = $condition->rule->id;
			
			$sql = "SELECT t.* $table as t where 1=1";
			if($id != NULL) {
				$sql .= "and id = $id " 
			}
			if($type != NULL) {
				$sql
				
			}
			
		}*/
		return $this->get_list_by_sql($sql);
	}
	
	public function get_score_count($condition) {
		$table = $this->table_name();
		$sql = "select count(*) from $table";
		$result = mysql_query($sql, $this->conn);
		list($num) = mysql_fetch_row($result);
		return $num;
	}
	
	// 
	public function get_record_count_by_day ($rule_id, $uuid) {
		date_default_timezone_set("Asia/Shanghai");
		$nowTime = date("Y-m-d 00:00:00");
		$table_name = $this->table_name();
		
		$sql = "select count(*) from $table_name where create_time > '$nowTime' and rule_id = $rule_id and user_id = '$uuid'";
		$result = mysql_query($sql, $this->conn);
		
		list($num) = mysql_fetch_row($result);
		return $num;
	}
	
	public function get_record_count_by_hour($rule_id, $uuid) {
		date_default_timezone_set("Asia/Shanghai");
		$nowTime = date("Y-m-d (H-1):i:s");
		$table_name = $this->table_name();
		
		$sql = "select count(*) from $table_name where create_time > '$nowTime' and rule_id = $rule_id and user_id = '$uuid'";
		$result = mysql_query($sql, $this->conn);
		
		list($num) = mysql_fetch_row($result);
		return $num;
	}
}

?>
