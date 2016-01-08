<?php

require_once(ykfile("source/dbtables/comment_table.php"));
require_once (ykfile("source/modules/user_module.php"));

class CommentService
{	
	/**
	 * 获取指定活动的评论列表
	 * 		需要组装数据   1、评论的内容  2、评论用户的图像
	 * @param unknown $act_id		活动id
	 * @param unknown $next_id		开始的数据条数
	 * @param unknown $count		每次的数量
	 * @return ：array
	 */
	public function get_comments($act_id, $next_id, $count) {
		$table = new CommentTable();
		$comm_list = $table->get_comments($act_id, $next_id, $count);
		
		$userModule = new UserModule(@$user_id);
		date_default_timezone_set("Asia/Shanghai");
		
		foreach ($comm_list as $comment) {
			$user_info = $userModule->get_by_id($comment->user->uuid);
			$now_time = date("Y-m-d H:i:s");
			$comm_sub_time = $comment->subtime;
			$timestamp = strtotime($now_time)-strtotime($comm_sub_time);
		
			$str_time = "";
			if($timestamp < 0) {
				$str_time = $timestamp;	
			} else if ($timestamp < 60) { //
				$str_time = $timestamp . "秒前";
			} else if ($timestamp < 3600) {
				$str_time = floor($timestamp / 60) . "分钟前";
			} else if($timestamp < 86400) {
				$str_time = floor($timestamp / 3600) . "小时前";
			} else if($timestamp < 259200){ // 3天
				$str_time = floor($timestamp / 86400) . "天前";
			} else {
				$str_time = "3天以前";
			}
					  
			$comment->subtime = $str_time; // 距离现在过了多久
			$comment->user = $user_info[0];
		}
		
		return $comm_list;
	}
	
	/**
	 * 取指定活动的评论数量
	 * @param unknown $act_id		活动id
	 * @return 
	 */
	public function get_count_by_act($act_id) {
		$table = new CommentTable();
		return $table->get_count_by_act($act_id);
	}

	public function remove_comment($com_id) {
		$table = new CommentTable();
		return $table->remove_comment($com_id);
	}
	
	/**
	 * 根据视频直播的id  查询出对应的评论列表
	 * @param unknown $vid
	 */
	public function get_comment_by_vid($vid){
		$table = new CommentTable();
		$comm_list = $table->get_comments_by_vid($vid);
		$userModule = new UserModule(@$user_id);
		date_default_timezone_set("Asia/Shanghai");
		
		foreach ($comm_list as $comment) {
			$user_info = $userModule->get_by_id($comment->user->uuid);
			$now_time = date("Y-m-d H:i:s");
			$comm_sub_time = $comment->subtime;
			$timestamp = strtotime($now_time)-strtotime($comm_sub_time);
		
			$str_time = "";
			if($timestamp < 0) {
				$str_time = $timestamp;
			} else if ($timestamp < 60) { //
				$str_time = $timestamp . "秒前";
			} else if ($timestamp < 3600) {
				$str_time = floor($timestamp / 60) . "分钟前";
			} else if($timestamp < 86400) {
				$str_time = floor($timestamp / 3600) . "小时前";
			} else if($timestamp < 259200){ // 3天
				$str_time = floor($timestamp / 86400) . "天前";
			} else {
				$str_time = "3天以前";
			}
				
			$comment->subtime = $str_time; // 距离现在过了多久
			$comment->user = $user_info[0];
		}
		return $comm_list;
	}
}

?>
