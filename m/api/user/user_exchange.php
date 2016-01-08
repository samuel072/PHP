<?php

require_once(ykfile("source/user_service.php"));

if(!unserialize($_SESSION['current_user'])->uuid){
	
	echo json_encode(array(
		"status" => 100,
		"message" => "亲，请您先登录！"
	));
	
	return ;
}
$json_params = json_decode(file_get_contents("php://input"));

$user_id = unserialize($_SESSION['current_user'])->uuid;
$com_id = $json_params->com_id;
$mobile = $json_params->mobile;
$address = $json_params->address;
$name = $json_params->name;

$usrv = new UserService($user_id);
$result = $usrv->exchange_commodity($com_id, $mobile, $address, $name);

$status = ERR_INTERNAL;
$message = "内部错误";
$user = new UserModel();

if($result == ERR_INTERNAL) {
	$status = 1;
	$message = "兑换系统出现错误！";
}else if($result == GOOD_IS_ZERO) { // 商品已经兑换完啦
	$status = 1;
	$message = "亲，该商品已经被兑换完啦";
	
}else if($result == USER_ERR_SCORE_NOT_ENOUGH) { // 用户的积分不够
	$status = 1;
	$message = "亲，您的积分不够兑换这件商品";
}else {
	$status = 0;
	$message = "亲，兑换成功";
}
echo json_encode(array(
	"user" => $usrv->get_current(),
	"status" => $status,
	"message" => $message,
));

?>
