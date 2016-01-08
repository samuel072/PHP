<?php
require_once(ykfile("source/model/activity_model.php"));
require_once(ykfile("source/model/user_model.php"));
require_once(ykfile('source/activity_service.php'));

$param = json_decode(file_get_contents('php://input'));

$state = $param->state ? $param->state :  ActivityModel::state_published;
$param->state = $state;

$user = new UserModel();
$user->uuid = unserialize($_SESSION['current_user'])->uuid;
$param->author = $user;

date_default_timezone_set("Asia/Shanghai");
$now_time = date("Y-m-d H:i:s");
$param->modify_time = $now_time;

$param->isdelete = 0;

$param->longitude = 0;
$param->latitude = 0;		

if(!$param->position) {
  $param->position = 0;
}

$actsrv = new ActivityService();
$result = $actsrv->save_activity($param);

$status = NULL;
$message = NULL;

if($result !== false) {
	$status = 0;
	$message = "发布成功,请等待审核";
	$act = $result;
} else {
	$status = ERR_INTERNAL;
	$message = "发布失败";
	$act = $param;
}

echo json_encode(array(
	"status" => $status,
	"message" => $message,
	"activity" => $act
));

?>
