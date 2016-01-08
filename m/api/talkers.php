<?php
require_once("../config.php");
require_once(ykfile("source/talker_service.php"));
header("Content-type:application/json;charset=utf-8");
session_start();

$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 1000) {
	$count = 10;
}



	
$talkersService = new TalkerService();
$talkers = $talkersService->get_all($next_id, $count);

if(!empty($talkers)){
	$json_array = array("status"=>"0", "message"=>"success", "talkers"=>$talkers);
	echo json_encode($json_array);
} else {
	$json_array = array("status"=>"1", "message"=>"没有更多的数据");
	echo json_encode($json_array);
}
	
?>
