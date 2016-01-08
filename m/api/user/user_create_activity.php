<?php

require_once(ykfile('source/activity_service.php'));

$param = json_decode(file_get_contents('php://input'));
$act = $param;

$actsrv = new ActivityService();
$result = $actsrv->create_activity($act);

$status = NULL;
$message = NULL;


if($result) {
	$status = 0;
	$message = "发布成功,请等待审核";
	$act = $result;
} else {
	$status = ERR_INTERNAL;
	$message = "发布失败";
}

echo json_encode(array(
	"status" => $status,
	"message" => $message,
	"activity" => $act
));

?>
