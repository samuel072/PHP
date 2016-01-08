<?php
require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/qq_reader_model.php"));

class QQReaderTable extends DB {
	
	public function __construct() {
		parent::__construct(USER_DB_HOST, USER_DB_USER, USER_DB_PWD, USER_DB_NAME);
	}
		
	public function table_name() {
		return "qq_reader";
	}
		
	public function dbobj_to_model($obj) {
		$qq_reader_model = new QQReaderModel();
		$qq_reader_model->qq_open_id = $obj->qq_open_id;
		$qq_reader_model->user->id = $obj->reader_id;
		return $qq_reader_model;
	}
	
	//检测open_id
	public function get_by_open_id($open_id) {
		$table_name = $this->table_name();
		$sql = "select t.* from $table_name as t where t.qq_open_id = '$open_id'";
		file_put_contents("/tmp/yike.log", "get_by_open_id===>".$sql."\n", FILE_APPEND);
		$result = $this->get_list_by_sql($sql);
		if($result) {
			return $result[0];
		}
		return null;
	}
	
	public function save_qq_reader($open_id, $user_id) {
		$table_name = $this->table_name();
		$sql = "insert into $table_name (qq_open_id, reader_id) values ('$open_id', $user_id)";
		file_put_contents("/tmp/yike.log","save_qq_reader--->".$sql."\n", FILE_APPEND);
		$result = mysql_query($sql, $this->conn);
		if($result) {
			$id = mysql_insert_id($this->conn);
			return $id;
		} else {
			return false;
		}
		
		
	}
}

?>
