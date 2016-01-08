<?php	

require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/comment_model.php"));

class CommentTable extends DB
{
	public function table_name() {
		return 'comment';
	}

	public function dbobj_to_model($obj) {
		$comment = new CommentModel();
		$comment->id = $obj->id;
		$comment->user->uuid = $obj->user_id;
		$comment->activity->id = $obj->activity_id;
		$comment->video_live->id = $obj->video_id;
		$comment->detail = $obj->detail;
		$comment->subtime = $obj->sub_time;
		$comment->state = $obj->state;
		$comment->reason = $obj->reason;
		$comment->position = $obj->position;

		return $comment;
	}

	// 取指定活动的评论
	public function get_comments($act_id, $next_id = 0, $count = 10) {
		$where = '';
		if($act_id !== NULL) {
			$where = "where activity_id = $act_id";
		}
		$sql = "select * from comment $where order by position, sub_time desc limit $next_id, $count";
		$list = $this->get_list_by_sql($sql);

		return $list;
	}

	// 取指定活动的评论数量
	function get_count_by_act($act_id) {
		$where = '';
		if($act_id !== NULL) {
			$where = " where activity_id = $act_id";
		}

		$sql = "select count(*) from " . $this->table_name() . $where;
		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	// 插入一条评论，返回ID
	function insert_comment($comment) {
		$user_id = $comment->user->uuid;
		$act_id = $comment->activity->id;
		$video_id = $comment->video_live->id;
		$detail = $comment->detail;
		$state = CommentModel::state_published;
		$sub_time = date('Y-m-d H:i:s');
		$reason = '';

		$sql = "insert into comment(user_id, activity_id, video_id, detail, sub_time, state, reason) values ('$user_id', '$act_id', '$video_id', '$detail', '$sub_time', $state, '$reason')";

		if(mysql_query($sql, $this->conn)) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}

	function remove_comment($com_id) {
		$table = $this->table_name();
		$sql = "delete from $table where id = $com_id";

		return mysql_query($sql);
	}
	
	/**
	 * 根据视频直播的id  查询出对应的评论列表
	 * @param $vid  视频直播的id
	 */
	public function get_comments_by_vid($vid) {
		$table_name = $this->table_name();
		
		$sql = "select a.* from $table_name as a where a.video_id = $vid order by a.sub_time desc";
		return $this->get_list_by_sql($sql);
	}
	
	
}

?>
