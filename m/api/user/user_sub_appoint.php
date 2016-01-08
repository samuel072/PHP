<?php
header("Content-type: text/html; charset=utf-8");
require_once(ykfile("source/model/appointment_model.php"));
require_once(ykfile("source/score_service.php"));

$json_params = json_decode(file_get_contents("php://input"));

$appoint = new AppointmentModel();
$appoint->user->uuid = $json_params->user->uuid;
$appoint->name = $json_params->user->name;
$appoint->mobile = $json_params->user->mobile;
$appoint->com_address = $json_params->user->com_address;
$appoint->activity->id = $json_params->act_id;
$code = $json_params->code;  // 数字验证码

$appoint->state = 0;
$userService = new UserService(@$appoint->user->uuid);



$status = ERR_INTERNAL;
$message = "内部错误";

$user_id = $appoint->user->uuid;

	//  先查询  当同一个手机和同一个活动id 查询得到数据时 告诉他 你已经预约了
if(!empty($user_id)) { // 已经登陆
	if($userService->select_appoint_userId($appoint->activity->id, $user_id)) {
		$status = 1;
		$message = "您已经报过名了,请到个人中心查看！";
		echo json_encode(array(
			"status"=>$status,
			"message"=>$message
		));	
	}else if($userService->insert_appoint($appoint, $code)){
		$status = 0;
		$message = "预约成功";
		
		$user_info = $userService->get_by_uuid($appoint->user->uuid);
		$scoSer = new ScoreService();
		$rule_list = $scoSer->apply_rule($user_info, GET_SCORE, ScoreModule::point_appoint);
		if($rule_list){
			$message_array = "";
			foreach($rule_list as $rule) {
				$msg = $rule->title." + ".$rule->amount;
				$message_array[] = $msg;
			}
			
		}
		
		echo json_encode(array(
		"status" => $status,
		"message" => $message,
		"message_array"=>$message_array));
	}
}else { //未登陆	  先查询  当同一个手机和同一个活动id 查询得到数据时 告诉他 你已经预约了
	if($userService->select_appoint_actId($appoint->activity->id, $appoint->mobile)){
		$status = 1;
		$message = "您已经报过名了,请到个人中心查看！";
		echo json_encode(array(
			"status"=>$status,
			"message"=>$message
		));
	}else if($userService->insert_appoint($appoint, $code)) {
		$status = 0;
		$message = "预约成功";
		echo json_encode(array(
		"status" => $status,
		"message" => $message));
	}
}




?>
