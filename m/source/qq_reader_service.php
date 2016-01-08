<?php
require_once(ykfile("source/modules/qq_reader_module.php"));

class QQReaderService{
	
	public function check_open_id($open_id) {
		$qq_reader_mod = new QQReaderModule();
		return $qq_reader_info = $qq_reader_mod->check_open_id($open_id);
	}
	
}
?>