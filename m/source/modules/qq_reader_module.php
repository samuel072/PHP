<?php
require_once(ykfile("source/dbtables/qq_reader_table.php"));
class QQReaderModule {
	
	// 检测open_id
	public function check_open_id($open_id) {
		$qq_reader_tab = new QQReaderTable();
		return $qq_reader_tab->get_by_open_id($open_id);
	}
	
	/**
	* open_id  QQ的唯一标识符
	* user_id  reader 的 id   
	*/
	public function save_qq_reader($open_id, $user_id) {
		$qq_reader_tab = new QQReaderTable();
		return $qq_reader_tab->save_qq_reader($open_id, $user_id);
	}
}
?>
