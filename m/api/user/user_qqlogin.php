<?php
require_once(ykfile("source/user_service.php"));
require_once(ykfile("source/score_service.php"));
require_once(ykfile("source/model/user_model.php"));
require_once(ykfile("source/qq_reader_service.php"));

$json_params = json_decode(file_get_contents("php://input"));

$openid = $json_params->openid;
$nickname = $json_params->nickname;
$gender = $json_params->gender;
$avatar = $json_params->avatar;

file_put_contents("/tmp/yike.log","avatar===>".$avatar."\n", FILE_APPEND);

$user_model = new UserModel();
$user_model->name = $nickname;
$user_model->sex = $gender;
$user_model->avatar = $avatar;

$userSer = new UserService(@$uuid);
$type = UserModel::QQ_LOGIN_USER;
$user_info = $userSer->save_user_part($user_model, $openid, $type);
if($user_info) {
	$qq_reader_ser = new QQReaderService();
	$qq_reader_info = $qq_reader_ser->check_open_id($openid);
	
	$scoSer = new ScoreService();
	if($qq_reader_info) {  // 登陆
		$status = ScoreModule::point_signin;
	}else {  // 注册
		$status = ScoreModule::point_signup;
	}
	$rule_list = $scoSer->apply_rule($user_info, GET_SCORE, $status);
	$message = "";
	foreach($rule_list as $rule) {
		$msg = $rule->title." + ".$rule->amount;
		$message[] = $msg;
	}
	$user_info = $userSer->get_by_uuid($user_info->uuid);
	
	unset($_SESSION['current_user']);
	$_SESSION['current_user'] = serialize($user_info);
	echo json_encode(array(
		"status" => "0",
		"message" => $message
	));	
	
}else {
	echo json_encode(array(
		"status"=>"0",
		"message"=>"fail"
	));
}




?>

