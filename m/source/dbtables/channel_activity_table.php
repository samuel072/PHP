<?php

require_once(ykfile('source/dbtables/db.php'));

class ChannelActivityTable extends DB
{
	public function table_name() {
		return 'channel_activity';
	}

	// 插入一条对应关系
	public function insert_link($channel_id, $activity_id, $number) {
		$table = $this->table_name();
		$sql = "insert into $table(channel_id, activity_id, number) values($channel_id, $activity_id, $number)";
		$ret = mysql_query($sql, $this->conn);
		if($ret === false) {
			file_put_contents("/tmp/yike.log", "DB Err: " . mysql_error() . "\n", FILE_APPEND);
		}

		return $ret;
	}

	// 删除一条对应关系
	public function remove_link($channel_id, $activity_id) {
		$table = $this->table_name();
		$sql = "delete from $table where channel_id = $channel_id and activity_id = $activity_id";
		return mysql_query($sql, $this->conn);
	}

	// 设置位置
	public function set_number($ch_id, $act_id, $num) {
		$table = $this->table_name();
		$sql = "update $table set number = $num where channel_id = $ch_id and activity_id = $act_id";
		return mysql_query($sql, $this->conn);
	}

	// 取指定栏目对应的活动数量
	public function get_channel_count($ch_id) {
		$table = $this->table_name();
		$sql = "select count(*) from $table where channel_id = $ch_id";

		$result = mysql_query($sql);
		if(!result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

}

?>
