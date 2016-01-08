<?php
require_once(ykfile('source/dbtables/db.php'));

class TagActivityTable extends DB {
	public function table_name() {
		return 'tag_activity';
	}
	
	// 插入一条对应关系
	public function insert_tag_activity ($tag_id, $activity_id) {
		$table_name = $this->table_name();
		$sql = "insert into $table_name (tag_id, activity_id) values ($tag_id, $activity_id)";
		return mysql_query($sql, $this->conn);
		
	}
	
	// 根据activity_id删除对应的数据   
	public function del_tag_activity($activity_id) {
		$table_name = $this->table_name();
		$sql = "delete from $table_name where activity_id = $activity_id";
		return mysql_query($sql, $this->conn);
	}
	
	
}

?>