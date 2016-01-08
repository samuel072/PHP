<?php
require_once(ykfile('source/dbtables/db.php'));
require_once(ykfile('source/model/exchange_model.php'));
	
class ExchangeTable extends DB
{
	public function table_name() {
		return 'exchange_record';
	}

	public function dbobj_to_model($obj) {
		$com = new ExchangeModel();
		$com->id = $obj->id;
		$com->commodity->id = $obj->com_id;
		$com->user->uuid = $obj->user_id;
		$com->mobile = $obj->mobile;
		$com->address = $obj->address;
		$com->name = $obj->name;
		$com->exch_time = $obj->exch_time;
		$com->code = $obj->code;
		$com->state = $obj->state;

		return $com;
	}

	// 取指定用户的兑换记录
	public function get_record($user_id, $next_id, $count) {
		$table = $this->table_name();
		$sql = "select * from $table where user_id = $user_id limit $next_id, $count";

		return $this->get_list_by_sql($sql);
	}

	// 取指定用度的兑换总数
	public function get_count_by_user($user_id) {
		$table = $this->table_name();
		$sql = "select count(*) from $table where user_id = $user_id";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	// 插入一条兑换记录，返回ID
	public function insert_exchange($exch) {
		$table = $this->table_name();
		$com_id = $exch->commodity->id;
		$user_id = $exch->user->uuid;
		$mobile = $exch->mobile;
		$address = $exch->address;
		$name = $exch->name;
		$exch_time = $exch->exch_time;
		$code = $exch->code;
		$state = $exch->state;

		$sql = "insert into $table (com_id, user_id, mobile, address, name, exch_time, code, state) values ($com_id, '$user_id', '$mobile', '$address', '$name', '$exch_time', '$code', $state)";

		$result = mysql_query($sql, $this->conn);
		if($result) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}
	
	
	public function get_all($next_id, $count) {
		$table_name = $this->table_name();
		$sql = "select a.* from $table_name as a limit $next_id, $count";
		return $this->get_list_by_sql($sql);		
	}

	// 获取全部记录的数量
	public function get_count() {
		$table_name = $this->table_name();
		$sql = "select count(*) from $table_name";
		
		$result = mysql_query($sql, $this->conn);
		if(!$result) {
			return 0;
		}else {
			list($num) = mysql_affected_rows($this->conn);
			return $num;
		}
	}
}

?>
