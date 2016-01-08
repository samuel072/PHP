<?php

require_once(ykfile("source/dbtables/commodity_table.php"));
require_once(ykfile("source/dbtables/exchange_table.php"));
require_once(ykfile("source/modules/commodity_module.php"));
require_once(ykfile("source/user_service.php"));

class CommodityService
{
	private $com_table;
	private $exch_table;

	public function __construct() {
		$this->com_table = new CommodityTable();
		$this->exch_table = new ExchangeTable();
	}

	public function get_by_id($com_id) {
		$commod = new CommodityModule();
		return $commod->get_by_id($com_id);
	}

	public function get_commodity($next_id, $count) {
		$commod = new CommodityModule();
		return $commod->get_commodity($next_id, $count);
	}

	public function dec_com($com_id) {
		$commod = new CommodityModule();
		return $commod->dec_count($com_id);
	}

	public function get_count() {
		$commod = new CommodityModule();
		return $commod->get_count();
	}

	public function save_commodity($commodity) {
		$comm_mod = new CommodityModule();
		if($commodity->id) { // update
			return $comm_mod->update_commodity($commodity);
		}else { // insert
			return $comm_mod->save_commodity($commodity);
		}
	}

	public function is_remove_commodity($id, $is_delete) {
		$comm_mod = new CommodityModule();
		return $comm_mod->is_remove($id, $is_delete);
	}

	public function get_exchange_record($user_id, $next_id, $count) {
		return $this->exch_table->get_record($user_id, $next_id, $count);
	}

	public function get_exchange_record_count($user_id) {
		return $this->exch_table->get_count_by_user($user_id);
	}

	public function add_exch_record($com_id, $user_id, $mobile, $address, $name) {
		$commod = new CommodityModule();
		return $commod->add_exch_record($com_id, $user_id, $mobile, $address, $name);
	}
	

	//  -------------------- 后台的兑换礼品记录  ------------------------

	public function get_exchange_record_all($next_id, $count) {
		$exch_list = $this->exch_table->get_all($next_id, $count);
		$userSer = new UserService(NULL);
		foreach($exch_list as $exch) {
			$user = $userSer->get_by_uuid($exch->user->uuid);
			$exch->user = $user;
		}	
		
		return $exch_list;
	}

	// 获取所有的数量兑换记录	
	public function get_count_all() {
		return $this->exch_table->get_count();
	}










}

?>
