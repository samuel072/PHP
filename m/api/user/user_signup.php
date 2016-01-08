<?php
/**
*	@author han
* 注册
*
*/
require_once(ykfile("source/score_service.php"));
require_once(ykfile("source/modules/score_module.php"));

$json_data = file_get_contents("php://input");
$json_param = json_decode($json_data);
	
$mobile = $json_param->mobile;
$nickname = $json_param->nickname;
$password = $json_param->password;
$verify_code = $json_param->verify_code;

// 根据手机号码查询服务器端发送的verify_code  对比是否是一样的
$userService = new UserService(@$user_id);
$id = $userService->register($mobile, $password, $nickname);
if($id) {
	$user_info = $userService->get_by_id($id);
	if(!empty($user_info)) {
		$scoSer = new ScoreService();
		$rule_list = $scoSer->apply_rule($user_info, GET_SCORE, ScoreModule::point_signup);
		
		$user_info = $userService->get_by_uuid($user_info->uuid);
		unset($_SESSION['current_user']); // 成功登陆 干掉session中关于前一个用户信息
		$_SESSION['current_user'] = serialize($user_info); // 装载新的用户信息
		
		$message = "";
		foreach($rule_list as $rule) {
			$msg = $rule->title." + ".$rule->amount;
			$message[] = $msg;
		}
	
		$json_array = array("message"=>"success", "status"=>0, "profile" => $user_info);
		echo json_encode($json_array);
	}
} else {
	$json_array = array("message"=>"用户名已被注册！", "status"=>"1", "profile"=>array());
	echo json_encode($json_array);
}

?>
