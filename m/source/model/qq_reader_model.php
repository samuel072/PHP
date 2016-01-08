<?php
require_once(ykfile("source/model/user_model.php"));

class QQReaderModel {
	
	public $qq_open_id;			//qq_open_id
	public $user;						// -->reader_id
	
	public function __construct() {
		$this->user = new UserModel();
	}
	
}
?>