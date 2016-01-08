<?php

require_once(ykfile("source/dbtables/comment_table.php"));
require_once(ykfile("source/user_service.php"));
require_once(ykfile("source/score_service.php"));
$json_param = json_decode(file_get_contents("php://input"));
$user_id = $json_param->user_id;
$act_id = $json_param->act_id;
$detail = $json_param->detail;

$comment = new CommentModel();
$comment->user->uuid = $user_id;
$comment->activity->id = $act_id;
$comment->detail = $detail;

$table = new CommentTable();
$rcode = $table->insert_comment($comment);
$message = "";
if(!$rcode) {
	$message = "评论失败";	
} else {
	$comm = $table->get_by_id($rcode);
	
	$userModule = new UserModule(@$user_id);
	date_default_timezone_set("Asia/Shanghai");
	
	$user_info = $userModule->get_by_id($comm->user->uuid);
	$scoreSer = new ScoreService();
	$rule_list = $scoreSer->apply_rule($user_info, GET_SCORE, ScoreModule::point_comment);
	file_put_contents("/tmp/yike.log","rule_liist --->".$rule_list, FILE_APPEND);
	if($rule_list) {
		$message = "";
		foreach($rule_list as $rule) {
			$msg = $rule->title." + ".$rule->amount;
			$message[] = $msg;
		}
		$user_info = $userModule->get_by_id($comm->user->uuid);
	}

	$now_time = date("Y-m-d H:i:s");
	$comm_sub_time = $comm->subtime;
	$timestamp = strtotime($now_time)-strtotime($comm_sub_time);

	$str_time = "";
	if($timestamp < 0) {
		$str_time = 0;
	} else if ($timestamp < 60) {
		$str_time = $timestamp."秒前";
	} else if ($timestamp < 3600) {
		$str_time = floor($timestamp / 60) . "分钟前";
	} else if($timestamp < 86400) {
		$str_time = floor($timestamp/3600) . "小时前";
	} else if($timestamp < 259200) { // 3天
		$str_time = floor($timestamp / 86400) . "天前";
	} else {
		$str_time = "3天以前";
	}
		
	$comm->subtime = $str_time; // 距离现在过了多久
	$comm->user = $user_info[0];

    $rcode = 0;
}


echo json_encode(array(
	"comment" => $comm,
	"status" => $rcode,
	"message" => $message));
?>
