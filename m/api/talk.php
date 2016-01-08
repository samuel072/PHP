<?php
require_once("../config.php");
require_once(ykfile("source/talk_service.php"));

header("application/json;charset=utf-8");
	
$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 1000) {
	$count = 10;
}
	
$talkService = new TalkService();
$talk_list = $talkService->get_talk_all(@$tag_id, $next_id, $count, STAGE_INDEX);

if($talk_list != 1000 && !empty($talk_list)) {
	$json_array = array("activities" => $talk_list);
	echo json_encode($json_array);
} else {

}

?>
