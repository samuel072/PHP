<?php

require_once(ykfile('source/dbtables/commodity_table.php'));
require_once(ykfile('source/dbtables/exchange_table.php'));
require_once(ykfile('source/modules/commodity_module.php'));

class CommodityModule
{
	public function __construct() {
	}

	public function get_by_id($com_id) {
		$table = new CommodityTable();
		return $table->get_by_id($com_id);
	}

	public function dec_count($com_id) {
		$table = new CommodityTable();
		return $table->dec_count($com_id);
	}

	public function add_exch_record($com_id, $user_id, $mobile, $address, $name) {

		$exch = new ExchangeModel();
		$exch->commodity->id = $com_id;
		$exch->user->uuid = $user_id;
		$exch->mobile = $mobile;
		$exch->name = $name;
		$exch->address = $address;
		$exch->exch_time = date('Y-m-d H:i:s');
		$exch->state = ExchangeModel::state_waiting;

		$table = new ExchangeTable();
		$result = $table->insert_exchange($exch);
		if(!$result) {
			return ERR_INTERNAL;
		}

		$exch_rec = $table->get_by_id($result);

		return $exch_rec;
	}
	
	public function get_commodity($next_id, $count) {
		$table = new CommodityTable();
		return $table->get_commodity($next_id, $count);
	}
	
	public function get_count() {
		$table = new CommodityTable();
		return $table->get_count();
	}
	
	// 保存一个礼品信息
	public function save_commodity($commodity) {
		$table = new CommodityTable();
		return $table->save_commodity($commodity);
	}

	// 修改一个礼品信息
	public function update_commodity($commodity) {
		$table = new CommodityTable();
		return $table->update_commodity($commodity);
	}
	
}

?>
