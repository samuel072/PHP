<?php

require_once(ykfile('source/dbtables/adv_table.php'));

class AdvModule
{
	public function get_by_id($aid) {
		$table = new AdvTable();
		return $table->get_by_id($aid);
	}

	public function get_by_channel($channel_id, $next_id, $count) {
		$table = new AdvTable();
		return $table->get_by_channel($channel_id, $next_id, $count);
	}

	public function get_adv($next_id, $count) {
		$table = new AdvTable();
		return $table->get_adv($next_id, $count);
	}

	public function save_adv($adv) {
		$table = new AdvTable();

		if($adv->id) {
			$table->update_adv($adv);
			return $adv->id;
		} else {
			return $table->insert_adv($adv);
		}
	}
	
	// 获取广告位的数量
	public function get_count() {
		$table = new AdvTable();
		return $table->get_count();
	}
	
	//修改广告位与channel的中间表
	public function update_adv_channel($adv_id, $number, $channel_id) {
		$table = new AdvTable();
		return $table->update_adv_channel($adv_id, $number, $channel_id);
	}
	
}

?>
