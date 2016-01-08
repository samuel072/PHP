<?php
require_once("../config.php");
require_once(ykfile("source/activity_service.php"));

header("application/json;charset=utf-8");
	
$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 1000) {
	$count = 0;
}
$tag_id = $_GET['tag'];

$activityService = new ActivityService();
$act_list = $activityService->get_all($tag_id, $next_id, $count, STAGE_INDEX);

foreach ($act_list as $act) {
	$start_time = date("Y-m-d H:i", strtotime($act->start_time));
	$act->start_time = $start_time;
	$end_time = date("m-d H:i", strtotime($act->end_time));
	$act->end_time = $end_time;
}


$json_array = array("activities" => $act_list);
echo json_encode($json_array);

	
?>
