<?php
/**
*  @author:  han
*  登陆
*/
require_once(ykfile("source/score_service.php"));
require_once(ykfile("source/modules/score_module.php"));

//获取所有的参数值
$json_params = json_decode(file_get_contents("php://input"));
$mobile = $json_params->mobile;
$password = $json_params->password;  

// 根据手机号码和密码查询数据
$userService = new UserService(@$user_id);
$user_info = $userService->get_by_mobile_pass($mobile,$password);

if($user_info != NULL) {
	
	$scoSer = new ScoreService();
	$rule_list = $scoSer->apply_rule($user_info, GET_SCORE, ScoreModule::point_signin);
	$message = "";
	foreach($rule_list as $rule) {
		$msg = $rule->title." + ".$rule->amount;
		$message[] = $msg;
	}
	
	$user_info = $userService->get_by_uuid($user_info->uuid);
	
	unset($_SESSION['current_user']); // 成功登陆 干掉session中关于前一个用户信息
	$_SESSION['current_user'] = serialize($user_info); // 装载新的用户信息
	
	$json_array = array("status"=>"0","message"=>$message,"profile"=>$user_info);
	echo json_encode($json_array);
} else {
	$json_array = array("status"=>"1","message"=>"亲，登录失败！");
	echo json_encode($json_array);
}
?>