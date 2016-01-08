<?php	

require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/favor_model.php"));

class FavorTable extends DB
{
	public function table_name() {
		return 'favorite';
	}

	// 数据库对像，转成模型对象
	public function dbobj_to_model($obj) {
		$favor = new FavorModel();
		$favor->id = $obj->id;
		$favor->user->uuid = $obj->user_id;
		$favor->activity->id = $obj->act_id;
		$favor->type = $obj->type;
		
		return $favor;
	}

	public function get_by_user($user_id, $next_id = 0, $count = 10) {
	
		$table = $this->table_name();	
		$sql = "select t.* from $table as t  where t.user_id = '$user_id' limit $next_id, $count";
		
		$list = $this->get_list_by_sql($sql);
		return $list;
	}

	function get_count_by_act($act_id) {
		$sql = "select count(*) from " . $this->table_name() . " where act_id = $act_id";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	function get_count_by_user($user_id) {

		$table = $this->table_name();
		$sql = "select count(*) from $table where user_id = $user_id";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	function insert_favor($favor) {
		$user_id = $favor->user->uuid;
		$act_id = $favor->activity->id;
		$type = $favor->type;
		$table = $this->table_name();
		$sql = "insert into $table(user_id, act_id, type) values ('$user_id', $act_id, $type)";

		if(mysql_query($sql, $this->conn)) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}
	
	public function get_by_user_and_act($favor) {
		$user_id = $favor->user->uuid;
		$act_id = $favor->activity->id;
		
		$table = $this->table_name();
		$sql = "select t.* from $table AS t where t.user_id = '$user_id' and act_id = $act_id ";
		$result = mysql_query($sql, $this->conn);
		if($result) {
			return true;
		}else {
			return false;
		}
		
	}
}
?>