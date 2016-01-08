<?php
// APP 的听我说的 一级页面展示的数据

require_once("../config.php");
require_once(ykfile("source/talk_service.php"));

header("application/json;charset=utf-8");

$next_id = 0;
$count = 4;
	
$talkSer = new TalkService();
$talk_list = $talkSer->get_talk_all(@$tag_id, $next_id, $count, STAGE_INDEX);

if($talk_list != 1000 && !empty($talk_list)) {
	$json_array = array("message"=>"获取数据成功", "status"=>1, "data" => $talk_list);
	echo json_encode($json_array);
} else {
    $json_array = array("message"=>"没有更多的数据", "status"=>0);
    echo json_encode($json_array);
}

?>
