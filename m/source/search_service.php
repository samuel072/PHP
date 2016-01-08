<?php

require_once(ykfile('source/dbtables/hotword_table.php'));
require_once(ykfile('source/modules/activity_module.php'));

class SearchService
{
	public function get_act_by_ids($ids) {
		$act_mod = new ActivityModule();
		$act_ids = "";
		foreach($ids as $id) {
			$act_ids .= $id.",";
		}
		
		$act_ids = substr($act_ids, 0, strlen($act_ids)-1);
		return $act_mod->get_act_by_ids($act_ids);
	}
}
