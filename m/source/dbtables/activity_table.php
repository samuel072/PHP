<?php
	require_once(ykfile("source/dbtables/db.php"));
	require_once(ykfile("source/model/activity_model.php"));
	require_once(ykfile("source/model/section_model.php"));

	class ActivityTable extends DB {

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
			$act->allow = $obj->allow;
            $act->is_free = $obj->is_free;
            $act->link = $obj->link;
			$act->content = array();
			return $act;
		}

		// 遍历表
		public function get_activity($next_id, $count) {
			$table = $this->table_name();
			$sql = "select * from $table limit $next_id, $count";

			return $this->get_list_by_sql($sql);
		}

		public function get_type_count($tag_id, $type) {
			$table = $this->table_name();

			$sql = "select count(*) from $table where type = $type";
			if($tag_id) {
			}

			$result = mysql_query($sql);
			if(!$result) {
				return 0;
			}
			list($num) = mysql_fetch_row($result);
			return $num;
		}

		/**
		* 查询分页式的活动
		* @param $next_id    从那一条数据开始
		* @param $pagesize   数据大小
		* return 返回的是没有被推荐的活动列表
		*/
        public function get_all_by_type($tag_id, $next_id, $pagesize, $type ,$is_delete) {
			date_default_timezone_set("Asia/Shanghai");
			$nowTime = date("Y-m-d H:i:s");
        	if ($is_delete === NULL) { // 后台admin
				if($tag_id) {
					 $sql = "SELECT  a.* FROM activity a,tag_activity ta WHERE a.type = ".$type."  AND a.id = ta.activity_id AND ta.tag_id = ".$tag_id ." ORDER BY a.position DESC , a.modify_time DESC LIMIT " .$next_id." , ".$pagesize;
				} else {
					$sql="SELECT  a.* FROM activity a WHERE a.type = ".$type." ORDER BY position DESC , modify_time DESC LIMIT " .$next_id." , ".$pagesize;
				}
        	}else { // 前台
        		if($tag_id) {
        			$sql = "SELECT  a.* FROM activity a,tag_activity ta WHERE a.type = ".$type."  AND a.id = ta.activity_id AND ta.tag_id = ".$tag_id ." AND a.is_delete = 0 and a.state =2 GROUP BY a.id ORDER BY a.position DESC , a.modify_time DESC LIMIT " .$next_id." , ".$pagesize;
        		} else {
					if($type == 0) { // 演讲
						$sql = "select a.* from activity a where '$nowTime' >= a.end_time and a.type = $type and a.is_delete = 0 and a.state = 2 group by a.id order by position desc, a.modify_time desc limit $next_id, $pagesize";
					}else {
        				$sql="SELECT  a.* FROM activity a WHERE a.type = ".$type." AND a.is_delete = 0 and a.state =2 GROUP BY a.id ORDER BY position DESC , modify_time DESC LIMIT " .$next_id." , ".$pagesize;
					}
        		}
        	}
			
			$list = $this->get_list_by_sql($sql);
			return $list;
        }


		/**
		*
		* @param $type:	活动的类型
		* @param acts: 	not in the array
		*/
		public function get_by_type_not_in($next_id, $pagesize, $type, $acts) {

		}
		/**
		* 查询分页式的活动
		* @param $next_id    从那一条数据开始
		* @param $pagesize   数据大小
		* @param $channel_id 栏目id
		* return 返回的是推荐的活动列表
		*/
		public function get_all_by_channel_and_type($next_id,$pagesize,$type,$channel_id){
			$sql = "SELECT a.* FROM activity AS a ,channel AS c ,channel_activity AS ac WHERE  a.id = ac.activity_id AND c.id = ac.channel_id and a.type=".$type." and a.state=2 and a.is_delete=0 and c.id=".$channel_id. " ORDER  BY ac.number limit ". $next_id." , ".$pagesize;
			$activity_list = $this->get_list_by_sql($sql);
			if(empty($activity_list)){
				return 1000;
			}else{
				return $activity_list;
			}
		}

		public function get_by_channel($ch_id, $next_id, $count) {
			$table = $this->table_name();
			$sql = "select a.* from $table as a, channel_activity as ac where ac.channel_id = $ch_id and a.id = ac.activity_id and a.is_delete = 0 and a.state = 2 order by ac.number desc, a.start_time, a.modify_time desc limit $next_id, $count";

			$list = $this->get_list_by_sql($sql);
			return $list;
		}

		// 在指定channel当中，找到结束时间早于指定时间的活动
		public function get_after_time($time, $channel, $count) {
			$table = $this->table_name();
			$sql = "select a.* from $table as a, channel_activity as ac where ac.channel_id = $channel and a.id = ac.activity_id and end_time < '$time' limit 0, $count";

			$list = $this->get_list_by_sql($sql);
			return $list;
		}

		/**
		* 查询可以报名的沙龙活动
		* @param $next_id 	开始条数
		* @param $pagesize 	查询数据的大小
		* @param $type		活动的类型
		* @param $nowTime	当前时间
		*/
		public function get_all_by_type_and_time($next_id,$pagesize,$type,$nowTime){
			$sql="SELECT  * FROM activity  WHERE type = ".$type." AND activity.state = 2 AND is_delete = 0 AND activity.start_time > '".$nowTime."' ORDER BY position DESC , modify_time DESC LIMIT ".$next_id." , ".$pagesize;
			$list = $this->get_list_by_sql($sql);
			if(!empty($list) && $list != 1000){
				return $list;
			}else{
				return 1000;
			}
		}
		/**
		* 根据标签id和活动类型查询活动
		* @param $tag_id  标签id
		* @param $type 活动类型
		*/
		public function get_act_by_tag($next_id,$pagesize,$tag_id,$type){
			$sql = "select a.* from activity a,tag_activity ta,tag t where t.id = ta.tag_id and a.id = ta.activity_id and t.id = ".$tag_id."  and a.type = ".$type." and a.is_delete = 0 and a.state = 2 order by position desc limit ". $next_id." , ".$pagesize;
			$list = $this->get_list_by_sql($sql);
			if(empty($list)){
				return 1000;
			}else{
				return $list;
			}
		}

		// 根据发布者ID获取活动
		public function get_act_by_user($user_id, $next_id, $count) {
			$table = $this->table_name();
			$sql = "select * from $table where author_id = $user_id limit $next_id, $count";

			$list = $this->get_list_by_sql($sql);
			return $list;
		}

		// 插入
		public function insert_activity($act) {
			$table = $this->table_name();
			$type = intval($act->type);
			$guest_name = $act->guest_name;
			$guest_avatar = $act->guest_avatar;
			$guest_intro = $act->guest_intro;
			$title = $act->title;
			$summary = $act->summary;
			$seo_title = $act->seo_title;
			$thumbnail = $act->thumbnail;
			$seo_alt = $act->seo_alt;
			$state = intval($act->state);
			$author_id = $act->author->uuid;
			$start_time = $act->start_time;
			$end_time = $act->end_time;
			$address = $act->address;
			$longitude = $act->longitude;
			$latitude = $act->latitude;
			$modify_time = $act->modify_time;
			$seo_keywords = $act->seo_keywords;
			$holder = $act->holder;
			$allow = $act->allow;
            $is_free = $act->is_free;
            $link = $act->link;   

			$sql = "insert into $table (type, guest_name, guest_avatar, guest_intro, title, summary, seo_title, thumbnail, seo_alt, state, author_id, start_time, end_time, address, longitude, latitude, modify_time, seo_keywords, is_delete, holder, position, allow, is_free, link) values ($type, '$guest_name', '$guest_avatar', '$guest_intro', '$title', '$summary', '$seo_title', '$thumbnail', '$seo_alt', $state, '$author_id', '$start_time', '$end_time', '$address', @$longitude, @$latitude, '$modify_time', '$seo_keywords', 0, '$holder', 0, '$allow', '$is_free', '$link')";

			if(mysql_query($sql, $this->conn)) {
				return mysql_insert_id($this->conn);
			} else {
				file_put_contents("/tmp/yike.log", mysql_error() . "\n", FILE_APPEND);
				return false;
			}
		}

		// 更新状态
		public function update_state_time($act_id, $type, $time) {
			$table = $this->table_name();
			$sql = "update $table set type = $type, modify_time = '$time' where id = $act_id";

			return mysql_query($sql, $this->conn);
		}

		// 设置删除
		public function set_deleted_time($act_id, $del, $time) {
			$table = $this->table_name();
			$sql = "update $table set is_delete = $del, modify_time = '$time' where id = $act_id";
			return mysql_query($sql, $this->conn);
		}

		// 更新封面和时间
		public function update_thumbnail_time($act_id, $path, $time) {
			$table = $this->table_name();
			$sql = "update $table set thumbnail = '$path', modify_time = '$time' where id = $act_id";

			return mysql_query($sql, $this->conn);
		}

		// 设置位置
		public function set_position_time($act_id, $pos, $time) {
			$table = $this->table_name();
			$sql = "update $table set position = $pos, modify_time = '$time' where id = $act_id";

			return mysql_query($sql, $this->conn);
		}

		// 更新
		public function update_activity($act) {
			$table = $this->table_name();
			$aid = $act->id;
			$type = $act->type;
			$guest_name = $act->guest_name;
			$guest_avatar = $act->guest_avatar;
			$guest_intro = $act->guest_intro;
			$title = $act->title;
			$summary = $act->summary;
			$seo_title = $act->seo_title;
			$thumbnail = $act->thumbnail;
			$seo_alt = $act->seo_alt;
			$state = $act->state;
			$author_id = $act->author->uuid;
			$start_time = $act->start_time;
			$end_time = $act->end_time;
			$address = $act->address;
			$longitude = $act->longitude;
			$latitude = $act->latitude;
			$modify_time = $act->modify_time;
			$seo_keywords = $act->seo_keywords;
			$holder = $act->holder;
			$position = $act->position;
			$allow = $act->allow;
            $is_free = $act->is_free;
            $link = $act->link;   

			$sql = "update $table set type = $type, guest_name = '$guest_name', guest_avatar = '$guest_avatar', guest_intro = '$guest_intro', title = '$title', summary = '$summary', seo_title = '$seo_title', thumbnail = '$thumbnail', seo_alt = '$seo_alt', state =$state, author_id = '$author_id', start_time = '$start_time', end_time ='$end_time', address = '$address', longitude = $longitude, latitude =$latitude, modify_time = '$modify_time', seo_keywords = '$seo_keywords', holder = '$holder', position = $position, allow = '$allow', is_free = '$is_free', link = '$link' where id = $aid";
			return mysql_query($sql, $this->conn);
		}
		// 根据标签id和活动类型查询活动预告
		/*public function get_recent_by_tagId($channel_id, $tag_id, $next_id, $count){
			$nowTime = date("Y-m-d H:i:s");
			if($tag_id){
				$sql ="SELECT a.* FROM  activity a ,tag_activity ta,channel_activity ca  WHERE a.is_delete = 0 AND a.state = 2 AND ca.activity_id = a.id AND  ta.activity_id = a.id AND ca.channel_id = $channel_id AND ta.tag_id = $tag_id AND '$nowTime' <= a.start_time ORDER BY ca.number DESC, a.start_time LIMIT $next_id, $count";
				return $this->get_list_by_sql($sql);
			}else{
				return $this->get_by_channel($channel_id, $next_id, $count);
			}
		}*/
		
		public function get_recent_by_tagId($tag_id, $next_id, $count) {
			$table_name = $this->table_name();
			if($tag_id) {
			  date_default_timezone_set("Asia/Shanghai");
			  $nowTime = date("Y-m-d");
			
			  $sql = "SELECT a.* FROM $table_name AS a , tag AS t , tag_activity AS ta WHERE a.id = ta.activity_id AND t.id = ta.tag_id AND a.is_delete = 0 AND a.state = 2 AND t.id = $tag_id AND IF(a.type = 0 , a.start_time >= '$nowTime' , '1=1') ORDER BY a.position DESC, a.start_time desc limit $next_id, $count";

				return $this->get_list_by_sql($sql);
			}else {
				return $this->get_recent($next_id, $count);
			}
			
			
		}
		
		// 获取演讲的预告和沙龙的预告 以及沙龙的不是预告
		public function get_recent($next_id, $count) {
			$table_name = $this->table_name();
			date_default_timezone_set("Asia/Shanghai");
			$nowTime = date("Y-m-d");
			
			$sql = "SELECT a.* FROM activity AS a WHERE a.type != 2 AND a.is_delete = 0 AND a.state = 2 and if(a.type = 0, a.start_time >= '$nowTime', '1=1') ORDER BY a.position DESC, a.start_time DESC  limit $next_id, $count";

			file_put_contents("/tmp/yike.log", "get_recnet-->".$sql."\n", FILE_APPEND);
			return $this->get_list_by_sql($sql);
			
		}

		// 修改channel_activity
		public function update_activity_channel($act_id, $number, $channel_id) {
			$sql = "update channel_activity set activity_id = $act_id where channel_id = $channel_id and number = $number ";
			return mysql_query($sql, $this->conn);
		}
		
		//根据发布状态获取对应的数据
		public function get_pub_act_by_state($state, $next_id, $count) {
			$table_name = $this->table_name();
			$sql = "select t.* from $table_name as t where t.state != $state order by modify_time desc limit $next_id, $count";
			return $this->get_list_by_sql($sql);
		}
		
		public function get_count_by_state($state) {
			$table_name = $this->table_name();
			$sql = "select count(*) from $table_name where state = $state";
			
			$result = mysql_query($sql, $this->conn);
			if(!$result) {
				return 0;
			} else {
				list($num) = mysql_fetch_row($result);
				return $num;
			}
		}
		
		// 根据活动的id 修改其状态  0  待审核 1 驳回 2 通过
		public function set_act_state($act_id, $state, $reject_message) {
			$table_name = $this->table_name();
			$sql = "update $table_name set state = $state, message = '$reject_message'  where id = $act_id ";
			$result = mysql_query($sql, $this->conn);
			
			if(!$result) {
				return false;
			} else {
				return true;
			}
			
		}
	
		// 根据activity 的id 集合  查询出这个集合对应的数据
		public function get_act_by_ids($ids) {
			$table_name = $this->table_name();
			$sql = "select a.* from $table_name as a where id in ($ids)";

			return  $this->get_list_by_sql($sql);
		}
			
	}
?>
