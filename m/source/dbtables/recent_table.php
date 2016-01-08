<?php 
	require_once(ykfile("source/dbtables/db.php"));
	
	class RecentTable extends DB{
		public function table_name() {
			return "activity";
		}

		public function dbobj_to_model($obj) {
            $act = new ActivityModel();
            $act->id = $obj->id;
            $act->type = $obj->type;
            $act->guest_name = $obj->guest_name;
            $act->guest_avatar = $obj->guest_avatar;
            $act->guest_intro = $obj->guest_intro;
            $act->title = $obj->title;
            $act->summary = $obj->summary;
            $act->seo_title = $obj->seo_title;
            $act->thumbnail = $obj->thumbnail;
            $act->seo_alt = $obj->seo_alt;
            $act->state = $obj->state;
            $act->author->uuid = $obj->author_id;
            $act->start_time = $obj->start_time;
            $act->end_time = $obj->end_time;
            $act->address = $obj->address;
            $act->longitude = $obj->longitude;
            $act->latitude = $obj->latitude;
            $act->modify_time = $obj->modify_time;
            $act->seo_keywords = $obj->seo_keywords;
            $act->holder = $obj->holder;
            $act->is_delete = $obj->is_delete;
            $act->position = $obj->position;
            $act->message = $obj->message;
            $act->content = array();
            return $act;
		
		}
		/**
		* 根据类型查询预告的activity
		* @param $nowTime	当前服务器的时间
		* @param $next_id	开始条数
		* @param $pagesize	每次查询数据的大小	
		*/
		public function get_recent_all($nowTime,$next_id,$pagesize){
			$sql = "select a.* from activity as a where a.state = 2 and '$nowTime'<= a.start_time order by a.position desc, a.start_time limit $next_id, $pagesize";
			$recent_list = $this->get_list_by_sql($sql);
			return $recent_list;
		}

		public function get_count() {
			$table_name = $this->table_name();
			date_default_timezone_set("Asia/Shanghai");
			$nowTime = date("Y-m-d H:i:s"); 
			$sql = "select count(*) from $table_name as a where '$nowTime' <= a.start_time and a.state = 2";

			$result = mysql_query($sql);
			if(!$result) {
				return 0;
			}else {
				list($num) = mysql_fetch_row($result);

				return $num;
		
			}
			
		}

	}

?>
