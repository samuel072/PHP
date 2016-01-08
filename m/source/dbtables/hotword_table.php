<?php

require_once(ykfile('source/model/hotword_model.php'));
require_once(ykfile('source/dbtables/db.php'));

class HotWordTable extends DB
{
	public function table_name() {
		return 'keywords';
	}

	public function dbobj_to_model($obj) {

		$word = new HotWordModel();
		$word->id = $obj->id;
		$word->word = $obj->word;
		$word->heat = $obj->heat;

		return $word;
	}

	//  取所有热词
	public function get_words() {

		$table = $this->table_name();
		$sql = "select * from $table";

		$list = $this->get_lst_by_sql($sql);
        return $list;
	}

	// 插入一条热词，返回ID
	public function insert_word($hotword) {
		$table = $this->table_name();
		$word = $hotword->word;
		$heat = $hotword->heat;

		$sql = "insert into $table(word, heat) values('$word', $heat)";
		if(mysql_query($sql)) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	public function update_word($hotword) {
		$table = $this->table_name();
		$word = $hotword->word;
		$heat = $hotword->heat;

		$sql = "update $table set word = $word, heat = $heat where id = $id";
		return mysql_query($sql);
	}
}

?>
