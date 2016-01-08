<?php
// 重置密码
$json_param = json_decode(file_get_contents("php://input"));
	
$mobile = $json_param->mobile;
$password = $json_param->password;
$verify_code = $json_param->verify_code;

$user_id = unserialize($_SESSION['current_user'])->uuid;
// 根据手机号码查询服务器端发送的verify_code  对比是否是一样的
$userService = new UserService(@$user_id);

// 修改密码
$user_info = $userService->reset_user_pwd($uuid, $mobile, $password);
if(!$user_info){
	$json_array = array("status"=>"1", "message"=>"亲，该用户不存在！");
	echo json_encode($json_array);
}else {
	unset($_SESSION['current_user']); // 成功登陆 干掉session中关于前一个用户信息
	$_SESSION['current_user'] = serialize($user_info); // 装载新的用户信息
	
	echo json_encode(array("status"=>0, "message"=>"亲，重置密码成功！"));
}

?>
