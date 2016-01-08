<?php  
	include_once(ykfile("source/dbtables/db.php"));
	include_once(ykfile("source/model/tag_model.php"));
	class TagTable extends DB {
		public function table_name() {
			return "tag";
		}

		// 把数据库对像，转换成模型类对像，DB每个子数必须重载
		public function dbobj_to_model($obj) {
			$tagModel = new TagModel();
			$tagModel->id = $obj->id;
			$tagModel->name = $obj->name;
			$tagModel->thumbnail = $obj->thumbnail;
			$tagModel->seo_alt = $obj->seo_alt;
			return $tagModel;
		}

		public function get_defualt($channel_id){
			$sql = "select t.* from tag t , channel_tag ct where t.id = ct.tag_id and ct.channel_id = ".$channel_id;
			$tag_list = $this->get_list_by_sql($sql);
			return empty($tag_list) ? 1000 : $tag_list;
		}
		
		//* 查询所有的标签对象
		public function get_all() {
			$table_name = $this->table_name();
			$sql = "select t.* from $table_name as t";
			return $this->get_list_by_sql($sql);
		}
		
		/**
		* 通过外键查询对应的标签集合
		* @param $act_id activity表的id
		* return $tag_list 标签集合
		*/
		public function get_tag_by_actId($act_id) {
			$table_name = $this->table_name();
			$sql = "SELECT t.* FROM $table_name t ,tag_activity ta WHERE ta.activity_id = $act_id AND ta.tag_id = t.id";
			return $this->get_list_by_sql($sql);
		}
		
		/**
		 * 通过video的id  查询这个直播视频对应的标签
		 * @param $videoId 视频直播的id
		 */
		public function get_video_tag_by_videoId($videoId){
			$table_name = $this->table_name();
			$sql = "select a.* from $table_name as a, tag_video as tv, video_live as vl where a.id = tv.tag_id and vl.id = tv.video_id and vl.id = $videoId ";
			return $this->get_list_by_sql($sql);
		}
	}

?>
