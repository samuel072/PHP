<?php

require_once(ykfile('source/model/adv_model.php'));
require_once(ykfile('source/dbtables/db.php'));

class AdvTable extends DB
{
	public function table_name() {
		return "adv";
	}

	public function dbobj_to_model($obj) {
		$adv = new AdvModel();
		$adv->id = $obj->id;
		$adv->title = $obj->title;
		$adv->summary = $obj->summary;
		$adv->type = $obj->type;
		$adv->link = $obj->link;
		$adv->image = $obj->image;

		return $adv;
	}

	public function get_by_channel($channel_id, $next_id, $count) {
		$table = $this->table_name();
		$sql = "select a.* from $table as a, channel_adv as ca where ca.channel_id = $channel_id and ca.adv_id = a.id order by ca.number limit $next_id, $count";

		return $this->get_list_by_sql($sql);
	}

	public function get_adv($next_id, $count) {
		$table = $this->table_name();
		$sql = "select * from $table limit $next_id, $count";

		return $this->get_list_by_sql($sql);
	}

	public function insert_adv($adv) {
		$table = $this->table_name();

		$type = $adv->type;
		$title = $adv->title;
		$summary = $adv->summary;
		$link = $adv->link;
		$image = $adv->image;

		$sql = "insert into $table (type, title, summary, link, image) values ($type, '$title', '$summary', '$link', '$image')";

		if(mysql_query($sql)) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	public function update_adv($adv) {
		$table = $this->table_name();

		$id = $adv->id;
		$type = $adv->type;
		$title = $adv->title;
		$summary = $adv->summary;
		$link = $adv->link;
		$image = $adv->image;

		$sql = "update $table set type = $type, title = '$title', summary = '$summary', link = '$link', image = '$image' where id = $id";

		return mysql_query($sql);
	}
	
	public function get_count() {
		$table = $this->table_name();
		
		$sql = "select count(*) from $table";
		
		$result = mysql_query($sql);
		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}
	
	//修改广告位与channel的中间表
	public function update_adv_channel($adv_id, $number, $channel_id) {
		$sql = "update channel_adv set adv_id = $adv_id where channel_id = $channel_id and number=$number " ;
		return mysql_query($sql, $this->conn);
	}
}

?>
