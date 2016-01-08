<?php 
// 修改用户名称
require_once(ykfile("source/model/user_model.php"));

$json_params = json_decode(file_get_contents("php://input"));

$name = $json_params->name;
$uuid = unserialize($_SESSION['current_user'])->uuid;

$userSer = new UserService($uuid);
$user_info = $userSer->update_profile($uuid, $name);

if($user_info == DB_ERR_NO_DATA) { // 没有查询到该数据
	$set_profile = array("status"=>1, "message"=>"亲，该用户不存在！");
	echo json_encode($set_profile);	
}else if($user_info == NICK_NAME_IS_ALREADY) {
	$set_profile = array("status"=>1, "message"=>"亲，昵称已存在！");
	echo json_encode($set_profile);	
}else {
	unset($_SESSION['current_user']);
	$_SESSION['current_user'] = serialize($user_info[0]);

	$set_profile = array("status"=>0, "message"=>"亲，修改成功！");
	echo json_encode($set_profile);	
}
?>
