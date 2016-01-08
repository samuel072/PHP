<?php
//  审核发布信息  0：  审核   1：驳回     2：发布
require_once(ykfile("source/activity_service.php"));

$state = $_GET['state'];
$act_id = $_GET['act_id'];
$reject_message = $_GET['reject'];

$actSer = new ActivityService();

$result = $actSer->set_act_state($act_id, $state, $reject_message);

$status = 0;
$message = "";
if($result) {
	$statue = 0;
	$message = "success";
} else {
	$status = 1;
	$message = "fail";
}

echo json_encode(array("status"=>$status, "message"=>$message));
?>
