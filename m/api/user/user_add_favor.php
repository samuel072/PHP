<?php
require_once(ykfile('source/score_service.php'));
require_once(ykfile('source/user_service.php'));


$user_id = $_GET['user_id'];
$act_id = $_GET['act_id'];
$type = $_GET['type'];

$usrv = new UserService($user_id);
$ret = $usrv->add_favor($act_id, $user_id, $type);

if($ret == ACTIVITY_IS_ALREADY) {
	$message ="亲，您已经收藏过！";
	$status = 1;
	$message_array = "";
}else if($ret) {  // 添加成功
	// 给积分
	$user_info = $usrv->get_by_uuid($user_id);

	$scoSer = new ScoreService();
	$message = "";
	if($type == 0){
		$score_point = ScoreModule::point_like;
		$message = "喜欢+1";
	}else {
		$score_point = ScoreModule::point_collect;
		$message = "收藏+1";
	}
	$rule_list = $scoSer->apply_rule($user_info, GET_SCORE, $score_point);
	$message_array = "";
	
	if($rule_list) {
		foreach($rule_list as $rule) {
			$msg = $rule->title." + ".$rule->amount;
			$message_array[] = $msg;
		}
	}
	
	
	$user_info = $usrv->get_by_uuid($user_id);
	
	unset($_SESSION['current_user']); // 成功登陆 干掉session中关于前一个用户信息
	$_SESSION['current_user'] = serialize($user_info); // 装载新的用户信息
	
	$status = 0;
}

echo json_encode(array(
	"status" => $status,
	"message" => $message,
	"message_array"=>$message_array
));

?>
