<?php
require_once('../config.php');
require_once(ykfile('source/commodity_service.php'));

$params = json_decode(file_get_contents('php://input'));

$comm_ser = new CommodityService();
$result = $comm_ser->save_commodity($params);

$status = NULL;
$message = NULL;

if($result != false) {
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
