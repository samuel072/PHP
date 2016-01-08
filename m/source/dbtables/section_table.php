<?php
require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/section_model.php"));

class SectionTable extends DB
{
	public function table_name() {
		return "section";
	}

	public function dbobj_to_model($section) {
		$sec_model = new SectionModel();
		$sec_model->id = $section->id;
		$sec_model->type = $section->type;		
		$sec_model->detail = $section->detail;		
		$sec_model->image_path = $section->image_path;	
		$sec_model->seo_alt = $section->seo_alt;	
		$sec_model->activity_id = $section->activity_id;
		$sec_model->link = $section->link;		
		$sec_model->num = $section->num;
		return $sec_model;
	}
	
	/**
	* 根据id  查询段落的内容
	* @param $actId  活动的id
	*/
	public function get_section_by_id($actId){
		$sql = "select a.* from section as a where a.activity_id = ".$actId." ORDER BY num";
		$sect_list = $this->get_list_by_sql($sql);
		return $sect_list;
	}

	public function insert_section($section) {
		$table = $this->table_name();

		$type = $section->type;
		$detail = $section->detail;
		$image_path = $section->image_path;
		$seo_alt = $section->seo_alt;
		$activity_id = $section->activity_id;
		$video_id = $section->video_id;
		$link = $section->link;
		$num = $section->num;

		$sql = "insert into $table (type, detail, image_path, seo_alt, activity_id, video_id, link, num) values ($type, '$detail', '$image_path', '$seo_alt', '$activity_id', '$video_id', '$link', $num)";

		if(mysql_query($sql, $this->conn)) {
			return mysql_insert_id();
		} else {
			return false;
		}
	}

	public function update_section($section) {
		$table = $this->table_name();
		
		$id = $section->id;
		$type = $section->type;
		$detail = $section->detail;
		$image_path = $section->image_path;
		$seo_alt = $section->seo_alt;
		$activity_id = $section->activity_id;
		$video_id = $section->video_id;
		$link = $section->link;
		$num = $section->num;

		$sql = "update $table set type = '$type', detail = '$detail', image_path = '$image_path', seo_alt = '$seo_alt', activity_id = '$activity_id', video_id = '$video_id', link = '$link', num = $num where id = $id";

		if(mysql_query($sql, $this->conn)) {
			return true;
		} else {
			file_put_contents("/tmp/yike.log", mysql_error() . "\n", FILE_APPEND);
			return false;
		}
	}

	public function remove_section($sec_id) {
		$table = $this->table_name();
		$sql = "delete from $table where id = $sec_id";

		return mysql_query($sql, $this->conn);
	}
	
	/**
	 * 根据video_id查询内容信息
	 * @param  $video_id video_live 的id	 */
	public function get_sec_by_videoId($video_id) {
		$table_name = $this->table_name();
		$sql = "select a.* from $table_name as a where a.video_id = $video_id ORDER BY num";
		return $this->get_list_by_sql($sql);
	}
	
}

?>
