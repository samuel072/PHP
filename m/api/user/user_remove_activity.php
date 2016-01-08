<?php

$act_id = intval($_GET['act_id']);
$type = intval($_GET['type']);
$is_delete = intval($_GET['is_delete']);

if($type == 0) { // 演讲
	$talkSer = new TalkService();
	$ret = $talkSer->remove_talk($act_id, $is_delete);
}else if($type == 1) { // 沙龙活动
	$acticitySer = new ActivityService();
	$ret = $acticitySer->remove_activity($act_id, $is_delete);
}else { //mooc
	$moocSer = new MoocService();
	$ret = $moocSer->remove_mooc($act_id, $is_delete);
}

if($ret == 0) {
	echo json_encode(array("status" => 0,
						"message" => "删除成功"));
} else {
	echo json_encode(array("status" => $ret,
						"message" => "删除失败"));
}

?>
