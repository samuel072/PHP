<?php

//获取所有的参数值
$json_params = json_decode(file_get_contents("php://input"));
$uuid = $json_params->userid;
$oldpassword = $json_params->oldpassword;
$newpassword = $json_params->newpassword;

// 根据uuid 查询得到当前用户的信息
//查询到 修改密码
//否则删除
$userService = new UserService(unserialize($_SESSION['current_user'])->uuid);
$user_info = $userService->update_user_pwd($uuid, $oldpassword, $newpassword);

if($user_info == 1000) { // 新旧密码是一样的
	echo json_encode(array("status" => 1, "message" => "亲，新老密码是一样的哦"));
}else if($user_info == 0) { // 修改失败
	echo json_encode(array("status" => 1, "message" => "亲，系统繁忙，稍后再试哟"));
}else { // success
	unset($_SESSION['current_user']);
	
	$_SESSION['current_user'] = serialize($user_info);
	echo json_encode(array("status"=>0, "message"=>"亲，修改成功！"));
}
?>
