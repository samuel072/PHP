<?php

require_once(ykfile('source/dbtables/talker_table.php'));

class TalkerModule
{
	public function get_by_channel($channel_id, $next_id, $count) {
		$table = new TalkerTable();
		return $table->get_by_channel($channel_id, $next_id, $count);
	}
	
	public function update_talker_channel($talker_id, $number, $channel_id) {
		$table = new TalkerTable();
		return $table->update_talker_channel($talker_id, $number, $channel_id);
	}
}

?>
