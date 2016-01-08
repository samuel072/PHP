<?php

$param = json_decode(file_get_contents('php://input'));

$talkerSer = new TalkerService();
$result = $talkerSer->save_talker($param);

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
