<?php	
	require_once(ykfile("source/dbtables/db.php"));
	require_once(ykfile("source/model/talker_model.php"));
	
	class TalkerTable extends DB {

		public function table_name() {
			return "talker";
		}

		public function dbobj_to_model($obj) {
			$talkers=new TalkerModel();
			$talkers->id = $obj->id;
			$talkers->name= $obj->name;
			$talkers->points = $obj->points;
			$talkers->image = $obj->image;
			return $talkers;
		}

		/**
		*	查询全部的演讲
		*/
		public function get_all($next_id,$count) {
			$table = $this->table_name();
			$sql = "select * from $table ORDER BY id desc limit " .$next_id." ," .$count;
			$talkerList = $this->get_list_by_sql($sql);
			if(count($talkerList) != 0){
				return $talkerList;
			}else{
				return NULL;
			}
		}

		
		/**
		* 根据id查询一个talker对象
		* @param: $uuid talker_id
		*/
		public function get_talker_id($uuid){
			return $this->getDataByAtr("id", $uuid);	
		}
		// 某人点击数加1
		public function add_point($uuid) {
			$talker = $this->get_talker_id($uuid);
			$points = $talker[0]->points+1;
			$where = "id = ".$uuid;
			$this->update($column = array("points"=>$points), $where);
		}

		// 获取某人点击数 
		public function get_point($uuid) {
			$talker = $this->get_talker_id($uuid);
			return $talker[0]->points;
		}

		public function get_by_channel($cid, $next_id, $count) {
			$table = $this->table_name();
			$sql = "select t.* from $table as t, channel_talker as ac where ac.talker_id = t.id and ac.channel_id = $cid order by ac.number limit $next_id, $count";
			return $this->get_list_by_sql($sql);
		}
		
		/**
		* 保存人物基本信息
		*@param $name  		人物名称
		*@param $image		人物图片地址
		*/
		public function save_talker($talker) {
			$table = $this->table_name();
			$id = @$talker->id;
			$name = $talker->name;
			$image = $talker->image;
			$points = $talker->points;
			if($id) { // 执行修改
				$sql = "update $table set name = '$name', points = $points, image = '$image' where id = $id";
				return mysql_query($sql, $this->conn);
			}else { // 执行添加方法
				$sql = "insert into $table (name, points, image) values ('$name', $points, '$image')";
				if(mysql_query($sql, $this->conn)) {
					$id = mysql_insert_id($this->conn);
					return $id;
				} else {
					return false;
				}
			}
			
			
			
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
		
		public function update_talker_channel($talker_id, $number, $channel_id) {
			$sql = "update channel_talker set talker_id = $talker_id where channel_id = $channel_id and number = $number ";
			return mysql_query($sql, $this->conn);
		}
	}
?>
