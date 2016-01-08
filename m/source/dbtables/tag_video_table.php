<?php
require_once(ykfile('source/dbtables/db.php'));

class TagVideoTable extends DB {
	public function table_name() {
		return 'tag_video';
	}
	
	// 插入一条对应关系
	public function insert_tag_video ($tag_id, $video_id) {
		$table_name = $this->table_name();
		$sql = "insert into $table_name (tag_id, video_id) values ($tag_id, $video_id)";
		return mysql_query($sql, $this->conn);
		
	}
	
	// 根据video_id删除对应的数据   
	public function delete_tag_video_by_video($video_id) {
		$table_name = $this->table_name();
		$sql = "delete from $table_name where video_id = $video_id";
		return mysql_query($sql, $this->conn);
	}
	
	
}

?>