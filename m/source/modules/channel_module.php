<?php

require_once(ykfile('source/dbtables/channel_table.php'));
require_once(ykfile('source/dbtables/channel_activity_table.php'));

class ChannelModule
{
	private $chanel_table;

	public function __construct() {
		$this->channel_table = new ChannelTable();
	}

	public function get_by_id($cid) {

		return $this->channel_table->get_by_id($cid);
	}

	public function get_channels($next_id, $count) {

		return $this->channel_table->get_channels($nexd_id, $count);
	}

	public function get_channel_count() {
		return $this->channel_table->get_count();
	}

	// 根据id判断，有ID则更新，无ID则新建
	// 成功返回ID，失败返回false
	public function save_channel($ch) {

		if($ch->id) {
			return $this->channel_table->update_channel($rule);
		} else {
			return $this->channel_table->insert_channel($rule);
		}
	}

	public function add_activity($ch_id, $act_id, $num) {
		file_put_contents("/tmp/yike.log", "add_activity($ch_id, $act_id, $num)\n", FILE_APPEND);
		$table = new ChannelActivityTable();
		return $table->insert_link($ch_id, $act_id, $num);
	}

	public function remove_activity($ch_id, $act_id) {
		$table = new ChannelActivityTable();
		return $table->remove_link($ch_id, $act_id);
	}

	public function get_channel_size($ch_id) {
		$table = new ChannelActivityTable();
		return $table->get_channel_count($ch_id);
	}

	public function get_activity($ch_id) {
		$table = new ActivityTable();
		return $table->get_by_channel($ch_id);
	}
}

?>
