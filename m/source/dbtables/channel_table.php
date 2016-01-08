<?php	

require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/channel_model.php"));

class ChannelTable extends DB
{
	public function table_name() {
		return 'channel';
	}

	public function dbobj_to_model($obj) {
		$channel = new ChannelModel();
		$channel->id = $obj->id;
		$channel->type = intval($obj->type);
		$channel->name = $obj->name;
		$channel->summary = $obj->summary;
		$channel->seo_title = $obj->seo_title;
		$channel->seo_desc = $obj->seo_desc;
		$channel->thumbnail = $obj->thumbnail;
		$channel->seo_alt = $obj->seo_alt;
		$channel->seo_keywords = $obj->seo_keywords;

		return $channel;
	}

	public function get_channels($next_id = 0, $count = 10) {
		$table = $this->table_name();
		$sql = "select * from $table limit $next_id, $count";
		$list = $this->get_list_by_sql($sql);

		return $list;
	}

	public function insert_channel($ch) {
		$table = $this->table_name();

		$type = $ch->type;
		$name = $ch->name;
		$summary = $ch->summary;
		$seo_title = $ch->seo_title;
		$seo_desc = $ch->seo_desc;
		$thumb = $ch->thumbnail;
		$seo_alt = $ch->seo_alt;
		$keywords = $ch->seo_keywords;

		$sql = "insert into $table(type, name, summary, seo_title, seo_desc, thumbnail, seo_alt, seo_keywords) values ($type, '$name', '$summary', '$seo_title', '$seo_desc', '$thumb', '$seo_alt', '$keywords')";

		if(mysql_query($sql, $this->conn)) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}

	public function update_channel($ch) {
		$table = $this->table_name();
		$cid = $ch->id;

		$type = $ch->type;
		$name = $ch->name;
		$summary = $ch->summary;
		$seo_title = $ch->seo_title;
		$seo_desc = $ch->seo_desc;
		$thumb = $ch->thumbnail;
		$seo_alt = $ch->seo_alt;
		$keywords = $ch->seo_keywords;
	
		$sql = "update $table set type = $type, name = '$name', summary = '$summary', seo_title = '$seo_title', seo_desc = '$seo_desc', thumbnail = '$thumbnail', seo_alt = '$seo_alt', seo_keywords = '$keywords' where id = $cid";
		return mysql_query($sql);
	}	
}

?>
